@extends('layouts.app')
@section('title')
  User Profile
@endsection
@section('content')

    <div class="page-wrapper">

        @include('partials.navbar')

                  <!-- Page Content-->
                  <div class="page-content">
                    <div class="container-fluid"> 
                       
                        <div class="row">
                            <div class="col-lg-12">
                                @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                
    
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">User Profile</h4>
                                        <form method="POST" action="{{ route('user.updateprofile', $user->id) }}">
                                            @csrf
                                           
                                            <div class="row">
                                                <!-- Existing form fields -->
                        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fname">First Name</label>
                                                        <input readonly type="text" class="form-control" id="fname" name="fname" value="{{ $user->fname }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lname">Last Name</label>
                                                        <input readonly type="text" class="form-control" id="lname" name="lname" value="{{ $user->lname }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input readonly type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email address</label>
                                                        <input readonly type="email" class="form-control" readonly id="email" name="email" value="{{ $user->email }}" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input type="password" class="form-control" id="password" name="password">
                                                        <small class="text-muted">Change current password.</small>
                                                    </div>
                                                </div>
                                        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary px-5 py-2">Update User</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!--end card-body-->
                                </div><!--end card-->
                            </div>
                        </div>
    
                    </div><!-- container -->
    
                    @include('partials.footer')
                </div>
                <!-- end page content -->

    </div>
    <!-- end page-wrapper -->

@endsection