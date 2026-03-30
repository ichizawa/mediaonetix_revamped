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

<div class="container-fluid p-0">
    <div class="position-relative">
        <div class="fullscreen-hero">
            <img src="{{ asset('assets/img/landpage_cover/news_cover.jpg') }}" alt="Header Image" class="img-fluid w-100" style="max-height: 700px; object-fit: cover;">
        </div>
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-3 text-nowrap">
            <h1 class="text-header">In the Spotlight.</h1>
        </div>
    </div>

    <div class="text-center mt-5 my-4 px-3">
        <h1 class="fw-bolder">New Releases</h1>
        <hr class="mx-0" style="border-top: 3px dashed #0F355A; width: 100%;">
    </div>

    <!-- <div class="card p-5 my-5 mx-3 mx-md-5" style="border-top: 10px solid #0F355A;">
        <div class="row gy-4">
            <div class="col-12 col-lg-8 my-5">
                <div><i class="bi bi-calendar-event me-2" style="color: #0F355A"></i>May 1, 2025</div>
                <h2 class="fw-bold">Davao Grunge Concert Rescheduled to May 2, 2025</h2>
                <hr style="border-top: 1px dashed #0F355A;">
                <p>We're turning the volume up just one day later!</p>
                <p>MediaOne Tix is excited to announce the new confirmed date for the much-anticipated Davao Grunge Concert—now set for May 2, 2025. Originally slated for May 1, the reschedule ensures an even more electrifying experience for all fans.</p>
                <p>Taking center stage are none other than:</p>
                <ul>
                    <li><strong>Jeremiah Oroyan</strong> – known for his raw vocals and high-energy performances.</li>
                    <li><strong>John Raphael</strong> – bringing gritty guitar riffs and unmatched stage presence.</li>
                    <li><strong>John Borja</strong> – the voice that grunge fans know and love.</li>
                </ul>
                <p>The venue and ticket details remain the same, and all previously purchased tickets will still be honored on the new date.</p>
                <p>Mark your calendars, gather your crew, and get ready to rock harder than ever on May 2, 2025!</p>
                <div class="d-flex align-items-center gap-2">
                    <p class="mb-0">Still need tickets? Grab yours now on</p>
                    <button class="btn btn-sm text-white rounded-3" style="background-color: #0F355A;">TICKETS</button>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <img src="{{ asset('assets/img/events/grunge_night.png') }}" class="img-fluid" alt="Event">
                <div class="text-white fw-bold p-3 text-center" style="background-color: #0F355A;">NEW CONFIRMED DATE: MAY 2, 2025</div>
            </div>
        </div>
        <div class="text-center mt-4">
            <h5 class="fw-bold">Read More</h5>
            <i class="fa-solid fa-chevron-down" style="color: #0F355A"></i>
        </div>
    </div>

    <div class="card p-5 my-5 mx-3 mx-md-5" style="border-top: 10px solid #0F355A;">
        <div class="row gy-4">
            <div class="col-12 col-lg-4 ">
                <img src="{{ asset('assets/img/events/grunge_night.png') }}" class="img-fluid" alt="Event">
                <div class="text-white fw-bold p-3 text-center" style="background-color: #0F355A;">NEW CONFIRMED DATE: MAY 2, 2025</div>
            </div>
            <div class="col-12 col-lg-8 my-5" >
                <div><i class="bi bi-calendar-event me-2" style="color: #0F355A"></i>May 1, 2025</div>
                <h2 class="fw-bold">Davao Grunge Concert Rescheduled to May 2, 2025</h2>
                <hr style="border-top: 1px dashed #0F355A;">
                <p>We're turning the volume up just one day later!</p>
                <p>MediaOne Tix is excited to announce the new confirmed date for the much-anticipated Davao Grunge Concert—now set for May 2, 2025. Originally slated for May 1, the reschedule ensures an even more electrifying experience for all fans.</p>
                <p>Taking center stage are none other than:</p>
                <ul>
                    <li><strong>Jeremiah Oroyan</strong> – known for his raw vocals and high-energy performances.</li>
                    <li><strong>John Raphael</strong> – bringing gritty guitar riffs and unmatched stage presence.</li>
                    <li><strong>John Borja</strong> – the voice that grunge fans know and love.</li>
                </ul>
                <p>The venue and ticket details remain the same, and all previously purchased tickets will still be honored on the new date.</p>
                <p>Mark your calendars, gather your crew, and get ready to rock harder than ever on May 2, 2025!</p>
                <div class="d-flex align-items-center gap-2">
                    <p class="mb-0">Still need tickets? Grab yours now on</p>
                    <button class="btn btn-sm text-white rounded-3" style="background-color: #0F355A;">TICKETS</button>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <h5 class="fw-bold">Read More</h5>
            <i class="fa-solid fa-chevron-down" style="color: #0F355A"></i>
        </div>
    </div> -->
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endsection