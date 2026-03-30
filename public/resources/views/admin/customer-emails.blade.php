@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center pt-2 pb-4 flex-wrap">
            <h1 class="fw-bold mb-3 mb-md-0">Settings > Customer Emails</h1>
        </div>

        <div class="row d-flex align-items-stretch">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Customer Emails</h4>
                        <!-- Button to open offcanvas -->
                        <!-- <button type="button" class="btn btn-sta fw-bold" data-bs-toggle="modal"
                                            data-bs-target="#createUserModal">
                                            Create Users
                                        </button> -->

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Consented</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('b75c1ebe893ce70cc089', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('customer-channel');
        channel.bind('customer-emails', function (data) {

        });

        function showNotif() {
            swal({
                title: "Work in progress",
                text: "This feature is not available yet",
                type: "info",
            });
        }

        $(document).ready(function () {
            const table = $('#basic-datatables').DataTable({
                pageLength: 10,
                searching: false,
                lengthChange: false,
                info: false,
                data: @JSON($customer_emails),
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return data.id;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return data.customer_first_name + ' ' + data.customer_last_name;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return data.customer_email;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return data.customer_subject_event;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return data.is_consent;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return `
                                            <button class="btn btn-warning btn-sm rounded" onclick="showNotif()">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm rounded">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            `;
                        }
                    }
                ]
            });
        });
    </script>



@endsection
