@extends('userlayout.design')

@section('content')

    <section>
        @include('adminlayout.message')
        <div class="container">
            <div class="col-sm-3">
                @include('userlayout.front_sidebar')
            </div>


            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                <a href="{{asset('images/backend_images/product/small/'.$productdetails->image)}}">
                                    <img class="mainimage"
                                         src="{{asset('images/backend_images/product/small/'.$productdetails->image)}}"
                                         alt=""/>
                                </a>
                            </div>
                            {{--<h3>ZOOM</h3>--}}
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active thumbnails">
                                    @foreach($productimage as $images)
                                        <a href="{{asset('images/backend_images/product/large/'.$images->image)}}"
                                           data-standard="{{asset('images/backend_images/product/small/'.$images->image)}}">
                                            <img class="changeimage" style="width:80px; cursor:pointer"
                                                 src="{{asset('images/backend_images/product/small/'.$images->image)}}">
                                        </a>
                                    @endforeach
                                </div>

                            </div>

                            <!-- Controls -->
                        </div>

                    </div>
                    <div class="col-sm-7">
                        <form action="{{route('add_to_cart')}}" method="post" name="addtocartform" id="addtocart">
                            {{csrf_field()}}
                            <div class="product-information"><!--/product-information-->
                                {{--<img src="images/product-details/new.jpg" class="newarrival" alt="" />--}}
                                <input type="hidden" name="product_id" value="{{$productdetails->id}}">
                                <input type="hidden" name="product_name" value="{{$productdetails->product_name}}">
                                <input type="hidden" name="product_code" value="{{$productdetails->product_code}}">
                                <input type="hidden" name="product_color" value="{{$productdetails->product_color}}">
                                <input type="hidden" name="price" value="{{$productdetails->price}}">
                                {{--<input type="hidden" name="product_id" value="{{$productdetails->product_id}}">--}}
                                <h2>{{$productdetails->product_name}}</h2>
                                <p>Product ID: {{$productdetails->product_code}}</p>
                                <p>
                                    <select id="selsize" name="size" style="width:150px">
                                        <option>select size</option>
                                        @foreach($productdetails->attribute as $size)
                                            <option value="{{$productdetails->id}}-{{$size->size}}">{{$size->size}}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <img src="{{asset('images/frontend_images/product/product-details/rating.png')}}"
                                     alt=""/>
                                <span>
									<span id="getprice" name="price">TAKA {{$productdetails->price}}</span>
									<label>Quantity:</label>
									<input id="quantity" type="text" value="{{$productdetails->stock}}"
                                           name="quantity"/>
                                    @if($totalstock>0)
                                        <button type="submit" class="btn btn-fefault cart" id="cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
                                    @endif
								</span>
                                <p><b>Availability:</b> <span id="availability">@if($totalstock>0) In Stock @else Out of
                                        stock @endif</span></p>
                                <p><b>Condition:</b> New</p>
                                {{--<p><b>Brand:</b> E-SHOPPER</p>--}}
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                                alt=""/></a>
                            </div><!--/product-information-->
                        </form>

                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#care" data-toggle="tab">Material & Care</a></li>
                            <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>

                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="description">
                            <div class="col-sm-12">
                                <p>{{$productdetails->description}}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="care">
                            <div class="col-sm-12">
                                <p>{{$productdetails->care}}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="delivery">
                            <div class="col-sm-12">
                                <p>100% original products<br/>
                                    Cash in Product
                                </p>
                            </div>
                        </div>


                    </div>
                </div><!--/category-tab-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = 1;?>
                            @foreach($relatedproducts->chunk(3) as $chunk)
                                <div <?php if($count == 1) { ?> class="item active"
                                     <?php } else { ?> class="item"<?php }?>>
                                    @foreach($chunk as $item)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{asset('images/backend_images/product/small/'.$item->image)}}"
                                                             alt=""/>
                                                        <h2>TAKA : {{$item->price}}</h2>
                                                        <p>{{$item->product_name}}</p>
                                                        <a href="{{route('Productdetails',$item->id)}}" type="button"
                                                           class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-shopping-cart"></i>Add to cart
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <?php $count++;?>
                            @endforeach

                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel"
                           data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel"
                           data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
        </div>
    </section>


@section('script')
    <script>
        // Instantiate EasyZoom instances
        var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function (e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function () {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
    </script>

@endsection

@endsection

