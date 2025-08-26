@extends('backend.layouts.app')
@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <a href="" role="button" class="btn btn-success btn-sm">
                                EXPORT EXCEL
                            </a> -->
                            <br/><br/>
                        </div>
                    </div>

                    <!-- Responsive Table Wrapper -->
                    <div class="table-responsive">
                        <table id="basictbl" class="table table-striped table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">S/N</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Refrence Number</th>
                                    <th>Hotel</th>
                                    <th>Room</th>
                                    <th>No Of Rooms</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doc_list as $doc)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($doc['name']) }}</td>
                                        <td>{{ strtoupper($doc['phone']) }}</td>
                                        <td>{{ strtoupper($doc['ref_tag']) }}</td>
                                        <td>{{ !empty($doc['hotel_name']) ? strtoupper($doc['hotel_name']) : '<span class="text-danger">NO BOOKINGS MADE</span>' }}</td>
                                        <td>{{ !empty($doc['room_type_name']) ? strtoupper($doc['room_type_name']) : '<span class="text-danger">NO ROOM SELECTED</span>' }}/td>
                                        <td>{{ strtoupper($doc['no_of_rooms']) }}</td>

                                        <!-- Check-in and Check-out Dates -->
                                        <td>{{ (!empty($doc['check_in_date']) && $doc['check_in_date'] != '0000-00-00' && $doc['check_in_date'] != '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($doc['check_in_date'])) : '' }}</td>
                                        <td>{{ (!empty($doc['check_out_date']) && $doc['check_out_date'] != '0000-00-00' && $doc['check_out_date'] != '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($doc['check_out_date'])) : '' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="17" class="text-center text-danger">NO BOOKINGS AVAILABLE</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- End Table Responsive -->
                </div>
            </div>
        </div>
    </div>    
@endsection
