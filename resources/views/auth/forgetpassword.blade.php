@include('auth.header')
@section('after-style')
    <style>
        .register {
            margin-left: 124px;
        }

    </style>
@endsection

@if (session('dismiss'))
    <div id="showmessage" class="myalert alert-float alert alert-dismiss alert-dismissable custom-success-box" style="margin: 15px;
    border-radius: 10px;
    width: 306px;
    margin-left: 468px;">
        <button  type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{ session('dismiss') }}
    </div>
@endif

<div id="loginbox">
    <form id="recoverform loginform" action="{{route('forgetPasswordProcess')}}" method="post" class="form-vertical">
        {{csrf_field()}}
        <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a
            password.</p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="email" name="email"
                                                                                      placeholder="E-mail address"/>
            </div>
            <span style="color: red">{{$errors->has('email')?$errors->first('email'):''}}</span>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="{{route('login')}}" class="flip-link btn btn-success"
                                       id="to-login">&laquo; Back to login</a></span>
            <button type="submit" class="pull-right btn btn-info">Recover</button>
        </div>
    </form>
</div>

@section('script')
    <script>
        $(document).ready(function(){
            $("#showmessage").delay(5000).slideUp(300);
        });
    </script>
@endsection

@include('auth.footer')