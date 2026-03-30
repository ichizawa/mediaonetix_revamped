@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center pt-2 pb-4 flex-wrap">
            <h1 class="fw-bold mb-3 mb-md-0">Settings > Users</h1>
        </div>

        <div class="row d-flex align-items-stretch">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Users</h4>
                        <!-- Button to open offcanvas -->
                        <button type="button" class="btn btn-sta fw-bold" data-bs-toggle="modal"
                            data-bs-target="#createUserModal">
                            Create Users
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th> #</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($user as $users)
                                    <tr>
                                        <td>{{ $users->id }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->username }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->is_admin == 1 ? 'Admin' : ($users->is_admin == 2 ? 'Merchant' : 'User') }}</td>
                                        <td>{{ $users->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-sta edit-btn">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="showNotif()">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Hidden Edit Section -->
                <div id="editUserSection" class="card mt-4 d-none">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>
                        <hr class="my-3">
                        <form>
                            <input type="hidden" name="id">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">First Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Last Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Username</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Roles</label>
                                    <select class="form-select bg-light" id="userRole" name="role" required>
                                        <option value="" disabled selected>Select User Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Merchant">Merchant</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Contact Number</label>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                            <button class="btn btn-sta" onclick="showNotif()">Save Changes</button>
                            <button class="btn btn-danger" onclick="showNotif()">Cancel</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded position-relative p-4">
                <!-- Top Border -->
                <div style="height: 8px; background-color: #0F355A; position: absolute; top: 0; left: 0; right: 0; border-top-left-radius: .3rem; border-top-right-radius: .3rem;"></div>
                <div>
                    <div class="modal-header bg-white border-0">
                        <h6 class="modal-title text-muted fst-italic fw-bold" id="createUserModalLabel">Kindly fill-up the form.</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <form id="createUserForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="userFirstName" class="form-label fw-semibold">First Name</label>
                                    <input type="text" class="form-control bg-light" id="userFirstName" name="first_name"
                                        placeholder="Enter First Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="userLastName" class="form-label fw-semibold">Last Name</label>
                                    <input type="text" class="form-control bg-light" id="userLastName" name="last_name"
                                        placeholder="Enter Last Name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-semibold">Username</label>
                                    <input type="text" class="form-control bg-light" id="username" name="username"
                                        placeholder="Enter Username" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="userRole" class="form-label fw-semibold">Roles</label>
                                    <select class="form-select bg-light" id="userRole" name="role" required>
                                        <option value="" disabled selected>Select User Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                        <option value="Merchant">Merchant</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="userEmail" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control bg-light" id="userEmail" name="email"
                                    placeholder="Enter Email Address" required>
                            </div>

                            <div class="mb-3">
                                <label for="contactNumber" class="form-label fw-semibold">Contact Number</label>
                                <input type="text" class="form-control bg-light" id="contactNumber" name="contact"
                                    placeholder="Enter Contact Number" required>
                            </div>

                            <button type="submit" class="btn w-100 fw-bold"
                                style="background-color: #0F355A; color: white;">
                                Create
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function showNotif() {
            swal({
                title: "Work in progress",
                text: "This feature is not available yet",
                type: "info",
            });
        }

        $(document).ready(function () {
            $('#basic-datatables').DataTable();

            $('.edit-btn').on('click', function () {
                $('#editUserSection').removeClass('d-none');
                $('html, body').animate({
                    scrollTop: $("#editUserSection").offset().top
                }, 500);
            });
        });
    </script>
@endsection
