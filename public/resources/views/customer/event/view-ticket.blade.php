<div class="modal fade" id="viewTicketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen"> <!-- Changed to fullscreen -->
        <div class="modal-content h-100"> <!-- Added h-100 -->
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalLabel">Ticket Viewer</h1> <!-- Larger title -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0"> <!-- Removed padding -->
                <div class="container-fluid h-100 w-100 d-flex flex-column"> <!-- Flex container -->
                    <!-- <iframe name="myiframe" id="myiframe" src="{{ asset('tickets.pdf') }}"
                            style="width: 100%; height: 90vh; min-height: 500px; border: none;"></iframe> -->
                    <iframe name="myiframe" id="myiframe" src="{{ asset('ticket.html') }}" style="width: 100%; height: 90vh; min-height: 500px; border: none;"></iframe>
                </div>
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                <!-- Larger button -->
            </div>
        </div>
    </div>
</div>