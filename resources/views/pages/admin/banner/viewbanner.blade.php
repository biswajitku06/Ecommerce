@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
            <h1>Banner Settings</h1>
        </div>


        @include('adminlayout.message')

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Banner List</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Banner ID</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr class="gradeU">
                                        <td>{{$banner->id}}</td>
                                        <td>{{$banner->title}}</td>
                                        <td>{{$banner->link}}</td>
                                        <td>@if($banner->status==2)Active @else Inactive @endif</td>
                                        <td>
                                            @if(!empty($banner->image))
                                                <img src="{{asset('images/frontend_images/banners/'.$banner->image)}}" width="60px" height="60px">
                                            @endif
                                        </td>
                                        <td class="center"><a href="{{route('editBanner',$banner->id)}}"
                                                              class="btn btn-primary btn-mini">Edit</a> <a href="#" class="btn btn-success btn-mini">Publish</a>
                                            <a rel="{{$banner->id}}" rel1="delete-banner" <?php /*href="{{route('deleteCategory',$categories->id)}}"*/?> href="javascript:" class="btn btn-danger btn-mini deleteRecord" id="clickdelete">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection