@extends('layouts')
@section('content')

    <style>
        .custom-table thead {
            background-color: #0F355A;
            color: white;
        }

        .custom-table tbody {
            background-color: white;
        }
    </style>

    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center py-3 flex-wrap border-bottom mb-4">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">News</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <button class="btn bg-custom-navy text-white"
                    onclick="window.location.href='{{ route('admin.create.news') }}'">
                    <i class="bi bi-plus-lg me-2"></i> Create New
                </button>
            </div>
        </div>

        <div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">News Pages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover custom-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Published Date</th>
                                    <th>Visibility</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Davao Grunge Concert Rescheduled to May 2, 2025</td>
                                    <td>May 1, 2025</td>
                                    <td>Public</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <button class="btn btn-sm btn-info text-white" title="Preview">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Davao Grunge Concert Rescheduled to May 2, 2025</td>
                                    <td>May 1, 2025</td>
                                    <td>Public</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <button class="btn btn-sm btn-info text-white" title="Preview">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-primary" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
