@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
            <h1>Product Images</h1>
        </div>


        @include('adminlayout.message')

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Add Product Image</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{route('addProductimage',$products_details->id)}}" name="basic_validate" id="add_product_attribute">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$products_details->id}}"/>
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <label class="control-label"><strong>{{$products_details->product_name}}</strong></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"><strong>{{$products_details->product_code}}</strong></label>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Upload Product image</label>
                                <div class="controls">
                                    <input type="file" name="image[]" id="image" multiple="multiple">
                                </div>

                            </div>



                            <div class="form-actions">
                                <input type="submit" value="Add Image" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                            <h5>view Product Image</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Image Id</th>
                                    <th>Product Id</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products_images['images'] as $images)
                                    <tr class="gradeU">
                                        <td>{{$images->id}}</td>
                                        <td>{{$images->product_id}}</td>
                                        <td><img src="{{asset('images/backend_images/product/small/'.$images->image)}}" width="40px" height="40px"></td>
                                        <td>
                                            <a rel="{{$images->id}}" rel1="delete-product_image"
                                               href="javascript:" class="btn btn-danger btn-mini deleteRecord"
                                               id="clickdelete">Delete</a>
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

@endsection