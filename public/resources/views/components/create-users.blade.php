<form action="{{ route('merchant.add.users') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="createUserSidePanel"
        aria-labelledby="createUserSidePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">Create Users</h5>
            <!-- <button class="btn btn-lg fw-bold" type="button" id="add_ticket">+ Add Ticket</button> -->
        </div>

        <div id="ticket_form" class="offcanvas-body" style="overflow-x: hidden;">
            <!-- Default Ticket Entry -->
            <div class="ticket-group">
                <div class="row ticket-item">
                    <!-- <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter User Name"
                                required />
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter User Email"
                                required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"> 
                            <label class="fw-bold">Phone Number</label>
                            <input type="number" name="phone_number" class="form-control"
                                placeholder="Enter User Phone Number" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                placeholder="Enter User First Name" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter User Last Name"
                                required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter User Username"
                                required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="" disabled selected>Select User Role</option>
                                <option value="1">Event Admin</option>
                                <option value="2">Event Staff</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Event</label>
                            <select name="event_id" class="form-control" required>
                                <option value="" disabled selected>Select Event</option>
                                @foreach ($event as $even)
                                    <option value="{{ $even->id }}">{{ $even->event_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter User Password" />
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
                        <button type="submit" class="btn btn-sta w-50 fw-bold">Create User</button>
                        <button type="button" class="btn btn-secondary w-50 fw-bold"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>