@extends('frontend.layouts.app')

@section('styles')
    <style>
       .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hs-item {
            opacity: 0.6;
            /* 60% opacity */
        }

        input[type="radio"]:disabled+label {
            color: red;
            cursor: not-allowed;
        }

        .radiocontainer {
            text-align: center;
        }

        .foreign-guest-box {
            border: 2px solid #dfa974;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .foreign-guest-box h3 {
            color: #dfa974;
            text-align: center;
        }
        /* Layout for input fields (2 per row) */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Two columns */
            gap: 20px; /* Spacing between items */
            margin-bottom: 20px;
        }

        /* Style for each input field */
        .check-date {
            display: flex;
            flex-direction: column;
        }

        /* Section Titles */
        h4 {
            margin-bottom: 10px;
            color: #333;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr; /* One column on mobile */
            gap: 10px;
        }

        @media (min-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr); /* Two columns on larger screens */
            }
        }

        .check-date {
            display: flex;
            flex-direction: column;
        }

        /* Fade-in and fade-out effect for Hotel Reservation */
        @keyframes fadeInOut1 {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }

        .attention-effect-1 {
            animation: fadeInOut1 3s infinite;
        }

        /* Fade-in and fade-out effect for Flight Itinerary with different timing */
        @keyframes fadeInOut2 {
            0% { opacity: 0; }
            30% { opacity: 1; }
            100% { opacity: 0; }
        }

        .attention-effect-2 {
            animation: fadeInOut2 4s infinite; /* Different duration */
        }

        .tribute-link {
            display: block;
            text-align: center;
            font-weight: bold;
            color: #DFA974;
            text-decoration: none;
            font-size: 18px; /* Adjust size if needed */
            margin-top: 50px; /* Adjust value to move it further down */
        }
    </style>
@endsection

