<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PaymentSuccessController extends Controller
{
    /* Displaying a payment success page when payment is successed */
    public function index(){
        return view('pages.success');
    }
}
