<form
    action="@if(Auth::user()->is_admin == 2) {{ route('merchant.create.ticket') }} @else {{ route('admin.create.ticket') }} @endif"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="createTicketSidePanel"
        aria-labelledby="createTicketSidePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">Create Ticket</h5>
            <button class="btn btn-lg fw-bold" type="button" id="add_ticket">+ Add Ticket</button>
        </div>

        <div id="ticket_form" class="offcanvas-body" style="overflow-x: hidden;">
            <input type="hidden" name="event_id" value="{{ $id }}" />

            <!-- Default Ticket Entry -->
            <div class="ticket-group">
                <div class="row ticket-item">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Name</label>
                            <input type="text" name="tickets_request[0][ticket_name]" class="form-control"
                                placeholder="Enter Ticket Name" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Type</label>
                            <input type="text" name="tickets_request[0][ticket_type]" class="form-control"
                                placeholder="Enter Ticket Type" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Color</label>
                            <input type="color" name="tickets_request[0][ticket_color]"
                                class="form_control_ticket_color w-100 rounded-3 border" required>

                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Price</label>
                            <input type="text" name="tickets_request[0][ticket_price]" class="form-control ticket-price"
                                placeholder="₱ 0.00" min="1" />
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
                        <button type="submit" class="btn btn-sta w-50 fw-bold">Create Ticket</button>
                        <button type="button" class="btn btn-secondary w-50 fw-bold"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript -->
<script>
    $(document).ready(function () {
        let count = 0;

        // Add New Ticket Entry
        $('#add_ticket').click(function () {
            count++;
            $('#ticket_form').append(`
                <div class="ticket-group">
                    <div class="row ticket-item" id="ticket${count}">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <label class="fw-bold">Ticket ${count + 1}</label>
                            <button class="btn btn-sm btn-danger remove-ticket" data-id="${count}">Remove</button>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold">Ticket Name</label>
                                <input type="text" name="tickets_request[${count}][ticket_name]" class="form-control" placeholder="Enter Ticket Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold">Ticket Type</label>
                                <input type="text" name="tickets_request[${count}][ticket_type]" class="form-control" placeholder="Enter Ticket Type" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold">Ticket Color</label>
                                <input type="color" name="tickets_request[${count}][ticket_color]" class="form-control" placeholder="Enter Color" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold">Ticket Price</label>
                                <input type="text" name="tickets_request[${count}][ticket_price]" class="form-control ticket-price" placeholder="₱ 0.00">
                            </div>
                        </div>
                    </div>
                </div>
            `);
        });
        // Prevent non-numeric input for price fields
        $(document).on('input', '.ticket-price', function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
        });

        // Remove specific ticket entry
        $(document).on('click', '.remove-ticket', function () {
            let id = $(this).data('id');
            $('#ticket' + id).remove();
        });

        // Remove all dynamically added rows when the offcanvas closes
        $('#createTicketSidePanel').on('hidden.bs.offcanvas', function () {
            $('#ticket_form').find('.ticket-group:not(:first)').remove();
            count = 0;
        });
    });
</script>