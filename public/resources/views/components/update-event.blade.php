<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="updateEventSidePanel"
    aria-labelledby="updateEventSidePanel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="updateEventSidePanel">Update Event</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
    </div>
    <div class="offcanvas-body" style="overflow-x: hidden; overflow-y: auto; white-space: nowrap;">
        <form id="createEventSide" method="POST" enctype="multipart/form-data" action="@if(Auth::user()->is_admin == 2)
            {{ route('merchant.update.events') }}
        @else
            {{ route('admin.update.events') }}
        @endif
            ">
            @csrf
            <div class="row">
                <div id="hideButtononUpload" class="col-md-12 text-center">
                    <div class="form-group">
                        <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                            style="height: 30rem;">
                            <button type="button" class="btn btn-light border" id="uploadImageButton">Add Image</button>
                            <input type="file" id="imageInput" name="event_image" style="display: none;">
                        </div>
                    </div>
                </div>
                <div id="showimage" class="col-md-12 text-center d-none">
                    <div class="form-group">
                        <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                            style="height: 30rem;">
                            <img class="img-fluid" id="imageEvent" style="object-fit: cover; object-position: center;"
                                src="..." alt="...." />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="fw-bold">Event Name</label>
                        <input type="text" name="event_name" id="event_name" class="form-control"
                            placeholder="Enter Event Name">
                        <input type="text" name="event_id" id="data_event_id" value="" hidden/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-bold">Date of Event</label>
                        <input type="date" name="event_date" id="event_date" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-bold">Time of Event</label>
                        <input type="time" name="event_time" id="event_time" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="fw-bold">Location</label>
                        <input type="text" name="event_location" id="event_location" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="fw-bold">Event Status</label>
                        <select name="event_status" class="form-control form-select">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Disable">Disable</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="d-flex justify-content-between grid gap-3">
                            <button type="submit" class="btn btn-sta w-50 fw-bold">Update
                                Event</button>
                            <button type="button" class="btn btn-secondary w-50 fw-bold" data-bs-dismiss="offcanvas"
                                data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('click', '.edit-event', function (e) {
            var event_id = $(this).data('id');
            // console.log(event_id);
            $.ajax({
                url: `/merchant/event/view-specific-event/${event_id}`,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {

                },
                success: function (res) {
                    const { data, success } = res;

                    console.info("data: ", data);
                    $('#event_name').val(data.event_name);
                    $('#event_date').val(data.event_date);
                    $('#event_time').val(data.event_time);
                    $('#event_location').val(data.event_loc);
                    $('#imageInput').attr('src', data.event_image);
                    $('#data_event_id').val(data.id);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
                complete: function () {
                    // $('#updateEventSidePanel').modal('show');
                }
            });
        });

        $('#uploadImageButton').click(function () {
            $('#imageInput').click();
        });
        $('#imageInput').change(function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imageEvent').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
            $('#showimage').removeClass('d-none');
            $('#hideButtononUpload').addClass('d-none');
        });
    });
</script>