<?php
use App\Http\Controllers\Controller;
$banners=Controller::getBanner();

?>


<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($banners as $key=>$banner)
                        <li data-target="#slider-carousel" data-slide-to="0" @if($key==0) class="active"> @endif</li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach($banners as $key=>$banner)
                        <div class="item @if($key==0) active @endif">
                            {{--<div class="col-sm-6">--}}
                                {{--<h1><span>E</span>-SHOPPER</h1>--}}
                                {{--<h2>Free E-Commerce Template</h2>--}}
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>--}}
                                {{--<button type="button" class="btn btn-default get">Get it now</button>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6">--}}
                            <a href="{{$banner->url}}" title="{{$banner->title}}"> <img src="{{asset('images/frontend_images/banners/'.$banner->image)}}" class="girl img-responsive" alt=""/></a>
                                {{--<img src="{{asset('images/frontend_images/home/pricing.png')}}"  class="pricing" alt="" />--}}
                            {{--</div>--}}
                        </div>
                        @endforeach

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->