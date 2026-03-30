@extends('layouts')

@section('content')
    <div class="page-inner">
        <!-- Header Section -->
        <div class="d-flex flex-column pb-4 align-items-start">
            <div class="mb-2">
                <h1 class="fw-bold mb-1" style="font-size: 2.5rem;">Ticket History</h1>
                <p class="text-muted mb-0" style="font-size: 1.1rem;">View and manage your event ticket purchases</p>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card shadow-sm border-0 mb-4" style="background: linear-gradient(135deg, #ffffff, #f8fbff); border-radius: 12px;">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h6 class="mb-0 fw-semibold">Filter Tickets</h6>
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown position-relative" style="width: 200px; margin-left: auto;">
                            <button id="dropdownBtn" class="btn px-4 py-2 fw-semibold text-white text-start w-100 shadow-sm"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                style="background: linear-gradient(135deg, #1976d2, #1565c0); border: none; border-radius: 8px;">
                                All Tickets
                            </button>
                            <i class="fas fa-chevron-down text-white position-absolute dropdown-arrow"
                                style="right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; font-size: 0.8rem;"></i>

                            <ul class="dropdown-menu w-100 shadow border-0" style="border-radius: 8px; margin-top: 5px;">
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="#" style="color: #1976d2;"
                                        data-value="All Tickets">
                                        All Tickets
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="#" style="color: #1976d2;"
                                        data-value="Completed">
                                        Completed
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="#" style="color: #1976d2;"
                                        data-value="Upcoming">
                                        Upcoming
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="#" style="color: #1976d2;"
                                        data-value="Cancelled">
                                        Cancelled
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item py-2 px-3" href="#" style="color: #1976d2;"
                                        data-value="Refunded">
                                        Refunded
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Cards -->
        <div class="row g-4 mb-5">
            @foreach ($events as $event)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 event-card"
                        style="border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #ffffff, #f8fbff);">
                        <div style="position: relative;">
                            <img src="{{ asset('assets/img/events/Davao Grunge Night 3.png') }}" class="card-img-top"
                                alt="Event Image" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge px-3 py-2 fw-semibold"
                                    style="background: linear-gradient(135deg, #4caf50, #388e3c); border-radius: 20px;">
                                    Completed
                                </span>
                            </div>
                        </div>
                        <div class="card-body px-4 py-3">
                            <h5 class="card-title fw-bold mb-3" style="color: #0d47a1;">{{ $event->event_name }}</h5>

                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 32px; height: 32px; background: linear-gradient(135deg, #bbdefb, #90caf9);">
                                        <i class="fa fa-calendar text-white" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <span
                                        style="color: #1976d2; font-weight: 500;">{{ date('F j, Y', strtotime($event->event_date)) }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 32px; height: 32px; background: linear-gradient(135deg, #bbdefb, #90caf9);">
                                        <i class="fas fa-clock text-white" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <span style="color: #1976d2; font-weight: 500;">{{ date('h:i A', strtotime($event->event_time)) }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle me-3"
                                        style="width: 32px; height: 32px; background: linear-gradient(135deg, #bbdefb, #90caf9);">
                                        <i class="fas fa-map-marker-alt text-white" style="font-size: 0.8rem;"></i>
                                    </div>
                                    <span style="color: #1976d2; font-weight: 500;">{{ $event->event_loc }}</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="d-flex flex-grow-1 justify-content-evenly gap-2">
                                    <button class="btn fw-semibold px-4 py-2 flex-fill"
                                        style="background: linear-gradient(135deg, #4caf50, #388e3c); color: white; border: none; border-radius: 8px;">
                                        <i class="fas fa-check me-2"></i>Completed
                                    </button>
                                    <button class="btn fw-semibold px-4 py-2 flex-fill"
                                        onclick="window.location.href='{{ route('customer.specific.history', $event->slug) }}'"
                                        style="background: linear-gradient(135deg, #1976d2, #1565c0); color: white; border: none; border-radius: 8px;">
                                        <i class="fas fa-eye me-2"></i>View Event
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link border-0 fw-semibold px-3 py-2" href="#"
                            style="background: linear-gradient(135deg, #bbdefb, #90caf9); color: #0d47a1; border-radius: 6px;">
                            Previous
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link border-0 fw-semibold px-3 py-2 mx-1" href="#"
                            style="background: linear-gradient(135deg, #1976d2, #1565c0); color: white; border-radius: 6px;">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link border-0 fw-semibold px-3 py-2 mx-1" href="#"
                            style="background: linear-gradient(135deg, #bbdefb, #90caf9); color: #0d47a1; border-radius: 6px;">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link border-0 fw-semibold px-3 py-2" href="#"
                            style="background: linear-gradient(135deg, #bbdefb, #90caf9); color: #0d47a1; border-radius: 6px;">
                            Next
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

<style>
    /* Minimal hover effects */
    .event-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .event-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(25, 118, 210, 0.12) !important;
    }

    .dropdown-item:hover {
        background-color: #e3f2fd !important;
        color: #0d47a1 !important;
    }

    .page-link {
        transition: transform 0.2s ease;
    }

    .page-link:hover {
        transform: translateY(-1px);
    }

    .btn {
        transition: transform 0.1s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .dropdown-arrow {
        transition: transform 0.2s ease;
    }

    .dropdown[aria-expanded="true"] .dropdown-arrow {
        transform: translateY(-50%) rotate(180deg);
    }

    /* Simple fade in animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fadeInUp {
        animation: fadeInUp 0.4s ease-out forwards;
    }

    /* Better button spacing in cards */
    .d-flex.gap-2 > .btn {
        flex: 1;
    }
</style>

<script>
    function showNotif() {
        swal({
            title: "Work in progress",
            text: "This feature is not available yet",
            type: "info",
        });
    }

    // Simple dropdown functionality
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const dropdownBtn = document.getElementById('dropdownBtn');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const selectedValue = this.getAttribute('data-value');

            // Update button text
            dropdownBtn.textContent = selectedValue;

            // Reset all dropdown items
            dropdownItems.forEach(i => {
                i.style.color = '#1976d2';
                i.style.fontWeight = '500';
            });

            // Highlight selected item
            this.style.color = '#0d47a1';
            this.style.fontWeight = '600';
        });
    });

    // Simple loading animation
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.event-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('fadeInUp');
        });
    });
</script>
