@include('auth.header')
@section('after-style')
    <style>
        .register{
            margin-left: 124px;
        }

    </style>
@endsection

{{--@if (session('success'))--}}
    {{--<div id="showmessage" class="myalert alert-float alert alert-success alert-dismissable custom-success-box" style="margin: 15px;--}}
    {{--border-radius: 10px;--}}
    {{--width: 306px;--}}
    {{--margin-left: 468px;">--}}
        {{--<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>--}}
        {{--{{ session('success') }}--}}
    {{--</div>--}}
{{--@endif--}}

{{--@if (session('dismiss'))--}}
    {{--<div id="showmessage" class="myalert alert-float alert alert-dismiss alert-dismissable custom-success-box" style="margin: 15px;--}}
    {{--border-radius: 10px;--}}
    {{--width: 306px;--}}
    {{--margin-left: 468px;">--}}
        {{--<button  type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>--}}
        {{--{{ session('dismiss') }}--}}
    {{--</div>--}}
{{--@endif--}}

@include('adminlayout.message')

<div id="loginbox">
    <form id="loginform" class="form-vertical" action="{{route('postlogin')}}" method="post">
        {{csrf_field()}}
        <div class="control-group normal_text"> <h3 style="color:green">Login Form</h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="icon-envelope"> </i></span><input type="email" name="email" placeholder="email" />
                </div>
                <span class="has-danger" style="color:red;margin-left:42px">{{$errors->has('email')?$errors->first('email'):''}}</span>
            </div>

        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
                </div>
                <span class="has-danger" style="color:red;margin-left:20px">{{$errors->has('password')?$errors->first('password'):''}}</span>
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="{{route('forgetPassword')}}" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
            {{--<span class="pull-right"><a type="submit" class="btn btn-success" >Login</a></span>--}}
            <button type="submit" class="btn btn-success pull-right">Login</button>
        </div>
        <a href="{{route('registration')}}"><h5 style="margin-left: 115px">Don't have an account? <span style="color:red">Register </span></h5></a>

    </form>


</div>

{{--it is used for message hide--}}
@section('script')
    <script>
        $(document).ready(function(){
            $("#showmessage").delay(5000).slideUp(300);
        });
    </script>
@endsection


@include('auth.footer')
