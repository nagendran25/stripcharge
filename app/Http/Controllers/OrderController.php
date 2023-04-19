<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    /* My-order page */
    public function index(){
        $loggedUser=Auth::id();
        $orders=Order::with('product')->whereHas('user', function($q) use($loggedUser){
            $q->where('user_id',$loggedUser);
        })->get();
        return view('orders.list',compact('orders'));
    }
}
