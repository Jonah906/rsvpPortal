
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>RSVP Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />

        <style type="text/css">
            body{
                position: relative;
                background: #DCDCDC;
                overflow: hidden;
            }

            .card {
                position: relative;
                z-index: 2000;
            }
            
            body:before {
                content: ' ';
                display: block;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                opacity: 0.2;
                background-image: url('{{ asset('welcome/assets/img/free.jpg') }}');
                background-repeat: no-repeat;
                background-position: 50% 0;
                background-size: cover;
            }
        </style>
        
    </head>

    <body>

        <div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center min-vh-100">
                            <div class="w-100 d-block my-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-5">
                                        <div class="card">
                                            <div class="alert alert-success" role="alert" style="display:none; font-weight:bold;">
                                            </div>
                                            <div class="alert alert-danger" role="alert" style="display:none; font-weight:bold;">
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mb-4 mt-3">
                                                    <!-- <center><img src="{{ asset('backend/assets/images/statelogo.png') }}" style="width:90px; height:auto;"></center> -->
                                                    <!-- <a href="#"> -->
                                                        <!-- <h2>e-Booking</h2> -->
                                                        <h3>Login Portal</h3>
                                                    <!-- </a> -->
                                                </div>
                                                <form id="frmLogin" action="post" class="p-2">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="emailaddress">Email address</label>
                                                        <input class="form-control" type="email" id="email" name="email" required="" placeholder="john@deo.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">
                                                    </div>
                                                    <div class="mb-3 text-center">
                                                        <input type="hidden" name="seenfr" >
                                                        <button id="btnLogin" class="btn btn-secondary btn-block" type="button"> Sign In </button>
                                                        <br>
                                                        <a href="{{ route('frontend.index') }}" style="font-weight: bold; text-decoration:underline; color: #495057;"> Back to home page </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- end card-body -->
                                        </div>
                                        <!-- end card -->
                
                                        <div class="row mt-4">
                                            <div class="col-sm-12 text-center">
                                            </div>
                                        </div>
                
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div> <!-- end .w-100 -->
                        </div> <!-- end .d-flex -->
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- jQuery  -->
        <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/metismenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/waves.js') }}"></script>
        <script src="{{ asset('backend/assets/js/simplebar.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('backend/assets/js/theme.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#btnLogin').click(function () {
                    $('#btnLogin').attr('disabled', 'disabled');

                    $('.alert-success, .alert-danger').hide().text('');

                    var dataStr = $('#frmLogin').serialize();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('login') }}",
                        data: dataStr,
                        timeout: 120000,
                        success: function (data) {
                            var outputMsg = data.split('|');

                            if (outputMsg[1] === 'success') {
                                $('.alert-success').show().text('LOGIN WAS SUCCESSFUL!');
                                setTimeout(function () {
                                    location.href = "{{ url('dashboard') }}";
                                }, 2000);
                            } else {
                                $('.alert-danger').show().text(outputMsg[0]);
                                $('#btnLogin').removeAttr('disabled');
                            }
                        },
                        error: function (x, y, z) {
                            $('#btnLogin').removeAttr('disabled');
                            $('.alert-danger').text(x.responseText).show();
                        }
                    });
                    return false;
                });
            });
        </script>
    </body>
</html>