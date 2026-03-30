<div class="modal fade" id="resendEmailTicket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="resendEmailTicket" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="{{ Auth::user()->is_admin == 2 ? route('merchant.resend.ticket') : route('admin.resend.ticket') }}" method="POST">
            @csrf
            <div class="modal-content">
                <input type="hidden" name="sale_id" id="modalSaleId">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="resendEmailTicket">Resend Tickets</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check">
                                    {{-- <input class="form-check-input" type="checkbox" value="disable"
                                        id="disableOldTickets"> --}}
                                    <input class="form-check-input" type="checkbox" id="disableOldTickets"
                                        name="disable_old" value="1">

                                    <label class="form-check-label" for="disableOldTickets">
                                        Disable Old Tickets
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sta">Resend</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>