@extends('layouts.master')
@section('title')
    Darte Ecom
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1')
    Home
    @endslot
    @slot('title')
    Product Orders
    @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <ul class="nav nav-pills nav-justified" id="order-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'new' ? 'active' : '' }} py-3"
                                href="{{ route('productOrders.index', ['status' => 'new']) }}">
                                <i class="bx bx-shopping-bag d-block mb-1 font-size-18"></i>
                                New Orders @if(isset($productOrderBIllingCount) && $productOrderBIllingCount > 0) <span
                                class="badge rounded-pill bg-danger ms-1">{{ $productOrderBIllingCount }}</span> @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'dispatched' ? 'active' : '' }} py-3"
                                href="{{ route('productOrders.index', ['status' => 'dispatched']) }}">
                                <i class="bx bx-cycling d-block mb-1 font-size-18"></i>
                                Dispatched @if(isset($productOrderDispatchCount) && $productOrderDispatchCount > 0) <span
                                class="badge rounded-pill bg-danger ms-1">{{ $productOrderDispatchCount }}</span> @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'delivery' ? 'active' : '' }} py-3"
                                href="{{ route('productOrders.index', ['status' => 'delivery']) }}">
                                <i class="bx bx-car d-block mb-1 font-size-18"></i>
                                Out for Delivery @if(isset($productOrderDeliveryCount) && $productOrderDeliveryCount > 0)
                                    <span class="badge rounded-pill bg-danger ms-1">{{ $productOrderDeliveryCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status == 'delivered' ? 'active' : '' }} py-3"
                                href="{{ route('productOrders.index', ['status' => 'delivered']) }}">
                                <i class="bx bx-check-double d-block mb-1 font-size-18"></i>
                                Delivered
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                                            <a class="nav-link {{ $status == 'return' ? 'active' : '' }} py-3" href="{{ route('productOrders.index', ['status' => 'return']) }}">
                                                <i class="bx bx-undo d-block mb-1 font-size-18"></i>
                                                Returned @if(isset($productreturn) && $productreturn > 0) <span class="badge rounded-pill bg-danger ms-1">{{ $productreturn }}</span> @endif
                                            </a>
                                        </li> -->
                    </ul>
                </div>

                <style>
                    #order-tabs .nav-link {
                        color: #74788d;
                        background-color: #f8f9fa;
                        border: 1px solid #eff2f7;
                        border-radius: 8px;
                        margin: 0 5px;
                        transition: all 0.3s ease;
                        font-weight: 500;
                    }

                    #order-tabs .nav-link:hover {
                        background-color: #eee;
                    }

                    #order-tabs .nav-link.active {
                        background-color: #5156be;
                        color: #fff;
                        border-color: #5156be;
                        box-shadow: 0 4px 10px rgba(81, 86, 190, 0.2);
                    }

                    .badge.bg-danger {
                        background-color: #fd625e !important;
                    }
                </style>

                <div class="card-body">
                    <div id="table-gridjs"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assignToModal" tabindex="-1" aria-labelledby="assignToModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductOrdersModalLabel">Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="#" method="POST" id="changestatus" novalidate="novalidate">
                        <input type="hidden" name="user_id" id="cusid">
                        <input type="hidden" name="phone_number" id="cusnum">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="order_id_input">Order Id*</label>
                                    <input type="text" name="order_id" class="form-control " value="" id="order_id_input"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="customer_name_input">Customer Name*</label>
                                    <input type="text" name="customer_name" class="form-control " value=""
                                        id="customer_name_input" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="add_status_select">Select Status*</label>
                                    <select class="form-select" name="select_status" id="add_status_select">
                                        <option value="" selected>Select status</option>
                                        <option value="5">Ready for Pickup (Shiprocket)</option>
                                        <option value="2">Dispatched</option>
                                        <option value="3">Out for Delivery</option>
                                        <option value="4">Delivered</option>
                                    </select>


                                </div>
                            </div>

                        </div>


                        <div class="text-center">
                            <button class="btn btn-primary mt-3 add_submit_btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="assignToModal1" tabindex="-1" aria-labelledby="assignToModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductOrdersModalLabel">Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="pickupstatus" method="POST" id="changestatus2" novalidate="novalidate">
                        @csrf
                        <input type="hidden" name="user_id" id="cusid6">

                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="order_id_input1">Order Id*</label>
                                    <input type="text" name="order_id" class="form-control " value="" id="order_id_input1"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="customer_name_input1">Customer Name*</label>
                                    <input type="text" name="customer_name" class="form-control " value=""
                                        id="customer_name_input1" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="add_status_select">Select Status*</label>
                                    <select class="form-select" name="select_status" id="add_status_select1">
                                        <option value="" selected>Select status</option>

                                        <option value="1">Pickup</option>





                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="text-center">
                            <button class="btn btn-primary mt-3 add_submit_btn2" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- product refund --}}
    <div class="modal fade" id="RefundModal" tabindex="-1" aria-labelledby="RefundModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RefundModalLabel">Product Refund Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="#" method="POST" id="changestatus1" novalidate="novalidate">
                        <input type="hidden" name="user_id" id="cusid1">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="order_id_input">Order Id*</label>
                                    <input type="text" name="order_id" class="form-control " value="" id="order_id_input1"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="customer_name_input">Customer Name*</label>
                                    <input type="text" name="customer_name" class="form-control " value=""
                                        id="customer_name_input1" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                                <div class="form-group">
                                    <label class="label-control" for="customer_name_input">Customer Name*</label>
                                    <textarea class="form-control " id="customer_resons_input1" readonly></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="text-center">
                            <button class="btn btn-primary mt-3 reson_submit_btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        window.productOrders = @json($productOrders);
        window.currentStatus = "{{ $status }}";
    </script>
    {{--
    <script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script> --}}

    <script src="{{ URL::asset('assets/js/app/ProductOrdersPage.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Function to filter status options based on current tab
            function filterStatusOptions() {
                const urlParams = new URLSearchParams(window.location.search);
                const currentTab = urlParams.get('status') || 'new';
                const $select = $('#add_status_select');

                // Reset select and show all initially
                $select.find('option').show();
                $select.val('');

                if (currentTab === 'new') {
                    // Show Ready for Pickup (5) and Returned / Cancelled (6)
                    $select.find('option').not('[value="5"], [value="6"], [value=""]').hide();
                } else {
                    // For other tabs (Dispatched, etc), statuses are largely automated.
                }
            }

            // Apply filter when modal is about to be shown
            $('#assignToModal').on('show.bs.modal', function () {
                filterStatusOptions();
            });
        });
    </script>
@endsection