@section('content')
    <div id="booking-form-container" style="display: block;">
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-xl-2 offset-lg-1">
                        <div class="booking-form">
                            <h3>EDIT RSVP</h3>
                            <form id="frmBookings" method="post">
                                <div id="step1">
                                    <div class="section">
                                            <div class="row">
                                            <div class="col-md-4">
                                                <div class="check-date">
                                                    <label for="date-in">First Name: <span class="text-danger">*</span></label>
                                                    <input type="text" id="fname" name="fname" value="{{ $bookings->fname }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="check-date">
                                                    <label for="date-out">Last Name:<span class="text-danger">*</span></label>
                                                    <input type="text" id="lname" name="lname" value="{{ $bookings->lname }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="check-date">
                                                    <label for="date-out">Other Name:</label>
                                                    <input type="text" id="oname" name="oname" value="{{ $bookings->oname }}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="check-date">
                                            <label for="phone">Phone Number:<span class="text-danger">*</span></label>
                                            <input type="text" id="phone" name="phone" value="{{ $bookings->phone }}" readonly>
                                        </div>
                                        <div class="check-date">
                                            <label for="email">Email:<span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" value="{{ $bookings->email }}" readonly>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <?php
                                    $check_in_date = date('Y-m-d', strtotime($bookings->check_in_date));
                                    $check_out_date = date('Y-m-d', strtotime($bookings->check_out_date));

                                    $arrival_date = !empty($bookings->arrival_date) ? date('Y-m-d', strtotime($bookings->arrival_date)) : '';
                                    $arrival_flight_time = date('H:i', strtotime($bookings->arrival_flight_time));
                                    $departure_date = !empty($bookings->departure_date) ? date('Y-m-d', strtotime($bookings->departure_date)) : '';
                                    $departure_flight_time = date('H:i', strtotime($bookings->departure_flight_time));
                                ?>

                                <div>
                                    <div class="select-option">
                                        <label for="hotel">Hotel:</label>
                                        <select id="hotel_id" name="hotel_id">
                                            <option value=""><<- SELECT HOTEL ->></option>
                                            <?php foreach ($hotel_list as $row): ?>
                                                <option value="{{ $row->id }}" {{ (($row->id == $bookings->hotel_id) ? 'selected' : '') }} >
                                                    {{ strtoupper($row->name) }} 
                                                </option>                                            
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div id="room-selection" style="display: none; margin-top: 10px;">
                                        <label>Choose Room Type:</label>
                                        <div id="room-options"></div>
                                        <input type="hidden" value="{{ $bookings->room_type }}" name="room_id" id="room_id">
                                    </div>
                                    <div class="check-date">
                                        <label for="rooms">Number of Rooms:</label>
                                        <input type="number" id="no_of_rooms" name="no_of_rooms" min="1" value="{{ $bookings->no_of_rooms }}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="check-date">
                                                <label for="date-in">Check In:</label>
                                                <input type="date" id="check_in_date" name="check_in_date" value="{{ $check_in_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="check-date">
                                                <label for="date-out">Check Out:</label>
                                                <input type="date" id="check_out_date" name="check_out_date" value="{{ $check_out_date }}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="seenfr">
                                    <input type="hidden" name="ref_tag"  id="ref_tag" value="{{ $bookings->ref_tag }}">
                                    <input type="hidden" name="payment_status"  id="payment_status" value="{{ $bookings->payment_status }}">

                                    <div id="buttonContainerBottom" style="margin-top: 15px;"></div>
                                </div>
                                
                                 <div class="foreign-guest-box">
                                    <h3>Flight Itinerary</h3>
                                    <div class="flight-details">
                                        <h4>Arrival Details</h4>
                                        <div class="grid-container">

                                            <div class="check-date">
                                                <label for="arrival_airport">From:</label>
                                                <select id="arrival_airport" name="arrival_airport">
                                                    <option value=""><<- SELECT ROUTE ->></option>
                                                    <option value="lagos to benin" {{ (($bookings->arrival_airport == 'lagos to benin') ? 'selected' : '') }}>Lagos to Benin</option>
                                                    <option value="abuja to benin"  {{ (($bookings->arrival_airport == 'abuja to benin') ? 'selected' : '') }}>Abuja to Benin</option>
                                                </select>
                                            </div>

                                            <div class="check-date">
                                                <label for="arrival_airline_name">Airline:</label>
                                                <select id="arrival_airline_name" name="arrival_airline_name">
                                                    <option value=""><<- SELECT AIRLINE ->></option>
                                                    <option value="Aero Contractors" {{ (($bookings->arrival_airline_name == 'Aero Contractors') ? 'selected' : '') }}>Aero Contractors</option>
                                                    <option value="Arik Air" {{ (($bookings->arrival_airline_name == 'Arik Air') ? 'selected' : '') }}>Arik Air</option>
                                                    <option value="Air Peace" {{ (($bookings->arrival_airline_name == 'Air Peace') ? 'selected' : '') }}>Air Peace</option>
                                                    <option value="Green Africa Airways" {{ (($bookings->arrival_airline_name == 'Green Africa Airway') ? 'selected' : '') }}>Green Africa Airways</option>
                                                    <option value="United Nigeria Airlines" {{ (($bookings->arrival_airline_name == 'United Nigeria Airlines') ? 'selected' : '') }}>United Nigeria Airlines</option>
                                                </select>
                                            </div>

                                            <div class="check-date">
                                                <label for="arrival_date">Date:</label>
                                                <input type="date" id="arrival_date" name="arrival_date" min="2025-05-01" max="2025-05-31" value="{{ $arrival_date }}">
                                            </div>
                                            
                                            <div class="check-date">
                                                <label for="arrival_flight_time">Time of Flight:</label>
                                                <input type="time" id="arrival_flight_time" name="arrival_flight_time" value="{{ $arrival_flight_time }}">
                                            </div>
                                            
                                        </div>

                                        <h4>Departure Details</h4>
                                        <div class="grid-container">
                                            <div class="check-date">
                                                <label for="departure_airport">From:</label>
                                                <select id="departure_airport" name="departure_airport">
                                                    <option value=""><<- SELECT ROUTE ->></option>
                                                    <option value="benin to abuja" {{ (($bookings->departure_airport == 'benin to abuja') ? 'selected' : '') }}>Benin to Abuja</option>
                                                    <option value="benin to lagos" {{ (($bookings->departure_airport == 'benin to lagos') ? 'selected' : '') }}>Benin to Lagos</option>
                                                </select>
                                            </div>

                                            <div class="check-date">
                                                <label for="departure_airline_name">Airline:</label>
                                                <select id="departure_airline_name" name="departure_airline_name">
                                                    <option value=""><<- SELECT AIRLINE ->></option>
                                                    <option {{ (($bookings->arrival_airline_name == 'Air Peace') ? 'selected' : '') }} value="Air Peace">Air Peace</option>
                                                    <option {{ (($bookings->arrival_airline_name == 'Aero Contractors') ? 'selected' : '') }}  value="Aero Contractors">Aero Contractors</option>
                                                    <option {{ (($bookings->arrival_airline_name == 'Arik Air') ? 'selected' : '') }} value="Arik Air">Arik Air</option>
                                                    <option {{ (($bookings->arrival_airline_name == 'Arik Peace') ? 'selected' : '') }} value="Arik Peace">Arik Peace</option>
                                                    <option {{ (($bookings->arrival_airline_name == 'Green Africa Airline') ? 'selected' : '') }} value="Green Africa Airline">Green Africa Airline</option>
                                                    <option {{ (($bookings->arrival_airline_name == 'United Nigeria Airlines') ? 'selected' : '') }} value="United Nigeria Airlines">United Nigeria Airlines</option>
                                                </select>
                                            </div>
                                            <div class="check-date">
                                                <label for="departure_date">Date:</label>
                                                <input type="date" id="departure_date" name="departure_date" min="2025-05-01" max="2025-05-31" value="{{ $departure_date }}">
                                            </div>
                                            <div class="check-date">
                                                <label for="departure_flight_time">Time of Flight:</label>
                                                <input type="time" id="departure_flight_time" name="departure_flight_time" value="{{ $departure_flight_time }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="buttonContainer">
                                    <button id="btnBookings" type="submit">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-slider owl-carousel">
                <div class="hs-item set-bg" data-setbg="{{ asset('frontend/img/room//room-3.jpg') }}"></div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let checkInDate = document.getElementById("check_in_date");
            let checkOutDate = document.getElementById("check_out_date");

            // Define allowed date range (May 14 - May 18, 2025)
            let minDate = "2025-05-14";
            let maxDate = "2025-05-18";

            // Set min and max attributes but do not set default values
            checkInDate.min = minDate;
            checkInDate.max = maxDate;
            checkOutDate.min = minDate;
            checkOutDate.max = maxDate;

            // Ensure Check-Out is always after Check-In and within range
            checkInDate.addEventListener("change", function () {
                if (checkInDate.value) { 
                    let selectedCheckIn = new Date(checkInDate.value);
                    let nextDay = new Date(selectedCheckIn);
                    nextDay.setDate(selectedCheckIn.getDate() + 1);

                    let nextDayFormatted = nextDay.toISOString().split("T")[0];

                    // Ensure Check-Out is within range
                    checkOutDate.min = nextDayFormatted <= maxDate ? nextDayFormatted : maxDate;

                    // Clear Check-Out if it doesn't fit the new range
                    if (checkOutDate.value && (checkOutDate.value < nextDayFormatted || checkOutDate.value > maxDate)) {
                        checkOutDate.value = "";
                    }
                } else {
                    checkOutDate.min = minDate;
                    checkOutDate.value = ""; // Reset if Check-In is cleared
                }
            });
        });


        $(document).ready(function() {

            // Submit Booking Form
            $("#frmBookings").submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Disable the submit button to prevent multiple clicks
                $("#btnBookings").prop("disabled", true).text("Processing..."); 

                // Collect form data
                var formData = {
                    fname: $("#fname").val().trim(),
                    lname: $("#lname").val().trim(),
                    oname: $("#oname").val().trim(),
                    phone: $("#phone").val().trim(),
                    email: $("#email").val().trim(),
                    arrival_date: $("#arrival_date").val().trim(),
                    arrival_airline_name: $("#arrival_airline_name").val().trim(),
                    arrival_flight_time: $("#arrival_flight_time").val().trim(),
                    arrival_airport: $("#arrival_airport").val().trim(),
                    departure_date: $("#departure_date").val().trim(),
                    departure_airline_name: $("#departure_airline_name").val().trim(),
                    departure_flight_time: $("#departure_flight_time").val().trim(),
                    departure_airport: $("#departure_airport").val().trim(),
                    hotel_id: $("#hotel_id").val(),
                    rooms: $("#no_of_rooms").val(),
                    room_id: $("#room_id").val(),
                    date_in: $("#check_in_date").val(),
                    date_out: $("#check_out_date").val(),
                    payment_status: $("#payment_status").val(),
                    ref_tag: $('#ref_tag').val(),
                };

                console.log(formData);

                // Simple validation
                if (!formData.fname || !formData.lname || !formData.phone || !formData.email) {
                    Swal.fire({
                        title: "Error!",
                        text: "Please fill all required fields.",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    return;
                }

                // AJAX request to save data
                $.ajax({
                    type: "POST",
                    url: "{{ url('rsvp/update') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        formData: formData
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            // Show a loading spinner before success message
                            Swal.fire({
                                title: "Processing...",
                                text: "Please wait while we update your booking.",
                                icon: "info",
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Simulate processing time before showing success message
                            setTimeout(function () {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Booking updated successfully. Check your email for further details.",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    window.location.href = "{{ route('frontend.index') }}";
                                });
                            }, 3000);
                        }
                        else if (response.status === "unavailable") {
                            Swal.fire({
                                title: "Info!",
                                text: response.message,
                                icon: "info",
                                confirmButtonText: "Try Again"
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: response.message,
                                icon: "error",
                                confirmButtonText: "Try Again"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                        Swal.fire({
                            title: "Oops!",
                            text: "An error occurred while saving your booking.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });

            // Hotel Selection Change Event
            $("#hotel_id").change(function() {
                var hotel_id = $(this).val();
                console.log(hotel_id);
                var roomOptions = $("#room-options");
                var roomContainer = $("#room-selection");

                if (!hotel_id) {
                    roomContainer.hide();
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ url('rsvp/get_rooms_by_hotel') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        hotel_id: hotel_id
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log("AJAX Response:", response);

                        roomOptions.empty(); // Clear previous options

                        if (Array.isArray(response) && response.length > 0) {
                            $.each(response, function(index, room) {
                                var formattedRate = new Intl.NumberFormat('en-NG', {
                                    style: 'currency',
                                    currency: 'NGN',
                                    minimumFractionDigits: 0
                                }).format(room.rates);

                                var option = `
                                    <div>
                                        <input type="radio" id="room_${room.id}" name="room_id" value="${room.id}" class="room-option"
                                            ${room.available_rooms == 0 ? "disabled" : ""}>
                                        <label for="room_${room.id}">${room.type_of_rooms}
                                            (Rooms: ${room.available_rooms == 0 ? "Not Available" : room.available_rooms})
                                        </label>
                                    </div>`;
                                roomOptions.append(option);
                            });

                            roomContainer.show(); // Show room selection container
                        } else {
                            roomOptions.append('<p>No rooms available</p>');
                            roomContainer.show();
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to load room types. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });

            // Handle room selection
            $(document).on("change", ".room-option", function() {
                var roomId = $(this).val();
                $("#room_id").val(roomId); // Store selected room ID in hidden field
            });

        });
    </script>
@endsection