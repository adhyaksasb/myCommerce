<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a @if(Session::get('page')=="dashboard") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif href="{{ url('admin/dashboard') }}">
            <i @if(Session::get('page')=="dashboard") class="icon-grid menu-icon iconActiveColor" @else class="icon-grid menu-icon" @endif></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(Auth::guard('admin')->user()->type=="vendor")
        <li class="nav-item">
            <a @if(Session::get('page')=="personal" || Session::get('page')=="business" || Session::get('page')=="bank") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif data-toggle="collapse" href="#ui-vendor" aria-expanded="false" aria-controls="ui-vendor">
            <i @if(Session::get('page')=="personal" || Session::get('page')=="business" || Session::get('page')=="bank") class="icon-layout menu-icon sidebarActiveColor nohover" @else class="icon-layout menu-icon" @endif class="icon-layout menu-icon"></i>
            <span class="menu-title">Vendor Details</span>
            </a>
            <div class="collapse" id="ui-vendor">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"> <a @if(Session::get('page')=="personal") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/update-vendor-details/personal') }}">Personal Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="business") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/update-vendor-details/business') }}">Business Details</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="bank") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/update-vendor-details/bank') }}">Bank Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="products" || Session::get('page')=="coupons") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
            <i @if(Session::get('page')=="products" || Session::get('page')=="coupons") class="icon-grid-2 menu-icon sidebarActiveColor nohover" @else class="icon-grid-2 menu-icon" @endif></i>
            <span class="menu-title">Catalogue Management</span>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"><a @if (Session::get('page')=="products") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/products') }}">Products</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="coupons") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/coupons') }}">Coupons</a></li>
                </ul>
            </div>
        </li>
        @else
        <li class="nav-item">
            <a @if(Session::get('page')=="update_admin_password" || Session::get('page')=="update_admin_details") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif  data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
            <i @if(Session::get('page')=="update_admin_password" || Session::get('page')=="update_admin_details") class="icon-layout menu-icon iconActiveColor nohover" @else class="icon-layout menu-icon" @endif></i>
            <span class="menu-title">Admin Details</span>
            </a>
            <div class="collapse" id="ui-settings">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"> <a @if (Session::get('page')=="update_admin_password") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/update-admin-password') }}">Update Password</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="update_admin_details") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/update-admin-details') }}">Update Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="view_all" || Session::get('page')=="view_admins" || Session::get('page')=="view_subadmins" || Session::get('page')=="view_vendors") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif data-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
            <i @if(Session::get('page')=="view_all" || Session::get('page')=="view_admins" || Session::get('page')=="view_subadmins" || Session::get('page')=="view_vendors") class="icon-head menu-icon iconActiveColor nohover" @else class="icon-head menu-icon" @endif></i>
            <span class="menu-title">Admin Management</span>
            </a>
            <div class="collapse" id="ui-admin">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"> <a @if(Session::get('page')=="view_all") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/admin-manage/') }}">All</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="view_admins") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/admin-manage/admin') }}">Admins</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="view_subadmins") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/admin-manage/subadmin') }}">Sub-Admins</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="view_vendors") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/admin-manage/vendor') }}">Vendors</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="users" || Session::get('page')=="subscribers") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
            <i @if(Session::get('page')=="users" || Session::get('page')=="subscribers") class="icon-head menu-icon iconActiveColor nohover" @else class="icon-head menu-icon" @endif></i>
            <span class="menu-title">Users Management</span>
            </a>
            <div class="collapse" id="ui-user">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"> <a @if(Session::get('page')=="users") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/user-manage/users') }}">Users</a></li>
                    <li class="nav-item"> <a @if(Session::get('page')=="subscribers") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/user-manage/subscribers') }}">Subscribers</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="banners") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif data-toggle="collapse" href="#ui-banner" aria-expanded="false" aria-controls="ui-banner">
            <i @if(Session::get('page')=="banners") class="icon-columns menu-icon sidebarActiveColor nohover" @else class="icon-columns menu-icon" @endif></i>
            <span class="menu-title">Banners Management</span>
            </a>
            <div class="collapse" id="ui-banner">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"> <a @if(Session::get('page')=="banners") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/banner-manage/banners') }}">Banners</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a @if(Session::get('page')=="sections" || Session::get('page')=="categories" || Session::get('page')=="products" || Session::get('page')=="brands" || Session::get('page')=="filters" || Session::get('page')=="coupons") class="nav-link sidebarActiveColor nohover" @else class="nav-link" @endif data-toggle="collapse" href="#ui-catalogue" aria-expanded="false" aria-controls="ui-catalogue">
            <i @if(Session::get('page')=="sections" || Session::get('page')=="categories" || Session::get('page')=="products" || Session::get('page')=="brands" || Session::get('page')=="filters" || Session::get('page')=="coupons") class="icon-grid-2 menu-icon sidebarActiveColor nohover" @else class="icon-grid-2 menu-icon" @endif></i>
            <span class="menu-title">Catalogue Management</span>
            </a>
            <div class="collapse" id="ui-catalogue">
                <ul class="nav flex-column sub-menu submenuColor">
                    <li class="nav-item"> <a @if (Session::get('page')=="sections") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/sections') }}">Sections</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="categories") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/categories') }}">Categories</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="brands") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/brands') }}">Brands</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="products") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/products') }}">Products</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="coupons") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/coupons') }}">Coupons</a></li>
                    <li class="nav-item"> <a @if (Session::get('page')=="filters") class="nav-link sidebarActiveColor nohover" @else class="nav-link sidebarInactiveColor" @endif href="{{ url('admin/catalogue-manage/filters') }}">Filters</a></li>
                </ul>
            </div>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
            <i class="icon-bar-graph menu-icon"></i>
            <span class="menu-title">Charts</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
            <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Icons</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="icon-ban menu-icon"></i>
            <span class="menu-title">Error pages</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>