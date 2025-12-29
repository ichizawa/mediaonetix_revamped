<div id="salesModal" class="modal">
    <div
        class="modal-content w-full max-w-2xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-white">Create Sale</h3>
            <button onclick="closeSalesModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.sales.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Ticket Selection and Quantity -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Select Ticket</label>
                    <select name="event" id="selected_event"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        onchange="updateTickets(this)" required>
                        <option value="" selected hidden disabled>Select Event</option>
                        {{-- <option value="150" class="text-black" data-event="Salindayaw Music Festival">Electronic
                            Paradise</option>
                        <option value="250" class="text-black" data-event="Salindayaw Music Festival">Rock the Night
                        </option>
                        <option value="100" class="text-black" data-event="Salindayaw Music Festival">Smooth Jazz Night
                        </option> --}}
                        @forelse($events as $event)
                            <option value="{{ $event->id }}" class="text-black" data-event='@json($event)'>
                                {{ $event->event_name }}
                            </option>
                        @empty
                            <option value="" hidden disabled>No Event Yet</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Quantity</label>
                    <input type="number" onchange="updateTotalPrice(this)" name="quantity" id="quantityInput" min="1"
                        value="1"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
            </div>

            <!-- Purchase Type and Payment Method -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Type</label>
                    <select onchange="updateTicketPrice(this)" name="ticket" id="ticket_selection"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                        <option value="" class="text-black" selected disabled>Select Ticket Type</option>
                        {{-- <option value="student" class="text-black">VVIP</option>
                        <option value="alumni" class="text-black">VIP</option>
                        <option value="employee" class="text-black">PLATINUM</option>
                        <option value="general" class="text-black">SILVER</option>
                        <option value="general" class="text-black">BRONZE</option> --}}
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Payment Method</label>
                    <select name="payment_method"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                        <option value="" class="text-black" selected hidden disabled>Select Payment Method</option>
                        <option value="cash" class="text-black">Cash</option>
                        <option value="credit_card" class="text-black">Credit Card</option>
                        <option value="debit_card" class="text-black">Debit Card</option>
                        <option value="gcash" class="text-black">GCash</option>
                        <option value="paymaya" class="text-black">PayMaya</option>
                        <option value="bank_transfer" class="text-black">Bank Transfer</option>
                    </select>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Customer Name</label>
                    <input type="text" name="customer_name"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Customer Email</label>
                    <input type="email" name="customer_email"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Customer Phone</label>
                    <input type="tel" name="customer_phone"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">City</label>
                    <input type="text" name="city"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Address</label>
                <textarea name="address" rows="2"
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
            </div>

            <!-- Price Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Price</label>
                    <div class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white">
                        PHP <span id="ticketPrice">0.00</span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Total Price</label>
                    <div
                        class="w-full px-4 py-2 bg-gradient-to-r from-blue-600/20 to-purple-600/20 border border-blue-500/30 rounded-lg">
                        <span class="text-2xl font-bold text-white">$<span id="totalPrice">0.00</span></span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Complete Sale
                </button>
                <button type="button" onclick="closeSalesModal()"
                    class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function updateTickets(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        const eventData = JSON.parse(selectedOption.dataset.event);
        // $('#ticket_selection').empty();

        eventData.tickets.forEach((ticket, index) => {
            $('#ticket_selection').append(`<option value="${ticket.id}" class="text-black" data-ticket='${JSON.stringify(ticket)}'>${ticket.name}</option>`);
        });
    }
    function updateTicketPrice(selectEl) {
        const selectedOption = selectEl.options[selectEl.selectedIndex];
        const ticket = JSON.parse(selectedOption.dataset.ticket);
        // console.log(ticket);
        $('#ticketPrice').text(ticket.price);
        $('#totalPrice').text(ticket.price);
    }
    function updateTotalPrice(sel) {
        const ticketPrice = parseFloat($('#ticketPrice').text()) || 0;
        const quantity = parseInt($(sel).val()) || 0;

        const total = ticketPrice * quantity;
        $('#totalPrice').text(total.toFixed(2));
    }

</script>