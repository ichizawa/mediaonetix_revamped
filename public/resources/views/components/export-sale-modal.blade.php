<div class="modal fade" id="exportSalesModal" tabindex="-1" aria-labelledby="exportSalesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('merchant.sales.export_sales') }}" enctype="multipart/form-data"
            id="exportForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportSalesModalLabel">Export Sales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" />
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" />
                    </div>
                    <div class="form-group">
                        <label for="status">End Date</label>
                        <select class="form-control" id="status" name="status">
                            <option value="all" selected disabled>All</option>
                            <option value="S">Paid</option>
                            <option value="F">Unpaid</option>
                            <option value="D">Disabled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sta export">Export</button>
                </div>
            </div>
        </form>
    </div>
</div>
@if($errors->any())
    <script>
        $(document).ready(function () {
            $.notify({
                icon: 'fa fa-bell',
                title: 'Error',
                message: @json($errors->all())
            }, {
                type: 'danger',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                delay: 1500
            });
        });
    </script>
@endif
<script>
    $(document).ready(function () {
        $('#exportForm').on('submit', function () {
            $('.loadings-container').fadeIn('slow');
            setTimeout(function () {
                $('.loadings-container').fadeOut('slow');
            }, 2000); // Optional delay if you want
        });
    });
</script>