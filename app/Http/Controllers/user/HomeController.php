<?php

namespace App\Http\Controllers\user;

use App\Category;
use App\Products_attributes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class HomeController extends Controller
{
    public function home()
    {
        //ascending order

        $productAll=Product::all();

        //echo '<pre>', print_r($productAll);die;
        //Descending order

        $productAll=Product::orderBy('id','DESC')->get();
//        //Random order
//
        $productAll=Product::inRandomOrder()->get();

        //get all categories and sub categories

        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
       //A $sub_categories=Category::where('parent_id','!=',0)->get();

        return view('pages.user.home')->with(compact('productAll','categories'));
    }

    public function getproductlist($url=null)
    {
        $countcategory=Category::where(['url'=>$url])->count();
        if($countcategory==0){
            abort(404);
        }
        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
        $category=Category::where(['url'=>$url])->first();
        if($category->parent_id==0){
            $subcategory=Category::where(['parent_id'=>$category->id])->get();
            foreach($subcategory as $subcat){
                $cat_ids[]=$subcat->id;
            }
            dd($cat_ids);
            $productAll=Product::whereIn('category_id',$cat_ids)->get();
        }else{
            $productAll=Product::where(['category_id'=>$category->id])->get();
        }

        return view('pages.user.listing_product')->with(compact('categories','productAll','category'));
    }

}
