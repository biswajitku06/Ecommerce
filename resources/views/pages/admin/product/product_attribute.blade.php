@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
            <h1>Product Attributes</h1>
        </div>


        @include('adminlayout.message')

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Add Product Attribute</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{route('addProductAttribute',$products_details->id)}}" name="basic_validate" id="add_product_attribute">
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
                                <label class="control-label">Product Color</label>
                                <label class="control-label"><strong>{{$products_details->product_color}}</strong></label>
                            </div>

                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="field_wrapper">
                                    <div>
                                        <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px"/>
                                        <input type="text" name="size[]" id="size" placeholder="SIZE" style="width:120px"/>
                                        <input type="text" name="price[]" id="price" placeholder="PRICE" style="width:120px"/>
                                        <input type="text" name="stock[]" id="stock" placeholder="STOCK" style="width:120px"/>

                                        <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                    </div>
                                </div>
                            </div>


                            <div class="form-actions">
                                <input type="submit" value="Add Attribute" class="btn btn-success">
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
                            <h5>view Attribute List</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Attribute Id</th>
                                    <th>SKU</th>
                                    <th>Size</th>
                                    <th>price</th>
                                    <th>stock</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products_details['attribute'] as $attributes)
                                    <tr class="gradeU">
                                        <td>{{$attributes->id}}</td>
                                        <td>{{$attributes->sku}}</td>
                                        <td>{{$attributes->size}}</td>
                                        <td>{{$attributes->price}}</td>
                                        <td>{{$attributes->stock}}</td>
                                        <td>
                                            <a rel="{{$attributes->id}}" rel1="delete-product_attribute"
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