<form action="{{ route('merchant.update.users') }}" method="post" id="updateUserSidePanelForm"
    enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="updateUserSidePanel"
        aria-labelledby="updateUserSidePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">Update Users</h5>
            <!-- <button class="btn btn-lg fw-bold" type="button" id="add_ticket">+ Add Ticket</button> -->
        </div>

        <div id="ticket_form" class="offcanvas-body" style="overflow-x: hidden;">
            <!-- Default Ticket Entry -->
            <div class="ticket-group">
                <div class="row ticket-item">
                    <input type="text" id="id" name="id" class="form-control" hidden />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter User Email" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Phone Number</label>
                            <input type="number" id="phone_number" name="phone_number" class="form-control"
                                placeholder="Enter User Phone Number" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                placeholder="Enter User First Name" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                placeholder="Enter User Last Name" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Username</label>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Enter User Username" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled selected>Select User Role</option>
                                <option value="1">Event Admin</option>
                                <option value="2">Event Staff</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" disabled selected>Select User status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Event</label>
                            <select name="event_id" id="event_id" class="form-control" required>
                                <option value="" disabled selected>Select Event</option>
                                @foreach ($event as $even)
                                    <option value="{{ $even->id }}">{{ $even->event_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group has-feedback">
                            <label class="fw-bold">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter User Password" />
                            <small id="passHelp" class="form-text text-muted">
                                If password is not changed, leave it
                                blank
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Buttons -->
        <div class="offcanvas-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between grid gap-3 p-3">
                        <button type="submit" class="btn btn-sta w-50 fw-bold">Update User</button>
                        <button type="button" class="btn btn-secondary w-50 fw-bold"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $('#updateUserSidePanel').on('hide.bs.offcanvas', function () {
        $('#updateUserSidePanelForm')[0].reset();
    });

    $(document).on('click', '.edit-user', function (e) {
        const value = $(this).data('value');
        const json = JSON.parse(atob(value));

        $('#email').val(json.email);
        $('#phone_number').val(json.phone);
        $('#first_name').val(json.first_name);
        $('#last_name').val(json.last_name);
        $('#username').val(json.username);
        $('#role').val(json.role_type);
        $('#event_id').val(json.event_id);
        $('#password').val(json.password);
        $('#id').val(json.id);
        $('#status').val(json.is_active);
    });
</script>