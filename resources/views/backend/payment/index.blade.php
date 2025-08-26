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
                                <th>Email</th>
                                <th>Reference Number</th>
                                <th>Number of Nights</th>
                                <th>&#8358;Total Amount</th>
                                <th>Total Night Paid For</th>
                                <th>Total Amount Paid</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Confirm Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doc_list as $doc)
                                   <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($doc->name) }}</td>
                                        <td>{{ $doc->phone}}</td>
                                        <td>{{ strtoupper($doc->email)}}</td>
                                        <td>{{ strtoupper($doc->ref_tag)}}</td>
                                        <td>{{ $doc->date_diff_days }} Night(s)</td>
                                        <td>{{ number_format($doc->total_amount, 2)}}</td>
                                        <td>
                                            @if (!empty($doc->total_amount_paid)) 
                                                {{ number_format($doc->total_amount - $doc->total_amount_paid, 2) }}
                                            @else 
                                                00.00
                                            @endif
                                        </td>

                                        <td>{{ empty($doc->total_amount_paid) ? '00.00' : number_format($doc->total_amount_paid, 2)}}</td>
                                        <td>{{ date('Y-m-d', strtotime($doc->created_at)) }}</td>
                                        <td>
                                            @if ($doc->payment_status == 1)
                                                <span class="badge badge-primary">Confirmed</span>
                                            @else
                                                <span class="badge badge-warning">Awaiting</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($doc->payment_status == 0)
                                                <button 
                                                    type="button" 
                                                    class="btn btn-primary btn-sm open-payment-modal" 
                                                    data-toggle="modal" 
                                                    data-target="#exampleModal" 
                                                    data-ref_tag="{{ $doc->ref_tag}}" 
                                                    data-booking_id="{{ $doc->booking_id}}">
                                                    Confirm Payment
                                                </button>

                                            @endif
                                        </td>
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

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frmProof" method="post">
                            @csrf
                            <input type="hidden" name="ref_tag" id="ref_tag">
                            <input type="hidden" name="booking_id" id="booking_id">

                            <div class="form-group">
                                <label for="total_amount_payed" class="col-form-label">Total Amount Paid: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="total_amount_payed" name="total_amount_payed" >
                                <!-- <input type="text" class="form-control" id="total_amount_payed" name="total_amount_payed" oninput="formatNumber(this)"> -->
                                <span class="text-danger">make sure total amount is the same on payment proof</span>
                            </div>
                            <div class="form-group">
                                <label for="date_payed" class="col-form-label">Date Paid:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="date_payed" name="date_payed">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="submitPaymentBtn" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            Submit
                        </button>
                    </div>
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
        // function formatNumber(input) {
        //     // Remove everything except numbers and dot
        //     let value = input.value.replace(/[^0-9.]/g, '');

        //     // Split into whole and decimal parts
        //     let parts = value.split('.');
        //     let whole = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        //     if (parts.length > 1) {
        //         input.value = whole + '.' + parts[1].substring(0,2); // max 2 decimal places
        //     } else {
        //         input.value = whole;
        //     }
        // }
        $(document).ready(function () {
            // Set booking info dynamically when modal opens
            $('.open-payment-modal').on('click', function () {
                let refTag = $(this).data('ref_tag');
                let bookingId = $(this).data('booking_id');

                $('#ref_tag').val(refTag);
                $('#booking_id').val(bookingId);
            });

            $('#submitPaymentBtn').on('click', function () {
                var $btn = $(this);  // Get the button object

                // Disable the button immediately
                $btn.prop('disabled', true);

                Swal.fire({
                    title: 'Processing Payment',
                    text: 'Please wait...',
                    icon: 'info',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                var formData = {
                    ref_tag: $('#ref_tag').val(),
                    booking_id: $('#booking_id').val(),
                    total_amount_payed: $('#total_amount_payed').val(),
                    date_payed: $('#date_payed').val()
                };

                if (!formData.total_amount_payed || !formData.date_payed) {
                    Swal.fire({
                        title: "Error!",
                        text: "Please fill all required fields.",
                        icon: "warning",
                        confirmButtonText: "OK"
                    });
                    $btn.prop('disabled', false); // Re-enable if validation fails
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "{{ url('payment_confirmation/store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        formData: formData
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Payment confirmed successfully!",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $('#exampleModal').modal('hide');
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                        $btn.prop('disabled', false); // Re-enable the button if error happens
                    }
                });
            });
        });
    </script>
@endsection