<form action="
@if(Auth::user()->is_admin == 2)
    {{ route('merchant.specific.event.create.sale') }}
@else
    {{ route('admin.specific.event.create.sale') }}
@endif" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="createSalesSidePanel"
        aria-labelledby="createSalesSidePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold">Create Sale</h5>
            <!-- <button class="btn btn-lg fw-bold" type="button" id="add_ticket">+ Add Ticket</button> -->
        </div>

        <div id="ticket_form" class="offcanvas-body" style="overflow-x: hidden;">
            <input type="hidden" name="event_id" value="{{ $eventSales->id }}" />

            <!-- Default Ticket Entry -->
            <div class="ticket-group">
                <div class="row ticket-item">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="selectTicketDefault">Select Ticket</label>
                            <select class="form-select form-control" name="ticket_name" id="selectTicketDefault">
                                <option selected hidden>Select Ticket</option>
                                @foreach ($eventSales->tickets as $ticket)
                                    <option value="{{ $ticket->id }}" data-price="{{ $ticket->ticket_price  }}">
                                        {{ $ticket->ticket_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Quantity</label>
                            <input type="number" name="ticket_quantity" id="ticket_quantity" class="form-control"
                                placeholder="Enter Quantity" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="ticket_type" class="fw-bold" style="color: #0F355A !important;">Select
                                Purchase Type</label>

                            <select class="form-select form-control" id="selected_type" name="purchase_type">
                                <option hidden selected value="">Select Purchase Type</option>
                                <option value="student">Student</option>
                                <option value="alumni">Alumni</option>
                                <option value="employee">Employee</option>
                                <option value="general_public">General Public</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Payment Method</label>
                            <input type="text" name="payment_method" class="form-control"
                                placeholder="Enter Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Customer Email</label>
                            <input type="email" name="customer_email" class="form-control" placeholder="Enter Email" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Customer Phone</label>
                            <input type="number" name="customer_phone" class="form-control"
                                placeholder="Enter Phone Number" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">City</label>
                            <input type="text" name="city" class="form-control" placeholder="Enter City" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="fw-bold">Ticket Price</label>
                            <input type="number" name="ticket_price" id="ticket_price" class="form-control ticket-price"
                                readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Buttons -->
        <div class="offcanvas-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="fw-bold">Total Price</label>
                        <input type="number" name="total_price" id="total_price" class="form-control ticket-price"
                            value="0.00" readonly />
                    </div>
                </div>
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
        let updateTotalPrice = function () {
            let price = $('#selectTicketDefault').find(':selected').data('price') || 0;
            let quantity = $('#ticket_quantity').val() || 0;
            $('#total_price').val(parseFloat(price * quantity).toFixed(2));
        };

        $('#selectTicketDefault').change(function () {
            let price = $(this).find(':selected').data('price') || 0;
            $('#ticket_price').val(parseFloat(price).toFixed(2));
            updateTotalPrice();
        });

        $('#ticket_quantity').keyup(function () {
            updateTotalPrice();
        });
    });
</script>