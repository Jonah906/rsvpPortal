<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>RSVP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    @include('backend.layouts.styles')
    @yield('styles')

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('backend.partials.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('backend.partials.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-success" role="alert" style="display:none;">
                            </div>
                            <div class="alert alert-danger" role="alert" style="display:none;">
                            </div>
                        </div>  
                    </div>
                    <!-- start page -->
                    @yield('content')
                    <!-- end page -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('backend.partials.footer')
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Processing...</h5>
                            <button type="button" id="btnclosemodal" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                                    <span class="sr-only">Processing...</span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>
            
            <!-- Button trigger modal -->
            <button type="button" id="btnopenmodal" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModalCenter" style="visibility:hidden">
                Launch demo modal
            </button> 
        </div>
        <!-- end main content-->


        
    </div>
    <!-- END layout-wrapper -->
    <div id="loaderdiv">
        <img src="{{ asset('backend/assets/images/loading2.gif') }}" alt="" /><br/>
        <p>Loading...</p>
    </div>

    @include('backend.layouts.scripts')

    @yield('scripts')

</body>
</html>