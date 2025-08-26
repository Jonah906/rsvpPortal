@extends('backend.layouts.app')
@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="color:white;">{{ $meta_title }}</h5>
                    @if(!empty($permissionsAdd))
                        <a href="{{ route('user.create') }}" class="btn btn-primary px-4 align-self-center report-btn float-right">Create New</a>
                    @endif
                </div>
            

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basictbl" class="table table-striped table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Contact Number</th>
                                    <th>Created Date</th>
                                    @if (!empty($permissionsDelete) || !empty($permissionsEdit))
                                        <th>Action</th>
                                    @endif                       
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->fname }}</td>
                                        <td>{{ $user->lname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user_roles->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                    
                                        <td>{{ $user->created_at }}</td>

                                        <td>  
                                            @if(!empty($permissionsEdit))
                                                <a href="{{ route('user.edit', $user->id) }}" class=""><i class="fas fa-edit text-success"></i></a>
                                            @endif
                                            @if(!empty($permissionsDelete))
                                            <a href="javascript:void(0);" 
                                                class="delete-user-btn" 
                                                data-id="{{ $user->id }}" 
                                                data-url="{{ route('user.destroy', $user->id) }}">
                                                <i class="fas fa-trash-alt text-danger ml-2"></i>
                                            </a>
                                                {{-- <a href="{{ route('user.destroy', $user->id) }}" class="" onclick="confirmation(event)"><i class="fas fa-trash-alt text-danger ml-2"></i></a> --}}
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


@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-user-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    const url = this.getAttribute('data-url');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Create a form and submit it
                            const form = document.createElement('form');
                            form.method = 'GET';
                            form.action = url;

                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = csrfToken;

                            const methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';

                            form.appendChild(csrfInput);
                            form.appendChild(methodInput);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection