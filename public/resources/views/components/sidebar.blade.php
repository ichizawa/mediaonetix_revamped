<style>
    .logo-header img {
        height: 4rem;
        margin-bottom: 10;
    }
</style>
<div class="sidebar sidebar-style-2 shadow-mg">
    <div class="sidebar-logo">
        <div class="logo-header d-flex justify-content-center align-items-center w-100">
            <a href="#" class="logo d-flex justify-content-center align-items-center mt-5 pt-5">
                <img src="{{ asset('assets/img/mediaoneTix.png') }}" alt="MediaOne Tix Logo"
                    class="logo-img img-fluid me-2 d-none d-md-block" />
            </a>
            <div class="nav-toggle ms-auto">
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
        </div>
    </div>

    @if(Auth::user()->is_admin == 1)
        <div class="sidebar-wrapper scrollbar scrollbar-inner vh-100 d-flex flex-column">
            <div class="sidebar-content d-flex flex-column flex-grow-1">
                <ul class="nav nav-secondary pt-5 d-flex flex-column flex-grow-1">
                    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ request()->routeIs('admin.events') || request()->routeIs('admin.events.view') ? 'active' : '' }}">
                        <a href="{{ route('admin.events') }}" aria-expanded="false">
                            <i class="fa-regular fa-calendar"></i>
                            <p>Events</p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ request()->routeIs('admin.sales') || request()->routeIs('admin.specific.event.sales') ? 'active' : '' }}">
                        <a href="{{ route('admin.sales') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Sales</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.log') ? 'active' : '' }}">
                        <a href="{{ route('admin.log') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Activity Logs</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.control-panel') ? 'active' : '' }}">
                        <a href="{{ route('admin.control-panel') }}" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Control Panel</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}">
                            <i class="fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ request()->routeIs('admin.forms') || request()->routeIs('admin.customer.email') || request()->routeIs('admin.news') || request()->routeIs('admin.about.us') ? 'active' : '' }}">
                        <a href="#settingsSubmenu" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <p>Settings</p>
                        </a>
                        <ul class="collapse" id="settingsSubmenu">
                            <li class="{{ request()->routeIs('admin.forms') ? 'active' : '' }}">
                                <a href="{{ route('admin.forms') }}">
                                    <i class="fas fa-file-alt me-2"></i>
                                    Forms
                                </a>
                            </li>
                            {{-- <li class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                                <a href="{{ route('admin.users') }}">
                                    <i class="fas fa-users me-2"></i>
                                    Users
                                </a>
                            </li> --}}
                            <li class="{{ request()->routeIs('admin.customer.email') ? 'active' : '' }}">
                                <a href="{{ route('admin.customer.email') }}">
                                    <i class="fas fa-envelope me-2"></i>
                                    Customer Emails
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.news') ? 'active' : '' }}">
                                <a href="{{ route('admin.news') }}">
                                    <i class="fas fa-newspaper me-2"></i>
                                    News
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.about.us') ? 'active' : '' }}">
                                <a href="{{ route('admin.about.us') }}">
                                    <i class="fas fa-users me-2"></i>
                                    About Us
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- LOGOUT at bottom -->
                    <li class="nav-item mt-auto">
                        <a href="{{ route('logout.post') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    @elseif(Auth::user()->is_admin == 2)
        <div class="sidebar-wrapper mt-4 h-100 d-flex flex-column">
            <div class="sidebar-content d-flex flex-column flex-grow-1 h-100">
                <ul class="nav nav-secondary pt-5 d-flex flex-column flex-grow-1">
                    <li class="nav-item {{ request()->routeIs('merchant.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('merchant.dashboard') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('merchant.events') || request()->routeIs('merchant.events.view') ? 'active' : '' }}">
                        <a href="{{ route('merchant.events') }}" aria-expanded="false">
                            <i class="fa-regular fa-calendar"></i>
                            <p>Events</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('merchant.sales') || request()->routeIs('merchant.specific.event.sales') ? 'active' : '' }}">
                        <a href="{{ route('merchant.sales') }}" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                            <p>Sales</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('merchant.profile') || request()->routeIs('merchant.profile.view') ? 'active' : '' }}">
                        <a href="{{ route('merchant.profile') }}" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('merchant.users') || request()->routeIs('merchant.users') ? 'active' : '' }}">
                        <a href="{{ route('merchant.users') }}" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a href="{{ route('logout.post') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    @elseif(Auth::user()->is_admin == 0)
        <div class="sidebar-wrapper mt-4 h-100 d-flex flex-column">
            <div class="sidebar-content d-flex flex-column h-100">
                <ul class="nav nav-secondary pt-5 d-flex flex-column h-100">
                    <li class="nav-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('customer.dashboard') }}" class="collapsed" aria-expanded="false">
                            <i class="bi bi-columns-gap nav-icon-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>


                    <li class="nav-item {{ request()->routeIs('customer.history') ? 'active' : '' }}">
                        <a href="{{ route('customer.history') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-history"></i>
                            <p>History</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                        <a href="{{ route('customer.profile') }}" class="collapsed" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    
                    <li class="nav-item mt-auto">
                        <a href="{{ route('logout.post') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Log Out</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif


</div>