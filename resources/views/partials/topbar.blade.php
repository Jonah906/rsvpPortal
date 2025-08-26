<!-- Top Bar Start -->
<div class="topbar">
    <!-- Navbar -->
    <nav class="navbar-custom">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="{{ route("dashboard") }}" class="logo">
               <span>
                   {{-- <img src="{{ asset('assets/images/logo-sm.png') }}" alt="logo-small" class="logo-sm"> --}}
                   <h4 class="logo-sm">E-Notice System</h4>
               </span>
               <span>
                   {{-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="logo-large" class="logo-lg"> --}}
               </span>
            </a>
        </div>

        <ul class="list-unstyled topbar-nav float-right mb-0">
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="profile-user" class="rounded-circle" /> 
                    <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> {{ Auth::user()->fname }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('user.profile', Auth::user()->id) }}"><i class="dripicons-user text-muted mr-2"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('settings') }}"><i class="dripicons-gear text-muted mr-2"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('logout')}}"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                </div>
            </li>
            <li class="menu-item">
                <a class="navbar-toggle nav-link" id="mobileToggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>    
        </ul>
    </nav>
</div>

<div class="page-wrapper-img">
    <div class="page-wrapper-img-inner">
        <div class="sidebar-user media">                    
            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user" class="rounded-circle img-thumbnail mb-1">
            <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
            <div class="media-body align-item-center">
                <h5>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h5>
                <ul class="list-unstyled list-inline mb-0 mt-2">
                    <li class="list-inline-item">
                        <a href="{{ route('user.profile', Auth::user()->id) }}" class=""><i class="mdi mdi-account"></i></a>
                    </li>
                    {{-- <li class="list-inline-item">
                        <a href="javascript: void(0);" class=""><i class="mdi mdi-settings"></i></a>
                    </li> --}}
                    <li class="list-inline-item">
                        <a href="{{url('logout')}}" class=""><i class="mdi mdi-power"></i></a>
                    </li>
                </ul>
            </div>                    
        </div>
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title mb-2"><i class="mdi mdi-monitor mr-2"></i>Dashboard</h4>
                    <div class="">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">E-Notice</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>                                      
                </div>
            </div>
        </div>
    </div>
</div>