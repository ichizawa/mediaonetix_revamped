@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Sales</h1>
            </div>
        </div>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-12 col-sm-6 col-md-5 col-lg-3">
                    <div class="card">
                        <img src="{{ $event->event_image ? (file_exists(storage_path('app/public/admin/events/' . $event->event_image)) ? asset('storage/admin/events/' . $event->event_image) : asset('storage/merchant/events/' . $event->event_image)) : 'https://s3.amazonaws.com/cdn.designcrowd.com/blog/60-Famous-Band-Logos-That-Rock/header-60-famous-band-logos-that-rock-designcrowd-blog.png' }}"
                            class="card-img-top" style="height: 15rem; object-fit: cover; object-position: center;"
                            alt="Event Image" />

                        {{-- <img src="{{ $event->event_image ? asset('storage/admin/events/' . $event->event_image) : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH14L2EGQ7s9Pujw_3GBM63edV8TLiSDffRA&s" }}"
                        class="card-img-top" style="height: 15rem; object-fit: cover; object-position: center;" alt="Event Image" /> --}}
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <h5 class="card-title">{{ $event->event_name }}</h5>
                            </div>
                            <div class="row d-flex flex-column align-items-start grid gap-3">
                                <div class="col-sm-12 d-flex align-items-center">
                                    <i class="fa fa-calendar fs-7 me-2"></i>
                                    <label class="fw-bold">{{ date('F d, Y', strtotime($event->event_date)) }}</label>
                                </div>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <i class="fa fa-clock fs-7 me-2"></i>
                                    <label class="fw-bold">{{ date('h:i A', strtotime($event->event_time)) }}</label>
                                </div>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <i class="fa fa-clock fs-7 me-2"></i>
                                    <label class="fw-bold">{{ $event->event_loc }}</label>
                                </div>
                                <div class="col-sm-12 d-flex align-items-center justify-content-center">
                                    <button
                                        onclick="window.location = '{{ route('admin.specific.event.sales', $event->slug) }}'"
                                        class="btn btn-sta p-2 w-100 fw-bold">View Sales</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
