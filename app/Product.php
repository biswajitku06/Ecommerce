<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable=[
        'category_id','product_name','product_code','product_color','description','price','image'
    ];

    public function attribute()
    {
       return $this->hasMany('App\Products_attributes','product_id');
    }

    public function images()
    {
        return $this->hasMany('App\Product_Image','product_id');
    }
}
