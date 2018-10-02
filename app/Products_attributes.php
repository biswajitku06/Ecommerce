<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_attributes extends Model
{
    protected $table='products_attributes';
    protected $fillable=[
        'product_id','sku','size','price','stock'
    ];

//    public function product()
//    {
//        return $this->belongsTo('App\Product','id');
//    }
}
