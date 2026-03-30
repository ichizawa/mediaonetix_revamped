@extends('components.navbar-guest')

@section('content')

    <div class="container-fluid px-0">
        <div class="position-relative">
            <div class="fullscreen-hero">
                <img src="{{ asset('assets/img/landpage_cover/about_cover.jpg') }}" alt="Header Image" class="img-fluid w-100" style="max-height: 700px; object-fit: cover;">
            </div>
            <div class="position-absolute top-50 start-50 translate-middle text-white text-center text-nowrap">
                <h1 class="text-header">Behind the Stage.</h1>
            </div>
        </div>
        <div class="text-center mt-5">
            <h1 class="fw-bold">About Us</h1>
            <hr class="section-dashed my-3">
        </div>

        <div class="container py-5" style="padding: 15px !important;">
            <div class="row gx-5">
                <div class="col-lg-8 p-3">
                    <div class="d-flex align-items-start mb-4">
                        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid me-3 about-logo">
                        <div>
                            <div class="mb-2">
                                <i class="fa-solid fa-chevron-down me-2" style="color: #0F355A;"></i> April 29, 2025
                            </div>
                            <h3 class="fw-bold">Behind the Stage – Meet MediaOne Tix</h3>
                            <hr style="border-top: 1px dashed #0F355A;">
                            <p>
                                <strong>MediaOne Tix</strong> is a proudly homegrown online ticketing platform committed to bringing live events closer to you—faster, safer, and simpler. Whether you’re hunting for concert tickets, live shows, cultural festivals, or exclusive local events, we’re here to make sure your next unforgettable experience is just a few clicks away.
                            </p>
                            <p>
                                We are more than just a ticketing site. We are a community of music lovers, concert-goers, artists, and organizers who believe in the power of live events to bring people together.
                            </p>
                        </div>
                    </div>

                    <p>
                        At MediaOne Tix, we don’t just sell tickets—we open doors to shared experiences, unforgettable nights, and stories worth telling.
                    </p>

                    <div class="mb-4 justify-text">
                        <h4 class="fw-bold">Our Mission</h4>
                        <p>
                            Our mission is to provide a seamless and secure digital ticketing experience that connects audiences to the events they love. We aim to simplify the event discovery and booking process, support local talent, and help event organizers reach more people with less hassle.
                        </p>
                        <p>
                            Through technology and community-driven service, we’re building a platform that’s not only reliable but also rooted in passion, culture, and creativity.
                        </p>
                    </div>

                    <div class="mb-4 justify-text">
                        <h4 class="fw-bold">Our Story</h4>
                        <p>
                            MediaOne Tix was born out of a shared frustration: long lines, confusing ticketing processes, and missed opportunities for both fans and organizers. With backgrounds in media production, tech development, and event management, our founding team from <strong>MediaOne</strong> came together to build something better—something local, smart, and built for real fans.
                        </p>
                        <p>
                            What started as a side project evolved into a full-fledged platform serving hundreds of users and helping bring events to life across Davao del Sur and nearby areas. Today, MediaOne Tix stands as a trusted partner in the local entertainment scene—offering real-time booking, secure payment, and support for both organizers and attendees.
                        </p>
                    </div>

                    <div class="mb-4 justify-text">
                        <h4 class="fw-bold">Let’s Stay Connected</h4>
                        <p>
                            Whether you're here to discover your next concert or promote your next event, <strong>MediaOne Tix</strong> is here to help.
                        </p>
                        <ul class="ps-4">
                            <li class="mb-2">
                                Want to list an event with us? <button class="btn btn-sm text-white rounded-3" style="background-color: #0F355A;">CONTACT US</button>
                            </li>
                            <li class="mb-2">
                                Follow us on social media for the latest updates, featured events, and exclusive promos.
                            </li>
                        </ul>
                        <p>Together, let’s keep the music playing and the crowds cheering. Welcome to <strong>MediaOne Tix</strong>—your stage, your scene.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="recent-articles mt-lg-0 mt-5 position-relative">
                        <div class="custom-half-circle">

                        </div>
                        <div class="text-center mb-5">
                            <h3 class="text-white fw-bold">Recent Articles</h3>
                            <hr class="section-dashed-white mt-3" style="opacity: 1; position: static !important;">
                        </div>

                        <!-- <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/events/grunge_night.png') }}" alt="Grunge" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: contain;">
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">Davao Grunge Concert Rescheduled to May 2, 2025</p>
                                <small>April 29, 2025</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/events/grunge_night.png') }}" alt="Venue" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: contain;">
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">Davao Grunge Concert: New Venue and Bold Red Look</p>
                                <small>April 28, 2025</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/events/Davao Grunge Night 2.png') }}" alt="Mariah" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: contain;">
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">Mariah Carey Live in Manila – A Night of Iconic Hits Awaits!</p>
                                <small>April 25, 2025</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/events/Davao Grunge Night 3.png') }}" alt="Script" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: contain;">
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">The Script Live in Manila – One Night Only!</p>
                                <small>April 21, 2025</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <img src="{{ asset('assets/img/events/Davao Grunge Night 5.png') }}" alt="Reggae" class="img-fluid rounded" style="width: 150px; height: 150px; object-fit: contain;">
                            <div class="ms-3">
                                <p class="mb-1 fw-bold">Reggae Rise Up: Elias Lytle x Kulamud Band</p>
                                <small>March 20, 2025</small>
                            </div>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endsection
