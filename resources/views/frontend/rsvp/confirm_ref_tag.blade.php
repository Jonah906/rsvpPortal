@extends('frontend.layouts.app')

@section('styles')

@endsection

@section('content')
   <section class="services-section spad"></section>
  
    <section class="hp-room-section">
        <div class="container-fluid">
            <div class="hp-room-items">
                <h2 style="text-align: center; text-decoration: underline; margin-bottom: 40px;">CONFIRM RERENCE NUMBER</h2>
                <div class="row">
                   <div class="col-lg-12 col-md-12">
                    <form id="frmref_tag" method="POST">
                            <div style="max-width: 700px; margin: auto;">
                                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Refrence Number:</label>
                                <input type="text" id="ref_tag" name="ref_tag" placeholder="Enter your Refrence Number" 
                                  style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

                                <button type="submit" class="btn btn-primary" 
                                        style="display: block; margin: 20px auto; padding: 10px 20px; font-size: 16px; cursor: pointer;">
                                    Confirm
                                </button>
                            </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-section spad"></section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#frmref_tag").submit(function(event) {
                event.preventDefault(); 

                var formData = {
                    ref_tag: $("#ref_tag").val().trim()  
                };

                
                $.ajax({
                    type: "POST",
                    url: "{{ url('rsvp/confirm_ref_tag') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        formData: formData
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                title: "Processing...",
                                text: "Please wait while we check your reference number.",
                                icon: "info",
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            setTimeout(() => {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Reference number is valid.",
                                    icon: "success",
                                    confirmButtonText: "EDIT"
                                }).then(() => {
                                    const safeRefTag = encodeURIComponent(response.ref_tag);
                                    window.location.href = @json(route('rsvp.edit')) + "?ref_tag=" + safeRefTag;
                                });
                            }, 3000);
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
                        console.error("AJAX Error:", xhr.responseText); 
                        Swal.fire({
                            title: "Oops!",
                            text: "An error occurred. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });
    </script>
@endsection