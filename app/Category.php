<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";
    protected $fillable=[
        'parent_id','name','description','url'
    ];

    public function categories()
    {
        return $this->hasMany('App\Category','parent_id');
    }
}
