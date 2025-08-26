@extends('backend.layouts.app')
@section('content')
    {{-- <div class="page-wrapper">

        @include('partials.navbar')
        @php
            $subscription = App\Models\Subscription::getRecord();
            $department = App\Models\Department::getRecord();
            $paymentCycle = App\Models\Paymentcycle::getRecord();
        @endphp

        <div class="page-content">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body mb-0">
                                <div class="row">                                            
                                    <div class="col-8 align-self-center">
                                        <div class="">
                                            <h4 class="mt-0 header-title">Total Users</h4>
                                            <h2 class="mt-0 font-weight-bold">{{ Auth::user()->count() }}</h2> 
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info text-right">
                                            <i class="dripicons-user-group bg-soft-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body overflow-hidden p-0">
                                <div class="d-flex mb-0 h-100 dash-info-box">
                                    <div class="w-100">                                                
                                        <div class="apexchart-wrapper">
                                            <div id="dash_spark_1" class="chart-gutters"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                  
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body mb-0">
                                <div class="row">                                            
                                    <div class="col-8 align-self-center">
                                        <div class="">
                                            <h4 class="mt-0 header-title">Total Subscription</h4>
                                            <h2 class="mt-0 font-weight-bold">{{ $subscription->count() }}</h2> 
                                        </div>
                                    </div>
                                    <div class="col-4 align-self-center">
                                        <div class="icon-info text-right">
                                            <i class="dripicons-jewel bg-soft-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body overflow-hidden p-0">
                                <div class="d-flex mb-0 h-100 dash-info-box">
                                    <div class="w-100">                                                
                                        <div class="apexchart-wrapper">
                                            <div id="apex_column1" class="chart-gutters"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                  
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card carousel-bg-img">
                            <div class="card-body dash-info-carousel mb-0">
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row">                                            
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Total Department</h4>
                                                        <div class="icon-info my-3">
                                                            <i class="dripicons-jewel bg-soft-pink"></i>
                                                        </div>
                                                        <h2 class="mt-0 font-weight-bold">{{ $department->count() }}</h2> 
                                                        <p class="mb-1 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>35.5%</span> Last 100 Subscriptions</p>
                                                    </div>
                                                </div>                                                     
                                            </div>                                                   
                                        </div>
                                        <div class="carousel-item">
                                            <div class="row">                                            
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Total Payment Cycle</h4>
                                                        <div class="icon-info my-3">
                                                            <i class="dripicons-basket bg-soft-info"></i>
                                                        </div>
                                                        <h2 class="mt-0 font-weight-bold">{{ $paymentCycle->count() }}</h2> 
                                                        <p class="mb-1 text-muted"><span class="text-danger"><i class="mdi mdi-arrow-down"></i>1.5%</span> Down From Last week</p>
                                                    </div>
                                                </div>                                                    
                                            </div>                                                 
                                        </div>

                                        <div class="carousel-item">
                                            <div class="row">                                            
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Order Returns</h4>
                                                        <div class="icon-info my-3">
                                                            <i class="dripicons-swap bg-soft-primary"></i>
                                                        </div>
                                                        <h2 class="mt-0 font-weight-bold">11.1%</h2> 
                                                        <p class="mb-1 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>11.1%</span> Up from Last Month</p>
                                                    </div>
                                                </div>                                                      
                                            </div>                                                  
                                        </div>
                                        <div class="carousel-item">
                                            <div class="row">                                            
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Total Brands</h4>
                                                        <div class="icon-info my-3">
                                                            <i class="dripicons-store bg-soft-warning"></i>
                                                        </div>
                                                        <h2 class="mt-0 font-weight-bold">92</h2> 
                                                        <p class="mb-1 text-muted">All International Brands</p>
                                                    </div>
                                                </div>                                                      
                                            </div>                                                  
                                        </div>
                                        <div class="carousel-item">
                                            <div class="row">                                            
                                                <div class="col-12 align-self-center">
                                                    <div class="text-center">
                                                        <h4 class="mt-0 header-title text-left">Total Visits</h4>
                                                        <div class="icon-info my-3">
                                                            <i class="dripicons-user-group bg-soft-success"></i>
                                                        </div>
                                                        <h2 class="mt-0 font-weight-bold">35k</h2> 
                                                        <p class="mb-1 text-muted"><span class="text-success"><i class="mdi mdi-arrow-up"></i>11.1%</span> Up from yesterday</p>
                                                    </div>
                                                </div>                                                       
                                            </div>                                                   
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>                                                                                                      
                        </div>
                    </div>                            
                </div>
            

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body new-user order-list">
                                <h4 class="header-title mt-0 mb-3">Order List</h4>
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="border-top-0">Product</th>
                                                <th class="border-top-0">Pro Name</th>
                                                <th class="border-top-0">Country</th>
                                                <th class="border-top-0">Order Date/Time</th>
                                                <th class="border-top-0">Pcs.</th>                                    
                                                <th class="border-top-0">Amount ($)</th>
                                                <th class="border-top-0">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img class="" src="{{asset('assets/images/products/img-1.png')}}" alt="user"> </td>
                                                <td>
                                                    Beg
                                                </td>
                                                <td>                                                                
                                                    <img src="{{asset('assets/images/flags/us_flag.jpg')}}" alt="" class="img-flag thumb-xxs rounded-circle">
                                                </td>
                                                <td>3/03/2019 4:29 PM</td>
                                                <td>200</td>                                   
                                                <td> $750</td>
                                                <td>                                                                        
                                                    <span class="badge badge-boxed  badge-soft-success">Shipped</span>
                                                </td>
                                            </tr><!--end tr-->
                                            <tr>
                                                <td>
                                                    <img class="" src="{{asset('assets/images/products/img-2.png')}}" alt="user"> </td>
                                                <td>
                                                    Watch
                                                </td>
                                                <td>                                                                
                                                    <img src="{{asset('assets/images/flags/french_flag.jpg')}}" alt="" class="img-flag thumb-xxs rounded-circle">
                                                </td>
                                                <td>13/03/2019 1:09 PM</td>
                                                <td>180</td>                                   
                                                <td> $970</td>
                                                <td>
                                                    <span class="badge badge-boxed  badge-soft-danger">Delivered</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="{{asset('assets/images/products/img-3.png')}}" alt="user"> </td>
                                                <td>
                                                    Headphone
                                                </td>
                                                <td>                                                                
                                                    <img src="{{asset('assets/images/flags/spain_flag.jpg')}}" alt="" class="img-flag thumb-xxs rounded-circle">
                                                </td>
                                                <td>22/03/2019 12:09 PM</td>
                                                <td>30</td>                                   
                                                <td> $2800</td>
                                                <td>
                                                    <span class="badge badge-boxed badge-soft-warning">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="{{asset('assets/images/products/img-4.png')}}" alt="user"> </td>
                                                <td>
                                                    Purse
                                                </td>
                                                <td>                                                                
                                                    <img src="{{asset('assets/images/flags/russia_flag.jpg')}}" alt="" class="img-flag thumb-xxs rounded-circle">
                                                </td>
                                                <td>14/03/2019 8:27 PM</td>
                                                <td>100</td>                                   
                                                <td> $520</td>
                                                <td>                                                                                                                                              
                                                    <span class="badge badge-boxed  badge-soft-success">Shipped</span>                                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="{{asset('assets/images/products/img-5.png')}}" alt="user"> </td>
                                                <td>
                                                    Shoe
                                                </td>
                                                <td>                                                                
                                                    <img src="{{asset('assets/images/flags/italy_flag.jpg')}}" alt="" class="img-flag thumb-xxs rounded-circle">
                                                </td>
                                                <td>18/03/2019 5:09 PM</td>
                                                <td>100</td>                                   
                                                <td> $1150</td>
                                                <td>
                                                    <span class="badge badge-boxed badge-soft-warning">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img class="" src="{{asset('assets/images/products/img-6.png')}}" alt="user"> </td>
                                                <td>
                                                    Boll
                                                </td>
                                                <td>                                                                
                                                    <img src="{{asset('assets/images/flags/us_flag.jpg')}}" alt="" class="img-flag thumb-xxs rounded-circle">
                                                </td>
                                                <td>30/03/2019 4:29 PM</td>
                                                <td>140</td>                                   
                                                <td> $ 650</td>
                                                <td>                                                                        
                                                    <span class="badge badge-boxed  badge-soft-success">Shipped</span>
                                                </td>
                                            </tr>                                                   
                                        </tbody>
                                    </table>                                              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

           @include('partials.footer')
        </div>

    </div> --}}


    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18 text-center text-md-left">
                    WELCOME ({{ strtoupper(Auth::user()->fname.' '.Auth::user()->lname) }})
                </h4>
            </div>
        </div>
    </div>

    <!-- Start Cards Section -->
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card shadow-sm">
                <a href="{{ url('total_rsvp') }}">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase">Total RSVP</h6>
                        <h3 class="mb-3" data-plugin="counterup">{{ $total_bookings }}</h3>
                        <span class="badge badge-success">{{ $percentate_total_bookings }} %</span> 
                        <span class="text-muted d-block mt-1">Of Total RSVP</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card shadow-sm">
                <a href="{{ url('rsvp_hotel') }}">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase">Total RSVP + Hotel Reservation</h6>
                        <h3 class="mb-3" data-plugin="counterup">{{ $total_bookings_rsvp }}</h3>
                        <span class="badge badge-success">{{ $percentate_total_bookings_rsvp }} %</span> 
                        <span class="text-muted d-block mt-1">Of Total RSVP + Hotel Reservation</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card shadow-sm">
                <a href="{{ url('rsvp_flight') }}">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase">Total RSVP + Flight Itinerary</h6>
                        <h3 class="mb-3" data-plugin="counterup">{{ $total_bookings_flight }}</h3>
                        <span class="badge badge-success">{{ $percentate_total_bookings_flight }} %</span> 
                        <span class="text-muted d-block mt-1">Of Total RSVP + Flight Itinerary</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- End Cards Section -->

    <!-- Start Responsive Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Bookings Per Hotel</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Hotel Name</th>
                                    <th>Total Bookings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($hotel_per_bookings as $booking)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ url('booking_details', $booking->hotel_id) }}">
                                                {{ $booking->hotel_name }}
                                            </a>
                                        </td>
                                        <td>{{ $booking->total_bookings }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No bookings found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Responsive Table -->


@endsection