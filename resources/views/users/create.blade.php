@extends('backend.layouts.app')
@section('content')
 
    <div class="row">
        <div class="col-lg-8">
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
                    <h4 class="mt-0 header-title">Create New User</h4>
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control" id="department" name="department" required>
                                        <option value="">>>-SELECT DEPARTMENT-<<</option>
                                        @foreach ($departments as $value)
                                            <option {{ old('role_id') == $value->id ? 'selected' : ""  }} value="{{ $value->id }}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" id="role_id" name="role_id" required>
                                        <option value="">>>-SELECT ROLE-<<</option>
                                        @foreach($roles as $role)
                                        <option {{ old('role_id') == $role->id ? 'selected' : ""  }} value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary px-5 py-2">Create User</button>
                            </div>
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div>
    </div>


@endsection