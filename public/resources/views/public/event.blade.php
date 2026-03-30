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

    <div class="container" style="padding: 0; margin: 0; max-width: 100%;">
        <div class="position-relative">
            <div class="fullscreen-hero">
                <img src="{{ asset('assets/img/landpage_cover/event_cover.png') }}" alt="Header Image"
                    class="img-fluid w-100" style="max-height: 700px; object-fit: cover;">
            </div>

            <div class="position-absolute top-50 start-50 translate-middle text-white text-center px-3 text-nowrap">
                <h1 class="text-header">Shows and Events.</h1>
            </div>
        </div>

        <div class="text-center mt-5 my-4">
            <h1 class="fw-bolder">Upcoming Events</h1>
            <hr style="border-top: 3px dashed  #0F355A; width: 100%;">
        </div>
        <div class="d-flex flex-wrap gap-2 justify-content-center my-3">
            <button class="btn text-white fw-bold rounded-3" style="background-color: #0F355A;">ALL</button>
            <button class="btn text-white fw-bold rounded-3" style="background-color: #0F355A;">SHOWS & CONCERTS</button>
            <button class="btn text-white fw-bold rounded-3" style="background-color: #0F355A;">SPORTS</button>
            <button class="btn text-white fw-bold rounded-3" style="background-color: #0F355A;">TOURS & ATTRACTION </button>
            <button class="btn text-white fw-bold rounded-3" style="background-color: #0F355A;">CORPORATE EVENTS</button>
            <button class="btn text-white fw-bold rounded-3" style="background-color: #0F355A;">FAMILY</button>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-4 my-5 eventscards">
            @foreach ($events as $event)
                <div class="border-0 event-card" style="width: 400px;" data-id="{{ $event->id }}">
                    <img src="{{ $event->event_image ? asset('storage/merchant/events/' . $event->event_image) : "https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg" }}"
                        class="img-fluid w-100" style="max-height: 700px; object-fit: fill ;">
                    <div class="card-body p-3">
                        <h5 class="card-title mb-2">{{ $event->event_name }}</h5>
                        <div class="mb-3" style="font-size: 0.95rem;">
                            <i class="bi bi-calendar-event me-2 color: #0F355A" style="color: #0F355A"></i>
                            {{ date('F j, Y', strtotime($event->event_date)) }} -
                            {{ date('g:i A', strtotime($event->event_time)) }}
                        </div>
                        <button class="btn btn-outline-primary text-truncate w-75" style="
                            border-width: 2px; 
                            background-color: rgba(15, 53, 90, 0.15);
                            border-color: #0F355A;
                            color: #0F355A; 
                        ">
                            {{ $event->event_loc }}
                        </button>

                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            Pusher.logToConsole = true;

            var pusher = new Pusher('b75c1ebe893ce70cc089', {
                cluster: 'ap1'
            });

            var channel = pusher.subscribe('event-channel');
            channel.bind('event-dashboard', function (data) {
                console.log(data);
                if (data.type === 'create') {
                    $('.eventscards').append(`
                            <div class="border-0 event-card" data-id="${data.event.id}" style="width: 400px;">
                                <img src="" class="img-fluid w-100" style="max-height: 700px; object-fit: fill;">
                                <div class="card-body p-3">
                                    <h5 class="card-title mb-2">${data.event.event_name}</h5>
                                    <div class="mb-3" style="font-size: 0.95rem;">
                                        <i class="bi bi-calendar-event me-2 color: #0F355A" style="color: #0F355A"></i>
                                        ${data.event.event_date} -
                                        ${data.event.event_time}
                                    </div>
                                    <button class="btn btn-outline-primary text-truncate w-75" style="
                                        border-width: 2px; 
                                        background-color: rgba(15, 53, 90, 0.15);
                                        border-color: #0F355A;
                                        color: #0F355A; 
                                    ">
                                        ${data.event.event_loc}
                                    </button>
                                </div>
                            </div>
                        `);
                } else if (data.type === 'delete') {
                    $(`.event-card[data-id="${data.event.id}"]`).remove();
                }
            });
        });
    </script>
@endsection