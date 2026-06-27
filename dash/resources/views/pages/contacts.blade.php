@extends('layouts.master')
@section('title')
    Contact Messages
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Home @endslot
    @slot('title') Contact Messages @endslot
    @endcomponent

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Subscriber Table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-email-outline me-2 text-primary"></i>
                        Contact Messages
                    </h5>
                    <span class="badge bg-primary fs-6">{{ $totalCount }} Total</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email / Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Received At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $index => $contact)
                                    <tr>
                                        <td>{{ $contacts->firstItem() + $index }}</td>
                                        <td>
                                            <span class="fw-medium">{{ $contact->name }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $contact->email }}</span><br>
                                            <small class="text-muted">{{ $contact->phone_number }}</small>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-info-subtle text-info px-2 py-1">{{ $contact->subject }}</span>
                                        </td>
                                        <td>
                                            <span
                                                style="white-space: pre-wrap; word-break: break-word;">{{ $contact->message }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y, h:i A') }}
                                            </span>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <i class="mdi mdi-email-off display-4 text-muted d-block mb-3"></i>
                                            <p class="text-muted mb-0">No contact messages yet.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                    <div class="mt-4 d-flex justify-content-between align-items-center mb-0">
                        <div class="text-muted" style="font-size: 13px;">
                            @if(count($contacts) > 0)
                                Showing <b>{{ $contacts->firstItem() }}</b> to <b>{{ $contacts->lastItem() }}</b> of <b>{{ $contacts->total() }}</b> results
                            @else
                                Showing <b>0</b> to <b>0</b> of <b>0</b> results
                            @endif
                        </div>
                        <div class="pagination-rounded">
                            {{ $contacts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
@endsection