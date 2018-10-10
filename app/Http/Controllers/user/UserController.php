<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function loginRegister()
    {
        return view('pages.user.login_register');
    }
    public function register(Request $request){

        if($request->isMethod('post')){
           $data=$request->all();
           $user = new User;
           $user->username=$data['name'];
           $user->email=$data['email'];
           $user->password=bcrypt($data['password']);
           $user->save();

           if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
               Session::put('frontsession',$data['email']);
               return redirect('cart');
           }
        }

    }

    public function check_email(Request $request){
        //$data=$request->all();
        $countemail=User::where('email',$request->email)->count();
        if($countemail>0)
            echo "false";
        else
            echo "true";
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                Session::put('frontsession',$request->email);
                return redirect('cart');
            }else{
                return redirect()->back()->with(['dismiss'=>'Email or password is invalid']);
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontsession');
        return redirect('index');
    }
}
