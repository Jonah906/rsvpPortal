<style type="text/css">
    .vertical-menu {
        background: linear-gradient(135deg, #1e3c72, #2a5298); /* Cool blue gradient */
        color: white;
        width: 250px;
        height: 100vh;
        box-shadow: 4px 0 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }

    .vertical-menu .navbar-brand-box {
        background: rgba(255, 255, 255, 0.1);
        text-align: center;
        padding: 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .vertical-menu .navbar-brand-box h3 {
        font-size: 20px;
        color: #fff;
        font-weight: bold;
    }

    #sidebar-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    #sidebar-menu ul li {
        padding: 12px 20px;
    }

    #sidebar-menu ul li a {
        display: flex;
        align-items: center;
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    #sidebar-menu ul li a i {
        font-size: 20px;
        margin-right: 10px;
    }

    #sidebar-menu ul li a:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }

    #sidebar-menu ul li.menu-title {
        font-size: 14px;
        text-transform: uppercase;
        font-weight: bold;
        padding: 15px 20px;
        color: rgba(255, 255, 255, 0.7);
    }

    .sub-menu {
        display: none;
        padding-left: 20px;
    }

    .has-arrow:hover + .sub-menu {
        display: block;
    }

    @media (max-width: 768px) {
        .vertical-menu {
            width: 200px;
        }
    }

</style>
@php
    $permissionsUser = App\Models\PermissionRole::getPermission('User', Auth::user()->role_id);
    $permissionsRole = App\Models\PermissionRole::getPermission('Role', Auth::user()->role_id);
    $permissionReports = App\Models\PermissionRole::getPermission('Reports', Auth::user()->role_id);
    $permissionsPayment = App\Models\PermissionRole::getPermission('Payment', Auth::user()->role_id);
    $permissionsDashboard = App\Models\PermissionRole::getPermission('Dashboard', Auth::user()->role_id);
    $permissionsSystemSetup = App\Models\PermissionRole::getPermission('System Setup', Auth::user()->role_id);
    $permissionsTotalGuest = App\Models\PermissionRole::getPermission('Total Guest', Auth::user()->role_id);
    $permissionsBookings = App\Models\PermissionRole::getPermission('Bookings', Auth::user()->role_id);
    $permissionsAdministration = App\Models\PermissionRole::getPermission('Administration', Auth::user()->role_id);
    $permissionsBatchUpload = App\Models\PermissionRole::getPermission('Batch Upload', Auth::user()->role_id);
@endphp

<div class="vertical-menu">
    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <h3 style='color:#FFF; margin-top:10px; vertical-align:center;'>RSVP PORTAL</h3>
        </div>

        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect"><i class='bx bx-home-smile'></i><span>Dashboard</span></a>
                </li> 

                @if(!empty($permissionsAdministration))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-user"></i><span>Administration</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if (!empty($permissionsUser))
                               <li><a href="{{ route('user.index') }}">Users</a></li>
                            @endif
                            @if(!empty($permissionsRole))
                                <li><a href="{{route('userrole.index')}}">User Role</a></li> 
                            @endif
                        </ul>
                    </li>
                @endif

                @if(!empty($permissionsBatchUpload))
                    <li>
                       <a href="{{ route('bookings.index') }}" class="waves-effect"><i class='bx bx-file'></i><span>Make Bookings</span></a>
                    </li> 
                @endif
                
                @if(!empty($permissionsPayment))
                    <li>
                       <a href="{{ route('payment_confirmation.index') }}" class="waves-effect"><i class='bx bx-money'></i><span>Payment Confirmation</span></a>
                    </li> 
                @endif

                @if(!empty($permissionReports))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-file"></i><span>Reports</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            @if(!empty($permissionsTotalGuest))
                                <li><a href="{{ route('reports.index') }}">Total Guest</a></li>
                            @endif
                            @if(!empty($permissionsBookings))
                                <li><a href="{{ route('reports.rsvp') }}">Booking</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
