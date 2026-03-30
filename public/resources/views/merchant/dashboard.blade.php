@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="card" style="height: 500px !important;">
                    <div class="card-body">
                        <h4 class="fw-bold">Scheduled Events</h4>
                        <div class="row">
                            @if($events->isNotEmpty())
                                @foreach ($events as $event)
                                    <div class="col-md-12">
                                        <div class="card text-bg-dark position-relative border-0 dashboard-card placeholder-glow"
                                            onclick="showNotif('{{ $event }}', '{{ $walkin_sales }}', '{{ $online_sales }}', {{ $walkin_tix }}, '{{ $online_tix }}')"
                                            style="cursor: pointer;  transition: transform 0.3s ease;">
                                            <div class="image-container">
                                                <img src="{{ $event->event_image ? asset('storage/merchant/events/' . $event->event_image) : "https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg" }}"
                                                    class="card-img" alt="Event Image" />
                                                <div class="overlay"></div>
                                            </div>
                                            <div class="card-img-overlay d-flex flex-column justify-content-end p-3 placeholder">
                                                <h5 class="card-title fw-bold text-white placeholder truncate-text">
                                                    {{ $event->event_name }}
                                                </h5>
                                                <p class="card-text text-light placeholder truncate-text">{{ $event->event_loc }}
                                                </p>
                                            </div>
                                            <div
                                                class="card-date position-absolute top-0 end-0 m-3 bg-light text-dark p-2 rounded text-center shadow-sm placeholder">
                                                <h4 class="d-block fw-bold placeholder">
                                                    {{ date('F', strtotime($event->event_date)) }}
                                                    <br>{{ date('d', strtotime($event->event_date)) }}
                                                </h4>
                                                <hr />
                                                <small
                                                    class="d-block fw-bold mt-0 placeholder">{{ date('hA', strtotime($event->event_time)) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif


                            <!-- <div class="col-md-12">
                                            <div class="card text-bg-dark position-relative border-0 ">
                                                <button class="btn btn-xl text-white">
                                                    <div class="image-container">
                                                        <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                                            <h5>+ Add Event</h5>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 second-panel" style="display: none;">
                <div class="card">
                    <div class="card-body">
                        <div class="row placeholder-glow">
                            <div class="col-md-5" style="height: 305px !important;">
                                <img class="img-fluid w-100 h-100 rounded placeholder"
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH14L2EGQ7s9Pujw_3GBM63edV8TLiSDffRA&s"
                                    id="event_image" alt="Davao Grunge Night" style="object-fit: cover; height: 100%;" />
                            </div>
                            <div class="col-md-7 d-flex flex-column justify-content-center placeholder">
                                <div class="card-body p-3 placeholder">
                                    <h5 class="card-title fw-bold placeholder" id="event_title"></h5>
                                    <!-- <p class="card-text text-muted mb-1 placeholder" id="event_loc"></p> -->
                                    <!-- <p class="mb-1 placeholder"><strong>Price:</strong> 
                                         <span class="fw-bold text-dark placeholder" id="event_price"></span> -->
                                    </p>
                                    <p class="mb-3">
                                        <i class="bi bi-geo-alt-fill text-primary"></i> 
                                        Location: <a id="event_loc"></a></p>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control text-truncate placeholder"
                                        value="" id="event_url" readonly>
                                    <span class="input-group-text" style="cursor: pointer;">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-dark text-white shadow-sm">
                            <div class="card-body px-4 placeholder">
                                <div class="d-flex align-items-center placeholder">
                                    <i class="bi bi-ticket-perforated fs-3 me-3 text-light"></i>
                                    <div>
                                        <p class="mb-0 fw-bold">Sold</p>
                                            <small id="walkin_quantity"></small>
                                    </div>
                                </div>
                                <h2 class="fw-bold" id="walkin_sales"></h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-primary text-white shadow-sm placeholder-glow">
                            <div class="card-body px-4 placeholder">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-text fs-3 me-3 text-light"></i>
                                    <div>
                                        <p class="mb-0 fw-bold">Booked</p>
                                        <small id="online_quantity"></small>
                                    </div>
                                </div>
                                <h2 class="fw-bold" id="online_sales"></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function showNotif(event_data, walkin_sales, online_sales, walkin_tix, online_tix) {
        // swal({
        //     title: "Work in progress",
        //     text: "This feature is not available yet",
        //     type: "info",
        // });
        $('.second-panel').fadeIn();
        var res = JSON.parse(event_data);
        $('#event_image').attr('src', '{{ asset('storage/merchant/events') }}/' + res.event_image);
        $('#event_title').text(res.event_name);
        $('#event_loc').text(res.event_loc);
        $('#event_url').val(`https://mediaonetix.com/${res.slug}`);
        $('#walkin_quantity').text(walkin_tix + ' Tickets');
        $('#walkin_sales').text(walkin_sales + ' PHP');
        $('#online_quantity').text(online_tix + ' Tickets');
        $('#online_sales').text(online_sales + ' PHP');
    }
</script>