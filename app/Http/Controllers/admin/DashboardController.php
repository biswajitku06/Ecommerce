<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    public function showdashboard()
    {
        return view('pages.admin.dashboard');
    }

    public function showsettings()
    {
        return view('pages.admin.settings');
    }

    public function checkpass(Request $request)
    {

        $data = $request->all();

        $current_password = $data['current_pwd'];
        $check_password = Auth::user()->password;
        if (Hash::check($current_password, $check_password)) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updatePassword(Request $request)
    {
         if($request->isMethod('post')){
             $current_password=$request->cur_password;
             $check_password=Auth::user()->password;

             if(Hash::check($current_password,$check_password)){
                 $new_password=bcrypt($request->new_pwd);
                 $update=User::where('email','=',Auth::user()->email)->update(['password'=>$new_password]);
                 if($update){
                     return redirect()->back()->with(['success'=>'Password Updated Successfully']);
                 }else{
                     return redirect()->back()->with(['dismiss'=>'Password not Updated Successfully']);
                 }
             }
         }

    }
}
