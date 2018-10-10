@extends('userlayout.design')

@section('content')
    @include('userlayout.message')
    <section id="form" style ="margin-top: 20px"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{route('login')}}" id="loginForm" name="loginForm" method="post">
                            {{csrf_field()}}
                            <input type="email" placeholder="Email Address" id="email" name="email" />
                            <input type="password" placeholder="Enter your password" id="password" name="password" />
                            {{--<span>--}}
								{{--<input type="checkbox" class="checkbox">--}}
								{{--Keep me signed in--}}
							{{--</span>--}}
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form id="registerForm" action="{{route('register')}}" method="post">
                            {{csrf_field()}}
                            <input id="name" name="name" type="text" placeholder="Name"/>
                            <input id="email" name="email" type="email" placeholder="Email Address"/>
                            <input id="password" name="password" type="password" placeholder="Password"/>
                            <button type="submit" name="form" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->


@endsection


