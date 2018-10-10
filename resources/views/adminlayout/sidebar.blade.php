{{--Take a current url for comparing the url --}}
<?php $url=url()->current(); ?>

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li <?php if(preg_match('/admin-dashboard/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('adminDashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Category</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/category/i',$url)) { ?> style="display: block;" <?php } ?>>
                <li <?php if(preg_match('/add-category/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('addCategory')}}">Add Category</a></li>
                <li <?php if(preg_match('/view-category/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('viewCategory')}}">View Category List</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Product</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/product/i',$url)) { ?> style="display: block;" <?php } ?>>
                <li <?php if(preg_match('/add-product/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('addProduct')}}">Add Product</a></li>
                <li <?php if(preg_match('/view-product/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('viewProduct')}}">View Product List</a></li>
            </ul>
        </li>

        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupon</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/coupon/i',$url)) { ?> style="display: block;" <?php } ?>>
                <li <?php if(preg_match('/add-coupon/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('addCoupon')}}">Add Coupon</a></li>
                <li <?php if(preg_match('/view-coupon/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('viewCoupon')}}">View Coupon List</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banner</span> <span class="label label-important">2</span></a>
            <ul <?php if(preg_match('/banner/i',$url)) { ?> style="display: block;" <?php } ?>>
                <li <?php if(preg_match('/add-banner/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('addBanner')}}">Add Banner</a></li>
                <li <?php if(preg_match('/view-banner/i',$url)) { ?> class="active" <?php } ?>><a href="{{route('viewBanner')}}">View Banner List</a></li>
            </ul>
        </li>


    </ul>
</div>
<!--sidebar-menu-->