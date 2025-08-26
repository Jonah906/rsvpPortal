<style type="text/css">
    #page-topbar {
        background: linear-gradient(135deg, #1e3c72, #2a5298); /* Same cool gradient as sidebar */
        color: black;
        padding: 10px 20px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }

    .navbar-header .header-item {
        color: black;
    }

    .navbar-header h4 {
        color: black;
        font-weight: bold;
    }

    #page-header-user-dropdown {
        color:linear-gradient(135deg, #1e3c72, #2a5298);
    }

    #page-header-user-dropdown:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
    }

    /* Style the dropdown menu */
    .dropdown-menu {
        background: #2a5298;
        border: none;
    }

    .dropdown-menu a {
        color: white !important;
    }

    .dropdown-menu a:hover {
        background: rgba(255, 255, 255, 0.2);
    }

</style>


<header id="page-topbar">
	<div class="navbar-header">
		<div class="d-flex align-items-left">
			<button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
				id="vertical-menu-btn">
				<i class="fa fa-fw fa-bars"></i>
			</button>

			<div class="dropdown d-none d-sm-inline-block">
				<h4 class="mb-0 font-size-18">{{ $meta_title }}</h4>
			</div>
		</div>

		<div class="d-flex align-items-center">

			<div class="dropdown d-none d-sm-inline-block ml-2">
			</div>

			<div class="dropdown d-inline-block">
			</div>

			<div class="dropdown d-inline-block">
			</div>

			<div class="dropdown d-inline-block ml-2">
				<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<!-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-3.jpg"
						alt="Header Avatar"> -->
					<span class="d-none d-sm-inline-block ml-1" style="color:black;">{{ (Auth::user()->fname.' '.Auth::user()->lname) }}</span>
					<i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-right">
					<!-- <a class="dropdown-item d-flex align-items-center justify-content-between"
						href="javascript:void(0)">
						<span>Inbox</span>
						<span>
							<span class="badge badge-pill badge-info">3</span>
						</span>
					</a> -->
					<a class="dropdown-item d-flex align-items-center justify-content-between"
						href="javascript:void(0)">
						<span>Profile</span>
					</a>
					<!-- <a class="dropdown-item d-flex align-items-center justify-content-between"
						href="javascript:void(0)">
						Settings
					</a>
					<a class="dropdown-item d-flex align-items-center justify-content-between"
						href="javascript:void(0)">
						<span>Lock Account</span>
					</a> -->
					<a class="dropdown-item d-flex align-items-center justify-content-between"
						href="{{ url('logout') }}">
						<span>Log Out</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>