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
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h1 class="fw-bold mb-3">Settings > Forms</h1>
        </div>
    </div>
    <div class="container mt-5">
        <div class="mb-3 text-end">
            <button class="btn" style="background-color: #0F355A; color: white;"
                onclick="window.location.href='{{ route('admin.create.forms') }}'">
                <i class="bi bi-plus-lg me-2"></i> New Publish
            </button>


        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List of Publishable Forms</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover custom-table">
                        <thead class="text-center">
                            <tr>
                                <th>Title</th>
                                <th>Published Date</th>
                                <th>Publish</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>About Us</td>
                                <td>June 3, 2025</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" id="publishSwitch1">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-wrap justify-content-center gap-1">
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
                                <td>Part 2 About Us</td>
                                <td>July 10, 2025</td>
                                <td class="text-center">
                                    <div class="form-check form-switch d-inline-flex align-items-center">
                                        <input class="form-check-input" type="checkbox" id="publishSwitch1">
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-wrap justify-content-center gap-1">
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