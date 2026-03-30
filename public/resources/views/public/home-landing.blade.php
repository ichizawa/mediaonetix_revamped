@extends('components.navbar-guest')

@section('content')
    <style>
        .card .overlay {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover .overlay {
            opacity: 1;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll {
            animation: scroll-left 30s linear infinite;
        }
    </style>

    <div class="container-fluid p-0 m-0">
        <div class="position-relative">
            <div class="fullscreen-hero">
                <img src="{{ asset('assets/img/landpage_cover/home_cover.png') }}" alt="Header Image" class="img-fluid"
                    style="max-height: 900px; width: 100%; object-fit: cover;">
            </div>
            <div class="d-flex flex-column justify-content-center h-100 w-100 position-absolute top-0 px-3 px-md-5"
                style="z-index: 2; align-items: center;">
                <div class="text-white text-end me-0">
                    <h1 class="text-header mb-0" style="line-height: 1; font-weight: normal;">MEDIAONE</h1>
                    <h1 class="text-header mt-0" style="line-height: 1; font-weight: normal;">TIX</h1>

                    <div class="bg-dark rounded-4 px-5 py-4 py-md-4 text-center mt-3 w-100 w-md-auto d-none d-lg-block">
                        <h1 class="text-white fs-1" style="letter-spacing: 0.5em;">
                            EVERY EVENT, ONE DESTINATION
                        </h1>
                        <!-- <h1 class="text-white fs-1" style="letter-spacing: 0.5em;">
                                                                                - MEDIAONE TIX.
                                                                            </h1> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="multiItemCarousel" class="carousel slide my-5 d-flex justify-content-center" data-bs-ride="carousel">
                                                                    <div class="carousel-inner mb-5 w-100" style="max-width: 1140px;">
                                                                        @foreach ($eventChunk as $index => $chunk)
    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                                <div class="row justify-content-center">
                                                                                    @foreach ($chunk as $event)
    <div class="col-12 col-md-4 mb-4 mb-md-0">
                                                                                            <img src="{{ asset('assets/img/events/Davao Grunge Night 2.png') }}"
                                                                                                class="d-block w-100 rounded" alt="{{ $event->event_name }}">
                                                                                        </div>
    @endforeach
                                                                                </div>
                                                                            </div>
    @endforeach
                                                                    </div>

                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#multiItemCarousel" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#multiItemCarousel" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>

                                                                    <div class="carousel-indicators mt-4 justify-content-center">
                                                                        @foreach ($eventChunk as $index => $chunk)
    <button type="button" data-bs-target="#multiItemCarousel" data-bs-slide-to="{{ $index }}"
                                                                                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                                                                aria-label="Slide {{ $index + 1 }}"></button>
    @endforeach
                                                                    </div>
                                                                </div> -->

        <div class="text-center mt-5 my-4">
            <h1 class="fw-bold">Featured Events</h1>
            <hr style="border-top: 3px dashed  #0F355A; width: 100%;">
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-4 my-5">
            @foreach ($events as $event)
                <div class="card border-0 shadow-sm" style="max-width: 100%; width: 100%; max-width: 400px;">
                    <div class="image-hover-container">
                        <img src="{{ $event->event_image ? (file_exists(storage_path('app/public/merchant/events/' . $event->event_image)) ? asset('storage/merchant/events/' . $event->event_image) : asset('storage/admin/events/' . $event->event_image)) : 'https://s3.amazonaws.com/cdn.designcrowd.com/blog/60-Famous-Band-Logos-That-Rock/header-60-famous-band-logos-that-rock-designcrowd-blog.png' }}"
                            alt="Event Image" class="card-img-top">
                        {{-- <div class="buy-ticket-overlay">
                            <a href="{{ route('buy.ticket', $event->slug) }}">
                            <button onclick="window.location.href = '{{ route('buy.ticket', $event->slug) }}'"
                                class="btn btn-black rounded-5" style="background-color: #fff; z-index: 3;">
                                Buy Ticket
                            </button>
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-2">{{ $event->event_name }}</h5>
                            <button class="btn btn-black btn-sm d-block d-md-none text-end px-3 py-2" style="display: block !important; font-size: 0.8rem;"
                                onclick="window.location.href = '{{ route('buy.ticket', $event->slug) }}'">
                                Buy Ticket
                            </button>
                        </div>
                        <div class="mb-3" style="font-size: 0.95rem;">
                            <i class="bi bi-calendar-event me-2" style="color: #0F355A"></i>
                            {{ date('F d, Y', strtotime($event->event_date)) }} -
                            {{ date('h:i A', strtotime($event->event_time)) }}
                        </div>
                        <div class="mb-3" style="font-size: 0.95rem;">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            {{ $event->event_loc }}
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center align-items-center my-5">
            <button class="btn rounded-3" style="border-width: 2px; color: white; background-color: #0F355A;">
                VIEW ALL EVENTS
                <!-- onmouseover="this.style.backgroundColor='#FF5733'" onmouseout="this.style.backgroundColor='#0F355A'" -->
            </button>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            localStorage.clear();
        });
    </script>
@endsection
