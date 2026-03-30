@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Mediaonetix Admin Dashboard</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body skew-shadow">
                        <h1>3,072</h1>
                        <h5 class="op-8">Total conversations</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">88%</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary bg-primary-gradient">
                    <div class="card-body bubble-shadow">
                        <h1>188</h1>
                        <h5 class="op-8">Total Sales</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">25%</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary bg-primary-gradient">
                    <div class="card-body curves-shadow">
                        <h1>12</h1>
                        <h5 class="op-8">New Users</h5>
                        <div class="pull-right">
                            <h3 class="fw-bold op-8">70%</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Page visits</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Page name</th>
                                        <th scope="col">Visitors</th>
                                        <th scope="col">Unique users</th>
                                        <th scope="col">Bounce rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/
                                        </th>
                                        <td>
                                            4,569
                                        </td>
                                        <td>
                                            340
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-up text-success me-3"></i> 46,53%
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/index.html
                                        </th>
                                        <td>
                                            3,985
                                        </td>
                                        <td>
                                            319
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-down text-warning me-3"></i> 46,53%
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/charts.html
                                        </th>
                                        <td>
                                            3,513
                                        </td>
                                        <td>
                                            294
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-down text-warning me-3"></i> 36,49%
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/tables.html
                                        </th>
                                        <td>
                                            2,050
                                        </td>
                                        <td>
                                            147
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-up text-success me-3"></i> 50,87%
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/profile.html
                                        </th>
                                        <td>
                                            1,795
                                        </td>
                                        <td>
                                            190
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-down text-danger me-3"></i> 46,53%
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/
                                        </th>
                                        <td>
                                            4,569
                                        </td>
                                        <td>
                                            340
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-up text-success me-3"></i> 46,53%
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            /kaiadmin/index.html
                                        </th>
                                        <td>
                                            3,985
                                        </td>
                                        <td>
                                            319
                                        </td>
                                        <td>
                                            <i class="fas fa-arrow-down text-warning me-3"></i> 46,53%
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Top Products</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ms-2">
                                <h6 class="fw-bold mb-1">CSS</h6>
                                <small class="text-muted">Cascading Style Sheets</small>
                            </div>
                            <div class="d-flex ms-auto align-items-center">
                                <h4 class="text-info fw-bold">+$17</h4>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ms-2">
                                <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                <small class="text-muted">The Best Donuts</small>
                            </div>
                            <div class="d-flex ms-auto align-items-center">
                                <h4 class="text-info fw-bold">+$300</h4>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="d-flex">
                            <div class="avatar">
                                <img src="assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                            </div>
                            <div class="flex-1 pt-1 ms-2">
                                <h6 class="fw-bold mb-1">Ready Pro</h6>
                                <small class="text-muted">Bootstrap 5 Admin Dashboard</small>
                            </div>
                            <div class="d-flex ms-auto align-items-center">
                                <h4 class="text-info fw-bold">+$350</h4>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="pull-in">
                            <canvas id="topProductsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Recent Activity</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ol class="activity-feed">
                            <li class="feed-item feed-item-secondary">
                                <time class="date" datetime="9-25">Sep 25</time>
                                <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                            </li>
                            <li class="feed-item feed-item-success">
                                <time class="date" datetime="9-24">Sep 24</time>
                                <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                            </li>
                            <li class="feed-item feed-item-info">
                                <time class="date" datetime="9-23">Sep 23</time>
                                <span class="text">Joined the group <a href="single-group.php">"Boardsmanship
                                        Forum"</a></span>
                            </li>
                            <li class="feed-item feed-item-warning">
                                <time class="date" datetime="9-21">Sep 21</time>
                                <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                            </li>
                            <li class="feed-item feed-item-danger">
                                <time class="date" datetime="9-18">Sep 18</time>
                                <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                            </li>
                            <li class="feed-item">
                                <time class="date" datetime="9-17">Sep 17</time>
                                <span class="text">Attending the event <a href="single-event.php">"Some New
                                        Event"</a></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Support Tickets</div>
                            <div class="card-tools">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-today" data-bs-toggle="pill" href="#pills-today"
                                            role="tab" aria-selected="true">Today</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-week" data-bs-toggle="pill" href="#pills-week"
                                            role="tab" aria-selected="false">Week</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-month" data-bs-toggle="pill" href="#pills-month"
                                            role="tab" aria-selected="false">Month</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="avatar avatar-online">
                                <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                            </div>
                            <div class="flex-1 ms-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span
                                        class="text-warning ps-3">pending</span></h6>
                                <span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
                            </div>
                            <div class="float-end pt-1">
                                <small class="text-muted">8:40 PM</small>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="d-flex">
                            <div class="avatar avatar-offline">
                                <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                            </div>
                            <div class="flex-1 ms-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span
                                        class="text-success ps-3">open</span></h6>
                                <span class="text-muted">I have some query regarding the license issue.</span>
                            </div>
                            <div class="float-end pt-1">
                                <small class="text-muted">1 Day Ago</small>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="d-flex">
                            <div class="avatar avatar-away">
                                <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                            </div>
                            <div class="flex-1 ms-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span
                                        class="text-muted ps-3">closed</span></h6>
                                <span class="text-muted">Is there any update plan for RTL version near future?</span>
                            </div>
                            <div class="float-end pt-1">
                                <small class="text-muted">2 Days Ago</small>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="d-flex">
                            <div class="avatar avatar-offline">
                                <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                            </div>
                            <div class="flex-1 ms-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">Peter Parker <span
                                        class="text-success ps-3">open</span>
                                </h6>
                                <span class="text-muted">I have some query regarding the license issue.</span>
                            </div>
                            <div class="float-end pt-1">
                                <small class="text-muted">2 Day Ago</small>
                            </div>
                        </div>
                        <div class="separator-dashed"></div>
                        <div class="d-flex">
                            <div class="avatar avatar-away">
                                <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                            </div>
                            <div class="flex-1 ms-3 pt-1">
                                <h6 class="text-uppercase fw-bold mb-1">Logan Paul <span
                                        class="text-muted ps-3">closed</span>
                                </h6>
                                <span class="text-muted">Is there any update plan for RTL version near future?</span>
                            </div>
                            <div class="float-end pt-1">
                                <small class="text-muted">2 Days Ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }
    </style>
@endsection