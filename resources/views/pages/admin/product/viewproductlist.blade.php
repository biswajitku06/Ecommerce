@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a></div>
            <h1>Product Settings</h1>
        </div>


        @include('adminlayout.message')

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"><span class="icon"><i class="icon-th"></i></span>
                            <h5>Product List</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Product Code</th>
                                    <th>Product Color</th>
                                    <th>Price</th>
                                    <th>Product Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $products)
                                    <tr class="gradeU">
                                        <td>{{$products->id}}</td>
                                        <td>{{$products->product_name}}</td>
                                        <td>{{$products->category_name}}</td>
                                        <td>{{$products->product_code}}</td>
                                        <td>{{$products->product_color}}</td>
                                        <td>{{$products->price}}</td>
                                        <td>
                                            @if(!empty($products->image))
                                                <img src="{{asset('images/backend_images/product/small/'.$products->image)}} "
                                                     width="60" height="60">
                                            @endif
                                        </td>
                                        <td class="center"><a href="#myModal{{$products->id}}" data-toggle="modal"
                                                              class="btn btn-success btn-mini">View</a> <a
                                                    href="{{route('editProduct',$products->id)}}"
                                                    class="btn btn-primary btn-mini">Edit</a>

                                            <a href="{{route('addProductAttribute',$products->id)}}"
                                                    class="btn btn-success btn-mini">Add</a>
                                            <a rel="{{$products->id}}" rel1="delete-product"

                                               href="javascript:" class="btn btn-danger btn-mini deleteRecord"
                                               id="clickdelete">Delete</a>
                                        </td>

                                    </tr>
                                    <div id="myModal{{$products->id}}" class="modal hide">
                                        <div class="modal-header">
                                            <button data-dismiss="modal" class="close" type="button">×</button>
                                            <h3>{{$products->product_name}} (Full details)</h3>
                                        </div>
                                        <div class="modal-body">
                                            <p>Product Id : {{$products->id}}</p>
                                            <p>Category Name : {{$products->category_name}}</p>
                                            <p>Product Code : {{$products->product_code}}</p>
                                            <p>Product Color : {{$products->product_color}}</p>
                                            <p>Product Description : {{$products->description}}</p>

                                            @if(!empty($products->image))
                                                <p> Image:
                                                    <img src="{{asset('images/backend_images/product/small/'.$products->image)}} "
                                                         width="60" height="60">
                                                </p>
                                            @endif

                                        </div>
                                    </div>
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