@extends('layouts')

@section('content')
    @include('customer.event.payment')
    @include('customer.event.view-ticket')
    <div class="page-inner">
        <!-- Header Section -->
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="flex-grow-1">
                <h1 class="fw-bold mb-2 text-primary">{{ $event->event_name }}</h1>
                <p class="text-muted mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>{{ date('F j, Y', strtotime($event->event_date)) }}
                    <span class="mx-2">•</span>
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $event->event_loc }}
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <span class="badge bg-success fs-6 px-3 py-2">
                    <i class="fas fa-check-circle me-1"></i>Active Event
                </span>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row">
            <!-- My Tickets Section -->
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 pt-4 pb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <h4 class="fw-bold mb-0 text-dark">
                                    <i class="fas fa-ticket-alt me-2 text-primary"></i>My Tickets
                                </h4>
                                @php
                                    $allTickets = collect();
                                    foreach ($my_tickets as $sale) {
                                        foreach ($sale->customer_tickets as $ticket) {
                                            $allTickets->push([
                                                'sale' => $sale,
                                                'ticket' => $ticket
                                            ]);
                                        }
                                    }
                                @endphp
                                <span class="badge bg-light text-dark ms-2">{{ $allTickets->count() }} total</span>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                    <i class="fas fa-download me-2"></i>Download All
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fas fa-filter me-1"></i>Filter
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">All Tickets</a></li>
                                        <li><a class="dropdown-item" href="#">Paid Only</a></li>
                                        <li><a class="dropdown-item" href="#">Pending Payment</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        @php
                            // Paginate the tickets (6 per page)
                            $perPage = 4;
                            $currentPage = request()->get('page', 1);
                            $paginatedTickets = $allTickets->forPage($currentPage, $perPage);
                            $totalPages = ceil($allTickets->count() / $perPage);
                        @endphp

                        @if($paginatedTickets->count() > 0)
                            <div class="tickets-grid">
                                @foreach($paginatedTickets as $item)
                                    @php
                                        $sale = $item['sale'];
                                        $ticket = $item['ticket'];
                                    @endphp
                                    <div
                                        class="ticket-card border rounded-3 p-4 mb-3 position-relative bg-white shadow-sm hover-shadow transition-all">
                                        <!-- Status indicator strip -->
                                        <div class="position-absolute top-0 start-0 bottom-0 rounded-start"
                                            style="width: 4px; background: {{ $sale->is_paid == 1 ? 'linear-gradient(180deg, #28a745 0%, #20c997 100%)' : ($sale->is_paid == 2 ? 'linear-gradient(180deg, #ffc107 0%, #fd7e14 100%)' : 'linear-gradient(180deg, #dc3545 0%, #e83e8c 100%)') }};">
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <!-- Header with status badge -->
                                                <div class="d-flex align-items-center mb-3">
                                                    @if($sale->is_paid == 1)
                                                        <span class="badge bg-success px-2 py-1 me-3">
                                                            <i class="fas fa-check me-1"></i>PAID
                                                        </span>
                                                    @elseif($sale->is_paid == 2)
                                                        <span class="badge bg-warning text-dark px-2 py-1 me-3">
                                                            <i class="fas fa-clock me-1"></i>PARTIAL
                                                        </span>
                                                    @else
                                                        <span class="badge bg-danger px-2 py-1 me-3">
                                                            <i class="fas fa-exclamation me-1"></i>UNPAID
                                                        </span>
                                                    @endif
                                                    <h5 class="mb-0 fw-bold text-dark">
                                                        {{ $sale->ticket->ticket_type ?? 'Unknown Type' }}
                                                    </h5>
                                                </div>

                                                <!-- Ticket details with improved icons and spacing -->
                                                <div class="ticket-details">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-user text-primary me-2 flex-shrink-0"
                                                            style="width: 16px;"></i>
                                                        <span class="text-dark fw-medium">{{ $sale->customer_name ?? 'N/A' }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-hashtag text-primary me-2 flex-shrink-0"
                                                            style="width: 16px;"></i>
                                                        <span
                                                            class="text-muted font-monospace">{{ $ticket->reference_num ?? 'N/A' }}</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-calendar text-primary me-2 flex-shrink-0"
                                                            style="width: 16px;"></i>
                                                        <span class="text-muted small">
                                                            Purchased on {{ date('M j, Y', strtotime($sale->created_at ?? now())) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- Price section -->
                                                <div class="text-end mb-3">
                                                    <div class="price-display">
                                                        <h4 class="mb-1 fw-bold text-primary">
                                                            ${{ number_format($sale->ticket->ticket_price ?? 0, 2) }}
                                                        </h4>
                                                        {{--<small class="text-muted">
                                                            {{ $sale->customer_tickets->count() }} ticket{{
                                                            $sale->customer_tickets->count() > 1 ? 's' : '' }}
                                                        </small>--}}
                                                    </div>
                                                </div>

                                                <!-- Action buttons -->
                                                <div class="text-end">
                                                    @if($sale->is_paid == 2) <!-- has balance -->
                                                        <button
                                                            class="btn btn-warning btn-sm fw-bold pay-balance-btn mb-2 d-block w-100"
                                                            data-balance="75" data-ticket-id="{{ $sale->id }}"
                                                            data-bs-toggle="offcanvas" data-bs-target="#paymentOffcanvas">
                                                            <i class="fas fa-credit-card me-2"></i>Pay $75 Balance
                                                        </button>
                                                        <div class="btn-group btn-group-sm w-100">
                                                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                                data-bs-target="#viewTicketModal" title="View Details">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-outline-secondary" title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="d-grid gap-2">
                                                            <div class="btn-group btn-group-sm">
                                                                <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#viewTicketModal" title="View Ticket">
                                                                    <i class="fas fa-eye me-1"></i>View
                                                                </button>
                                                                <button class="btn btn-outline-success" title="Download PDF">
                                                                    <i class="fas fa-download me-1"></i>Download
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- QR Code placeholder for visual interest -->
                                        <div class="position-absolute" style="top: 12px; right: 12px; opacity: 0.1;">
                                            <i class="fas fa-qrcode fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Enhanced Pagination -->
                            @if($totalPages > 1)
                                <nav aria-label="Ticket pagination" class="mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="pagination-info">
                                            <small class="text-muted">
                                                Showing {{ (($currentPage - 1) * $perPage) + 1 }} to
                                                {{ min($currentPage * $perPage, $allTickets->count()) }}
                                                of {{ $allTickets->count() }} tickets
                                            </small>
                                        </div>
                                        <div class="pagination-controls">
                                            <ul class="pagination pagination-sm mb-0">
                                                @if($currentPage > 1)
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page={{ $currentPage - 1 }}" aria-label="Previous">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                @endif

                                                @php
                                                    $start = max(1, $currentPage - 2);
                                                    $end = min($totalPages, $currentPage + 2);
                                                @endphp

                                                @if($start > 1)
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page=1">1</a>
                                                    </li>
                                                    @if($start > 2)
                                                        <li class="page-item disabled">
                                                            <span class="page-link">...</span>
                                                        </li>
                                                    @endif
                                                @endif

                                                @for($i = $start; $i <= $end; $i++)
                                                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                                    </li>
                                                @endfor

                                                @if($end < $totalPages)
                                                    @if($end < $totalPages - 1)
                                                        <li class="page-item disabled">
                                                            <span class="page-link">...</span>
                                                        </li>
                                                    @endif
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page={{ $totalPages }}">{{ $totalPages }}</a>
                                                    </li>
                                                @endif

                                                @if($currentPage < $totalPages)
                                                    <li class="page-item">
                                                        <a class="page-link" href="?page={{ $currentPage + 1 }}" aria-label="Next">
                                                            <i class="fas fa-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            @endif
                        @else
                            <!-- Empty state -->
                            <div class="empty-state text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-ticket-alt fa-4x text-muted opacity-50"></i>
                                </div>
                                <h5 class="text-muted mb-3">No tickets found</h5>
                                <p class="text-muted mb-4">You haven't purchased any tickets for this event yet.</p>
                                <a href="#buy-more-tickets" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Buy Tickets Now
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Buy More Tickets and Cart -->
            <div class="col-md-4">
                <!-- Buy More Tickets Section -->
                <div class="card shadow-sm border-0 mb-4" id="buy-more-tickets">
                    <div class="card-header bg-white border-0 pt-4">
                        <h4 class="fw-bold mb-0 text-dark">
                            <i class="fas fa-shopping-cart me-2 text-success"></i>Buy More Tickets
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Scrollable ticket container -->
                        <div class="ticket-scroll-container"
                            style="max-height: 400px; overflow-y: auto; margin-bottom: 1rem;">
                            @foreach($event->tickets as $ticket)
                                @if($ticket->ticket_price > 0)
                                    <div class="ticket-option border rounded-3 p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="fw-bold mb-0">{{ $ticket->ticket_type }}</h6>
                                            <span class="badge bg-success">Available</span>
                                        </div>
                                        <p class="text-muted small mb-3">{{ $ticket->ticket_name }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="h5 fw-bold text-primary">${{ $ticket->ticket_price }}</span>
                                                <small class="text-muted">/ticket</small>
                                            </div>
                                            <button class="btn btn-primary btn-sm add-ticket-btn" data-ticket-id="{{ $ticket->id }}"
                                                data-ticket-type="{{ $ticket->ticket_type }}"
                                                data-ticket-price="{{ $ticket->ticket_price }}">
                                                <i class="fas fa-plus me-1"></i>Add
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Shopping Cart Section -->
                <div class="card shadow-sm border-0 cart-section" style="display: none;">
                    <div class="card-header bg-white border-0 pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="fw-bold mb-0 text-dark">
                                <i class="fas fa-shopping-cart me-2 text-primary"></i>Shopping Cart
                            </h4>
                            <div class="position-relative">
                                <span class="badge bg-primary rounded-pill cart-badge">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Cart Items Container -->
                        <div class="cart-items-container mb-3">
                            <!-- Cart items will be dynamically added here -->
                        </div>
                        <!-- Empty Cart Message -->
                        <div class="empty-cart-message text-center text-muted py-4" style="display: none;">
                            <i class="fas fa-shopping-cart fa-3x mb-3 opacity-50"></i>
                            <p>Your cart is empty</p>
                        </div>

                        <!-- Cart Summary -->
                        <div class="cart-summary border-top pt-3" style="display: none;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Total Items:</span>
                                <span class="total-items-count">0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="fw-bold">Total Amount:</span>
                                <span class="total-amount-display text-primary fw-bold">$0.00</span>
                            </div>

                            <!-- Clear Cart and Checkout Buttons -->
                            <div class="d-grid gap-2">
                                <button class="btn btn-success fw-bold proceed-checkout-btn" data-bs-toggle="offcanvas"
                                    data-bs-target="#paymentOffcanvas">
                                    <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                                </button>
                                <button class="btn btn-outline-danger btn-sm clear-cart-btn">
                                    <i class="fas fa-trash me-2"></i>Clear Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>
@endsection