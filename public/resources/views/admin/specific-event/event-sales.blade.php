@extends('layouts')
@section('content')
    @include('components.create-sale')
    @include('components.view-customer-tickets')
    @include('components.edit-customer-tickets')
    @include('components.resend-email-modal')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="page-inner">
        <div class="d-flex align-items-md-center flex-column flex-md-row pt-2 pb-4">
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
                        <img src="{{ $eventSales->event_image ? asset('storage/admin/events/' . $eventSales->event_image) : 'https://s3.amazonaws.com/cdn.designcrowd.com/blog/60-Famous-Band-Logos-That-Rock/header-60-famous-band-logos-that-rock-designcrowd-blog.png' }}"
                            class="card-img h-100 w-100 rounded" style="object-fit: cover; height: 100%;" alt="Event Image">

                        {{-- <img
                            src="{{ $eventSales->event_image ? asset('storage/admin/events/' . $eventSales->event_image) : "
                            https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSH14L2EGQ7s9Pujw_3GBM63edV8TLiSDffRA&s"
                            }}" class="card-img h-100 w-100 rounded" style="object-fit: cover; height: 100%;"
                            alt="Davao Grunge Night"> --}}
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
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-column align-items-start">
                                    <span class="fw-bold fs-5 total-sales-text">₱
                                        {{ number_format($totalSales, 2, '.', ',') }}</span>
                                    <span class="fw-bold fs-5 walkin-sales-text">₱
                                        {{ number_format($walkingSales, 2, '.', ',') }}</span>
                                    <span class="fw-bold fs-5 online-sales-text">₱
                                        {{ number_format($onlineSales, 2, '.', ',') }}</span>

                                    {{-- <span class="fw-bold fs-5">₱ {{ number_format($totalSales, 2, '.', ',') }}</span>
                                    <span class="fw-bold fs-5">₱ {{ number_format($walkingSales, 2, '.', ',') }}</span>
                                    <span class="fw-bold fs-5">₱ {{ number_format($onlineSales, 2, '.', ',') }}</span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="basic-datatables1" class="display table table-striped table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Contact</th>
                                        <th>Ticket Quantity</th>
                                        <th>Total Price</th>
                                        <th>Activity Log</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>

                            {{-- <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Contact</th>
                                        <th>Ticket Quantity</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->customer_name }}</td>
                                        <td>{{ $sale->customer_email }}</td>
                                        <td>{{ $sale->customer_contact }}</td>
                                        <td>{{ $sale->customer_quantity }}</td>
                                        <td>₱ {{ number_format(floatval($sale->ticket->ticket_price) *
                                            $sale->customer_quantity, 2, '.', ',') }}</td>
                                        <td><span class="badge {{ $sale->is_paid ? 'bg-success' : 'bg-danger' }}">{{
                                                $sale->is_paid ? 'Paid' : 'Unpaid' }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-sm btn-sta" data-bs-toggle="modal"
                                                    data-bs-target="#viewCustomerTickets" data-id="{{ $sale->id }}"
                                                    data-event-id="{{ $sale->event_id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="openResendModal('{{ $sale->id }}', '{{ addslashes($sale->customer_email) }}')">
                                                    <i class="fa fa-envelope"></i>
                                                </button> --}}

                                                {{-- <button type="button" class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal" data-bs-target="#resendEmailTicket"
                                                    data-id="{{ $sale->ticket->id  }}">
                                                    <i class="fa fa-envelope"></i>
                                                </button> --}}
                                                {{--
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}

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
    {{--
    <script>
        $(document).ready(function () {
            var doughnutChart = $('#doughnutChart').get(0).getContext('2d');

            $('#basic-datatables').DataTable({
                pageLength: 10,
                searching: false,
                lengthChange: false,
                info: false,
            });

            var myDoughnutChart = new Chart(doughnutChart, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [10, 20],
                        backgroundColor: ['#0F355A', '#CFE1EA'],
                        hoverOffset: 4
                    }],

                    labels: [
                        'Ticket Sold',
                        'Total Tickets',
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'right',
                    },
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 20
                        }
                    }
                }
            });

        });

    </script> --}}

    {{-- CCJCREATE --}}
    <script>
        function openResendModal(saleId, email) {
            $('#modalSaleId').val(saleId);
            $('#visibleSaleId').text(saleId);

            var $modalEl = $('#resendEmailTicket');
            var modal = bootstrap.Modal.getOrCreateInstance($modalEl[0]);
            modal.show();

            console.log('Resend modal triggered with Sale ID:', saleId, 'Email:', email);
        }
    </script>

    <script>
        $(document).ready(function () {
            window.adminSalesData = @json($admin_sales);
            window.tableSales = $('#basic-datatables1').DataTable({
                pageLength: 10,
                searching: true,
                lengthChange: false,
                info: true,
                responsive: true,
                autoWidth: false,
                data: adminSalesData,
                columns: [{
                    data: 'customer_name'
                },
                {
                    data: 'customer_email'
                },
                {
                    data: 'customer_contact'
                },
                {
                    data: 'customer_quantity'
                },
                {
                    data: 'total_price'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render(d) {
                        switch (d.status) {
                            case 'awaiting_payment_method':
                                return 'pending';
                            case 'awaiting_next_action':
                                return 'cancelled';
                            default:
                                return 'paid';
                        }
                    }
                },
                {
                    data: 'status',
                    orderable: false,
                    searchable: false,
                    render(status) {
                        if (status === 'awaiting_payment_method')
                            return '<span class="badge bg-warning">Pending</span>';
                        if (status === 'awaiting_next_action')
                            return '<span class="badge bg-danger">Cancelled</span>';
                        return '<span class="badge bg-success">Paid</span>';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render(d) {
                        return `
                                    <div class="d-flex gap-2">
                                      <button class="btn btn-sm btn-sta" data-bs-toggle="modal"
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
                                    </div>`;
                    }
                }
                ],
                order: [
                    [0, 'asc']
                ],
                language: {
                    searchPlaceholder: "Search sales...",
                    info: "_START_-_END_ of _TOTAL_ sales"
                }
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

            Pusher.logToConsole = true;
            var pusher = new Pusher('b75c1ebe893ce70cc089', {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('admin-sales-channel');
            channel.bind('admin-sales-updated', function (data) {
                if (adminSalesData.some(s => s.id === data.id)) {
                    return;
                }
                const validated = {
                    ...data,
                    total_price: parseFloat(data.total_price) || 0,
                    customer_quantity: parseInt(data.customer_quantity) || 0
                };
                adminSalesData.unshift(validated);
                tableSales.clear().rows.add(adminSalesData).draw(false);
                recalcChartAndText();
            });
        });

        function recalcChartAndText() {
            let walkQty = 0,
                onlineQty = 0,
                walkSales = 0,
                onlineSales = 0,
                total = 0;
            adminSalesData.forEach(sale => {
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

            myDoughnutChart.data.datasets[0].data = [walkQty, onlineQty];
            myDoughnutChart.update();

            const fmt = {
                minimumFractionDigits: 2
            };
            $('.total-sales-text').text(`₱ ${total.toLocaleString(undefined, fmt)}`);
            $('.walkin-sales-text').text(`₱ ${walkSales.toLocaleString(undefined, fmt)}`);
            $('.online-sales-text').text(`₱ ${onlineSales.toLocaleString(undefined, fmt)}`);
        }
    </script>
@endsection