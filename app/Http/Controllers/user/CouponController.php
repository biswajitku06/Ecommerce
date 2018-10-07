<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;

class CouponController extends Controller
{
    public function addCoupon(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            $coupon =new Coupon;
            $coupon->coupon_code=$data['coupon_code'];
            $coupon->amount=$data['amount'];
            $coupon->amount_type=$data['amount_type'];
            $coupon->expiry_date=$data['expiry_date'];
            if(empty($data['status'])){
                $coupon->status=0;
            }else{
                $coupon->status=2;
            }

            $coupon->save();

            return redirect()->back()->with(['success'=>'Coupon item inserted successfully']);
        }

        return view('pages.admin.coupon.add_coupon');
    }

    public function viewCoupon(){
        $coupons=Coupon::get();
        return view('pages.admin.coupon.viewcoupon')->with(compact('coupons'));
    }

    public function editCoupon(Request $request,$id=null){
        if(isset($id) && is_numeric($id)){
            $coupon=Coupon::where('id',$id)->first();
        }
        return view('pages.admin.coupon.editcoupon')->with(compact('coupon'));
    }
}
