@extends('backend.layouts.app')
@section('content')
    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ url('dashboard/generate_bookings_per_hotel', $hotel_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{Request::get('name')}}">
                                <input type="hidden" name="hotel_name" value="{{Request::get('hotel_name')}}">
                                <input type="hidden" name="phone" value="{{Request::get('phone')}}">
                                <input type="hidden" name="email" value="{{Request::get('email')}}">
                                <input type="hidden" name="room_type" value="{{Request::get('room_type')}}">
                                <input type="hidden" name="no_of_rooms" value="{{Request::get('no_of_rooms')}}">
                                <input type="hidden" name="check_in_date" value="{{Request::get('check_in_date')}}">
                                <input type="hidden" name="check_out_date" value="{{Request::get('check_out_date')}}">
                                <input type="hidden" name="rate" value="{{Request::get('rate')}}">
                                <input type="hidden" name="no_of_nights" value="{{Request::get('no_of_nights')}}">
                                <input type="hidden" name="total_amount" value="{{Request::get('total_amount')}}">

                                <button class="btn btn-primary btn-sm" type="submit"> EXPORT EXCEL</button>
                            </form>
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
                                    <th>Email</th>
                                    <th>Room Type</th>
                                    <th>No Of Rooms</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Rate</th>
                                    <th>Number Of Nights</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doc_list as $doc)
                                    @php
                                        $check_in = (!empty($doc['check_in_date']) && $doc['check_in_date'] != '0000-00-00' && $doc['check_in_date'] != '0000-00-00 00:00:00') ? new DateTime($doc['check_in_date']) : null;
                                        $check_out = (!empty($doc['check_out_date']) && $doc['check_out_date'] != '0000-00-00' && $doc['check_out_date'] != '0000-00-00 00:00:00') ? new DateTime($doc['check_out_date']) : null;
                                        $nights = '';
                                        $total_amount = '';

                                        if ($check_in && $check_out) {
                                            $interval = $check_in->diff($check_out);
                                            $nights = $interval->days;
                                            if (isset($doc['rates'])) {
                                                $total_amount = $nights * $doc['rates'] * $doc['no_of_rooms'];
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($doc['name'])  }}</td>
                                        <td>{{ strtoupper($doc['phone'])}}</td>
                                        <td>{{ strtoupper($doc['email'])}}</td>
                                        <td>{{ !empty($doc['room_type_name']) ? strtoupper($doc['room_type_name']) : '<span class="text-danger">NO ROOM SELECTED</span>'}}</td>
                                        <td>{{ strtoupper($doc['no_of_rooms'])}}</td>

                                        <!-- Check-in and Check-out Dates -->
                                        <td>{{ $check_in ? $check_in->format('Y-m-d') : ''}}</td>
                                        <td>{{ $check_out ? $check_out->format('Y-m-d') : ''}}</td>

                                        <td>{{ number_format($doc['rates'], 2) }}</td>


                                        <!-- Number of Nights -->
                                        <td>{{ $nights ? $nights . ' Night' . ($nights > 1 ? 's' : '') : ''}}</td>

                                        <!-- Total Amount -->
                                        <td>{{ $total_amount ? '₦' . number_format($total_amount, 2) : ''}}</td>
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
