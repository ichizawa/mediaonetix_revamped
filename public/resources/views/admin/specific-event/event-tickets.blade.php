@extends('layouts')
@section('content')
    @include('components.create-ticket')
    @include('components.update-ticket')
    @include('components.create-announcement')
    @include('components.update-event')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Event > {{ $event->event_name }}</h1>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <button data-bs-toggle="offcanvas" href="#createTicketSidePanel" role="button"
                    aria-controls="createTicketSidePanel" class="btn btn-sta fw-bold">Create Ticket</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card w-100 d-flex">
                    <div class="bg-light d-flex flex-column w-100 p-3">
                        <img src="{{ $event->event_image ? asset('storage/merchant/events/' . $event->event_image) : "https://s3.amazonaws.com/cdn.designcrowd.com/blog/60-Famous-Band-Logos-That-Rock/header-60-famous-band-logos-that-rock-designcrowd-blog.png" }}"
                            class="card-img-top" alt="Event Image"
                            style="height: 20rem; object-fit: cover; object-position: center;" />
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $event->event_name  }}</h5>
                            <a data-bs-toggle="offcanvas" class="btn btn-warning btn-sm rounded" href="#updateEventSidePanel">
                                <i class="fa fa-edit"></i>
                            </a>
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
                            <div class="col-sm-12 d-flex align-items-center">
                                <i class="fa fa-clock fs-7 me-2"></i>
                                <label class="fw-bold">{{ $event->event_loc }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 d-flex">
                <div class="card w-100 d-flex">
                    <div class="m-4">
                        <h2 class="pd-2 fw-bold">Announcement</h2>
                        <div class="gap-5">
                            <div style="max-height: 350px; overflow-y: auto;">
                                <div class="container bg-light p-4 rounded border mb-3">
                                    <h3>Title 1</h3>
                                    <p>Description 1</p>
                                </div>
                                <div class="container bg-light p-4 rounded border mb-3">
                                    <h3>Title 2</h3>
                                    <p>Description 2</p>
                                </div>
                                <div class="container bg-light p-4 rounded border mb-3">
                                    <h3>Title 3</h3>
                                    <p>Description 3</p>
                                </div>
                                <div class="container bg-light p-4 rounded border mb-3">
                                    <h3>Title 4</h3>
                                    <p>Description 4</p>
                                </div>
                            </div>

                            <div class="container bg-light p-4 rounded border text-center" data-bs-toggle="offcanvas"
                                href="#createAnnouncementSidePanel" role="button"
                                aria-controls="createAnnouncementSidePanel" style="cursor: pointer;">

                                <i class="fa fa-plus fs-7 me-2 fst-italic"></i>
                                <label class="fst-italic">Create Announcement</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-stretch">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Event Tickets</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Ticket #</th>
                                        <th>Ticket Name</th>
                                        <th>Ticket Type</th>
                                        <th>Ticket Price</th>
                                        <th>Ticket Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Error Ticket',
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
            const tableTicket = $('#basic-datatables').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: {
                    url: "{{ route('admin.tickets.view', $id) }}",
                    type: "GET",
                    dataType: "json",
                    dataSrc: "",
                },
                columns: [
                    {
                        data: 'id',
                    },
                    {
                        data: 'ticket_name',
                    },
                    {
                        data: 'ticket_type',
                    },
                    {
                        data: 'ticket_price',
                    },
                    {
                        data: 'is_active',
                        render: function (data, type, row) {
                            return data == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function (data, type, row) {
                            return `
                                <a data-bs-toggle="offcanvas" class="btn btn-warning btn-sm rounded" href="#editTicketSidePanel">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm rounded delete-ticket" data-id="${row.id}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            `
                        }
                    }
                ]
            });

            $(document).on('click', '.delete-ticket', function () {
                let id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this ticket!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('admin.delete.ticket') }}",
                            type: "DELETE",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                // console.log(response);
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
                                $('#basic-datatables').DataTable().ajax.reload();
                                // swal({
                                //     title: "Deleted!",
                                //     text: "Your ticket has been deleted.",
                                //     icon: "success",
                                //     button: "OK"
                                // });
                                // if (response.status == 'success') {
                                //     $('#basic-datatables').DataTable().ajax.reload();
                                // }
                            }
                        });
                    }
                });
            })
        });
    </script>
@endsection
