@extends('backend.layouts.app')

@section('content')

<!-- Page Content -->
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">

                <!-- Header Buttons Row -->
                <div class="row mb-4">
                    <div class="col text-center">
                        <a href="{{ url('bookings/download_template') }}" role="button" class="btn btn-primary px-4">
                            DOWNLOAD EXCEL TEMPLATE
                        </a>
                    </div>
                </div>

                <!-- Form Row -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form id="frmBookings" method="POST" enctype="multipart/form-data" class="p-3 border rounded shadow-sm bg-light">
                            @csrf
                            <h4 class="text-center mb-2 font-weight-bold text-uppercase">Batch Upload</h4>

                            <!-- Hotel Dropdown -->
                            <div class="form-group mb-3">
                                <label for="hotel" class="form-label">Select Hotel</label>
                                <select name="hotel_id" class="form-control" id="hotel_id" required>
                                    <option value=""><<- SELECT HOTEL ->></option>
                                    @foreach ($hotels as $hotel)
                                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Excel Upload -->
                            <div class="form-group mb-4">
                                <label for="excel" class="form-label">Upload Excel File</label>
                                <input type="file" class="form-control" id="excel" name="excel" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-5">
                                    Submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- End Form Row -->

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // Submit Booking Form
            $("#frmBookings").submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Disable the submit button to prevent multiple clicks
                $("#btnBookings").prop("disabled", true).text("Processing..."); 

                // Collect form data
                let formData = new FormData($("#frmBookings")[0]);

                console.log(formData);

                //AJAX request to save data
                $.ajax({
                    type: "POST",
                    url: "{{ url('bookings/batch_upload') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            // Show a loading spinner before success message
                            Swal.fire({
                                title: "Processing...",
                                text: "Please wait while we save your booking.",
                                icon: "info",
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Simulate processing time before showing success message
                            setTimeout(() => {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Booking saved successfully.",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(() => {
                                    location.reload(); // Reload the page after success
                                });
                            }, 3000); // Adjust the delay as needed (3000ms = 3 seconds)
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

                        let errorMessage = "An error occurred while saving your booking.";

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: "Oops!",
                            text: errorMessage,
                            icon: "error",
                            confirmButtonText: "OK"
                        });

                        // Re-enable button if needed
                        $("#btnBookings").prop("disabled", false).text("Submit");
                    }

                });
            });

        });
    </script>
@endsection
