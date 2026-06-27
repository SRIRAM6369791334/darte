@extends('layouts.master')
@section('title')
    Darte Ecom
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection


@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Home
        @endslot
        @slot('title')
            Product Wise Reports
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Product Wise Report</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
    <div class="col-md-2">
        <button id="export-excel" class="btn btn-success w-100">Export Excel</button>
    </div>
    <div class="col-md-2" style="display:none;">
        <button id="export-pdf" class="btn btn-danger w-100">Export PDF</button>
    </div>
</div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="filter">Filter by:</label>
                            <select id="filter" class="form-control">
                                <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All Data</option>
                                <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>This Month
                                </option>
                                <option value="last_month">Last Month</option>
                                <option value="this_week">This Week</option>
                                <option value="custom">Custom Date</option>
                            </select>
                        </div>
                        <div class="col-md-3 custom-date d-none">
                            <label for="from-date">From:</label>
                            <input type="date" id="from-date" class="form-control">
                        </div>
                        <div class="col-md-3 custom-date d-none">
                            <label for="to-date">To:</label>
                            <input type="date" id="to-date" class="form-control">
                        </div>
                        <div class="col-md-2 custom-date d-none">
                            <label>&nbsp;</label>
                            <button id="apply-filter" class="btn btn-primary w-100">Apply</button>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="product-report">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Product Name</th>
                                    <th>Variant</th>
                                    <th>Total Quantity Sold</th>
                                    <th>Total Value</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($initialResults as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->product_name ?? '-'  }}</td>
                                        <td>{{ $item->variant_label ?? '-'  }}</td>
                                        <td>{{ $item->total_quantity }}</td>
                                        <td>₹{{ number_format($item->total_value, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>


                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#filter').on('change', function() {
                if ($(this).val() === 'custom') {
                    $('.custom-date').removeClass('d-none');
                } else {
                    $('.custom-date').addClass('d-none');
                    loadReport($(this).val());
                }
            });

            $('#apply-filter').on('click', function() {
                const from = $('#from-date').val();
                const to = $('#to-date').val();

                if (!from || !to) {
                    alert("Please select both From and To dates.");
                    return;
                }

                loadReport('custom', from, to);
            });

            function loadReport(filter, from = '', to = '') {
                $.ajax({
                    url: '{{ route('product.wise.report.filter') }}',
                    data: {
                        filter: filter,
                        from: from,
                        to: to
                    },
                    success: function(data) {
                        let tbody = $('#product-report tbody');
                        tbody.empty();

                        if (data.length > 0) {
                            $.each(data, function(index, item) {
                                const productName = item.product_name && item.product_name.trim() !== '' ? item.product_name : '-';
                    const variantLabel = item.variant_label && item.variant_label.trim() !== '' ? item.variant_label : '-';
                                tbody.append(`
    <tr>
        <td>${index + 1}</td>
        <td>${productName}</td>
        <td>${variantLabel}</td>
        <td>${item.total_quantity}</td>
        <td>₹${parseFloat(item.total_value).toFixed(2)}</td>
    </tr>
`);

                            });
                        } else {
                            tbody.append(
                                '<tr><td colspan="5" class="text-center">No Data Found</td></tr>');
                        }
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            const initialFilter = $('#filter').val();
            if (initialFilter !== 'custom') {
                loadReport(initialFilter);
            }
        });
    </script>
    <script>
    $('#export-excel').click(function () {
        const filter = $('#filter').val();
        const from = $('#from-date').val();
        const to = $('#to-date').val();
        let url = '{{ route("product.wise.report.export.excel") }}' + '?filter=' + filter;

        if (filter === 'custom') {
            url += '&from=' + from + '&to=' + to;
        }

        window.location.href = url;
    });

    $('#export-pdf').click(function () {
        const filter = $('#filter').val();
        const from = $('#from-date').val();
        const to = $('#to-date').val();
        let url = '{{ route("product.wise.report.export.pdf") }}' + '?filter=' + filter;

        if (filter === 'custom') {
            url += '&from=' + from + '&to=' + to;
        }

        window.location.href = url;
    });
</script>


    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection
