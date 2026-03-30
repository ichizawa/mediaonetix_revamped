<div class="modal fade" id="viewCustomerTickets" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewCustomerTickets" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="#">Customer Tickets</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="customerTicketsTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Reference Num</th>
                                <th>Scanned</th>
                                <th>Cutomer Type</th>
                                <th>Ticket Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        if ($.fn.DataTable.isDataTable('#customerTicketsTable')) {
            $('#customerTicketsTable').DataTable().destroy();
        }

        $('#viewCustomerTickets').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('id');
            var event_id = $(event.relatedTarget).data('event-id');

            if ($.fn.DataTable.isDataTable('#customerTicketsTable')) {
                $('#customerTicketsTable').DataTable().destroy();
            }

            $('#customerTicketsTable').DataTable({
                pageLength: 10,
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: {
                    url: "{{ Auth::user()->is_admin == 2 ? route('merchant.view.customer.tickets', ':id') : route('admin.view.customer.tickets', ':id') }}".replace(':id', id),
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    dataSrc: "",
                    // success: function (data) {
                    //     console.log(data);
                    // }
                },
                columns: [
                    {
                        data: null,
                        render: function (data, type, row) {
                            return data.sale.ticket_id;
                        }
                    },
                    { data: 'reference_num' },
                    {
                        data: 'is_redeemed',
                        render: function (data, type, row) {
                            return `<span class="badge badge-${data ? 'success' : 'danger'}">${data ? 'Yes' : 'No'}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return row.sale.is_online == 1 ? 'Online' : 'Walk-in';
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            // return row.is_disabled == 1 ? 'Disabled' : 'Active';
                            return `<span class="badge badge-${row.is_disabled ? 'danger' : 'success'}">${row.is_disabled ? 'Disabled' : 'Active'}</span>`;
                        }
                    }
                ]
            });

        });
    });
</script>