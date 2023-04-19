<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* enabling a ui boostrap authentication  */
Auth::routes();

Route::group(['middleware'=>['auth']],function(){
    /* Routing for a home page */
    Route::get('/', function () {
        return redirect('/products');
    });
    /* Routing for a product list */
    Route::get('/products', 'ProductController@index')->name('productList');
    /* Routing for a checkout routes */
    Route::get('/checkout/{id}', 'ProductController@checkout')->name('productCheckout');
    /* Routing for a get stripe intent key */
    Route::post('/getSetUpIntent', 'PaymentController@getSetUpIntent')->name('getSetUpIntentValue');
    /* Routing for a stripe payment process */
    Route::post('/purchase', 'PaymentController@paymentProcess')->name('paymentProcess');
    /* Routing for a payment success page */
    Route::get('/paymentSuccess', 'PaymentSuccessController@index')->name('paymentSuccess');
    /* Routing for a  my-orders management page */
    Route::get('/my-orders', 'OrderController@index')->name('my-orders');
});
