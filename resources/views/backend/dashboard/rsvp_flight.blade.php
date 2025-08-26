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
                                    <th>Arriving From</th>
                                    <th>Airline</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Departing From</th>
                                    <th>Airline</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doc_list as $doc)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($doc['name']) }}</td>
                                        <td>{{ strtoupper($doc['phone'])}}</td>
                                        <td>{{ strtoupper($doc['ref_tag'])  }}</td>

                                        <!-- Arrival Information -->
                                        <td>{{ strtoupper($doc['arrival_airport'])}}</td>
                                        <td>{{ strtoupper($doc['arrival_airline_name'])}}</td>
                                        <td>{{ ($doc['arrival_date'] != '0000-00-00') ? strtoupper($doc['arrival_date']) : ''}}</td>
                                        <td>{{ ($doc['arrival_flight_time'] != '00:00:00') ? strtoupper($doc['arrival_flight_time']) : ''}}</td>

                                        <!-- Departure Information -->
                                        <td>{{ strtoupper($doc['departure_airport'])}}</td>
                                        <td>{{ strtoupper($doc['departure_airline_name'])}}</td>
                                        <td>{{ ($doc['departure_date'] != '0000-00-00') ? strtoupper($doc['departure_date']) : ''}}</td>
                                        <td>{{ ($doc['departure_flight_time'] != '00:00:00') ? strtoupper($doc['departure_flight_time']) : ''}}</td>
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
