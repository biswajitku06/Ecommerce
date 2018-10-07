<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    protected $table='product__images';
    protected $fillable=[
        'product_id','image'
    ];
}
