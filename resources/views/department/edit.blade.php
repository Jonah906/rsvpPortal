@extends('layouts.app')
@section('title')
 Edit Departments
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
                                        <h4 class="mt-0 header-title">Create Department</h4>
                                        {{-- <p class="text-muted mb-4">Custom stylr example.</p> --}}
                                        <form class="" method="POST" action="{{ route('department.update', $department->id) }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="username">Department Name <span style="color: red">*</span></label>
                                                        <input type="text" name="department_name" class="form-control @error('department_name') is-invalid @enderror" value="{{ $department->name }}" placeholder="Enter Name" >
                                                        @error('department_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="useremail">Department Code <span style="color: red">*</span></label>
                                                        <input type="text" name="department_code" class="form-control @error('department_code') is-invalid @enderror" value="{{ $department->department_code }}" placeholder="Enter Code" >
                                                        @error('department_code')
                                                            <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">                            
                                                    <div class="form-group">
                                                        <label for="message">Description</label>
                                                        <textarea placeholder="Enter Description" class="form-control @error('department_description') is-invalid @enderror" rows="5" name="department_description">{{ $department->description }}</textarea>
                                                        @error('department_description')
                                                            <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary px-5 py-2">Update</button>
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