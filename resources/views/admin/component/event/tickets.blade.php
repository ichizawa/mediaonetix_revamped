@extends('layouts')
@section('content')
    <style>
        .ticket-card {
            transition: all 0.3s ease;
        }

        .ticket-card:hover {
            transform: translateY(-4px);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 50;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('admin.events') }}"
                                class="p-2 hover:bg-white/5 rounded-lg text-white transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </a>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Ticket Types</h2>
                                <p class="text-sm text-gray-400">Manage ticket types for this event</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button onclick="openAddTicketModal()"
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="hidden sm:inline">Add Ticket Type</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Event Info Card -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div
                            class="w-full md:w-48 h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20 rounded-xl overflow-hidden flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3">
                                </path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $event->event_name }}</h3>
                            <div class="flex flex-col gap-2 text-gray-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ date('F j, Y', strtotime($event->event_date)) }} •
                                        {{ date('g:i A', strtotime($event->event_time)) }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $event->event_venue }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Total Ticket Types</p>
                        <h3 class="text-3xl font-bold text-white">{{ $total_tickets }}</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Available Tickets</p>
                        <h3 class="text-3xl font-bold text-white">{{ $available_tickets }}</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Total Revenue</p>
                        <h3 class="text-3xl font-bold text-white">₱186,750.00</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Tickets Sold</p>
                        <h3 class="text-3xl font-bold text-white">1,248</h3>
                    </div>
                </div>

                <!-- Tickets Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- @php
                    $mockTickets = [
                    [
                    'id' => 1,
                    'ticket_type' => 'VIP Pass',
                    'description' => 'Premium seating, backstage access, exclusive merchandise, meet & greet',
                    'price' => 5000,
                    'quantity' => 100,
                    'sold' => 87,
                    'color' => '#FFD700'
                    ],
                    [
                    'id' => 2,
                    'ticket_type' => 'General Admission',
                    'description' => 'Standard entry to the event, standing area access',
                    'price' => 1500,
                    'quantity' => 1000,
                    'sold' => 756,
                    'color' => '#3B82F6'
                    ],
                    [
                    'id' => 3,
                    'ticket_type' => 'Early Bird',
                    'description' => 'Discounted ticket for early purchasers, general admission',
                    'price' => 1200,
                    'quantity' => 500,
                    'sold' => 500,
                    'color' => '#10B981'
                    ],
                    [
                    'id' => 4,
                    'ticket_type' => 'Student Discount',
                    'description' => 'Special rate for students with valid ID, general admission',
                    'price' => 1000,
                    'quantity' => 300,
                    'sold' => 245,
                    'color' => '#8B5CF6'
                    ],
                    [
                    'id' => 5,
                    'ticket_type' => 'Group Package',
                    'description' => 'Package for 5 people, includes reserved seating area',
                    'price' => 6000,
                    'quantity' => 50,
                    'sold' => 38,
                    'color' => '#F97316'
                    ]
                    ];
                    @endphp

                    @foreach($mockTickets as $ticket)
                    <div
                        class="ticket-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                        <div class="h-2 w-full" style="background: {{ $ticket['color'] }}"></div>
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-xl font-bold text-white">{{ $ticket['ticket_type'] }}</h3>
                                        <div class="w-4 h-4 rounded-full border-2 border-white/20"
                                            style="background: {{ $ticket['color'] }}"></div>
                                    </div>
                                    <p
                                        class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                        ₱{{ number_format($ticket['price'], 2) }}
                                    </p>
                                </div>
                                <div
                                    class="px-3 py-1 bg-blue-500/20 backdrop-blur-sm border border-blue-500/30 rounded-full">
                                    <span class="text-xs font-semibold text-blue-400">{{ $ticket['quantity'] -
                                        $ticket['sold'] }} Available</span>
                                </div>
                            </div>

                            <p class="text-gray-400 text-sm mb-4">{{ $ticket['description'] }}</p>

                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-400">{{ $ticket['sold'] }} / {{ $ticket['quantity'] }}
                                        sold</span>
                                    <span class="text-blue-400 font-semibold">{{ round(($ticket['sold'] /
                                        $ticket['quantity']) * 100) }}%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full transition-all"
                                        style="width: {{ round(($ticket['sold'] / $ticket['quantity']) * 100) }}%; background: {{ $ticket['color'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                <div class="text-sm text-gray-400">
                                    Revenue: <span class="text-white font-semibold">₱{{ number_format($ticket['price'] *
                                        $ticket['sold'], 2) }}</span>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick='openEditTicketModal(@json($ticket))'
                                        class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button onclick="return confirm('Are you sure you want to delete this ticket type?')"
                                        class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach --}}
                    @forelse($tickets as $ticket)
                        <div
                            class="ticket-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                            <div class="h-2 w-full" style="background: {{ $ticket->color }}"></div>
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="text-xl font-bold text-white">{{ $ticket->name }}</h3>
                                            <div class="w-4 h-4 rounded-full border-2 border-white/20"
                                                style="background: {{ $ticket->color }}"></div>
                                        </div>
                                        <p
                                            class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                            ₱{{ number_format($ticket->price, 2) }}
                                        </p>
                                    </div>
                                    <div
                                        class="px-3 py-1 bg-blue-500/20 backdrop-blur-sm border border-blue-500/30 rounded-full">
                                        <span class="text-xs font-semibold text-blue-400">
                                            {{ $ticket->quantity }} Available
                                        </span>
                                    </div>
                                </div>

                                <p class="text-gray-400 text-sm mb-4">{{ $ticket->type }}</p>

                                <div class="mb-4">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-400">{{ $ticket->quantity }} sold</span>
                                        <span
                                            class="text-blue-400 font-semibold">{{ round(($ticket->quantity / $ticket->quantity) * 100) }}%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full transition-all"
                                            style="width: {{ round(($ticket->quantity / $ticket->quantity) * 100) }}%; background: {{ $ticket->color }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <div class="text-sm text-gray-400">
                                        Revenue: <span
                                            class="text-white font-semibold">₱{{ number_format($ticket->price * $ticket->quantity, 2) }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick='openEditTicketModal(@json($ticket))'
                                            class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <form action="{{ route('admin.events.tickets.destroy', [$event->slug, $ticket->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this ticket type?')"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all">
                                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div>

                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script type="module">
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if($errors->any())
        <script type="module">
            Toast.fire({
                icon: 'error',
                title: "{{ implode(' ', $errors->all()) }}"
            });
        </script>
    @endif

    @include('admin.component.event.tickets.add-ticket')

    <script>
        function openAddTicketModal() {
            document.getElementById('ticketForm').reset();
            document.getElementById('ticketModalTitle').textContent = 'Add Ticket Type';
            document.getElementById('ticketSubmitBtn').textContent = 'Create Ticket Type';
            document.getElementById('ticketId').value = '';
            document.getElementById('ticketFormMethod').value = 'POST';
            document.getElementById('ticketForm').action = "#";
            document.getElementById('ticketModal').classList.add('active');
        }

        function closeTicketModal() {
            document.getElementById('ticketModal').classList.remove('active');
        }

        function openEditTicketModal(ticket) {
            document.getElementById('ticketModalTitle').textContent = 'Edit Ticket Type';
            document.getElementById('ticketSubmitBtn').textContent = 'Update Ticket Type';
            document.getElementById('ticketId').value = ticket.id;
            document.getElementById('ticketFormMethod').value = 'PUT';
            document.getElementById('ticketTypeName').value = ticket.ticket_type;
            document.getElementById('ticketDescription').value = ticket.description || '';
            document.getElementById('ticketPrice').value = ticket.price;
            document.getElementById('ticketQuantity').value = ticket.quantity;
            document.getElementById('ticketForm').action = "#";
            document.getElementById('ticketModal').classList.add('active');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function (event) {
            const modal = document.getElementById('ticketModal');
            if (modal && modal.classList.contains('active') && event.target === modal) {
                closeTicketModal();
            }
        });
    </script>
@endsection
