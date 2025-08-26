@extends('layouts.app')
@section('title')
  Settings
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
        
                                        <h4 class="mt-0 header-title">Settings</h4>
                                        <p class="text-muted mb-4" >
                                            @if (!empty($permissionsAdd))
                                               <a href="{{ route('subscription.create') }}" class="btn btn-info px-4 align-self-center report-btn float-right">Create New</a>
                                            @endif
                                        </p>
        
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Staff</th>
                                                    <th>Payment Cycle</th>
                                                    <th>Start Date</th>
                                                    <th>Next Payment Date</th>
                                                    <th>Created Date</th>

                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @php
                                                      dd($subscriptions)
                                                    @endphp --}}
                                                @forelse ($settings as $sub)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $sub->name }}</td>
                                                    <td>{{ $sub->categories->name }}</td>
                                                    <td>{{ $sub->users->fname }}</td>
                                                    <td>{{ $sub->paymentcycles->name }}</td>
                                                    <td>{{ $sub->start_date }}</td>
                                                    <td>{{ $sub->next_payment_date }}</td>
                                                    <td>{{ $sub->created_at }}</td>

                                                    <td>  
                                                        {{-- @if (!empty($permissionsEdit)) --}}
                                                           <a href="{{ route('subscription.edit', $sub->id) }}" class=""><i class="fas fa-edit text-success"></i></a>
                                                        {{-- @endif --}}
                                                        
                                                        @if (!empty($permissionsDelete))
                                                          <a href="{{ route('subscription.destroy', $sub->id) }}" class="" onclick="confirmation(event)"><i class="fas fa-trash-alt text-danger ml-2"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                   <tr>
                                                     <td colspan="100%">Record not Found</td>
                                                   </tr>
                                                @endforelse
                                                
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

    </div>

@endsection