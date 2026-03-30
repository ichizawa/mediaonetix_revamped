@extends('layouts')

@section('content')
    @include('components.create-users')
    @include('components.update-user')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Users</h1>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <button data-bs-toggle="offcanvas" href="#createUserSidePanel" data-id="" role="button"
                    aria-controls="createUserSidePanel" class="btn btn-sta fw-bold">Create User</button>
            </div>
        </div>
        <div class="row d-flex align-items-stretch">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 1rem !important;">
                        <div class="table-responsive">
                            <table id="basic-datatables1" class="display table table-striped table-hover w-100"
                                style="padding: 0 !important;">
                                <thead>
                                    <tr>
                                        <th>Date / Time</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Event</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ date('M d, Y h:i A', strtotime($user->created_at)) }}</td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->events->event_name }}</td>
                                            <td>{{ $user->is_admin == 2 ? 'Merchant Staff' : 'Merchant Admin' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $user->is_active == 1 ? 'success' : 'danger' }}">
                                                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-sta edit-user" data-bs-toggle="offcanvas"
                                                    href="#updateUserSidePanel"
                                                    data-value="{{ base64_encode(json_encode($user)) }}" role="button"
                                                    aria-controls="updateUserSidePanel">Edit</button>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="deleteUser({{ $user->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Event</h4>
                    </div>
                    <div class="card-body" style="padding: 1rem !important;">
                        <div class="table-responsive">
                            <table id="event-datatables" class="display table table-striped table-hover w-100"
                                style="padding: 0 !important;">
                                <thead>
                                    <tr>
                                        <th>Date / Time</th>
                                        <th>Event ID</th>
                                        <th>Event Slug</th>
                                        <th>Event Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event as $event_details)
                                        <tr class="event_clicked" data-id="{{ $event_details->id }}">
                                            <td>{{ date('F d, Y', strtotime($event_details->event_date)) }}
                                                {{ date('g:i A', strtotime($event_details->event_time)) }}
                                            </td>
                                            <td>{{ $event_details->id }}</td>
                                            <td>{{ $event_details->slug }}</td>
                                            <td>{{ $event_details->event_name }}</td>
                                            <td><span class="badge bg-success">Test {{ $event_details->status }}</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning">View</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users > Event</h4>
                    </div>
                    <div class="card-body" style="padding: 1rem !important;">
                        <div class="table-responsive">
                            <table id="users-event-datatables" class="display table table-striped table-hover w-100"
                                style="padding: 0 !important;">
                                <thead>
                                    <tr>
                                        <th>Date / Time</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
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
            $('#basic-datatables1').DataTable({});
            $('#event-datatables').DataTable({});

            let users = $('#users-event-datatables').DataTable({
                length: 10,
                paging: true,
                searching: true,
                columns: [
                    {
                        data: 'created_at',
                        render: function (data, type, row) {
                            return new Date(data).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        }
                    },
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    // { data: 'event_name' },
                    { data: 'role_type' },
                    { data: 'is_active' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `
                                <button class="btn btn-sm btn-sta edit-btn" data-bs-toggle="offcanvas"
                                    href="#updateUserSidePanel"
                                    data-value="${data}" role="button">Edit</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteUser(${data.id})">Delete</button>
                            `;
                        }
                    }
                ]
            });

            $(document).on('click', '.event_clicked', function () {
                var id = $(this).data('id');

                $.ajax({
                    url: `event-users/${id}`,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    beforeSend: function () {

                    },
                    success: function (response) {
                        console.info(response);
                        users.clear().draw();
                        users.rows.add(response.data.users).draw();
                    },
                    error: function (xhr, status, error) {
                        $.notify({
                            icon: 'fa fa-bell',
                            title: 'Error',
                            message: xhr.responseJSON.message
                        }, {
                            type: 'danger',
                            timer: 1000,
                            placement: {
                                from: 'top',
                                align: 'right'
                            }
                        });
                    },
                    complete: function () {

                    }
                });
            });
        });

        function deleteUser(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: `delete-users`,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        data: {
                            id: id
                        },
                        beforeSend: function () {

                        },
                        success: function (response) {
                            // $('#users-event-datatables').DataTable().ajax.reload();
                            $('#basic-datatables1').DataTable().ajax.reload();

                            $.notify({
                                icon: 'fa fa-bell',
                                title: 'Success',
                                message: response.message
                            }, {
                                type: 'success',
                                timer: 1000,
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            $.notify({
                                icon: 'fa fa-bell',
                                title: 'Error',
                                message: xhr.responseJSON.message
                            }, {
                                type: 'danger',
                                timer: 1000,
                                placement: {
                                    from: 'top',
                                    align: 'right'
                                }
                            });
                        },
                        complete: function () {

                        }
                    });
                }
            }).catch((err) => {

            });
        }

    </script>
@endsection