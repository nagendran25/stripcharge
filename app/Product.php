<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /* orders table */
    public function orders(){
        return $this->hasMany(Order::class,'product_id');
    }

    /* Get a product description only 140 characters */
    public function getDescriptionExcerptAttribute(){
        return  Str::limit($this->description,150,'...');
    }
}
