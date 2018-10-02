@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
            <h1>Category Settings</h1>
        </div>


        @include('adminlayout.message')

            <div class="container-fluid">
                <hr>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                                <h5>Category List</h5>
                            </div>
                            <div class="widget-content nopadding">
                                <table class="table table-bordered data-table">
                                    <thead>
                                    <tr>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                        <th>Category Level</th>
                                        <th>Category Url</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $categories)
                                    <tr class="gradeU">
                                        <td>{{$categories->id}}</td>
                                        <td>{{$categories->name}}</td>
                                        <td>{{$categories->parent_id}}</td>
                                        <td>{{$categories->url}}</td>
                                        <td class="center"><a href="{{route('editCategory',$categories->id)}}"
                                                              class="btn btn-primary btn-mini">Edit</a> <a href="#" class="btn btn-success btn-mini">Publish</a>
                                            <a rel="{{$categories->id}}" rel1="delete-categories" <?php /*href="{{route('deleteCategory',$categories->id)}}"*/?> href="javascript:" class="btn btn-danger btn-mini deleteRecord" id="clickdelete">Delete</a>
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