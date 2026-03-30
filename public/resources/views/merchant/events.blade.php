@extends('layouts')
@section('content')
    @include('components.create-event')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Events</h1>
            </div>
        </div>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div style="position: relative;">
                            <img src="{{ $event->event_image ? asset('storage/merchant/events/' . $event->event_image) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' }}"
                                class="card-img-top" alt="Event Image"
                                style="height: 20rem; object-fit: cover; object-position: center;" />
                            <div class="form-check form-switch"
                                style="position: absolute; top: 10px; right: 10px; padding: 5px; border-radius: 5px;">
                                <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <h5 class="card-title text-truncate">{{ $event->event_name }}</h5>
                            </div>
                            <div class="row d-flex flex-column align-items-start grid gap-2">
                                <div class="col-sm-12 d-flex align-items-center">
                                    <i class="fa fa-calendar fs-7 me-2"></i>
                                    <label class="fw-bold">{{ date('F d, Y', strtotime($event->event_date)) }}</label>
                                </div>
                                <div class="col-sm-12 d-flex align-items-center">
                                    <i class="fa fa-clock fs-7 me-2"></i>
                                    <label class="fw-bold">{{ date('h:i A', strtotime($event->event_time)) }}</label>
                                </div>
                                <div class="col-sm-12 d-flex align-items-center justify-content-between mt--2">
                                    <div class="d-flex align-items-center w-75">
                                        <i class="fa fa-map-marker fs-5 me-2"></i>
                                        <span
                                            class="fw-bold me-2 text-truncate d-inline-block w-auto overflow-hidden text-nowrap"
                                            style="max-width: 150px;">
                                            {{ $event->event_loc }}
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center gap-1">
                                        <button
                                            onclick="window.location.href = '{{ route('merchant.events.view', $event->slug) }}'"
                                            class="btn btn-sm p-1">
                                            <i class="fa fa-edit fs-5"></i>
                                        </button>
                                        <button class="btn btn-sm text-danger p-1 delete-event" data-id="{{ $event->id }}">
                                            <i class="fa fa-trash fs-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            <div class="col-sm-4">
                <div data-bs-toggle="offcanvas" href="#createEventSidePanel" role="button"
                    aria-controls="createEventSidePanel"
                    class="card bg-white p-5 h-75 text-black d-flex justify-content-center align-items-center cursor-pointer"
                    style="cursor: pointer;">
                    <i class="fa fa-plus fa-2x text-black"></i>
                    Add Event
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Error',
                    message: @json($errors->all())
                }, {
                    type: 'danger',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 1500
                });
            });
        </script>
    @endif
    @if(session('success'))
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Success!',
                    message: @json(session('success'))
                }, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    delay: 1500
                });
            });
        </script>
    @endif
    <script>
        $(document).ready(function () {
            $(document).on('click', '.delete-event', function () {
                let id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this event!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('merchant.delete.event') }}",
                            type: 'DELETE',
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                // window.location.reload();
                                $.notify({
                                    icon: 'fa fa-bell',
                                    title: response.code == 200 ? 'Success' : 'Error',
                                    message: response.message
                                }, {
                                    type: 'success',
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    delay: 1500
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection