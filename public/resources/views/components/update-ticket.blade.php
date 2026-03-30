<form
    action="@if(Auth::user()->is_admin == 2) {{ route('merchant.update.ticket') }} @else {{ route('admin.update.ticket') }} @endif"
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="editTicketSidePanel"
        aria-labelledby="editTicketSidePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">Update Ticket</h5>
            {{-- <button class="btn btn-lg fw-bold" type="button" id="add_ticket">+ Add Ticket</button> --}}
        </div>

        <div id="ticket_form" class="offcanvas-body" style="overflow-x: hidden;">
            <input type="hidden" name="ticket_id" id="ticket_id" value=""/>

            <!-- Default Ticket Entry -->
            <div class="ticket-group">
                <div class="row ticket-item">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Name</label>
                            <input type="text" name="ticket_name" id="ticket_name" class="form-control"
                                placeholder="Enter Ticket Name" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Type</label>
                            <input type="text" name="ticket_type" id="ticket_type" class="form-control"
                                placeholder="Enter Ticket Type" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Color</label>
                            <input type="color" name="ticket_color" id="ticket_color" class="w-100 rounded-3 border"
                                required>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Price</label>
                            <input type="text" name="ticket_price" id="ticket_price" class="form-control ticket-price"
                                placeholder="₱ 0.00" min="1" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Status</label>
                            <select name="ticket_status" id="ticket_status" class="form-control form-select" required>
                                <option selected hidden>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                <option value="2">Disable</option>
                            </select>
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
                        <button type="submit" class="btn btn-sta w-50 fw-bold">Update Ticket</button>
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

        $(document).on('click', '.edit-ticket', function () {
            var id = $(this).data('id');

            $.ajax({
                url: `/merchant/event/view-specific-ticket/${id}`,
                type: "GET",
                dataType: "json",
                beforeSend: function () {
                    
                },
                success: function (res) {
                    const { data, success } = res;

                    if(success){
                        $('#ticket_id').val(data.id);
                        $('#ticket_name').val(data.ticket_name);
                        $('#ticket_type').val(data.ticket_type);
                        $('#ticket_color').val(data.ticket_color);
                        $('#ticket_price').val(data.ticket_price);
                        $('#ticket_status').val(data.is_active);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
                complete: function () {
                    // $('#editTicketSidePanel').modal('show');
                }
            });
        });

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
                                <input type="text" name="tickets_request[${count}][ticket_price]" class="form-control ticket-price" placeholder="₱ 0.00" required>
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