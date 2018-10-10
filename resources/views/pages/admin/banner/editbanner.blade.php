@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
            <h1>Banner Settings</h1>
        </div>


        @include('adminlayout.message')

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Banner</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{route('editBanner',$banners->id)}}" name="basic_validate" id="edit_banner">
                            {{csrf_field()}}


                            <div class="control-group">
                                <label class="control-label">Title</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" @if(isset($banners)) value="{{$banners->title}}" @endif>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Link</label>
                                <div class="controls">
                                    <input type="text" name="link" id="link" @if(isset($banners)) value="{{$banners->link}}" @endif>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Banner Image</label>
                                <div class="controls">
                                    <input type="file" name="image" id="image" />
                                    <input type="hidden" name="current_image" id="image" value="{{$banners->image}}">
                                    @if(!empty($banners->image))
                                        <img src="{{asset('images/frontend_images/banners/'.$banners->image)}}" width="40px" height="40px">
                                    @endif
                                    <a href="{{route('delete-banner-image',$banners->id)}}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls" >
                                    <input type="checkbox" name="status" id="status" value="2" @if($banners->status==2) checked @endif/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="update Banner" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection