document.addEventListener('DOMContentLoaded', function () {
    // Use event delegation for .purchase-btn
    document.body.addEventListener('click', function (e) {
        const btn = e.target.closest('.purchase-btn');
        if (btn) {
            // FIX: Scope the query selectors to 'btn' instead of 'document'
            // This ensures it only grabs the hidden input inside the clicked button.
            let eid = btn.getAttribute('data-event-id') 
                || btn.querySelector('.event-id-holder')?.value 
                || btn.querySelector('#mobile-event-id-holder')?.value;

            if (eid) {
                window.location.href = '/event/' + eid;
            } else {
                alert('Event not found.');
            }
        }
    });
});