<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="active"><a href="{{route('adminDashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Category</span> <span class="label label-important">2</span></a>
            <ul>
                <li><a href="{{route('addCategory')}}">Add Category</a></li>
                <li><a href="{{route('viewCategory')}}">View Category List</a></li>
            </ul>
        </li>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Product</span> <span class="label label-important">2</span></a>
            <ul>
                <li><a href="{{route('addProduct')}}">Add Product</a></li>
                <li><a href="{{route('viewProduct')}}">View Product List</a></li>
            </ul>
        </li>

        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupon</span> <span class="label label-important">2</span></a>
            <ul>
                <li><a href="{{route('addCoupon')}}">Add Coupon</a></li>
                <li><a href="{{route('viewCoupon')}}">View Coupon List</a></li>
            </ul>
        </li>

    </ul>
</div>
<!--sidebar-menu-->