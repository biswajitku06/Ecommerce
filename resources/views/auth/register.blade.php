<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <title>Matrix Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="{{asset('asset/dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <![endif]-->
</head>
<style>
    .has-danger{
        color:red;

    }
</style>
<body>


<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    @if (session('dismiss'))
        <div class="alert alert-dismiss alert-dismissable custom-success-box" style="margin: 15px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('dismiss') }}
        </div>
    @endif

    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div>
                <div class="text-center p-t-20 p-b-20">
                    <div class="control-group normal_text"> <h3 style="color:green">Registration Form</h3></div>
                </div>
                <!-- Form -->
                <form class="form-horizontal m-t-20" action="{{route('register')}}" method="post">
                    {{csrf_field()}}
                    <div class="row p-b-30">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend {{$errors->has('username')?'has-danger':''}}">
                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                                class="ti-user"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Username"
                                      name="username" aria-label="Username" aria-describedby="basic-addon1" >
                            </div>
                            <span class="has-danger">{{$errors->has('username')?$errors->first('username'):''}}</span>
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                                class="ti-email"></i></span>
                                </div>
                                <input type="email" class="form-control form-control-lg" placeholder="Email Address"
                                       aria-label="Email" name="email" aria-describedby="basic-addon1" >
                            </div>
                            <span class="has-danger">{{$errors->has('email')?$errors->first('email'):''}}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                                class="ti-pencil"></i></span>
                                </div>
                                <input type="password" class="form-control form-control-lg" placeholder="Password"
                                     name="password"  aria-label="Password" aria-describedby="basic-addon1" >
                            </div>
                            <span class="has-danger">{{$errors->has('password')?$errors->first('password'):''}}</span>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i
                                                class="ti-pencil"></i></span>
                                </div>
                                <input type="password" class="form-control form-control-lg" placeholder=" Confirm Password"
                                       name="conpassword" aria-label="Password" aria-describedby="basic-addon1" >
                            </div>
                            <span class="has-danger">{{$errors->has('conpassword')?$errors->first('conpassword'):''}}</span>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20">
                                    <button class="btn btn-block btn-lg btn-info" type="submit">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{route('login')}}"> <h5 style="margin-left: 90px;color:white">Already a member?<span style="color:red">Login</span></h5></a>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="{{asset('asset/assets/libs/jquery/dist/jquery.min.js')}}"></script>

<script src="{{asset('asset/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('asset/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
</script>
</body>

</html>