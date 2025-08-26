
                
@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            

            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Edit User Role</h4>
                    <form class="" method="POST" action="{{ route('userrole.update', $userrole->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="username">Role Name <span style="color: red">*</span></label>
                                    <input type="text" name="name" value="{{ $userrole->name }}" class="form-control @error('name') is-invalid @enderror" required placeholder="Enter Role Name" >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            

                                <div >
                                    <div class="form-group">
                                        <label style="display: block; margin-bottom: 20px" for="username"><b>Role Permission</b></label>
                                        <br>
                                        @foreach($getPermission as $value)
                                            <div class="row" style="margin-bottom: 20px">
                                                    <div class="col-md-3">
                                                        {{ $value['name'] }}
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            @foreach($value['group'] as $group)
                                                            @php
                                                                $checked = "";
                                                            @endphp
                                                            @foreach ($getRolePermission as $role)
                                                                @if ($role->permission_id == $group['id'])
                                                                    @php
                                                                        $checked = "checked";
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            <div class="col-md-3">
                                                                <label for=""><input type="checkbox" {{ $checked }} value="{{ $group['id'] }}" name="permission_id[]"> {{ $group['name'] }}</label>
                                                            </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn btn-primary px-5 py-2">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

