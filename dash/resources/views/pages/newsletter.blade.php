@extends('layouts.master')
@section('title')
    Newsletter Subscribers
@endsection

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}">
@endsection

@section('content')
    @component('components.breadcrumb')
    @slot('li_1') Home @endslot
    @slot('title') Newsletter Subscribers @endslot
    @endcomponent

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-4">
                    <div class="avatar-sm mx-auto mb-3">
                        <span class="avatar-title bg-primary rounded-circle fs-4">
                            <i class="mdi mdi-email-newsletter"></i>
                        </span>
                    </div>
                    <h4 class="mb-1 fw-bold">{{ $totalCount }}</h4>
                    <p class="text-muted mb-0">Total Subscribers</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-4">
                    <div class="avatar-sm mx-auto mb-3">
                        <span class="avatar-title bg-success rounded-circle fs-4">
                            <i class="mdi mdi-check-circle"></i>
                        </span>
                    </div>
                    <h4 class="mb-1 fw-bold text-success">{{ $activeCount }}</h4>
                    <p class="text-muted mb-0">Active Subscribers</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-4">
                    <div class="avatar-sm mx-auto mb-3">
                        <span class="avatar-title bg-warning rounded-circle fs-4">
                            <i class="mdi mdi-account-off"></i>
                        </span>
                    </div>
                    <h4 class="mb-1 fw-bold text-warning">{{ $inactiveCount }}</h4>
                    <p class="text-muted mb-0">Inactive Subscribers</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Send Offer Card --}}
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #6f42c1 !important;">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <h5 class="mb-1 fw-bold text-purple">
                                <i class="mdi mdi-email-send me-2" style="color:#6f42c1;"></i>
                                Send Offer to All Active Subscribers
                            </h5>
                            <p class="text-muted mb-0 small">
                                Compose and send a promotional email to all <strong class="text-success">{{ $activeCount }}
                                    active</strong> subscribers instantly.
                            </p>
                        </div>
                        @if($activeCount > 0)
                            <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal"
                                data-bs-target="#sendOfferModal" id="sendOfferBtn">
                                <i class="mdi mdi-send me-1"></i> Compose Offer Mail
                            </button>
                        @else
                            <button class="btn btn-secondary px-4" disabled>
                                <i class="mdi mdi-send-lock me-1"></i> No Active Subscribers
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Subscriber Table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">
                        <i class="mdi mdi-email-outline me-2 text-primary"></i>
                        All Newsletter Subscribers
                    </h5>
                    <span class="badge bg-primary fs-6">{{ $totalCount }} Total</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Email Address</th>
                                    <th>Status</th>
                                    <th>Subscribed At</th>
                                    <th>Created At</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subscribers as $index => $subscriber)
                                    <tr>
                                        <td>{{ $subscribers->firstItem() + $index }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs">
                                                    <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                        {{ strtoupper(substr($subscriber->email, 0, 1)) }}
                                                    </span>
                                                </div>
                                                <span class="fw-medium">{{ $subscriber->email }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($subscriber->is_active)
                                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                                    <i class="mdi mdi-check-circle me-1"></i> Active
                                                </span>
                                            @else
                                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                                    <i class="mdi mdi-pause-circle me-1"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $subscriber->subscribed_at ? \Carbon\Carbon::parse($subscriber->subscribed_at)->format('d M Y, h:i A') : '—' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ \Carbon\Carbon::parse($subscriber->created_at)->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- Toggle status --}}
                                                <form action="{{ route('newsletter.toggle', $subscriber->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $subscriber->is_active ? 'btn-warning' : 'btn-success' }}"
                                                        title="{{ $subscriber->is_active ? 'Deactivate' : 'Activate' }}">
                                                        <i
                                                            class="mdi {{ $subscriber->is_active ? 'mdi-pause' : 'mdi-play' }}"></i>
                                                        {{ $subscriber->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                                {{-- Delete --}}
                                                <form action="{{ route('newsletter.destroy', $subscriber->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to remove this subscriber?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="mdi mdi-delete"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="mdi mdi-email-off display-4 text-muted d-block mb-3"></i>
                                            <p class="text-muted mb-0">No subscribers yet.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($subscribers->hasPages())
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $subscribers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ====== SEND OFFER MODAL ====== --}}
    <div class="modal fade" id="sendOfferModal" tabindex="-1" aria-labelledby="sendOfferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background: linear-gradient(135deg,#6f42c1,#4a90e2); color:#fff;">
                    <h5 class="modal-title mb-0" id="sendOfferModalLabel" style="color:#fff;">
                        <i class="mdi mdi-email-send me-2"></i>
                        Compose Offer Email
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('newsletter.sendOffer') }}" method="POST" id="offerMailForm">
                    @csrf
                    <div class="modal-body p-4">

                        {{-- Info Banner --}}
                        <div class="alert alert-info border-0 d-flex align-items-center gap-2 mb-4 py-2">
                            <i class="mdi mdi-information-outline fs-5"></i>
                            <span>This email will be sent to all <strong>{{ $activeCount }} active</strong>
                                subscribers.</span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="offer_subject">
                                <i class="mdi mdi-format-title me-1 text-primary"></i> Email Subject <span
                                    class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="offer_subject" name="subject"
                                placeholder="e.g. 🎉 Exclusive 20% OFF — This Weekend Only!" maxlength="255" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="offer_title">
                                <i class="mdi mdi-card-text-outline me-1 text-primary"></i> Offer Headline <span
                                    class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="offer_title" name="title"
                                placeholder="e.g. Summer Collection — Flat 20% Off!" maxlength="255" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="offer_message">
                                <i class="mdi mdi-text me-1 text-primary"></i> Email Body / Message <span
                                    class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="offer_message" name="message" rows="5"
                                placeholder="Write your offer details here... (supports plain text)" required></textarea>
                        </div>

                        <div class="mb-1">
                            <label class="form-label fw-semibold" for="offer_link">
                                <i class="mdi mdi-link-variant me-1 text-primary"></i> Call-to-Action Link <span
                                    class="text-muted">(optional)</span>
                            </label>
                            <input type="url" class="form-control" id="offer_link" name="link"
                                placeholder="https://yourstore.com/shop">
                            <div class="form-text">Subscribers will be taken to this link when they click the button.</div>
                        </div>

                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="mdi mdi-close me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-4" id="offerSendBtn">
                            <i class="mdi mdi-send me-1"></i> Send to {{ $activeCount }} Subscribers
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ====== END SEND OFFER MODAL ====== --}}

@endsection

@section('script')
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script>
        // Disable button after submit to prevent double-send
        document.getElementById('offerMailForm').addEventListener('submit', function () {
            var btn = document.getElementById('offerSendBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Sending...';
        });
    </script>
@endsection