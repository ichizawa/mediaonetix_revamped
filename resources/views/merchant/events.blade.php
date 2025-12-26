@extends('layouts')
@section('content')
    <style>
        .event-card {
            transition: all 0.3s ease;
        }

        .event-card:hover {
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

        .tab-btn {
            background: transparent;
            color: #9ca3af;
        }

        .tab-btn.active {
            background: linear-gradient(to right, rgba(59, 130, 246, 0.2), rgba(147, 51, 234, 0.2));
            color: white;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button id="openSidebar" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Events Management</h2>
                                <p class="text-sm text-gray-400">Manage and create your events</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button onclick="openAddModal()"
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="hidden sm:inline">Add Event</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Total Events</p>
                        <h3 class="text-3xl font-bold text-white">23</h3>
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
                        <p class="text-gray-400 text-sm mb-1">Active Events</p>
                        <h3 class="text-3xl font-bold text-white">18</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Tickets Sold</p>
                        <h3 class="text-3xl font-bold text-white">1,247</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Upcoming</p>
                        <h3 class="text-3xl font-bold text-white">12</h3>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                    <button class="tab-btn active px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">All
                        Events</button>
                    <button
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Upcoming</button>
                    <button
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Ongoing</button>
                    <button
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Completed</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($events as $event)
                        <div
                            class="event-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                            <div class="relative h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20">
                                <div class="absolute inset-0 bg-cover bg-center opacity-40">
                                    @if($event->event_image)
                                        <img src="{{ asset('images/events/' . $event->event_image) }}" alt="Event Image" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span
                                        class="px-3 py-1 bg-green-500/20 backdrop-blur-sm border border-green-500/30 rounded-full text-xs font-semibold text-green-400">{{ $event->status['label'] }}</span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-gray-400">{{ $event->event_date }} •
                                        {{ date('g:i A', strtotime($event->event_time)) }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">{{ $event->event_name }}</h3>
                                <p class="text-gray-400 text-sm mb-4">{{ $event->description }}</p>
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm text-gray-400">{{ $event->event_venue }}</span>
                                </div>
                                <div class="mb-4">
                                    <div class="flex justify-between text-sm mb-2">
                                        <span class="text-gray-400">342 / {{ $event->event_total_tickets }} sold</span>
                                        <span class="text-blue-400 font-semibold">68%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-blue-600 to-blue-400 transition-all"
                                            style="width: 68%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <div>
                                        {{-- <p class="text-sm text-gray-400">Starting from</p>
                                        <p class="text-xl font-bold text-white">$45</p> --}}
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick='openViewModal(@json($event))'
                                            class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button onclick='openEditModal(@json($event))'
                                            class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                        <form action="{{ route('merchant.events.delete', $event->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this event?')" class="inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all">
                                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                    @endforelse
                    {{-- @for($i = 0; $i < 6; $i++) <div
                        class="event-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                        <div class="relative h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20">
                            <div class="absolute inset-0 bg-cover bg-center opacity-40"></div>
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 bg-green-500/20 backdrop-blur-sm border border-green-500/30 rounded-full text-xs font-semibold text-green-400">Active</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm text-gray-400">August 15, 2024 • 8:00 PM</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Event Name {{ $i + 1 }}</h3>
                            <p class="text-gray-400 text-sm mb-4">Event description goes here</p>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-400">Event Location</span>
                            </div>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-400">342 / 500 sold</span>
                                    <span class="text-blue-400 font-semibold">68%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-600 to-blue-400 transition-all"
                                        style="width: 68%"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                <div>
                                    <p class="text-sm text-gray-400">Starting from</p>
                                    <p class="text-xl font-bold text-white">$45</p>
                                </div>
                                <div class="flex gap-2">
                                    <button onclick="openViewModal('{{ $i }}')"
                                        class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button onclick="openEditModal({{ $i + 1 }})"
                                        class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all">
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
                @endfor --}}
            </div>
        </div>
    </div>
    </div>

    @include('merchant.component.event.modal')
    @include ('merchant.component.event.view')
    <!--  Add EVENT MODAL-->

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

    <script>
        let currentEventId = null;
        let isEditMode = false;
        // Modal management functions
        function openAddModal() {
            isEditMode = false;
            currentEventId = null;

            // Reset form
            document.getElementById('eventForm').reset();
            document.getElementById('modalTitle').textContent = 'Add New Event';
            document.getElementById('submitBtn').textContent = 'Create Event';
            document.getElementById('eventId').value = '';
            document.getElementById('formMethod').value = 'POST';

            // Hide image preview and current image info
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('currentImageInfo').classList.add('hidden');

            // Set default values
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('eventDate').value = today;
            document.getElementById('eventTime').value = '19:00';
            document.getElementById('eventStatus').value = 'upcoming';
            document.getElementById('eventTotalTickets').value = '100';
            document.getElementById('eventPrice').value = '0.00';

            // Show modal
            document.getElementById('eventModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('eventModal').classList.remove('active');
        }

        function openViewModal(event) {
            // const event = sampleEvents[eventIndex] || sampleEvents[0];
            const percentage = Math.round((event.event_total_tickets / event.event_total_tickets) * 100);
            console.log(event);
            // Populate view modal with event data
            document.getElementById('viewEventName').textContent = event.event_name;
            document.getElementById('viewEventCategory').textContent = event.category;
            document.getElementById('viewEventDateTime').textContent = `${formatDate(event.event_date)} • ${formatTime(event.event_time)}`;
            document.getElementById('viewEventLocation').textContent = event.event_venue;
            document.getElementById('viewEventPrice').textContent = event.price;
            document.getElementById('viewEventDescription').textContent = event.description;
            document.getElementById('viewEventSold').textContent = `${event.soldTickets} sold`;
            document.getElementById('viewEventTotal').textContent = `of ${event.event_total_tickets} tickets`;
            document.getElementById('viewEventPercentage').textContent = `${percentage}%`;
            document.getElementById('viewEventProgress').style.width = `${percentage}%`;
            document.getElementById('viewEventStatus').textContent = event.status.label;

            // // Set status color based on status
            // const statusEl = document.getElementById('viewEventStatus');
            // statusEl.className = 'px-3 py-1 backdrop-blur-sm border rounded-full text-xs font-semibold';

            // switch (event.status.toLowerCase()) {
            //     case 'active':
            //         statusEl.classList.add('bg-green-500/20', 'border-green-500/30', 'text-green-400');
            //         break;
            //     case 'upcoming':
            //         statusEl.classList.add('bg-blue-500/20', 'border-blue-500/30', 'text-blue-400');
            //         break;
            //     case 'ongoing':
            //         statusEl.classList.add('bg-yellow-500/20', 'border-yellow-500/30', 'text-yellow-400');
            //         break;
            //     case 'completed':
            //         statusEl.classList.add('bg-gray-500/20', 'border-gray-500/30', 'text-gray-400');
            //         break;
            // }

            // Set background image
            const imageEl = document.getElementById('viewEventImage');
            imageEl.style.backgroundImage = `url('${event.event_image}')`;

            // Store event ID for edit functionality (in real app, use real ID)
            document.getElementById('viewEventModal').dataset.eventId = event.id;

            // // Show the view modal
            document.getElementById('viewEventModal').classList.add('active');
        }

        function closeViewModal() {
            document.getElementById('viewEventModal').classList.remove('active');
        }

        function openEditModal(event) {
            const eventIndex = document.getElementById('viewEventModal').dataset.eventId;
            closeViewModal();

            // Populate edit form
            document.getElementById('modalTitle').textContent = 'Edit Event';
            document.getElementById('submitBtn').textContent = 'Update Event';
            document.getElementById('eventId').value = event.id || '';
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('eventName').value = event.event_name || '';
            document.getElementById('eventCategory').value = event.category || 'Music';
            document.getElementById('eventDescription').value = event.description || '';
            document.getElementById('eventDate').value = event.event_date || '';
            document.getElementById('eventTime').value = event.event_time || '';
            document.getElementById('eventLocation').value = event.event_venue || '';
            document.getElementById('eventTotalTickets').value = event.event_total_tickets || '';
            // document.getElementById('eventPrice').value = event.price || '';
            document.getElementById('eventStatus').value = event.status['label'] || 'active';

            document.getElementById('currentImageText').style.display = 'block';

            // Show edit modal
            setTimeout(() => {
                document.getElementById('eventModal').classList.add('active');
            }, 300);
        }

        // Utility functions
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        function formatTime(timeString) {
            const [hours, minutes] = timeString.split(':');
            const hour = parseInt(hours);
            const ampm = hour >= 12 ? 'PM' : 'AM';
            const formattedHour = hour % 12 || 12;
            return `${formattedHour}:${minutes} ${ampm}`;
        }

        function openEditModalFromView() {
            const eventId = document.getElementById('viewEventModal').dataset.eventId;
            closeViewModal();
            setTimeout(() => {
                openEditModal(eventId);
            }, 300);
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function () {
            // Tab functionality
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Close modals when clicking outside
            document.addEventListener('click', function (event) {
                const viewModal = document.getElementById('viewEventModal');
                const eventModal = document.getElementById('eventModal');

                if (viewModal && viewModal.classList.contains('active') &&
                    event.target === viewModal) {
                    closeViewModal();
                }

                if (eventModal && eventModal.classList.contains('active') &&
                    event.target === eventModal) {
                    closeModal();
                }
            });

            // // Form submission
            // document.getElementById('eventForm').addEventListener('submit', function (e) {
            //     e.preventDefault();

            //     const formData = new FormData(this);
            //     const method = document.getElementById('formMethod').value;
            //     const isEdit = method === 'PUT';

            //     // In real app, send to server
            //     console.log('Form submitted:', Object.fromEntries(formData));

            //     // Show success message
            //     alert(isEdit ? 'Event updated successfully!' : 'Event created successfully!');
            //     closeModal();

            //     // In real app, you would refresh the events list
            //     // window.location.reload();
            // });
        });
    </script>

@endsection