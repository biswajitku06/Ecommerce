<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='carts';
    protected $fillable=[
        'product_id','product_name','product_code','product_color','size','price','quantity','user_email','session_id'
    ];
}
