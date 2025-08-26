<div class="page-wrapper-inner">

    <!-- Navbar Custom Menu -->
    <div class="navbar-custom-menu">
        
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu list-unstyled">
                    @php
                        $permissionsUser = App\Models\PermissionRole::getPermission('User', Auth::user()->role_id);
                        $permissionsRole = App\Models\PermissionRole::getPermission('Role', Auth::user()->role_id);
                        $permissionReports = App\Models\PermissionRole::getPermission('Reports', Auth::user()->role_id);
                        $permissionsCategory = App\Models\PermissionRole::getPermission('Category', Auth::user()->role_id);
                        $permissionsDashboard = App\Models\PermissionRole::getPermission('Dashboard', Auth::user()->role_id);
                        $permissionsDepartment = App\Models\PermissionRole::getPermission('Department', Auth::user()->role_id);
                        $permissionsSystemSetup = App\Models\PermissionRole::getPermission('System Setup', Auth::user()->role_id);
                        $permissionsSubscription = App\Models\PermissionRole::getPermission('Subscription', Auth::user()->role_id);
                        $permissionsPaymentCycle = App\Models\PermissionRole::getPermission('Payment Cycle', Auth::user()->role_id);
                        $permissionsAdministration = App\Models\PermissionRole::getPermission('Administration', Auth::user()->role_id);
                        $permissionSubscriptionRenewal = App\Models\PermissionRole::getPermission('Subscription Renewal', Auth::user()->role_id);
                    @endphp

                    <li class="has-submenu">
                        <a href="{{ route('dashboard') }}">
                            <i class="mdi mdi-monitor"></i>
                            Dashboard
                        </a>
                    </li>
                    @if(!empty($permissionsAdministration))
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-account"></i>Administration</a>
                        <ul class="submenu">
                            @if (!empty($permissionsUser))
                               <li><a href="{{ route('user.index') }}">Users</a></li>
                            @endif
                            @if (!empty($permissionsRole))
                              <li><a href="{{route('userrole.index')}}">User Role</a></li> 
                            @endif
                        </ul>
                    </li> 
                    @endif

                    @if (!empty($permissionsSystemSetup))
                        <li class="has-submenu">
                            <a href="#"><i class="mdi mdi-settings"></i>System Setup</a>
                            <ul class="submenu">
                                @if (!empty($permissionsDepartment))
                                  <li><a href="{{ route('department.index') }}">Department</a></li>
                                @endif
                                @if (!empty($permissionsCategory))
                                   <li><a href="{{ route('category.index') }}">Category</a></li> 
                                @endif
                                @if (!empty($permissionsPaymentCycle))
                                   <li><a href="{{ route('paymentcycle.index') }}">Payment Cycle</a></li> 
                                @endif
                                @if (!empty($permissionsSubscription))
                                   <li><a href="{{ route('subscription.index') }}">Subscription</a></li>
                                @endif 
                                
                            </ul>
                        </li>
                    @endif

                    @if(!empty($permissionSubscriptionRenewal))
                        <li class="has-submenu">
                            <li><a href="{{ route('subscription.renew') }}"><i class="mdi mdi-bank"></i>Subscription Renewal</a></li>
                        </li>
                    @endif

                  
                    @if(!empty($permissionReports))
                        <li class="has-submenu">
                            <a href="{{ route('reports.index') }}"><i class="mdi mdi-buffer"></i>Reports</a>
                        </li>
                    @endif

                    {{-- <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-cards-playing-outline"></i>UI Elements</a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li><a href="ui-alerts.html">Alerts</a></li>                                
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-cards.html">Cards</a></li>                                
                                    <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-progress.html">Progress</a></li>
                                    <li><a href="ui-tabs-accordions.html">Tabs & Accordions</a></li>                                            
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><a href="ui-tooltips-popovers.html">Tooltips & Popover</a></li>
                                    <li><a href="ui-carousel.html">Carousel</a></li>
                                    <li><a href="ui-pagination.html">Pagination</a></li>
                                    <li><a href="ui-grid.html">Grid System</a></li>
                                    <li><a href="ui-scrollspy.html">Scrollspy</a></li>
                                    <li><a href="ui-spinners.html">Spinners</a></li>
                                    <li><a href="ui-toasts.html">Toasts</a></li>
                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li><p class="font-12 mb-0 py-2 rounded-pill mt-2 badge badge-soft-success">Extra Components</p></li>
                                    <li><a href="ui-other-animation.html">Animation</a></li>
                                    <li><a href="ui-other-avatar.html">Avatar</a></li>
                                    <li><a href="ui-other-clipboard.html">Clip Board</a></li>
                                    <li><a href="ui-other-files.html">File Meneger</a></li>
                                    <li><a href="ui-other-ribbons.html">Ribbons</a></li>
                                    <li><a href="ui-other-dragula.html">Dragula</a></li>
                                    <li><a href="ui-other-check-radio.html">Check & Radio Buttons</a></li>                                                
                                </ul>
                            </li>                                        
                        </ul>
                    </li>
                    
                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-arrow-down-drop-circle-outline"></i>More</a>
                        <ul class="submenu">                                        
                            <li class="has-submenu">
                                <a href="#">Icons</a>
                                <ul class="submenu">
                                    <li><a href="icons-materialdesign.html">Material Design</a></li>
                                    <li><a href="icons-dripicons.html">Dripicons</a></li>
                                    <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                    <li><a href="icons-themify.html">Themify</a></li>
                                    <li><a href="icons-typicons.html">Typicons</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#">Tables </a>
                                <ul class="submenu">
                                    <li><a href="tables-basic.html">Basic</a></li>
                                    <li><a href="tables-datatable.html">Datatables</a></li>
                                    <li><a href="tables-responsive.html">Responsive</a></li>
                                    <li><a href="tables-footable.html">Footable</a></li>
                                    <li><a href="tables-jsgrid.html">Jsgrid</a></li>
                                    <li><a href="tables-editable.html">Editable</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#">Forms</a>
                                <ul class="submenu">
                                    <li><a href="forms-elements.html">Basic Elements</a></li>
                                    <li><a href="forms-advanced.html">Advance Elements</a></li>
                                    <li><a href="forms-validation.html">Validation</a></li>
                                    <li><a href="forms-wizard.html">Wizard</a></li>
                                    <li><a href="forms-editors.html">Editors</a></li>
                                    <li><a href="forms-repeater.html">Repeater</a></li>
                                    <li><a href="forms-x-editable.html">X Editable</a></li>
                                    <li><a href="forms-uploads.html">File Upload</a></li>
                                    <li><a href="forms-img-crop.html">Image Crop</a></li>
                                </ul>
                            </li>   
                            <li class="has-submenu">
                                <a href="#">Maps</a>
                                <ul class="submenu">
                                    <li><a href="maps-google.html">Google Maps</a></li>
                                    <li><a href="maps-vector.html">Vector Maps</a></li>
                                </ul>
                            </li>   
                            <li class="has-submenu">
                                <a href="#">Email Templates</a>
                                <ul class="submenu">
                                    <li><a href="email-templates-basic.html">Basic Action Email</a></li>
                                    <li><a href="email-templates-alert.html">Alert Email</a></li>
                                    <li><a href="email-templates-billing.html">Billing Email</a></li>
                                </ul>
                            </li>                                   
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="mdi mdi-chart-bar"></i>Charts</a>
                        <ul class="submenu">
                            <li><a href="charts-apex.html">Apex</a></li>
                            <li><a href="charts-morris.html">Morris</a></li>
                            <li><a href="charts-chartist.html">Chartist</a></li>
                            <li><a href="charts-flot.html">Flot</a></li>
                            <li><a href="charts-peity.html">Peity</a></li>
                            <li><a href="charts-chartjs.html">Chartjs</a></li>
                            <li><a href="charts-sparkline.html">Sparkline</a></li>
                            <li><a href="charts-knob.html">Jquery Knob</a></li>
                            <li><a href="charts-justgage.html">JustGage</a></li>
                        </ul>
                    </li> --}}

                   
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end navigation -->
        </div> <!-- end container-fluid -->
    </div>
    <!-- end left-sidenav-->
</div>
{{-- @include('partials.message')         --}}
<!--end page-wrapper-inner -->