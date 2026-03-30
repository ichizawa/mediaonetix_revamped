@extends('layouts')
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@4/dist/maplibre-gl.css" />
    <script src="https://unpkg.com/maplibre-gl@4/dist/maplibre-gl.js"></script>

    <div class="min-h-screen bg-[#0c1222] py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            @if (isset($event))
                <!-- Hero Image Section -->
                @if ($event->event_image)
                    <div class="mb-8 rounded-2xl overflow-hidden border border-white/10 h-96">
                        <img src="{{ asset('images/events/' . $event->event_image) }}" alt="Event Image"
                            class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Event Header Section -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] border border-white/10 rounded-2xl p-6 sm:p-8 mb-8">
                    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-6">{{ $event->event_name }}</h1>

                    <!-- Event Info Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 pb-8 border-b border-white/10">
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Date</p>
                            <p class="text-white font-semibold text-lg">{{ $event->event_date ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Time</p>
                            <p class="text-white font-semibold text-lg">
                                {{ $event->event_time ? \Carbon\Carbon::parse($event->event_time)->format('h:i A') : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm mb-1">Venue</p>
                            <p class="text-white font-semibold text-lg">{{ $event->event_venue ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Event Description -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-blue-300 mb-3">About This Event</h2>
                        <p class="text-gray-300 text-lg leading-relaxed">
                            {{ $event->description ?? 'No description available.' }}</p>
                    </div>
                </div>

                <!-- Seat Plan Section -->
                @if ($event->seat_plan)
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] border border-white/10 rounded-2xl p-6 sm:p-8 mb-8 overflow-hidden">
                        <h2 class="text-2xl font-semibold text-blue-300 mb-6">Venue Seat Plan</h2>
                        <div class="rounded-lg overflow-hidden h-96">
                            <img src="{{ asset('images/events/seat_plan/' . $event->seat_plan) }}" alt="Seat Plan"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

                <!-- Tickets Section -->
                @if ($event->tickets && count($event->tickets))
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] border border-white/10 rounded-2xl p-6 sm:p-8 mb-8">
                        <h2 class="text-2xl font-semibold text-blue-300 mb-6">Available Tickets</h2>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-white/10">
                                        <th class="px-4 py-4 text-left text-gray-400 font-semibold">Ticket Type</th>
                                        <th class="px-4 py-4 text-left text-gray-400 font-semibold">Price</th>
                                        <th class="px-4 py-4 text-left text-gray-400 font-semibold">Available</th>
                                        <th class="px-4 py-4 text-right text-gray-400 font-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event->tickets as $ticket)
                                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                            <td class="px-4 py-4 text-white font-semibold">{{ $ticket->type ?? '-' }}</td>
                                            <td class="px-4 py-4 text-white text-lg">
                                                ₱{{ number_format($ticket->price ?? 0, 2) }}</td>
                                            <td class="px-4 py-4 text-white">{{ $ticket->quantity ?? '-' }} tickets</td>
                                            <td class="px-4 py-4 text-right">
                                                <button
                                                    class="purchase-btn group px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 rounded-xl font-bold shadow-lg hover:shadow-blue-500/50 transition-all hover:scale-105 inline-flex items-center justify-center gap-2 text-white"
                                                    id="main-purchase-btn" onclick="openBuyModal()">
                                                    Buy Now
                                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @else
                <div
                    class="bg-gradient-to-br from-red-900/30 to-red-900/10 border border-red-500/30 rounded-2xl p-8 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-red-400 opacity-50" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-red-300 mb-2">Event Not Found</h2>
                    <p class="text-gray-400">Sorry, we couldn't find the event you're looking for.</p>
                </div>
            @endif
        </div>
    </div>

    @include('public.component.ticket.modal')



    <script>
        function openBuyModal(ticket) {
            isEditMode = false;
            currentTicketId = null;

            // Reset form
            document.getElementById('ticketForm').reset();
            document.getElementById('modalTitle').textContent = 'Guest Details';
            document.getElementById('submitBtn').textContent = 'Confirm Purchase';
            document.getElementById('ticketId').value = '';
            document.getElementById('formMethod').value = 'POST';

            // Set default values
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('ticketDate').value = today;
            document.getElementById('ticketTime').value = '19:00';
            const statusLabel = document.querySelector('[data-target="ticket    Status"] .custom-select-label');
            if (statusLabel) statusLabel.textContent = statusLabel.getAttribute('data-default-text') || 'Status';
            const categoryLabel = document.querySelector('[data-target="eventCategory"] .custom-select-label');
            if (categoryLabel) categoryLabel.textContent = categoryLabel.getAttribute('data-default-text') || 'Category';

            // Show modal using 'active' class
            const eventModal = document.getElementById('ticketModal');
            eventModal.classList.add('active');
        }

        function closeModal() {
            const eventModal = document.getElementById('ticketModal');
            eventModal.classList.remove('active');
        }
    </script>
@endsection
