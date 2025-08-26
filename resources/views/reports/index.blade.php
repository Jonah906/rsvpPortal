@extends('layouts.app')

@section('title')
    Reports
@endsection

@section('content')
    <div class="page-wrapper">
        @include('partials.navbar')

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Reports</h4>
                                <p class="text-muted mb-4 font-13"></p>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="d-flex">
                                        <div>
                                            <label for="filter-select">Filter By:</label>
                                            <select id="filter-select" class="form-control">
                                                <option value="">Select Filter</option>
                                                <option value="department">Department</option>
                                                <option value="category">Category</option>
                                                <option value="payment_cycle">Payment Cycle</option>
                                                <option value="expired_subscriptions">Expired Subscriptions</option> <!-- Added filter option -->
                                            </select>
                                        </div>

                                        <div id="dynamic-filter" style="display: none; margin-left: 10px;">
                                            <label for="dynamic-filter-select">Select:</label>
                                            <select id="dynamic-filter-select" class="form-control">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button id="reset-button" class="btn btn-secondary">Reset</button>
                                </div>

                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Subscription Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Payment Cycle</th>
                                            <th>Department</th>
                                            <th>Created By</th>
                                            <th>Subscription Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- DataTables will handle the data -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>

        @include('partials.footer')
    </div>

    <!-- Custom CSS for Buttons -->
    <style>
        .dt-button {
            background-color: white !important;
            color: black !important;
            border: 1px solid #ccc !important;
            padding: 5px 10px !important;
            border-radius: 3px !important;
        }

        .dt-button:hover {
            background-color: #f1f1f1 !important;
            color: black !important;
        }
    </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterSelect = document.getElementById('filter-select');
        const dynamicFilter = document.getElementById('dynamic-filter');
        const dynamicFilterSelect = document.getElementById('dynamic-filter-select');
        const resetButton = document.getElementById('reset-button');
        const dataTable = $('#datatable-buttons').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });

        // Fetch and populate all subscriptions on page load
        const populateAllSubscriptions = () => {
            const url = '{{ route("reports.filter") }}'; // Use the filter endpoint
            fetch(`${url}?filter_type=all`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    dataTable.clear().draw();
                    data.forEach((subscription, index) => {
                        dataTable.row.add([
                            index + 1,
                            subscription.subscription_name,
                            subscription.description,
                            subscription.category_name,
                            subscription.payment_cycle_name,
                            subscription.department,
                            subscription.user_name,
                            subscription.created_at
                        ]).draw(false);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        };

        populateAllSubscriptions(); // Call this on page load

        filterSelect.addEventListener('change', function () {
            const filterType = this.value;
            dynamicFilter.style.display = filterType ? 'block' : 'none';

            let options = '<option value="">Select</option>';
            if (filterType === 'department') {
                @foreach ($departments as $department)
                    options += `<option value="{{ $department->id }}">{{ $department->name }}</option>`;
                @endforeach
            } else if (filterType === 'category') {
                @foreach ($categories as $category)
                    options += `<option value="{{ $category->id }}">{{ $category->name }}</option>`;
                @endforeach
            } else if (filterType === 'payment_cycle') {
                @foreach ($paymentCycles as $paymentCycle)
                    options += `<option value="{{ $paymentCycle->id }}">{{ $paymentCycle->name }}</option>`;
                @endforeach
            } else if (filterType === 'expired_subscriptions') {
                options += `<option value="">Expired Subscriptions</option>`;
            }
            dynamicFilterSelect.innerHTML = options;
        });

        dynamicFilterSelect.addEventListener('change', function () {
            const filterType = filterSelect.value;
            const filterValue = this.value;
            const url = '{{ route("reports.filter") }}';

            fetch(`${url}?filter_type=${filterType}&filter_value=${filterValue}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    dataTable.clear().draw();
                    data.forEach((subscription, index) => {
                        dataTable.row.add([
                            index + 1,
                            subscription.subscription_name,
                            subscription.description,
                            subscription.category_name,
                            subscription.payment_cycle_name,
                            subscription.department,
                            subscription.user_name,
                            subscription.created_at
                        ]).draw(false);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        resetButton.addEventListener('click', function () {
            filterSelect.value = '';
            dynamicFilter.style.display = 'none';
            dynamicFilterSelect.innerHTML = '<option value="">Select</option>';
            populateAllSubscriptions(); // Reset to show all subscriptions
        });
    });
</script>


@endsection
