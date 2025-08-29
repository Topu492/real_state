<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Website Setting</span></a>
                <ul class="dropdown-menu">
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Logo</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Favicon</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Banner</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Footer</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Property Section</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/location/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_location_index') }}"><i class="fas fa-angle-right"></i> Location</a></li>
                    <li class="{{ Request::is('admin/type/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_type_index') }}"><i class="fas fa-angle-right"></i> Type</a></li>
                    <li class="{{ Request::is('admin/amenity/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_amenity_index') }}"><i class="fas fa-angle-right"></i> Amenity</a></li>
                    <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Property</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('admin/package/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_package_index') }}"><i class="far fa-file"></i> <span>Package</span></a></li>

            <li class="{{ Request::is('admin/order/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_order_index') }}"><i class="far fa-file"></i> <span>Orders</span></a></li>

            <li class="{{ Request::is('admin/customer/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_customer_index') }}"><i class="far fa-file"></i> <span>Customer</span></a></li>

            <li class="{{ Request::is('admin/agent/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_agent_index') }}"><i class="far fa-file"></i> <span>Agent</span></a></li>

            <li class=""><a class="nav-link" href=""><i class="far fa-file"></i> <span>Testimonial</span></a></li>

            <li class=""><a class="nav-link" href=""><i class="far fa-file"></i> <span>Blog Post</span></a></li>

            <li class=""><a class="nav-link" href=""><i class="far fa-file"></i> <span>FAQ</span></a></li>

            <li class=""><a class="nav-link" href=""><i class="far fa-file"></i> <span>Page Section</span></a></li>

            <li class=""><a class="nav-link" href=""><i class="far fa-file"></i> <span>Subscriber</span></a></li>

            <li class="{{ Request::is('admin/profile') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_profile') }}"><i class="far fa-file"></i> <span>Edit Profile</span></a></li>

            <li><a class="nav-link" href="{{ route('admin_logout') }}"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>

        </ul>
    </aside>
</div>