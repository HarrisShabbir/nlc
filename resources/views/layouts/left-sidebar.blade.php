<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bxs-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @can('shift_view')
                <li>
                    <a href="{{ route('shifts') }}" class="waves-effect">
                        <i class="bx bx-timer"></i>
                        <span>Shifts</span>
                    </a>
                </li>
                @endcan
                @can('vendor_pool_view')
                    <li>
                        <a href="{{ route('vendorpools') }}" class="waves-effect">
                            <i class="bx bx-water"></i>
                            <span>Vendor Pools</span>
                        </a>
                    </li>
                @endcan
                @can('vehicle_view')
                <li>
                    <a href="{{ route('vehicles') }}" class="waves-effect">
                        <i class="bx bxs-truck"></i>
                        <span>Vehicles</span>
                    </a>
                </li>
                @endcan
                @can('article_view')
                    <li>
                        <a href="{{ route('articles') }}" class="waves-effect">
                            <i class="bx bx-shopping-bag"></i>
                            <span>Articles</span>
                        </a>
                    </li>
                @endcan
                @can('inload_view')
                <li>
                    <a href="{{ route('inloads') }}" class="waves-effect">
                        <i class="bx bxs-truck"></i>
                        <span>In Loads</span>
                    </a>
                </li>
                @endcan
                @can('outload_view')
                <li>
                    <a href="{{ route('outloads') }}" class="waves-effect">
                        <i class="bx bxs-truck"></i>
                        <span>Out Loads</span>
                    </a>
                </li>
                @endcan
                @can('driver_view')
                    <li>
                        <a href="{{ route('drivers') }}" class="waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span>Drivers</span>
                        </a>
                    </li>
                @endcan
                @can('distributor_view')
                    <li>
                        <a href="{{ route('distributors') }}" class="waves-effect">
                            <i class="bx bxs-user"></i>
                            <span>Distributors</span>
                        </a>
                    </li>
                @endcan
                @can('user_view')
                    <li>
                        <a href="{{ route('users') }}" class="waves-effect">
                            <i class="bx bx-user"></i>
                            <span>Users</span>
                        </a>
                    </li>
                @endcan
                @can('role_view')
                <li>
                    <a href="{{ route('roles') }}" class="waves-effect">
                        <i class='bx bxs-user-detail'></i>
                        <span>Roles</span>
                    </a>
                </li>
                @endcan
                @can('permission_view')
                <li>
                    <a href="{{ route('permissions') }}" class="waves-effect">
                        <i class="bx bx-shuffle"></i>
                        <span>Permissions</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
