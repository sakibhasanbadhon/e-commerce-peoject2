 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('/') }}assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">James Brown</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('admin.dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="#"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Category</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('admin.brand.index') }}">Brands</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.category.index') }}">Category</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.subcategory.index') }}">Sub Category</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.childCategory.index') }}">Child Category</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.warehouse.index') }}">Warehouse</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Product</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{ route('admin.product.create') }}">Product</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.product.index') }}">Product Manage</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">Offer</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{ route('admin.coupon.index') }}">Coupon</a>
                    </li>
                    <li>
                        <a href="text_editors.html">E Campign</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Pickup Point</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{ route('admin.pickupPoint.index') }}">Pickup Point</a>
                    </li>
                    <li>
                        <a href="text_editors.html">Others</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-file-text"></i>
                    <span class="nav-label">Setting</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('admin.setting.seo') }}">Seo Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting.smtp') }}">Smtp Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.page.index') }}">Create Page</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.setting.website') }}">Website Setting</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.password.change') }}">password Change</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Menu Levels</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="javascript:;">Level 2</a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <span class="nav-label">Level 2</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-3-level collapse">
                            <li>
                                <a href="javascript:;">Level 3</a>
                            </li>
                            <li>
                                <a href="javascript:;">Level 3</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
