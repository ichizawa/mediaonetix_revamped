@extends('layouts')
@section('content')
    <style>
        .event-card {
            transition: all 0.3s ease;
            cursor: pointer;
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

        /* Modal overlay animations */
        @keyframes modalBackdropIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes modalBackdropOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        /* Modal content animations */
        @keyframes modalContentIn {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(16px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes modalContentOut {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }

            to {
                opacity: 0;
                transform: scale(0.92) translateY(16px);
            }
        }

        #eventModal.modal-opening {
            animation: modalBackdropIn 0.25s ease forwards;
        }

        #eventModal.modal-closing {
            animation: modalBackdropOut 0.25s ease forwards;
        }

        #eventModal.modal-opening .modal-content {
            animation: modalContentIn 0.28s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
        }

        #eventModal.modal-closing .modal-content {
            animation: modalContentOut 0.22s ease forwards;
        }

        #viewEventModal.modal-opening {
            animation: modalBackdropIn 0.25s ease forwards;
        }

        #viewEventModal.modal-closing {
            animation: modalBackdropOut 0.25s ease forwards;
        }

        #viewEventModal.modal-opening .modal-content {
            animation: modalContentIn 0.28s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
        }

        #viewEventModal.modal-closing .modal-content {
            animation: modalContentOut 0.22s ease forwards;
        }

        @keyframes deleteConfirmIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(12px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes deleteConfirmOut {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }

            to {
                opacity: 0;
                transform: scale(0.95) translateY(12px);
            }
        }

        #deleteConfirmModal.modal-opening .delete-confirm-panel {
            animation: deleteConfirmIn 0.2s ease forwards;
        }

        #deleteConfirmModal.modal-closing .delete-confirm-panel {
            animation: deleteConfirmOut 0.16s ease forwards;
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-wrap items-start sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-4">
                            <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-xl sm:text-2xl font-bold text-white">Events Management</h2>
                                <p class="text-sm text-gray-400">Manage and create your events</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 shrink-0">
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
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-4 sm:p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Total Events</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ $total_events }}</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-4 sm:p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Active Events</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ $active_events }}</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-4 sm:p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Tickets Sold</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ $tickets_sold }}</h3>
                    </div>
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-4 sm:p-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Upcoming</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">{{ $upcoming_events }}</h3>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                    <button data-filter="all"
                        class="tab-btn active px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">All
                        Events</button>
                    <button data-filter="1"
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Active</button>
                    <button data-filter="0"
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Upcoming</button>
                    <button data-filter="2"
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Ongoing</button>
                    <button data-filter="3"
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Completed</button>
                    <button data-filter="4"
                        class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Cancelled</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($events as $event)
                       
                            <div data-status="{{ $event->status }}"
                                class="event-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm rounded-2xl overflow-hidden {{ $event->latestShowcase ? 'border border-green-400' : '' }}"
                                onclick='openViewModal(@json($event))'>
                                <div class="relative h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20">
                                    <div class="absolute inset-0 bg-cover bg-center opacity-40 event-card-media"
                                        @if ($event->event_image) data-image-url="{{ asset('images/events/' . $event->event_image) }}" @endif
                                        data-crop-x="{{ $event->crop_x ?? '' }}" data-crop-y="{{ $event->crop_y ?? '' }}"
                                        data-crop-width="{{ $event->crop_width ?? '' }}"
                                        data-crop-height="{{ $event->crop_height ?? '' }}"
                                        data-crop-natural-width="{{ $event->crop_natural_width ?? '' }}"
                                        data-crop-natural-height="{{ $event->crop_natural_height ?? '' }}">
                                        @if ($event->event_image)
                                            <img src="{{ asset('images/events/' . $event->event_image) }}"
                                                alt="Event Image" class="w-full h-full object-cover">
                                        @endif
                                    </div>

                                <div class="absolute top-4 right-4">
                                    @php
                                        $statusStyles = [
                                            0 => ['bg' => 'rgba(147,51,234,0.2)', 'border' => 'rgba(147,51,234,0.4)', 'color' => '#c084fc'],
                                            1 => ['bg' => 'rgba(34,197,94,0.2)', 'border' => 'rgba(34,197,94,0.4)', 'color' => '#4ade80'],
                                            2 => ['bg' => 'rgba(59,130,246,0.2)', 'border' => 'rgba(59,130,246,0.4)', 'color' => '#60a5fa'],
                                            3 => ['bg' => 'rgba(107,114,128,0.2)', 'border' => 'rgba(107,114,128,0.4)', 'color' => '#9ca3af'],
                                            4 => ['bg' => 'rgba(239,68,68,0.2)', 'border' => 'rgba(239,68,68,0.4)', 'color' => '#f87171'],
                                        ];
                                        $s = $statusStyles[$event->status] ?? $statusStyles[0];
                                    @endphp
                                    <span
                                        class="px-3 py-1 backdrop-blur-sm rounded-full text-xs font-semibold flex items-center gap-1"
                                        style="background:{{ $s['bg'] }};border:1px solid {{ $s['border'] }};color:{{ $s['color'] }}">
                                        @if($event->status === 1)
                                            <span class="relative flex h-2 w-2">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                                                    style="background-color:#4ade80"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2"
                                                    style="background-color:#4ade80"></span>
                                            </span>
                                        @endif
                                        {{ $event->status_label['label'] }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-gray-400">{{ date('F j, Y', strtotime($event->event_date)) }} •
                                        {{ date('g:i A', strtotime($event->event_time)) }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">{{ $event->event_name }}</h3>
                                <p class="event-card-desc text-gray-400 text-sm mb-4 overflow-hidden"
                                    style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                                    data-raw="{{ $event->description }}"></p>
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
                                        <span class="text-gray-400">{{ $event->tickets_sold }} /
                                            {{ $event->tickets->sum('original_qty') }} sold</span>
                                        <span
                                            class="text-blue-400 font-semibold">{{ number_format($event->percentage, 0) }}%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-blue-600 to-blue-400 transition-all"
                                            style="width: {{ $event->percentage }}%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                    <div>
                                        {{-- <p class="text-sm text-gray-400">Starting from</p>
                                        <p class="text-xl font-bold text-white">$45</p> --}}
                                    </div>
                                    <div class="flex gap-2" onclick="event.stopPropagation()">
                                        <button onclick='openEditModal(@json($event))'
                                            class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a      2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>

                                            <a href="{{ route('merchant.events.tickets.tickets', $event->slug) }}"
                                                class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 -1 17 18">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                        d="M4 4.85v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9z">
                                                    </path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                        d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3zM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('merchant.events.delete', $event->id) }}"
                                                method="POST" onsubmit="confirmDelete(event, this)" class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all">
                                                    <svg class="w-5 h-5 text-red-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
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
                </div>
            </div>
        </div>
    </div>

    <div id="deleteConfirmModal" class="hidden fixed inset-0 z-[70] items-center justify-center p-4"
        style="background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(8px);">
        <div
            class="delete-confirm-panel w-full max-w-md rounded-2xl border border-white/10 bg-gradient-to-br from-[#1a2332] to-[#0c1222] p-6 shadow-2xl">
            <div class="flex items-center gap-3 mb-4">
                <div class="h-10 w-10 rounded-xl bg-red-500/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white">Delete Event?</h3>
            </div>
            <p class="text-sm text-gray-300 mb-6">This action is permanent and cannot be undone.</p>
            <div class="flex items-center justify-end gap-3">
                <button id="deleteModalCancelBtn" type="button"
                    class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">Cancel</button>
                <button id="deleteModalConfirmBtn" type="button"
                    class="px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-200 rounded-lg font-semibold transition-all">Delete Event</button>
            </div>
        </div>
    </div>

    @include('merchant.component.event.modal')
    @include ('merchant.component.event.view')

    <script>
        let currentEventId = null;
        let isEditMode = false;
        let pendingDeleteForm = null;
        const deleteRouteTemplate = "{{ route('merchant.events.delete', '__EVENT_ID__') }}";
        const ticketsRouteTemplate = "{{ route('merchant.events.tickets.tickets', '__EVENT_SLUG__') }}";
        // Helper: set value + label for a custom dropdown
        function setCustomSelect(id, value) {
            const hidden = document.getElementById(id);
            if (!hidden) return;
            hidden.value = value;
            const wrapper = hidden.nextElementSibling; // .custom-select-wrapper
            if (!wrapper) return;
            const label = wrapper.querySelector('.custom-select-label');
            const option = wrapper.querySelector(`.custom-select-option[data-value="${value}"]`);
            if (label && option) label.textContent = option.textContent;
        }

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

            // Fully reset image state (clears crop fields, background, src, etc.)
            clearImageState();



            // Set default values
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('eventDate').value = today;
            document.getElementById('eventTime').value = '19:00';
            document.getElementById('eventStatus').value = '0';
            const statusLabel = document.querySelector('[data-target="eventStatus"] .custom-select-label');
            if (statusLabel) statusLabel.textContent = statusLabel.getAttribute('data-default-text') || 'Status';
            document.getElementById('eventCategory').value = 'Music';
            const categoryLabel = document.querySelector('[data-target="eventCategory"] .custom-select-label');
            if (categoryLabel) categoryLabel.textContent = categoryLabel.getAttribute('data-default-text') || 'Category';

            // Show modal with animation
            const eventModal = document.getElementById('eventModal');
            eventModal.classList.remove('hidden', 'modal-closing');
            eventModal.classList.add('flex', 'modal-opening');
            eventModal.addEventListener('animationend', () => {
                eventModal.classList.remove('modal-opening');
            }, {
                once: true
            });
        }

        function closeModal() {
            const eventModal = document.getElementById('eventModal');
            eventModal.classList.remove('modal-opening');
            eventModal.classList.add('modal-closing');
            eventModal.addEventListener('animationend', () => {
                eventModal.classList.add('hidden');
                eventModal.classList.remove('flex', 'modal-closing');
            }, {
                once: true
            });
        }

        function openViewModal(event) {
            // const percentage = Math.round((event.event_total_tickets / event.event_total_tickets) * 100);
            const totalTickets = event.tickets.reduce((sum, ticket) => {
                return sum + ticket.original_qty;
            }, 0);
            const soldTickets = Number(event.tickets_sold || 0);
            const percentage = Math.max(0, Math.min(100, Number(event.percentage || 0)));
            const lowestPrice = event.tickets.length ? Math.min(...event.tickets.map(t => t.price ?? 0)) : 0;

            const seatPlanBtn = document.getElementById('viewSeatPlanBtn');
            const seatPlanImg = document.getElementById('seatPlanLightboxImg');
            if (event.seat_plan) {
                seatPlanImg.src = '/images/events/seat_plan/' + event.seat_plan;
                seatPlanBtn.classList.remove('hidden');
                seatPlanBtn.classList.add('flex');
            } else {
                seatPlanImg.src = '';
                seatPlanBtn.classList.remove('flex');
                seatPlanBtn.classList.add('hidden');
            }
            // console.log(event);
            // Populate view modal with event data
            document.getElementById('viewEventName').textContent = event.event_name;
            document.getElementById('viewEventCategory').textContent = event.category;
            document.getElementById('viewEventDateTime').textContent =
                `${formatDate(event.event_date)} • ${formatTime(event.event_time)}`;
            document.getElementById('viewEventLocation').textContent = event.event_venue;
            document.getElementById('viewEventPrice').textContent = '₱ ' + lowestPrice.toFixed(2);
            document.getElementById('viewEventDescription').innerHTML = isHtml(event.description)
                ? event.description
                : renderMarkdown(event.description);
            document.getElementById('viewEventTotal').textContent = `of ${totalTickets} tickets`;
            document.getElementById('viewEventPercentage').textContent = `${percentage.toFixed(2)}%`;
            document.getElementById('viewEventProgress').style.width = `${percentage}%`;

            // Status Badge Formatting (styled like reference dropdown options + translucent pill background)
            const statusContainer = document.getElementById('viewEventStatusContainer');
            let statusHtml = '';

            switch (event.status) {
                case 0: // Upcoming
                    statusHtml =
                        `<span class="px-3 py-1 font-semibold text-sm rounded-full bg-[#c084fc]/15 border border-[#c084fc]/30" style="color:#c084fc">Upcoming</span>`;
                    break;
                case 1: // Active
                    statusHtml = `<div class="px-3 py-1 font-semibold text-sm rounded-full bg-[#4ade80]/15 border border-[#4ade80]/30 flex items-center gap-2" style="color:#4ade80">
                                        <span class="relative flex h-2 w-2 shrink-0">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color:#4ade80"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2" style="background-color:#4ade80"></span>
                                        </span>
                                        <span>Active</span>
                                      </div>`;
                    break;
                case 2: // Ongoing
                    statusHtml =
                        `<span class="px-3 py-1 font-semibold text-sm rounded-full bg-[#60a5fa]/15 border border-[#60a5fa]/30" style="color:#60a5fa">Ongoing</span>`;
                    break;
                case 3: // Completed
                    statusHtml =
                        `<span class="px-3 py-1 font-semibold text-sm rounded-full bg-[#9ca3af]/15 border border-[#9ca3af]/30" style="color:#9ca3af">Completed</span>`;
                    break;
                case 4: // Cancelled
                    statusHtml =
                        `<span class="px-3 py-1 font-semibold text-sm rounded-full bg-[#f87171]/15 border border-[#f87171]/30" style="color:#f87171">Cancelled</span>`;
                    break;
                default:
                    statusHtml =
                        `<span class="px-3 py-1 font-semibold text-sm rounded-full bg-gray-500/15 border border-gray-500/30 text-gray-400">${event.status_label?.label || 'Unknown'}</span>`;
            }
            statusContainer.innerHTML = statusHtml;

            // Set background image
            const imageEl = document.getElementById('viewEventImage');
            if (event.event_image) {
                const imageUrl = `{{ asset('images/events') }}/${event.event_image}`;
                imageEl.style.backgroundImage = `url('${imageUrl}')`;
                imageEl.style.backgroundSize = '';
                imageEl.style.backgroundPosition = '';
                imageEl.style.backgroundRepeat = '';

                applyFocalImageToBox(
                    imageEl,
                    imageUrl,
                    Number(event.crop_x),
                    Number(event.crop_y),
                    Number(event.crop_width),
                    Number(event.crop_height),
                    Number(event.crop_natural_width),
                    Number(event.crop_natural_height)
                );
            } else {
                imageEl.style.backgroundImage = 'none';
                imageEl.style.backgroundSize = '';
                imageEl.style.backgroundPosition = '';
                imageEl.style.backgroundRepeat = '';
            }

            // Store event ID for edit functionality (in real app, use real ID)
            document.getElementById('viewEventModal').dataset.eventId = event.id;

            // Wire delete form action in view modal
            const viewDeleteForm = document.getElementById('viewDeleteEventForm');
            if (viewDeleteForm && event.id) {
                viewDeleteForm.action = deleteRouteTemplate.replace('__EVENT_ID__', String(event.id));
            }

            const manageTicketsBtn = document.getElementById('viewManageTicketsBtn');
            if (manageTicketsBtn && event.slug) {
                manageTicketsBtn.href = ticketsRouteTemplate.replace('__EVENT_SLUG__', String(event.slug));
            }

            // // Show the view modal
            const viewModal = document.getElementById('viewEventModal');
            viewModal.classList.remove('hidden', 'modal-closing');
            viewModal.classList.add('flex', 'modal-opening');
            if (typeof syncViewOverlayScrollLock === 'function') {
                syncViewOverlayScrollLock();
            }
            viewModal.addEventListener('animationend', () => {
                viewModal.classList.remove('modal-opening');
            }, {
                once: true
            });

            document.getElementById('openEditModalFromView').addEventListener('click', function () {
                // console.log(event);
                closeViewModal();
                setTimeout(() => {
                    openEditModal(event);
                }, 300);
            });
        }

        // Removed duplicate closeViewModal

        function openEditModal(event) {
            closeViewModal();

            // Populate edit form
            document.getElementById('modalTitle').textContent = 'Edit Event';
            document.getElementById('submitBtn').textContent = 'Update Event';
            document.getElementById('eventId').value = event.id || '';
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('eventName').value = event.event_name || '';
            setCustomSelect('eventCategory', event.category || 'Music');
            document.getElementById('eventDescription').value = event.description || '';
            document.getElementById('eventDate').value = event.event_date || '';
            document.getElementById('eventTime').value = event.event_time || '';
            document.getElementById('eventLocation').value = event.event_venue || '';
            setCustomSelect('eventStatus', String(event.status));
            document.getElementById('eventForm').action = "{{ route('merchant.events.update') }}";

            // Event Image Preview — use editEventSetPreview so crop focal point is applied
            const imageUrl = event.event_image ?
                "{{ asset('images/events') }}/" + event.event_image :
                null;
            editEventSetPreview(
                imageUrl,
                event.crop_x, event.crop_y,
                event.crop_width, event.crop_height,
                event.crop_natural_width, event.crop_natural_height
            );


            // Seat Plan Preview
            const seatPlanPreviewContainer = document.getElementById('seatPlanPreviewContainer');
            const seatPlanPreviewImg = document.getElementById('seatPlanPreview');
            const seatPlanPlaceholder = document.getElementById('seatPlanPlaceholder');

            if (event.seat_plan) {
                seatPlanPreviewImg.src = "{{ asset('images/events/seat_plan') }}/" + event.seat_plan;
                if (seatPlanPreviewContainer) seatPlanPreviewContainer.classList.remove('hidden');
                if (seatPlanPlaceholder) seatPlanPlaceholder.classList.add('hidden');
            } else {
                if (seatPlanPreviewContainer) seatPlanPreviewContainer.classList.add('hidden');
                if (seatPlanPlaceholder) seatPlanPlaceholder.classList.remove('hidden');
            }

            // Show edit modal with animation
            setTimeout(() => {
                const eventModal = document.getElementById('eventModal');
                eventModal.classList.remove('hidden', 'modal-closing');
                eventModal.classList.add('flex', 'modal-opening');
                eventModal.addEventListener('animationend', () => {
                    eventModal.classList.remove('modal-opening');
                }, {
                    once: true
                });
            }, 300);
        }

        function isHtml(str) {
            return str && /<[a-z][\s\S]*>/i.test(str);
        }

        function confirmDelete(event, form) {
            event.preventDefault();
            pendingDeleteForm = form;

            const deleteModal = document.getElementById('deleteConfirmModal');
            if (!deleteModal) return;

            deleteModal.classList.remove('hidden', 'modal-closing');
            deleteModal.classList.add('flex', 'modal-opening');

            deleteModal.addEventListener('animationend', () => {
                deleteModal.classList.remove('modal-opening');
            }, {
                once: true
            });
        }

        function closeDeleteConfirmModal() {
            const deleteModal = document.getElementById('deleteConfirmModal');
            if (!deleteModal || deleteModal.classList.contains('hidden')) return;

            deleteModal.classList.remove('modal-opening');
            deleteModal.classList.add('modal-closing');
            deleteModal.addEventListener('animationend', () => {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex', 'modal-closing');
            }, {
                once: true
            });
        }

        // Utility functions
        function renderMarkdown(raw) {

            if (!raw) return '<span class="text-gray-600">No description provided.</span>';

            return raw
                .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
                .replace(/^## (.+)$/gm, '<h2 class="text-lg font-bold text-white mt-3 mb-1">$1</h2>')
                .replace(/^# (.+)$/gm, '<h1 class="text-xl font-bold text-white mt-3 mb-1">$1</h1>')
                .replace(/\*\*(.*?)\*\*/g, '<strong class="text-white font-semibold">$1</strong>')
                .replace(/__(.*?)__/g, '<u>$1</u>')
                .replace(/_(.*?)_/g, '<em>$1</em>')
                .replace(/^&gt; (.+)$/gm,
                    '<blockquote class="border-l-2 border-gray-500 pl-3 italic text-gray-300">$1</blockquote>')
                .replace(/^---$/gm, '<hr class="border-gray-600 my-2">')
                .replace(/((?:^• .+\n?)+)/gm, (block) => {
                    const items = block.trim().split('\n').map(l => `<li>${l.replace(/^• /, '')}</li>`).join('');
                    return `<ul class="list-disc list-inside text-gray-400 my-1 space-y-0.5">${items}</ul>`;
                })
                .replace(/((?:^\d+\. .+\n?)+)/gm, (block) => {
                    const items = block.trim().split('\n').map(l => `<li>${l.replace(/^\d+\. /, '')}</li>`).join('');
                    return `<ol class="list-decimal list-inside text-gray-400 my-1 space-y-0.5">${items}</ol>`;
                })
                .replace(/(<\/h[12]>|<\/blockquote>|<\/ul>|<\/ol>|<hr[^>]*>)<br>/g, '$1')
                .replace(/\n/g, '<br>');
        }

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

        function setActiveEvent(eventSlug) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('merchant.events.set-active') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify({
                        slug: eventSlug
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // console.log("Active event set:", data);
                    // Swal.fire()
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });

                    window.location.reload(); // temporary reload but should implement websocket
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        }

        function hasValidCropData(cropX, cropY, cropW, cropH, natW, natH) {
            return Number.isFinite(cropX) && Number.isFinite(cropY) && Number.isFinite(cropW) &&
                Number.isFinite(cropH) && Number.isFinite(natW) && Number.isFinite(natH) &&
                cropW > 0 && cropH > 0 && natW > 0 && natH > 0;
        }

        function buildFocalStyles(cropX, cropY, cropW, cropH, natW, natH, containerW, containerH) {
            const scaleX = containerW / cropW;
            const scaleY = containerH / cropH;
            const scale = Math.max(scaleX, scaleY);

            return {
                sizeX: natW * scale,
                sizeY: natH * scale,
                posX: -(cropX * scale),
                posY: -(cropY * scale),
            };
        }

        function applyFocalImageToBox(boxEl, imageUrl, cropX, cropY, cropW, cropH, natW, natH) {
            if (!boxEl || !imageUrl || !hasValidCropData(cropX, cropY, cropW, cropH, natW, natH)) return;

            const containerW = boxEl.offsetWidth;
            const containerH = boxEl.offsetHeight;
            if (!containerW || !containerH) {
                requestAnimationFrame(() => {
                    applyFocalImageToBox(boxEl, imageUrl, cropX, cropY, cropW, cropH, natW, natH);
                });
                return;
            }

            const focal = buildFocalStyles(cropX, cropY, cropW, cropH, natW, natH, containerW, containerH);
            boxEl.style.backgroundImage = `url('${imageUrl}')`;
            boxEl.style.backgroundSize = `${focal.sizeX}px ${focal.sizeY}px`;
            boxEl.style.backgroundPosition = `${focal.posX}px ${focal.posY}px`;
            boxEl.style.backgroundRepeat = 'no-repeat';

            const fallbackImg = boxEl.querySelector('img');
            if (fallbackImg) fallbackImg.style.display = 'none';
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.event-card-desc').forEach(el => {
                const raw = el.getAttribute('data-raw');
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = isHtml(raw) ? raw : renderMarkdown(raw);
                el.textContent = tempDiv.textContent || tempDiv.innerText || '';
            });

            document.querySelectorAll('.event-card-media').forEach(mediaEl => {
                const imageUrl = mediaEl.dataset.imageUrl || '';
                const cropX = Number(mediaEl.dataset.cropX);
                const cropY = Number(mediaEl.dataset.cropY);
                const cropW = Number(mediaEl.dataset.cropWidth);
                const cropH = Number(mediaEl.dataset.cropHeight);
                const natW = Number(mediaEl.dataset.cropNaturalWidth);
                const natH = Number(mediaEl.dataset.cropNaturalHeight);

                applyFocalImageToBox(mediaEl, imageUrl, cropX, cropY, cropW, cropH, natW, natH);
            });

            const eventImageInput = document.getElementById('eventImage');
            const previewImage = document.getElementById('previewImage');
            const imagePlaceholder = document.getElementById('eventImagePlaceholder');
            const eventDropZone = document.getElementById('eventDropZone');
            const seatPlanInput = document.getElementById('seatPlanImage');
            const seatPlanPreview = document.getElementById('seatPlanPreview');
            const seatPlanPlaceholder = document.getElementById('seatPlanPlaceholder');

            function showEventImagePreview(file) {
                if (!file || !previewImage || !imagePlaceholder) return;

                const reader = new FileReader();
                reader.onload = function(evt) {
                    previewImage.src = evt.target.result;
                    previewImage.classList.remove('hidden');

                    const container = document.getElementById('eventPreviewContainer');
                    if (container) container.classList.remove('hidden');

                    imagePlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }

            if (eventImageInput && previewImage && imagePlaceholder) {
                eventImageInput.addEventListener('change', function(e) {
                    const file = e.target.files && e.target.files[0];
                    if (!file) return;
                    showEventImagePreview(file);
                    // Also show the container
                    const container = document.getElementById('eventPreviewContainer');
                    if (container) container.classList.remove('hidden');
                });
            }

            // Remove Image Button Handler
            const removeEventImageBtn = document.getElementById('removeEventImageBtn');
            if (removeEventImageBtn) {
                removeEventImageBtn.addEventListener('click', function() {
                    if (eventImageInput) eventImageInput.value = '';
                    if (previewImage) {
                        previewImage.src = '';
                        previewImage.classList.add('hidden'); // Or just container
                    }
                    const container = document.getElementById('eventPreviewContainer');
                    if (container) container.classList.add('hidden');
                    if (imagePlaceholder) imagePlaceholder.classList.remove('hidden');

                    // If we want to support clearing the existing image on edit, we might need a hidden input to signal "delete image"
                    // But for now, this just resets the UI to allow uploading a new one.
                    // If user saves now, no new image is uploaded. The backend usually keeps the old one if 'image' input is empty.
                    // If they WANT to remove the image completely, backend support is needed.
                    // Based on "make the current image show", we assume they want to SEE it, and if they remove it here, they probably want to REPLACE it.
                });
            }

            if (eventDropZone && eventImageInput) {
                const highlightDropZone = () => {
                    eventDropZone.classList.add('border-blue-500', 'bg-blue-500/10');
                    eventDropZone.classList.remove('border-[#a7a7a7]');
                };

                const unhighlightDropZone = () => {
                    eventDropZone.classList.remove('border-blue-500', 'bg-blue-500/10');
                    eventDropZone.classList.add('border-[#a7a7a7]');
                };

                ['dragenter', 'dragover'].forEach(eventName => {
                    eventDropZone.addEventListener(eventName, function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        highlightDropZone();
                    });
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    eventDropZone.addEventListener(eventName, function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        unhighlightDropZone();
                    });
                });

                eventDropZone.addEventListener('drop', function(e) {
                    const file = e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0];
                    if (!file) return;

                    const transfer = new DataTransfer();
                    transfer.items.add(file);
                    eventImageInput.files = transfer.files;
                    showEventImagePreview(file);
                });
            }

            if (seatPlanInput && seatPlanPreview && seatPlanPlaceholder) {
                seatPlanInput.addEventListener('change', function(e) {
                    const file = e.target.files && e.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        seatPlanPreview.src = evt.target.result;
                        seatPlanPreview.classList.remove('hidden');
                        seatPlanPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                });
            }

            // --- Custom select dropdowns ---
            document.querySelectorAll('.custom-select-wrapper').forEach(wrapper => {
                wrapper.style.position = 'relative';
                const btn = wrapper.querySelector('.custom-select-btn');
                const dropdown = wrapper.querySelector('.custom-select-dropdown');
                const targetId = wrapper.dataset.target;

                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Close all other open dropdowns first
                    document.querySelectorAll('.custom-select-dropdown').forEach(d => {
                        if (d !== dropdown) {
                            d.classList.add('hidden');
                            d.previousElementSibling.querySelector('svg').style.transform =
                                '';
                        }
                    });
                    dropdown.classList.toggle('hidden');
                    btn.querySelector('svg').style.transform = dropdown.classList.contains(
                        'hidden') ? '' : 'rotate(180deg)';
                });

                wrapper.querySelectorAll('.custom-select-option').forEach(option => {
                    option.addEventListener('click', function() {
                        const value = this.dataset.value;
                        const label = this.textContent;
                        document.getElementById(targetId).value = value;
                        wrapper.querySelector('.custom-select-label').textContent = label;
                        dropdown.classList.add('hidden');
                        btn.querySelector('svg').style.transform = '';
                    });
                });
            });

            // Close custom dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.custom-select-dropdown').forEach(d => {
                    if (!d.classList.contains('hidden')) {
                        d.classList.add('hidden');
                        d.previousElementSibling.querySelector('svg').style.transform = '';
                    }
                });
            });

            // Tab functionality
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove(
                    'active'));
                    this.classList.add('active');

                    const filter = this.dataset.filter;
                    document.querySelectorAll('.event-card').forEach(card => {
                        if (filter === 'all' || card.dataset.status === filter) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Close modals when clicking outside
            document.addEventListener('click', function(event) {
                const viewModal = document.getElementById('viewEventModal');
                const deleteModal = document.getElementById('deleteConfirmModal');

                if (viewModal && !viewModal.classList.contains('hidden') &&
                    event.target === viewModal) {
                    closeViewModal();
                }

                if (deleteModal && !deleteModal.classList.contains('hidden') &&
                    event.target === deleteModal) {
                    pendingDeleteForm = null;
                    closeDeleteConfirmModal();
                }
            });

            const deleteModalCancelBtn = document.getElementById('deleteModalCancelBtn');
            if (deleteModalCancelBtn) {
                deleteModalCancelBtn.addEventListener('click', function() {
                    pendingDeleteForm = null;
                    closeDeleteConfirmModal();
                });
            }

            const deleteModalConfirmBtn = document.getElementById('deleteModalConfirmBtn');
            if (deleteModalConfirmBtn) {
                deleteModalConfirmBtn.addEventListener('click', function() {
                    if (pendingDeleteForm) {
                        const formToSubmit = pendingDeleteForm;
                        pendingDeleteForm = null;
                        closeDeleteConfirmModal();
                        formToSubmit.submit();
                    }
                });
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    pendingDeleteForm = null;
                    closeDeleteConfirmModal();
                }
            });
        });
    </script>
@endsection
