@extends('layouts.app')
@section('title')
Payment Cycle
@endsection
@section('content')

    <div class="page-wrapper">

        @include('partials.navbar')

                  <!-- Page Content-->
                  <div class="page-content">
                    <div class="container-fluid"> 
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="mt-0 header-title">Payment Cycle</h4>
                                        <p class="text-muted mb-4" >
                                            @if (!empty($permissionsAdd))
                                              <a href="{{ route('paymentcycle.create') }}" class="btn btn-info px-4 align-self-center report-btn float-right">Create New</a>
                                            @endif
                                        </p>
        
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>First Reminder Period</th>
                                                    <th>Second Reminder Period</th>
                                                    <th>Created By</th>
                                                    <th>Created Date</th>
                                                    @if (!empty($permissionsEdit) || !empty($permissionDelete))
                                                     <th>Action</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse ($paymentcycles as $paymentcycle)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $paymentcycle->name }}</td>
                                                    <td>{{ $paymentcycle->first_reminder_period }} Days</td>
                                                    <td>{{ $paymentcycle->second_reminder_period }} Days</td>

                                                    <td>{{ $paymentcycle->users->fname }}</td>
                                                    <td>{{ $paymentcycle->created_at }}</td>

                                                    <td>  
                                                        @if (!empty($permissionsEdit))
                                                          <a href="{{ route('paymentcycle.edit', $paymentcycle->id) }}" class=""><i class="fas fa-edit text-success"></i></a>
                                                        @endif
                                                        @if (!empty($permissionsDelete))
                                                          <a href="{{ route('paymentcycle.destroy', $paymentcycle->id) }}" class="" onclick="confirmation(event)"><i class="fas fa-trash-alt text-danger ml-2"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                   <tr>
                                                      <td colspan="100%">Record not Found</td>
                                                   </tr>
                                                @endforelse
                                                
                                                </tbody>
                                            </table><!--end /table-->
                                        </div><!--end /tableresponsive-->
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div> <!-- end col -->
                        </div> <!-- end row -->
    
                    </div><!-- container -->
    
                    @include('partials.footer')
                </div>
                <!-- end page content -->

    </div>
    <!-- end page-wrapper -->

@endsection