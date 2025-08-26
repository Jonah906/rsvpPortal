@extends('layouts.app')
@section('title')
Create Category
@endsection
@section('content')

    <div class="page-wrapper">

        @include('partials.navbar')

                  <!-- Page Content-->
                  <div class="page-content">
                    <div class="container-fluid"> 
                       
                        <div class="row">
                            <div class="col-lg-6">
                                
    
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="mt-0 header-title">Create Category</h4>
                                        {{-- <p class="text-muted mb-4">Custom stylr example.</p> --}}
                                        <form class="" method="POST" action="{{ route('category.store') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="username">Category Name <span style="color: red">*</span></label>
                                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required placeholder="Enter Category Name" >
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
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