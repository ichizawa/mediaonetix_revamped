@extends('components.navbar-guest')

@section('content')
    <style>

    </style>

    {{-- <div class="loading" id="loading">
        <div class="loading-spinner"></div>
    </div> --}}

    <div class="bg-animation"></div>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 0px;">
                            <div style="margin-right: 5px;">
                                <img src="{{ URL::asset('assets/img/ddc-artist/ddc-logo.png') }}" class="img-fluid"
                                    style="max-width: 20vh;">
                            </div>
                            <div>
                                <h1 class="hero-subtitle" style="margin: 0; font-size: 20px;">
                                    DAVAO DOCTORS COLLEGE <br>
                                    <span style="font-size: 14px;">PRESENTS</span>
                                </h1>
                            </div>
                        </div>
                        {{-- <img src="{{ URL::asset('assets/img/ddc-artist/ddc-logo.png') }}"
                            class="mx-auto d-block w-25 img-fluid" alt="Moonstar 88">
                        <h1 class="hero-subtitle">DAVAO DOCTORS COLLEGE <br><span style="font-size: 15px;">PRESENTS</span>
                        </h1> --}}
                        <h1 class="hero-title">Salindayaw Music Festival</h1>
                        <div class="event-details">
                            <div class="detail-item">
                                <i class="bi bi-calendar-event"></i>
                                <span> {{ date('F d, Y', strtotime('August 30, 2025')) }}</span>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ date('h:i A', strtotime('4:00 PM')) }}</span>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>Crocodile Park Festival Grounds</span>
                            </div>
                        </div>

                        <div class="text-center btn-container">
                            <a class="cta-button btn btn-lg" href="{{ route('home') }}">
                                Buy your tickets now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h2 class="text-center mb-4 fw-bold f_a" style="color: #4dccc4;">Featured Artists</h2>
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner text-center">
                            <div class="carousel-item active">
                                <img src="{{ URL::asset('assets/img/ddc-artist/PNE.png') }}"
                                    class="mx-auto d-block w-75 img-fluid" alt="Parokya Ni Edgar">
                                <div class="carousel-caption-custom">Parokya Ni Edgar</div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('assets/img/ddc-artist/ohcaraga.png') }}"
                                    class="mx-auto d-block w-75 img-fluid" alt="Oh! Caraga">
                                <div class="carousel-caption-custom">Oh! Caraga</div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('assets/img/ddc-artist/MOONSTAR88.png') }}"
                                    class="mx-auto d-block w-75 img-fluid" alt="Moonstar 88">
                                <div class="carousel-caption-custom">Moonstar 88</div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('assets/img/ddc-artist/EA.png') }}"
                                    class="mx-auto d-block w-75 img-fluid" alt="Earl Agustin">
                                <div class="carousel-caption-custom">Earl Agustin</div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('assets/img/ddc-artist/JR Oclarit.png') }}"
                                    class="mx-auto d-block w-75 img-fluid" alt="JR Oclarit">
                                <div class="carousel-caption-custom">JR Oclarit</div>
                            </div>
                            <div class="carousel-item">
                                <img src="{{ URL::asset('assets/img/ddc-artist/cupofjoe.png') }}"
                                    class="mx-auto d-block w-75 img-fluid" alt="Cup of Joe">
                                <div class="carousel-caption-custom">Cup of Joe</div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <footer class="text-center py-3" style="color: #fff;">
        <div class="container">
            <small>Copyright © 2025. Powered by <a style="color: #4dccc4;" href="https://mediaoneph.com/"
                    target="_blank">MediaOne Software Solutions</a></small>
        </div>
    </footer>
    <script>
        $(document).ready(function() {
            localStorage.clear();
        });
    </script>
@endsection
