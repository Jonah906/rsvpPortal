@extends('backend.layouts.app')
@section('content')
 
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0" style="color:white;">{{ $meta_title }}</h5>
                    <form action="{{ url('dashboard/generate_attendance') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{Request::get('name')}}">
                        <input type="hidden" name="email" value="{{Request::get('email')}}">
                        <input type="hidden" name="phone" value="{{Request::get('phone')}}">
                        <input type="hidden" name="ref_tag" value="{{Request::get('ref_tag')}}">
                        <input type="hidden" name="created_at" value="{{Request::get('created_at')}}">

                        <button class="btn btn-primary btn-sm float-right" type="submit"> EXPORT EXCEL</button>
                    </form>
                    {{-- <a href="#" id="exportExcel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> EXPORT EXCEL
                    </a> --}}
                </div>
            

                <div class="card-body">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-md-2 col-sm-4 text-center">
                            <label for="filterByAdmin" class="form-label">Filter by Admin</label>
                            <select name="filterByAdmin" id="filterByAdmin" class="form-control">
                                <option value=""><<- SELECT ADMIN ->></option>
                                @foreach ($admin_list as $row)
                                    @if ($row['email'] != 'superadmin@landuser.com')
                                        <option value="{{ $row['email'] }}">{{ strtoupper($row['fname']) }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="basictbl" class="table table-striped table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">S/N</th>
                                    <th>Name</th>
                                    <th>Date Created</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Refrence Number</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($doc_list))
                                    @forelse ($doc_list as $doc)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ strtoupper($doc['name']) }}</td>
                                            <td>{{ date('Y-m-d', strtotime($doc['created_at'])) }}</td>
                                            <td>{{ $doc['phone'] }}</td>
                                            <td>{{ strtoupper($doc['email']) }}</td>
                                            <td>{{ $doc['ref_tag'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-danger fw-bold">NO BOOKINGS AVAILABLE</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody> 
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('#filterByAdmin').on('change', function() {
            var adminId = $(this).val();

            $.ajax({
                url: "{{ url('filter_bookings_by_admin') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    admin_id: adminId 
                },
                success: function(response) {
                    $('#basictbl tbody').html(response); 
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
        $('#exportExcel').click(function(e) {
            e.preventDefault(); 
            var adminEmail = $('#filterByAdmin').val(); 
            // console.log(adminId);

            if (adminEmail) {
                window.location.href = ""
            } else {
                window.location.href = "";
            }
        });
    });
    </script>

@endsection