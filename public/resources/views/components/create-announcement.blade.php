<form method="POST" action="{{ route('merchant.announcements.create') }}" enctype="multipart/form-data">
    @csrf
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="createAnnouncementSidePanel"
        aria-labelledby="createAnnouncementSidePanel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" id="createAnnouncementSidePanel">Create Announcement</h5>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
        </div>
        <div class="offcanvas-body" style="overflow-x: hidden; overflow-y: auto; white-space: nowrap;">
            <div class="row">
                <input type="text" name="event_id" id="event_id" hidden/>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="fw-bold fs-5 text-input">Title</label>
                        <input type="text" class="form-control bg-light p-2 border rounded" name="title"
                            placeholder="Announcement Title Here">
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="fw-bold fs-5 text-input">Description</label>
                        <textarea class="form-control bg-light p-2 border rounded " name="description" resize="none"
                            rows="15" placeholder="Enter Message Here"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Buttons -->
        <div class="offcanvas-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="d-flex justify-content-between grid gap-3">
                            <button type="submit" class="btn btn-sta w-50 fw-bold">Create Announcement</button>
                            <button type="button" class="btn btn-secondary w-50 fw-bold" data-bs-dismiss="offcanvas"
                                data-bs-dismiss="offcanvas" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $(document).on('click', '.create-announcement', function() {
            var event_id = $(this).data('id');
            $('#event_id').val(event_id);
        });
    });
</script>
