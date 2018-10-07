@extends('adminlayout.design')

@section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a></div>
            <h1>Coupon Settings</h1>
        </div>


        @include('adminlayout.message')


        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Coupon</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{route('editCoupon',$coupon->id)}}"
                              name="basic_validate" id="edit_coupon">
                            {{csrf_field()}}
                            <div class="control-group">
                                <label class="control-label">Coupon Code</label>
                                <div class="controls">
                                    <input type="text" name="coupon_code" id="coupon_code"
                                           @if(isset($coupon)) value="{{$coupon->coupon_code}}" @endif minlength="5"
                                           maxlength="15">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Amount</label>
                                <div class="controls">
                                    <input type="number" name="amount" min="1" id="amount"
                                           @if(isset($coupon)) value="{{$coupon->amount}}" @endif>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Amount_type</label>
                                <div class="controls">
                                    <select name="amount_type" style="width:220px" id="amount_type">
                                        <option>Select amount_type</option>

                                        <option value="percentage"
                                                @if($coupon->amount_type=='percentage') selected @endif>Percentage
                                        </option>

                                        <option value="fixed" @if($coupon->amount_type=='fixed') selected @endif>Fixed
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Expiry Date</label>
                                <div class="controls">
                                    <input type="text" name="expiry_date" id="expiry_date" autocomplete="off"
                                           @if(isset($coupon)) value="{{$coupon->expiry_date}}" @endif>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Enable</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="2"
                                           @if(($coupon->status==2)) checked @endif/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Update Coupon" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection