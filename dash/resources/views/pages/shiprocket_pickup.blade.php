@extends('layouts.master')
@section('title')
    Shiprocket Pickup Locations
@endsection
@section('css')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Shiprocket
        @endslot
        @slot('title')
            Pickup Locations
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Registered Pickup Addresses</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('shiprocket.sync') }}" class="btn btn-info btn-sm">
                                <i class="bx bx-sync me-1"></i> Sync Order Status
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nickname</th>
                                    <th>Address</th>
                                    <th>City/State</th>
                                    <th>Pincode</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $location)
                                    <tr>
                                        <td class="fw-bold">{{ $location['pickup_location'] }}</td>
                                        <td>
                                            {{ $location['address'] }}<br>
                                            <small>{{ $location['address_2'] }}</small>
                                        </td>
                                        <td>{{ $location['city'] }}, {{ $location['state'] }}</td>
                                        <td>{{ $location['pin_code'] }}</td>
                                        <td>{{ $location['phone'] }}</td>
                                        <td>
                                            <span class="badge {{ $location['is_primary'] ? 'bg-primary' : 'bg-secondary' }}">
                                                {{ $location['is_primary'] ? 'Primary' : 'Secondary' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $location['status'] == 'Verified' ? 'bg-success' : 'bg-warning' }}">
                                                {{ $location['status'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($locations) == 0)
                                    <tr>
                                        <td colspan="7" class="text-center">No pickup locations found in your Shiprocket account.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
