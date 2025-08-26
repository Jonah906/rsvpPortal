@extends('backend.layouts.app')
@section('content')

    <!-- Start Page Title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ url('reports/generate_bookings') }}" method="POST">
                                @csrf
                                <input type="hidden" name="name" value="{{Request::get('name')}}">
                                <input type="hidden" name="email" value="{{Request::get('email')}}">
                                <input type="hidden" name="phone" value="{{Request::get('phone')}}">
                                <input type="hidden" name="hotel_name" value="{{Request::get('hotel_name')}}">
                                <input type="hidden" name="room_type" value="{{Request::get('room_type')}}">
                                <input type="hidden" name="no_of_rooms" value="{{Request::get('no_of_rooms')}}">
                                <input type="hidden" name="check_in_date" value="{{Request::get('check_in_date')}}">
                                <input type="hidden" name="check_out_date" value="{{Request::get('check_out_date')}}">

                                <input type="hidden" name="arrival_from" value="{{Request::get('arrival_from')}}">
                                <input type="hidden" name="arrival_airline" value="{{Request::get('arrival_airline')}}">
                                <input type="hidden" name="arrival_date" value="{{Request::get('arrival_date')}}">
                                <input type="hidden" name="arrival_time" value="{{Request::get('arrival_time')}}">

                                <input type="hidden" name="departure_from" value="{{Request::get('departure_from')}}">
                                <input type="hidden" name="departure_airline" value="{{Request::get('departure_airline')}}">
                                <input type="hidden" name="departure_date" value="{{Request::get('departure_date')}}">
                                <input type="hidden" name="departure_time" value="{{Request::get('departure_time')}}">

                                <button class="btn btn-primary" type="submit"> EXPORT EXCEL</button>
                            </form>
                            {{-- <a href="" role="button" class="btn btn-success btn-sm">
                                EXPORT EXCEL
                            </a> --}}
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
                                    <th>Refrence Number</th>
                                    <th>Hotel</th>
                                    <th>Room</th>
                                    <th>No Of Rooms</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Arriving From</th>
                                    <th>Airline</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Departing From</th>
                                    <th>Airline</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doc_list as $doc)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($doc['name']) }}</td>
                                        <td>{{ strtoupper($doc['ref_tag']) }}</td>
                                        <td>{!! !empty($doc['hotel_name']) ? strtoupper($doc['hotel_name']) : '<span class="text-danger">NO BOOKINGS MADE</span>' !!}</td>
                                        <td>{!! !empty($doc['room_type_name']) ? strtoupper($doc['room_type_name']) : '<span class="text-danger">NO ROOM SELECTED</span>' !!}</td>
                                        <td><?= strtoupper($doc['no_of_rooms']); ?></td>

                                        <!-- Check-in and Check-out Dates -->
                                        <td>{{ (!empty($doc['check_in_date']) && $doc['check_in_date'] != '0000-00-00' && $doc['check_in_date'] != '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($doc['check_in_date'])) : '' }}</td>
                                        <td>{{ (!empty($doc['check_out_date']) && $doc['check_out_date'] != '0000-00-00' && $doc['check_out_date'] != '0000-00-00 00:00:00') ? date('Y-m-d', strtotime($doc['check_out_date'])) : '' }}</td>

                                        <!-- Arrival Information -->
                                        <td>{{ strtoupper($doc['arrival_airport']) }}</td>
                                        <td>{{ strtoupper($doc['arrival_airline_name']) }}</td>
                                        <td>{{ ($doc['arrival_date'] != '0000-00-00') ? strtoupper($doc['arrival_date']) : '' }}</td>
                                        <td>{{ ($doc['arrival_flight_time'] != '00:00:00') ? strtoupper($doc['arrival_flight_time']) : '' }}</td>

                                        <!-- Departure Information -->
                                        <td>{{ strtoupper($doc['departure_airport']) }}</td>
                                        <td>{{ strtoupper($doc['departure_airline_name']) }}</td>
                                        <td>{{ ($doc['departure_date'] != '0000-00-00') ? strtoupper($doc['departure_date']) : '' }}</td>
                                        <td>{{ ($doc['departure_flight_time'] != '00:00:00') ? strtoupper($doc['departure_flight_time']) : '' }}</td>
                                        <td>{{ date('Y-m-d',strtotime($doc['created_at'])) }}</td>
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

