@extends('userlayout.design')

@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>

            @include('userlayout.message')

            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total_price = 0 ?>
                    @foreach($userCart as $cart)
                        <tr>

                            <td class="cart_product">
                                <a href=""><img src="{{asset('images/backend_images/product/small/'.$cart->image)}}"
                                                alt="" width="50px" height="50px"></a>
                            </td>
                            <td class="cart_description">

                                <h4><a href="">{{$cart->product_name}}</a></h4>
                                <p>Web ID: {{$cart->product_code}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{$cart->price}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="{{route('increment-quantity',$cart->id)}}">
                                        + </a>
                                    <div oninput="myFunction()">
                                        <input type="hidden" id="id" value="{{$cart->id}}">
                                        <input class="cart_quantity_input" type="text" name="quantity" id="quantity"
                                               value="{{$cart->quantity}}" autocomplete="off" size="2">
                                    </div>
                                    @if($cart->quantity > 1)
                                        <a class="cart_quantity_down"
                                           href="{{route('decrement-quantity',$cart->id)}}"> - </a>
                                    @endif
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" id="totalprice">{{$cart->price*$cart->quantity}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{route('delete-item-cart',$cart->id)}}"><i
                                            class="fa fa-times"></i></a>

                            </td>

                        </tr>
                        <?php $total_price = $total_price + ($cart->price * $cart->quantity); ?>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a Coupon code you want to use.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <form method="post" action="{{route('coupon-apply')}}">
                                    {{csrf_field()}}
                                    <label>Coupon Code</label>
                                    <input type="text" name="coupon_code">
                                    <input type="submit" value="apply" class="btn btn-default">
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            @if(!empty(Session::get('couponamount')))
                                <li>sub Total : <span><?php echo $total_price?></span></li>
                                <li>Coupon Discount : <span><?php echo Session::get('couponamount');?></span></li>
                                <li>Grand Total : <span><?php echo $total_price - Session::get('couponamount')?></span>
                                </li>
                            @else
                                <li>sub Total : <span><?php echo $total_price?></span></li>
                            @endif
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->


@endsection


@section('script')
    <script>
        function myFunction() {
            var id = $('#id').val();
            my_url = "http://localhost/Authentication/public/";
            $.ajax({
                type: 'get',
                datatype: 'json',
                //data:{id:id},
                url: my_url + 'update-price/' + id,
                success: function (resp) {
                    var price = resp['price'];
                    var quantity = $('#quantity').val();
                    var totalprice = price * quantity;
                    $('#totalprice').text(totalprice);
                }, error: function () {
                    alert(error);
                }
            });
        }
    </script>


    {{--for message showing--}}
    <script>
        $(document).ready(function () {
            $("#showmessage").delay(5000).slideUp(300);
        });
    </script>


@endsection