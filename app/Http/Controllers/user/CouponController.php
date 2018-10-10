<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use Dotenv\Validator;
use Validate;

class CouponController extends Controller
{
    public function addCoupon(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
//            $rules=[
//                'coupon_code'=>'required| regex:/(^([a-zA-Z]+)(\d+)?$)/u'
//            ];
//            $messages=[
//                'coupon_code'=>'Must be a Alpha Numeric value'
//            ];
//            $this->validate($request,$rules,$messages);

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
        if($request->isMethod('post')){
            if(empty($request->status))
                $status=0;
            else
                $status=2;
            $data=[
                'coupon_code'=>$request->coupon_code,
                'amount'=>$request->amount,
                'amount_type'=>$request->amount_type,
                'expiry_date'=>$request->expiry_date,
                'status'=>$status
            ];
            $updatecoupon=Coupon::where('id',$id)->update($data);
            if($updatecoupon){
                return redirect()->back()->with(['success'=>'Coupon Updated successfully']);
            }else{
                return redirect()->back()->with(['dismiss'=>'Coupon not Updated successfully']);
            }

        }
        return view('pages.admin.coupon.editcoupon')->with(compact('coupon'));
    }

    public function deleteCoupon($id=null){
        if(isset($id) && is_numeric($id)){
            $deletecoupon=Coupon::where('id',$id)->delete();
            if($deletecoupon){
                return redirect()->back()->with(['success'=>'Coupon Deleted successfully']);
            }
        }
    }
}
