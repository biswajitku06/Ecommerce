<?php

namespace App\Http\Controllers\user;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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

    public function updateaccount(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();

//            if(empty($data['address'])){
//                $data['address']='';
//            }
//            if(empty($data['city'])){
//                $data['city']='';
//            }
//            if(empty($data['state'])){
//                $data['state']='';
//            }
//            if(empty($data['country'])){
//                $data['country']='';
//            }
//            if(empty($data['pincode'])){
//                $data['pincode']='';
//            }
//            if(empty($data['mobile'])){
//                $data['mobile']='';
//            }

            $user=User::find(Auth::user()->id);
            if(empty($user->username)){
                return redirect()->back()->with(['error'=>'please enter your name']);
            }

            $user->address=$data['address'];
            $user->city=$data['city'];
            $user->state=$data['state'];
            $user->country=$data['country'];
            $user->pincode=$data['pincode'];
            $user->mobile=$data['mobile'];

            $user->save();

            return redirect()->back()->with(['success'=>'Account Details has been updated successfully']);

        }
        $country=Country::get();
        return view('pages.user.account')->with(compact('country'));
    }

    public function checkPassword(Request $request){
        $data=$request->all();
        $currentpassword=$data['cpass'];
        $check_password = Auth::user()->password;
        if (Hash::check($currentpassword, $check_password)) {
            return response()->json('true');
        } else {
            return response()->json('false');
        }
    }

    public function updatePassword(Request $request){
//        if($request->isMethod('post')){
//            $id=Auth::user()->id;
//            $data=[
//                'password'=>bcrypt($request->newpassword)
//            ];
//            $updatepass=User::where('id',$id)->update($data);
//            if($updatepass)
//                return redirect()->back()->with(['success'=>"password Updated successfully!"]);
//        }

        if($request->isMethod('post')){
            $current_password=$request->currentpassword;
            $check_password=Auth::user()->password;

            if(Hash::check($current_password,$check_password)){
                $new_password=bcrypt($request->newpassword);
                $update=User::where('email','=',Auth::user()->email)->update(['password'=>$new_password]);
                if($update){
                    return redirect()->back()->with(['success'=>'Password Updated Successfully']);
                }else{
                    return redirect()->back()->with(['dismiss'=>'Password not Updated Successfully']);
                }
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontsession');
        return redirect('index');
    }
}
