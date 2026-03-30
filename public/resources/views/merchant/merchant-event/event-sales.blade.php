@extends('layouts')
@section('content')
    @include('components.create-sale')
    @include('components.view-customer-tickets')
    @include('components.edit-customer-tickets')
    @include('components.resend-email-modal')
    @include('components.export-sale-modal')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Sales > {{ $eventSales->event_name }}</h1>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <button data-bs-toggle="offcanvas" href="#createSalesSidePanel" data-id="" role="button"
                    aria-controls="createSalesSidePanel" class="btn btn-sta fw-bold">Create Sale</button>
            </div>
        </div>
        <div class="row d-flex align-items-stretch">
            <div class="col-md-6">
                <div class="card h-auto w-40">
                    <div class="d-flex flex-column w-100 p-3" style="height: 305px !important;">
                        <img src="{{ $eventSales->event_image ? asset('storage/merchant/events/' . $eventSales->event_image) : 'https://s3.amazonaws.com/cdn.designcrowd.com/blog/60-Famous-Band-Logos-That-Rock/header-60-famous-band-logos-that-rock-designcrowd-blog.png' }}"
                            class="card-img h-100 w-100 rounded" style="object-fit: cover; height: 100%;" alt="">
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <h5 class="card-title">{{ $eventSales->event_name }}</h5>
                        </div>
                        <div class="row d-flex flex-column align-items-start grid gap-2">
                            <div class="col-sm-12 d-flex align-items-center">
                                <i class="fa fa-calendar fs-7 me-2"></i>
                                <label class="fw-bold">{{ date('F d, Y', strtotime($eventSales->event_date)) }}</label>
                            </div>
                            <div class="col-sm-12 d-flex align-items-center">
                                <i class="fa fa-clock fs-7 me-2"></i>
                                <label class="fw-bold">{{ date('h:i A', strtotime($eventSales->event_time)) }}</label>
                            </div>
                            <div class="col-sm-12 d-flex align-items-center">
                                <i class="fa fa-clock fs-7 me-2"></i>
                                <label class="fw-bold">{{ $eventSales->event_loc }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card h-auto w-100">
                    <div class="card-body">
                        <h4 class="fw-bold card-title">Sales</h4>
                        <div class="chart-container">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column align-items-start">
                                    <span class="fw-bold fs-5">Total Sales</span>
                                    <span class="fw-bold fs-5">Walkin Sales</span>
                                    <span class="fw-bold fs-5">Online Sales</span>
                                    <span class="fw-bold fs-5">Pending Sales</span>
                                    <span class="fw-bold fs-5">Disabled Sales</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-column align-items-start">
                                    <span class="fw-bold fs-5 total-sales-text">₱
                                        {{ number_format($totalSales, 2, '.', ',') }}</span>
                                    <span class="fw-bold fs-5 walkin-sales-text">₱
                                        {{ number_format($walkingSales, 2, '.', ',') }}</span>
                                    <span class="fw-bold fs-5 online-sales-text">₱
                                        {{ number_format($onlineSales, 2, '.', ',') }}
                                    </span>
                                    <span class="fw-bold fs-5 total-sales-text">₱
                                        {{ number_format($pendingSales, 2, '.', ',') }}
                                    </span>
                                    <span class="fw-bold fs-5 total-sales-text">₱
                                        {{ number_format($disabledSales, 2, '.', ',') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-end w-100 justify-content-between align-items-end">
                            <h4 class="card-title">Sales List</h4>
                            <div>
                                <button class="btn btn-sm btn-sta fw-bold" id="exportSales" data-bs-toggle="modal"
                                    data-bs-target="#exportSalesModal">Export Sales</button>
                                <button type="button" class="btn btn-sm btn-warning fw-bold" id="informCustomers">Inform
                                    Customers</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1rem !important;">
                        <div class="table-responsive">
                            <table id="basic-datatables1" class="display table table-striped table-hover w-100"
                                style="padding: 0 !important;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date / Time</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Contact</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Birthdate</th>
                                        <th>Ticket Type</th>
                                        <th>Ticket Quantity</th>
                                        <th>Total Price</th>
                                        <th>Payment Method</th>
                                        <th>Purchase Type</th>
                                        <th>Status</th>
                                        <th>TXNID</th>
                                        <th>REFNO</th>
                                        <th>Promo Code</th>
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
    @if (session('success'))
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
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $.notify({
                    icon: 'fa fa-bell',
                    title: 'Something went wrong!',
                    message: "{{ $errors->first() }}"
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
    <script>
        function openResendModal(saleId, email) {
            $('#modalSaleId').val(saleId);
            $('#visibleSaleId').text(saleId);

            var $modalEl = $('#resendEmailTicket');
            var modal = bootstrap.Modal.getOrCreateInstance($modalEl[0]);
            modal.show();

            // console.log('Resend modal triggered with Sale ID:', saleId, 'Email:', email);
        }

        $(document).ready(function () {
            window.merchantSalesData = @json($merchant_sales);
            window.tableSales = $('#basic-datatables1').DataTable({
                pageLength: 10,
                searching: true,
                lengthChange: false,
                info: true,
                responsive: true,
                autoWidth: false,
                data: merchantSalesData,
                orderable: true,
                order: [[0, 'desc']],
                columns: [
                    {
                        data: 'id',
                        visible: false,
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'customer_name'
                    },
                    {
                        data: 'customer_email'
                    },
                    {
                        data: 'customer_contact'
                    },
                    {
                        data: 'customer_address'
                    },
                    {
                        data: 'customer_city'
                    },
                    {
                        data: 'birthdate'
                    },
                    {
                        data: 'ticket_type'
                    },
                    {
                        data: 'customer_quantity'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'payment_method',
                    },
                    {
                        data: 'purchase_type',
                    },
                    {
                        data: 'status',
                        //orderable: false,
                        //searchable: false,
                        render(status) {
                            if (status == 'P')
                                return '<span class="badge bg-warning">Pending</span>';
                            if (status == 'pending')
                                return '<span class="badge bg-warning">Pending</span>';
                            if (status == 'F')
                                return '<span class="badge bg-danger">Cancelled</span>';
                            if (status == 'S')
                                return '<span class="badge bg-success">Paid</span>';
                            if (status == 'D')
                                return '<span class="badge bg-danger">Disabled</span>';

                            return '<span class="badge bg-secondary">unknown</span>';
                        }
                    },
                    {
                        data: 'txnid'
                    },
                    {
                        data: 'refno'
                    },
                    {
                        data: 'promo_code'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render(d) {
                            return `
                                                        <div class="d-flex gap-2">
                                                            <button class="btn btn-sm btn-sta view-cust-tix" data-bs-toggle="modal"
                                                                    data-bs-target="#viewCustomerTickets"
                                                                    data-id="${d.id}" data-event-id="${d.event_id}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-warning"
                                                                    onclick="openResendModal('${d.id}','${d.customer_email}')">
                                                                <i class="fa fa-envelope"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                                    data-bs-target="#editCustomerTickets"
                                                                    data-id="${d.id}" data-event-id="${d.event_id}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger trash-tickets"
                                                                    data-id="${d.id}" data-event-id="${d.event_id}">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    `;
                        }
                    }
                ],
                language: {
                    searchPlaceholder: "Search sales...",
                    info: "_START_-_END_ of _TOTAL_ sales"
                }
            });

            window.tableSales.on('click', '.trash-tickets', function () {
                swal({
                    title: "Are you sure?",
                    text: "You are about to disabled this sale with its related tickets!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        var id = $(this).data('id');
                        var eventId = $(this).data('event-id');

                        $.ajax({
                            url: `{{ route('merchant.sales.disable_sale_tickets') }}`,
                            type: 'DELETE',
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function (data) {
                                // console.info("disable sales: ", data);
                                // window.tableSales.ajax.reload(null, false);
                                $.notify({
                                    icon: 'fa fa-bell',
                                    title: data.title,
                                    message: data.message
                                }, {
                                    type: data.statusCode,
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    delay: 1500
                                });
                            },
                            error: function (xhr, status, error) {
                                var err = xhr.responseJSON.error;
                                $.notify({
                                    icon: 'fa fa-bell',
                                    title: 'Something went wrong!',
                                    message: err
                                }, {
                                    type: 'danger',
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    delay: 1500
                                });
                            },
                            complete: function () {
                                // window.location.reload();
                                recalcChartAndText();
                            }
                        });
                    }
                }).catch((err) => {
                    $.notify({
                        icon: 'fa fa-bell',
                        title: 'Something went wrong!',
                        message: err
                    }, {
                        type: 'danger',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        delay: 1500
                    });
                });
            });

            Chart.defaults.global.defaultFontFamily = 'Lato';
            Chart.defaults.global.defaultFontSize = 18;
            Chart.defaults.global.defaultFontColor = '#777';

            const ctx = document.getElementById('doughnutChart').getContext('2d');
            window.myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Walk-in Sales', 'Online Sales'],
                    datasets: [{
                        data: [0, 0],
                        backgroundColor: ['#0F355A', '#CFE1EA'],
                        borderWidth: 1,
                        borderColor: '#777',
                        hoverBorderWidth: 3,
                        hoverBorderColor: '#000'
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Ticket Sold',
                        fontSize: 25
                    },
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            fontColor: '#000'
                        }
                    },
                    layout: {
                        padding: {
                            left: 50,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    tooltips: {
                        enabled: true
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            recalcChartAndText();

            // Pusher.logToConsole = true;
            var pusher = new Pusher('b75c1ebe893ce70cc089', {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('merchant-sales-channel');
            channel.bind('merchant-sales-updated', function (data) {
                if (merchantSalesData.some(s => s.id === data.id)) {
                    return;
                }
                const validated = {
                    ...data,
                    total_price: parseFloat(data.total_price) || 0,
                    customer_quantity: parseInt(data.customer_quantity) || 0
                };
                merchantSalesData.unshift(validated);
                tableSales.clear().rows.add(merchantSalesData).draw(false);

                // console.info("Sales updated: ", data);
                // window.location.reload();
                recalcChartAndText();
            });



            $('#informCustomers').click(function () {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: `{{ route('merchant.sales.inform_customers') }}`,
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            beforeSend: function () {
                                $('.loadings-container').fadeIn('slow');
                            },
                            success: function (data) {
                                $.notify({
                                    icon: 'fa fa-bell',
                                    title: "Success!",
                                    message: data.message
                                }, {
                                    type: "success",
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    delay: 1500
                                });
                            },
                            error: function (xhr, status, error) {
                                var err = xhr.responseJSON.message || "Unexpected error occurred";
                                $.notify({
                                    icon: 'fa fa-bell',
                                    title: 'Something went wrong!',
                                    message: err
                                }, {
                                    type: 'danger',
                                    placement: {
                                        from: 'top',
                                        align: 'right'
                                    },
                                    delay: 1500
                                }
                                );
                            },
                            complete: function () {
                                // window.location.reload();
                                recalcChartAndText();
                                $('.loadings-container').fadeOut('slow');
                            }
                        });
                    }
                })
            });

        });

        function recalcChartAndText() {
            let walkQty = 0,
                onlineQty = 0,
                walkSales = 0,
                onlineSales = 0,
                total = 0;
            merchantSalesData.forEach(sale => {
                const amt = parseFloat(sale.total_price) || 0;
                const qty = parseInt(sale.customer_quantity) || 0;

                const isOnline = sale.is_online;

                if (isOnline) {
                    onlineQty += qty;
                    onlineSales += amt;

                } else {
                    walkQty += qty;
                    walkSales += amt;
                }
                total += amt;
            });

            myDoughnutChart.data.datasets[0].data = [@json($total_walk_in_ticket_count), @json($total_online_ticket_count)];
            myDoughnutChart.update();

            const fmt = {
                minimumFractionDigits: 2
            };
            // $('.total-sales-text').text(`₱ ${total.toLocaleString(undefined, fmt)}`);
            // $('.walkin-sales-text').text(`₱ ${walkSales.toLocaleString(undefined, fmt)}`);
            // $('.online-sales-text').text(`₱ ${onlineSales.toLocaleString(undefined, fmt)}`);
        }
    </script>
@endsection
