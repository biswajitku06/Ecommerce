@extends('userlayout.design')

@section('content')
    @include('userlayout.message')
    <section id="form" style ="margin-top: 20px"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Update account</h2>
                        <form action="{{route('account')}}" id="accountForm" name="accountForm" method="post">
                            {{csrf_field()}}
                            <input type="text" placeholder="Username" id="username" name="username" value="{{Auth::user()->username}}" />
                            <input type="text" placeholder="address" id="address" name="address" value="{{Auth::user()->address}}"/>
                            <input type="text" placeholder="city" id="city" name="city" value="{{Auth::user()->city}}"/>
                            <input type="text" placeholder="state" id="state" name="state" value="{{Auth::user()->state}}"/>
                            <select name="country" id="country" >
                                <option value="0">select country</option>
                                @foreach($country as $country)
                                    <option value="{{$country->country_name}}" @if($country->country_name==Auth::user()->country) selected @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                            <input style="margin-top:10px" type="text" placeholder="pincode" id="piincode" name="pincode" value="{{Auth::user()->pincode}}"/>
                            <input type="text" placeholder="mobile" id="mobile" name="mobile" value="{{Auth::user()->mobile}}"/>
                            <button type="submit" class="btn btn-default">update</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Update Password</h2>
                        <form id="updatepasswordForm" action="{{route('update-password')}}" method="post">
                            {{csrf_field()}}
                            <input id="currentpassword" name="currentpassword" type="password" placeholder="current password"/>
                            <span id="chkpwd"></span>
                            <input id="newpassword" name="newpassword" type="password" placeholder="new password"/>
                            <input id="confirmpassword" name="confirmpassword" type="password" placeholder="confirm password"/>
                            <button type="submit" class="btn btn-default">update password</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection


