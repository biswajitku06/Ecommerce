<?php

namespace App\Http\Controllers\user;

use App\Category;
use App\Products_attributes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_Image;
use App\Cart;
use Illuminate\Support\Facades\Session;
use DB;

class HomeController extends Controller
{
    public function home()
    {
        //ascending order

        $productAll=Product::where('status',2)->get();

        //echo '<pre>', print_r($productAll);die;
        //Descending order

        $productAll=Product::orderBy('id','DESC')->where(['status'=>2])->get();
//        //Random order
//
        $productAll=Product::inRandomOrder()->where(['status'=>2])->get();

        //get all categories and sub categories

        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
       //A $sub_categories=Category::where('parent_id','!=',0)->get();

        return view('pages.user.home')->with(compact('productAll','categories'));
    }

    public function getproductlist($url=null)
    {
        $countcategory=Category::where(['url'=>$url])->count();
        if($countcategory==0){
            return view('pages.user.404');
        }
        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
        $category=Category::where(['url'=>$url])->first();
        if($category->parent_id==0){
            $subcategory=Category::where(['parent_id'=>$category->id])->get();
            foreach($subcategory as $subcat){
                $cat_ids[]=$subcat->id;
            }
            if(isset($cat_ids)){
                $productAll=Product::whereIn('category_id',$cat_ids)->where(['status'=>2])->get();
            }else{
                return redirect()->back()->with(['dismiss'=>'Sorry This item is not available']);
            }

        }else{
            $productAll=Product::where(['category_id'=>$category->id])->where(['status'=>2])->get();
        }

        return view('pages.user.listing_product')->with(compact('categories','productAll','category'));
    }

    public function productdetails($id){

        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
        $productdetails=Product::with('attribute')->where(['id'=>$id])->where(['status'=>2])->first();
        $relatedproducts=Product::where('id','!=',$id)->where(['category_id'=>$productdetails->category_id])->where(['status'=>2])->get();
        $productimage=Product_Image::where('product_id',$id)->get();
        $totalstock=Products_attributes::where(['product_id'=>$id])->sum('stock');
        return view('pages.user.product_detail')->with(compact('categories','productdetails','productimage','totalstock','relatedproducts'));

    }

    public function getProductPrice(Request $request)
    {
        $data=$request->all();
        $proarr=explode('-',$data['idvalue']);
        $productattribute=Products_attributes::where(['product_id'=>$proarr[0],'size'=>$proarr[1]])->first();
        return response()->json($productattribute);

    }

    public function addToCart(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            if(empty($request->user_email)){
                $request->user_email='';
            }
            $session_id=Session::get('session_id');
            if(empty($session_id)){
                $session_id=str_random(40);
                Session::put('session_id',$session_id);
            }

            $cart=new Cart;
            $cart->product_id=$request->product_id;
            $cart->product_name=$request->product_name;
            $cart->product_code=$request->product_code;
            $cart->product_color=$request->product_color;

            //for explode the size because size will be the only string not number
            $size=$request->size;
            $divide=explode('-',$size);
            $cart->size=$divide[1];

            $cart->price=$request->price;
            $cart->quantity=$request->quantity;
            $cart->user_email=$request->user_email;
            $cart->session_id=$session_id;

            $cart->save();

            return redirect('cart')->with(['success'=>'Product successfully added in the cart']);
        }
    }

    public function cart()
    {
        $session_id=Session::get('session_id');
        $userCart=Cart::where('session_id',$session_id)->get();
        foreach($userCart as $key=> $product){
            $image=Product::where('id',$product->product_id)->first();
            $userCart[$key]->image=$image->image;
        }
        return view('pages.user.cart')->with(compact('userCart'));
    }

    public function deleteItem($id){
        if(isset($id) && is_numeric($id)){
            $deleteitem=Cart::where('id',$id)->delete();
            if($deleteitem){
                return redirect()->back()->with(['dismiss'=>'item deleted from the cart']);
            }
        }
    }

    public function incrementQuantity($id=null)
    {
        if (isset($id) && is_numeric($id)) {
            $cartdetails = Cart::where('id', $id)->first();
            $proattdet = Products_attributes::where(['product_id' => $cartdetails->product_id, 'size' => $cartdetails->size])->first();

            if ($cartdetails->quantity < $proattdet->stock) {
                Cart::where('id', $id)->increment('quantity', 1);
                return redirect('cart')->with(['success' => 'Quantity has been updated successfully!']);
            } else {
                return redirect('cart')->with(['error' => 'Quantity is not available!']);
            }
        }
    }


    public function decrementQuantity($id=null){
        if(isset($id) && is_numeric($id)){
            $updateQunatity=Cart::where('id',$id)->increment('quantity',-1);
            if($updateQunatity){
                return redirect('cart')->with(['success'=>'Quantity has been updated successfully!']);
            }
        }

    }

    public function updatePrice($id){
        //$data=$request->all();
        $item=Cart::where('id',$id)->first();
        return response()->json($item);
    }

}
