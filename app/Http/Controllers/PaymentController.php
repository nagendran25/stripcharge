<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\user;
use Auth;
use App\Product;
use App\Order;

class PaymentController extends Controller
{
    /* getting a user secrect id by from a stripe */
    public function getSetUpIntent(Request $request)
    {
        $requestData = $request->all();
        if($request->ajax()){
            $currentLoggedUserInfo=Auth::user();
            return response()->json(['status'=>'success','intent_id'=>$currentLoggedUserInfo->createSetupIntent()->client_secret]);
        }
        return response()->json(['status'=>'error','msg'=>'Invalid request.']);
    }
    /* Payment process method */
    public function paymentProcess(Request $request){
        if($request->isMethod('post')){
            $loggedUserDetail= Auth::user();

            /* Getting a stripe related request form checkout page */
            $paymentMethod = $request->payment_method;
            $productInfo = $request->productInfo;
            /* Checking a selected product is valid or not */
            try {
                $pid=Crypt::decryptString($productInfo);
                $productDetails = Product::find($pid);
            } catch (DecryptException $e) {
                return redirect()->route('productList')->with('error','Product is invalid.');
            }
            /* getting a delivery address from checkout page */
            $deliveryAddress1 = $request->shippingAddress1;
            $deliveryAddress2 = $request->shippingAddress2;
            $deliveryState = $request->shippingState;
            $deliveryCity = $request->shippingCity;
            $deliveryZipcode = $request->shippingZipcode;
            $deliveryCountry = $request->shippingCountry;
            $deliveryAddressInfo=['address'=>['line1'=>$deliveryAddress1,'line2'=>$deliveryAddress2,'postal_code'=>$deliveryZipcode,'city'=>$deliveryCity,'state'=>$deliveryState,'country'=>$deliveryCountry],'name'=>$loggedUserDetail->name];

            /* Processing a stripe payment */
            try {
                /* Checking a user is available in stripe otherwise creating a new user into stripe */
                if (is_null($loggedUserDetail->stripe_id)) {
                    $createUserOptions = [
                        'name' => $loggedUserDetail->name
                    ];
                    $loggedUserDetail->createOrGetStripeCustomer($createUserOptions);
                }

                /* Updating a default payment method in stripe for current logged user */
                $loggedUserDetail->updateDefaultPaymentMethod($paymentMethod);

                /*Charging a amount through a credit card using a stripe gateway*/
                $orderNumber=Order::generateOrderNum();
                $payment=$loggedUserDetail->charge($productDetails->price * 100, $paymentMethod,['off_session' => true,'description'=>$productDetails->description,"metadata" => ["orderNumber" => $orderNumber],['shipping'=>$deliveryAddressInfo]]);
                /* if payment is success to redirect a success page otherwise displaying a error message in the checkout page */
                if($payment->status=='succeeded'){
                    $orderDetails=[
                        'orderNumber'=>$orderNumber,
                        'userId'=>$loggedUserDetail->id,
                        'productId'=>$pid,
                        'price'=>$productDetails->price,
                        'status'=>$payment->status,
                        'paymentIntentId'=>$payment->id
                    ];
                    $newOrder=Order::createOrder($orderDetails);
                    if($newOrder==1){
                        return redirect()->route('paymentSuccess')->with('success','Your order has been placed successfully.');
                    }
                    return back()->with('error','Your order has been placed.But Something went wrong into a order storing process. Please contact FGG Team.');
                }
                return back()->with('error','Something went wrong in the payment process. Please try again later or contact to FGG team.');
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        }
        return back()->with('error','The request is invalid.');
    }
}
