<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Str;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number', 'user_id', 'product_id','price','status','payment_intent_id'
    ];
    /* user table */
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    /* product table */
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    /* inserting a new order into orders table */
    public static function createOrder($orderInfo){
        DB::beginTransaction();
        try{
            Order::create([
                'order_number'=>$orderInfo['orderNumber'],
                'user_id'=>$orderInfo['userId'],
                'product_id'=>$orderInfo['productId'],
                'price'=>$orderInfo['price'],
                'status'=>$orderInfo['status'],
                'payment_intent_id'=>$orderInfo['paymentIntentId']
            ]);
            DB::commit();
            return 1;
        }
        catch(Exception $ex) {
            DB::rollback();
            return 0;
        }
    }
    /* Generating a new order number */
    public static function generateOrderNum(){
        $orderIns=new Order;
        $orderTableSchemaInfo = DB::select("SHOW TABLE STATUS LIKE '".$orderIns->table."'");
        $newOrderId=$orderTableSchemaInfo[0]->Auto_increment;
        $length = Str::length($newOrderId);
        $currentTimeValue = \Carbon\Carbon::now()->timestamp;
        $getOrderNumber='NGG:'.$currentTimeValue.'-';
        if($length<5){
            for($i=1; $i<5; $i++){
                $getOrderNumber .='0';
            }
        }
        return $getOrderNumber.$newOrderId;
    }
}
