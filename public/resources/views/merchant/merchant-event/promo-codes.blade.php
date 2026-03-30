<style>
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --success-color: #059669;
        --danger-color: #dc2626;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-900: #111827;
    }

    .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        max-width: 800px;
        margin: 0 auto;
    }

    .modal-dialog {
        max-width: 90%;
    }

    .modal-header {
        background: white;
        border-bottom: 1px solid var(--gray-200);
        border-radius: 12px 12px 0 0;
        padding: 24px 32px 20px;
    }

    .modal-title {
        font-weight: 600;
        font-size: 1.5rem;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modal-title i {
        color: var(--primary-color);
        font-size: 1.25rem;
    }

    .btn-close {
        background: none;
        border: none;
        padding: 8px;
        border-radius: 6px;
        opacity: 0.6;
        transition: all 0.2s ease;
    }

    .btn-close:hover {
        opacity: 1;
        background: var(--gray-100);
    }

    .modal-body {
        padding: 32px;
        background: white;
    }

    .promo-form {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        padding: 24px;
        border-radius: 8px;
        margin-bottom: 32px;
    }

    .form-section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-title i {
        color: var(--primary-color);
        font-size: 1rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--gray-700);
        margin-bottom: 8px;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .form-control {
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.15s ease;
        background: white;
        color: var(--gray-900);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: var(--gray-500);
    }

    .btn-primary {
        background: var(--primary-color);
        border: 1px solid var(--primary-color);
        padding: 12px 24px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: white;
        border: 1px solid var(--gray-300);
        color: var(--gray-700);
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.15s ease;
    }

    .btn-secondary:hover {
        background: var(--gray-50);
        border-color: var(--gray-300);
        color: var(--gray-700);
    }

    .table-container {
        background: white;
        border: 1px solid var(--gray-200);
        border-radius: 8px;
        overflow: hidden;
    }

    .table-header {
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-200);
        padding: 16px 24px;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-header i {
        color: var(--primary-color);
    }

    .table {
        margin-bottom: 0;
        font-size: 0.875rem;
    }

    .table thead th {
        background: white;
        border-bottom: 1px solid var(--gray-200);
        color: var(--gray-700);
        font-weight: 600;
        padding: 16px 24px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .table tbody td {
        padding: 16px 24px;
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
        color: var(--gray-900);
    }

    .table tbody tr:hover {
        background: var(--gray-50);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .promo-code {
        background: var(--gray-100);
        color: var(--gray-900);
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
        font-family: 'SF Mono', 'Monaco', 'Consolas', monospace;
        font-size: 0.875rem;
        letter-spacing: 0.025em;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .status-active {
        background: #dcfce7;
        color: var(--success-color);
    }

    .status-inactive {
        background: #fef2f2;
        color: var(--danger-color);
    }

    .btn-delete {
        background: var(--danger-color);
        border: 1px solid var(--danger-color);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        transition: all 0.15s ease;
    }

    .btn-delete:hover {
        background: #b91c1c;
        border-color: #b91c1c;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: var(--gray-500);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        color: var(--gray-300);
    }

    .empty-state h6 {
        color: var(--gray-600);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .modal-footer {
        border-top: 1px solid var(--gray-200);
        background: var(--gray-50);
        padding: 20px 32px;
        border-radius: 0 0 12px 12px;
    }

    .success-message {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        color: var(--success-color);
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 24px;
        display: none;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
    }

    .input-group {
        position: relative;
        margin-bottom: 16px;
    }

    .input-group:last-child {
        margin-bottom: 0;
    }

    /* Hide the event_id field completely for better UX */
    #event_id {
        display: none;
    }

    /* Custom scrollbar for table if needed */
    .table-container::-webkit-scrollbar {
        height: 8px;
    }

    .table-container::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    .table-container::-webkit-scrollbar-thumb {
        background: var(--gray-300);
        border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: var(--gray-400);
    }
</style>
<div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="promoModalLabel">
                    <i class="fas fa-ticket-alt"></i>
                    Promo Code Management
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Success Message -->
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <span>Promo code added successfully!</span>
                </div>

                <!-- Promo Code Form -->
                <div class="promo-form">
                    <div class="form-section-title">
                        <i class="fas fa-plus"></i>
                        Add New Promo Code
                    </div>
                    <form id="promoForm">
                        <div class="input-group">
                            <!-- <label for="promoCode" class="form-label">Promo Code</label> -->
                            <input type="text" class="form-control" name="promo_code" id="promoCode"
                                placeholder="Enter promo code (e.g., SUMMER2024)" required />
                        </div>
                        <div class="input-group">
                            <input type="text" name="event_id" id="event_id" readonly />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Add Promo Code
                        </button>
                    </form>
                </div>

                <!-- Promo Codes Table -->
                <div class="table-container">
                    <div class="table-header">
                        <i class="fas fa-list"></i>
                        Active Promo Codes
                    </div>
                    <div id="tableWrapper">
                        <!-- Uncomment for empty state -->
                        <!-- <div class="empty-state">
                            <i class="fas fa-ticket-alt"></i>
                            <h6>No promo codes found</h6>
                            <p class="mb-0">Create your first promo code using the form above</p>
                        </div> -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Promo Code</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody id="promoCodesTable">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#successMessage').hide();
        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        function loadPromoCodes(eventId) {
            $('#promoCodesTable').empty();
            $('#tableWrapper').empty(); // clear the wrapper before appending

            $.ajax({
                url: '{{ route('merchant.get.promo.codes', ':id') }}'.replace(':id', eventId),
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (!response.data || response.data.length === 0) {
                        // Show empty state
                        $('#tableWrapper').html(`
                            <div class="empty-state">
                                <i class="fas fa-ticket-alt"></i>
                                <h6>No promo codes found</h6>
                                <p class="mb-0">Create your first promo code using the form above</p>
                            </div>
                        `);
                    } else {
                        // Show table with data
                        let tableHtml = `
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Promo Code</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="promoCodesTable"></tbody>
                            </table>
                        `;
                        $('#tableWrapper').html(tableHtml);

                        response.data.forEach(function (data) {
                            $('#promoCodesTable').append(`
                                <tr>
                                    <td>${data.id}</td>
                                    <td><span class="promo-code">${data.code}</span></td>
                                    <td>${formatDate(data.created_at)}</td>
                                    <td><span class="status-badge ${data.is_active ? 'status-inactive' : 'status-active'}">
                                        ${data.is_active ? 'Inactive' : 'Active'}
                                    </span></td>
                                </tr>
                            `);
                        });
                    }
                }
            });
        }


        $('#promoModal').on('show.bs.modal', function (event) {
            $('#promoCodesTable').empty();
            var button = $(event.relatedTarget);
            var eventId = button.data('event-id');
            $('#event_id').val(eventId);

            loadPromoCodes(eventId);
        });

        $('#promoForm').submit(function (e) {
            e.preventDefault();
            var eventId = $('#event_id').val();
            $.ajax({
                url: '{{ route('merchant.add.promo.codes') }}',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#successMessage').hide();
                },
                success: function (response) {
                    // $('#successMessage').show();
                    // setTimeout(function () {
                    //     $('#successMessage').fadeOut();
                    // }, 3000);
                    console.log(response);
                    loadPromoCodes(eventId);
                    $.notify({
                        icon: 'fa fa-bell',
                        title: 'Success',
                        message: response.message
                    }, {
                        type: 'success',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        delay: 1500,
                        z_index: 9999
                    });
                },
                error: function (xhr, status, error) {
                    // console.error('Error:', xhr);
                    $.notify({
                        icon: 'fa fa-bell',
                        title: 'Error',
                        message: xhr.responseJSON.message
                    }, {
                        type: 'danger',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        delay: 1500,
                        z_index: 9999
                    });
                },
                complete: function () {
                    // $('#promoModal').modal('hide');
                }
            });
        });
    });
</script>