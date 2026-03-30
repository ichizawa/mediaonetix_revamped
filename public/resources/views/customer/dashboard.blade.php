@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Dashboard</h1>
            </div>
        </div>

        <div class="row d-flex align-items-stretch">
            <div class="col-md-5 d-flex">
                <div class="card w-100">
                    <h4 class="fw-bold my-4 mx-4">Purchase Ticket</h4>
                    <div class="card-body d-flex flex-column">
                        <div class="row">
                            <div class="col-md-12" id="cardContainer">

                                <div class="position-relative border-0 mb-4">
                                    <div
                                        style="width: 80px; height: 80px; background-color: white; border-radius: 50%; position: absolute; left: -40px; top: 50%; transform: translateY(-50%); z-index: 10;">
                                    </div>

                                    <div class="image-container">
                                        <div class="card-body p-0 d-flex align-items-center justify-content-center"
                                            style="max-height: 250px;">
                                            <img src="{{ asset('assets/img/events/Davao Grunge Night 1.png') }}"
                                                class="card-img-top" alt="Event Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 d-flex flex-column d-none">
                <div class="card flex-fill mb-4 overflow-hidden shadow-sm">
                    <div class="row g-0 h-100">
                        <!-- Image Column - Full width on mobile, half on desktop -->
                        <div class="col-12 col-md-5">
                            <img src="{{ asset('assets/img/events/Davao Grunge Night 3.png') }}"
                                class="img-fluid w-100 h-100 object-fit-cover rounded-start" alt="Event Image: MediaOne Tix"
                                style="min-height: 200px; max-height: 300px; object-position: center;">
                        </div>

                        <!-- Content Column -->
                        <div class="col-12 col-md-7 d-flex flex-column">
                            <div class="card-body d-flex flex-column h-100 p-3 p-md-4">
                                <!-- Event Title with better hierarchy -->
                                <h3 class="card-title fw-bold fs-5 mb-2">MediaOne Tix</h3>

                                <!-- Event Details -->
                                <div class="mb-2">
                                    <p class="card-text mb-1">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <span class="text-muted">Date:</span> June 15, 2023
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-clock text-primary me-2"></i>
                                        <span class="text-muted">Time:</span> 6:00 PM
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <span class="text-muted">Location:</span> Mic 1 Live Room, Davao City
                                    </p>
                                </div>

                                <!-- Price with emphasis -->
                                <div class="mt-auto pt-2">
                                    <p class="card-text mb-3">
                                        <span class="badge bg-primary text-white py-2 px-3 fs-6">
                                            <i class="fas fa-ticket-alt me-2"></i>
                                            Gate Fee: 100 PHP
                                        </span>
                                    </p>

                                    <!-- Share link section with improved interaction -->
                                    <div class="d-flex align-items-center bg-light rounded p-2">
                                        <i class="fas fa-share-alt text-muted me-2"></i>
                                        <span class="text-truncate flex-grow-1" id="event-link">
                                            {{ url()->current() }}
                                        </span>
                                        <button class="btn btn-sm btn-outline-secondary ms-2" onclick="copyToClipboard()"
                                            title="Copy Link" aria-label="Copy event link to clipboard">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h1 class="fw-bold mb-3 p-3">News & Announcements</h1>

                <div class="card p-3 flex-fill">
                    <div class="row g-0 h-100">
                        <div class="col-12 col-md-6 p-3 d-flex flex-column">
                            <h1 class="fw-bold">Davao Grunge Concert Reschedule to May 2, 2025</h1>
                            <div class="d-flex align-items-center my-2">
                                <i class="fa fa-calendar me-2"></i>
                                <span>April 25, 2025</span>
                            </div>
                            <hr style="border-top: 3px dashed  #0F355A; width: 100%;">
                            <p class="mb-0">MediaOne Tix is excited to announce the new confirmed date for the
                                much-anticipated Davao Grunge Concert—now set for May 2, 2025. Originally slated for May 1,
                                the reschedule ensures an even more electrifying experience for all fans. <span
                                    class="fw-bold">Read More.</span></p>
                        </div>
                        <div class="col-12 col-md-6">
                            <img src="{{ asset('assets/img/events/Davao Grunge Night 3.png') }}"
                                class="img-fluid w-100 h-100 object-fit-cover rounded-end" alt="Event Image"
                                style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        const hiddenCards = document.querySelectorAll('.hidden-card');
        let isExpanded = false;

        toggleBtn.addEventListener('click', () => {
            hiddenCards.forEach(card => {
                card.style.display = isExpanded ? 'none' : 'block';
            });
            toggleBtn.textContent = isExpanded ? 'Show More' : 'Show Less';
            isExpanded = !isExpanded;
        });
    </script>
    <script>
        function showNotif() {
            swal({
                title: "Work in progress",
                text: "This feature is not available yet",
                type: "info",
            });
        }
    </script>
    <script>
        function copyToClipboard() {
            const text = document.getElementById('event-link').innerText;
            navigator.clipboard.writeText(text).then(() => {
                // Optional: alert or toast
                console.log('Link copied:', text);
            });
        }
    </script>
@endsection
