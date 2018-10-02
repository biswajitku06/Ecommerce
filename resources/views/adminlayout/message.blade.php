@if (session('success'))
    <div id="showmessage" class="myalert alert-float alert alert-success alert-dismissable custom-success-box" style="margin: 15px;
    border-radius: 10px;
    width: 306px;
    margin-left: 468px;">
        <button  type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{ session('success') }}
    </div>
@endif

@if (session('dismiss'))
    <div id="showmessage" class="myalert alert-float alert alert-dismiss alert-dismissable custom-success-box" style="margin: 15px;
    border-radius: 10px;
    width: 306px;
    margin-left: 468px;">
        <button  type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{ session('dismiss') }}
    </div>
@endif

@if (session('error'))
    <div id="showmessage" class="myalert alert-float alert alert-error alert-dismissable custom-success-box" style="margin: 15px;
    border-radius: 10px;
    width: 306px;
    margin-left: 468px;">
        <button  type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{ session('error') }}
    </div>
@endif


<script>
    $(document).ready(function(){
        $("#showmessage").delay(5000).slideUp(300);
    });
</script>