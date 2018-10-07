@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a></div>
            <h1>Category Settings</h1>
        </div>


        @include('adminlayout.message')


        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{route('editCategory',$categories->id)}}"
                              name="basic_validate" id="add_category">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Category Name</label>
                                <div class="controls">
                                    <input type="text" name="cat_name" id="cat_name"
                                           @if(isset($categories))  value="{{$categories->name}}"
                                           @else value="{{old('cat_name')}}" @endif>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Category Level</label>
                                <div class="controls">
                                    <select name="parent_id" id="parent_id" style="width:220px">
                                        <option value="0">Main Category</option>
                                        @if(isset($categories) && isset($levels))
                                            @foreach($levels as $val)
                                                <option value="{{$val->id}}" @if($val->id == $categories->parent_id) selected @endif>{{$val->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    <textarea name="description" id="description">{{$categories->description}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">URL</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url"
                                           @if(isset($categories))  value="{{$categories->url}}"
                                           @else value="{{old('url')}}" @endif>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" @if($categories->status=="2") checked @endif value="2">
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" value="Update Category" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection