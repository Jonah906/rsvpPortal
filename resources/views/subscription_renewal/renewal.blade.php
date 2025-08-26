@extends('layouts.app')
@section('title')
  Subscriptions
@endsection
@section('content')

    <div class="page-wrapper">

        @include('partials.navbar')

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Subscription Renewal</h4>
                                <p class="text-muted mb-4">
                                    @if (!empty($permissionsAdd))
                                       <a href="{{ route('subscription.create') }}" class="btn btn-info px-4 align-self-center report-btn float-right">Create New</a>
                                    @endif
                                </p>

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Payment Cycle</th>
                                                <th>Start Date</th>
                                                <th>Next Payment Date</th>
                                                <th>Created Date</th>
                                                <th>Status</th> <!-- New Column -->
                                                @if (!empty($permissionsDelete) || !empty($permissionsEdit))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($subscriptions as $sub)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $sub->name }}</td>
                                                <td>{{ $sub->paymentcycles->name }}</td>
                                                <td>{{ $sub->start_date }}</td>
                                                <td>{{ $sub->next_payment_date }}</td>
                                                <td>{{ $sub->created_at }}</td>
                                                <td>
                                                    <!-- Display red button if expired -->
                                                    @if (Carbon\Carbon::parse($sub->next_payment_date)->isPast())
                                                        <label class="badge badge-boxed badge-soft-danger">Expired</label>
                                                    @else
                                                        <button class="btn btn-success btn-sm">Active</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="#renewModal{{ $sub->id }}" class="btn btn-info px-4 align-self-center report-btn float-right" data-toggle="modal" data-target="#renewModal{{ $sub->id }}">Renew</a>
                                                    </div>

                                                    <!-- Renewal Modal -->
                                                    <div class="modal fade" id="renewModal{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="renewModalLabel{{ $sub->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="renewModalLabel{{ $sub->id }}">Renew Subscription</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Click "Auto Renew" to renew automatically to the next payment date: <strong>{{ $sub->next_payment_date }}</strong> or select a custom date for new payment.</p>
                                                                    <form id="customDateForm{{ $sub->id }}" action="{{ route('subscription.renew.custom', $sub->id) }}" method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="custom_date">Custom Date</label>
                                                                            <input type="date" class="form-control" name="custom_date" required>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('subscription.renew.auto', $sub->id) }}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-secondary">Auto Renew</button>
                                                                    </form>
                                                                    <button type="submit" form="customDateForm{{ $sub->id }}" class="btn btn-info">Custom Date</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

                                 <!-- Toast message script -->
                                <script>
                                    @if(session('success'))
                                        toastr.success("{{ session('success') }}");
                                    @endif
                                </script>

                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div><!-- container -->

            @include('partials.footer')
        </div>
        <!-- end page content -->

    </div>
    <!-- end page-wrapper -->

@endsection
