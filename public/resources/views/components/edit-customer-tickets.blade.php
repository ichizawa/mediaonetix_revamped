<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Modal -->
<div class="modal fade" id="editCustomerTickets" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="editCustomerTickets" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Customer Tickets</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="editCustomerTicketsTable" class="table table-striped table-hover w-100">
            <thead>
              <tr>
                <th>Ticket ID</th>
                <th>Reference Num</th>
                <th>Scanned</th>
                <th>Customer Type</th>
                <th>Ticket Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button id="updateTicketsBtn" type="button" class="btn btn-sta">Mark as Paid</button>
        <button id="resetTicketsBtn" type="button" class="btn btn-warning">Reset All</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#editCustomerTicketsTable')) {
      $('#editCustomerTicketsTable').DataTable().destroy();
    }

    let editIDticks;

    $('#editCustomerTickets').on('show.bs.modal', function (event) {
      var id = $(event.relatedTarget).data('id') || parseInt(editIDticks);
      var event_id = $(event.relatedTarget).data('event-id');

      if ($.fn.DataTable.isDataTable('#editCustomerTicketsTable')) {
        $('#editCustomerTicketsTable').DataTable().destroy();
      }

      $('#editCustomerTicketsTable').DataTable({
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
          // Ticket ID from the related sale
          { data: 'sale.ticket_id', name: 'sale.ticket_id' },

          // Reference number
          { data: 'reference_num', name: 'reference_num' },

          // Scanned?
          {
            data: 'is_redeemed',
            render: function (data) {
              return data
                ? `<span class="badge bg-success">Yes</span>`
                : `<span class="badge bg-danger">No</span>`;
            }
          },

          // Customer type
          {
            data: 'sale.is_online',
            render: function (data) {
              return data ? 'Online' : 'Walk‑in';
            }
          },

          {
            data: 'is_disabled',
            render: function (data) {
              return data
                ? `<span class="badge bg-secondary">Disabled</span>`
                : `<span class="badge bg-success">Active</span>`;
            }
          },

          // Reset‑scan button
          {
            data: 'id',
            orderable: false,
            searchable: false,
            render: function (id) {
              return `<button
                        class="btn btn-sm btn-sta edit-ticket"
                        data-id="${id}">
                          Reset Scan
                      </button>`;
            }
          }
        ]
      });

      $(document).on('click', '.edit-ticket', function (e) {
        e.preventDefault();
        const ticketId = $(this).data('id');

        swal({
          title: 'Reset scan status?',
          text: "This will mark this ticket as un‑scanned.",
          icon: 'warning',
          buttons: {
            cancel: {
              visible: true,
              text: "No, cancel!",
              className: "btn btn-danger",
            },
            confirm: {
              text: "Yes, reset it!",
              className: "btn btn-success",
            },
          },
        }).then((willDelete) => {
          if (!willDelete) return;

          $.ajax({
            url: "{{ Auth::user()->is_admin == 1 ? route('admin.sales.reset_tickets', ':id') : route('merchant.sales.reset_tickets', ':id') }}".replace(':id', ticketId),
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (res) {
              console.info(res);
              $.notify({
                icon: "fa fa-bell",
                title: res.title,
                message: res.message,
              }, {
                type: res.status,
                placement: {
                  from: "top",
                  align: "right"
                },
                time: 1000,
                delay: 2000,
                z_index: 10000
              });
            },
            error: function (res) {
              console.log(res);
            },
            complete: function () {
              $('#editCustomerTicketsTable').DataTable().ajax.reload();
            }
          });
        });
      });

      $(document).on('click', '#resetTicketsBtn', function (e) {
        e.preventDefault();
        console.log(id);

        swal({
          title: 'Reset scan status?',
          text: "This will mark this ticket as un‑scanned.",
          icon: 'warning',
          buttons: {
            cancel: {
              visible: true,
              text: "No, cancel!",
              className: "btn btn-danger",
            },
            confirm: {
              text: "Yes, reset it!",
              className: "btn btn-success",
            },
          },
        }).then((willDelete) => {
          if (!willDelete) return;

          $.ajax({
            url: "{{ Auth::user()->is_admin == 1 ? route('admin.sales.reset_tickets', ':id') : route('merchant.sales.reset_tickets', ':id') }}".replace(':id', id),
            method: 'POST',
            data: {
              'reset_all': true
            },
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (res) {
              console.info(res);
              $.notify({
                icon: "fa fa-bell",
                title: res.title,
                message: res.message,
              }, {
                type: res.status,
                placement: {
                  from: "top",
                  align: "right"
                },
                time: 1000,
                delay: 2000,
                z_index: 10000
              });
            },
            error: function (res) {
              console.log(res);
            },
            complete: function () {
              $('#editCustomerTicketsTable').DataTable().ajax.reload();
            }
          });
        });

      });

      $(document).on('click', '#updateTicketsBtn', function (e) {
        e.preventDefault();
        $('#editCustomerTickets').modal('hide');
        Swal.fire({
          title: 'Mark entire sale paid?',
          text: "This will set this sale’s paid flag to true.",
          icon: 'warning',
          input: 'text',
          inputPlaceholder: 'Enter auth code',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, mark paid!',
          showLoaderOnConfirm: true,
          preConfirm: async (code) => {

          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "{{ Auth::user()->is_admin == 2 ? route('merchant.sales.mark_paid', ':id') : route('admin.sales.mark_paid', ':id') }}".replace(':id', id),
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
              },
              method: 'POST',
              dataType: 'json',
              data: JSON.stringify({ "auth_code": result.value }),
              success: function (res) {
                console.info(res);
                editIDticks = res.data.id;
                $('#editCustomerTicketsTable').DataTable().ajax.reload();
                $.notify({
                  icon: "fa fa-bell",
                  title: res.title,
                  message: res.message,
                }, {
                  type: res.type,
                  placement: {
                    from: "top",
                    align: "right"
                  },
                  time: 1000,
                  delay: 2000,
                  z_index: 10000
                });
              },
              error: function (xhr, status, error) {
                $.notify({
                  icon: "fa fa-bell",
                  title: "Error",
                  message: xhr.responseJSON.message,
                }, {
                  type: "danger",
                  placement: {
                    from: "top",
                    align: "right"
                  }
                });
              },
              complete: function () {
                $('#editCustomerTickets').modal('show');
              }
            });
          }
        });
      });

    });
  });
</script>