<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Product;
use Auth;

class ProductController extends Controller
{
    /* Displaying all the products into grid view */
    public function index(){
        $products=Product::orderBy('id', 'desc')->paginate(9);
        return view('product.pgrid',compact('products'));
    }
    /* displaying a purchase form */
    public function checkout($pd_id){
        try {
            $pd_id=Crypt::decryptString($pd_id);
            $productInfo = Product::find($pd_id);
            return view('checkout.index',compact('productInfo'));
        } catch (DecryptException $e) {
            return redirect()->route('productList')->with('error','Product is invalid.');
        }
    }
}
