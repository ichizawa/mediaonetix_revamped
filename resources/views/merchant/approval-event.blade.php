@extends('layouts')

@section('content')
    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-wrap items-start sm:items-center justify-between gap-3">
                        <div>
                            <h2 class="text-xl sm:text-2xl font-bold text-white">Event Approval</h2>
                            <p class="text-sm text-gray-400">Review event details before publishing or rejecting.</p>
                        </div>
                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back
                        </a>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-8 space-y-6">
                <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                        <div class="lg:col-span-1 min-h-[240px] bg-[#111b31]">
                            @if (!empty($event->event_image ?? null))
                                <img src="{{ asset('images/events/' . $event->event_image) }}" alt="Event Image"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-500 p-6 text-center">
                                    No event image uploaded
                                </div>
                            @endif
                        </div>

                        <div class="lg:col-span-2 p-6 sm:p-8 space-y-5">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-400 mb-2">Pending Review</p>
                                    <h3 class="text-2xl font-bold text-white">{{ $event->event_name ?? 'Untitled Event' }}</h3>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 border border-yellow-400/40 text-yellow-300">
                                    For Approval
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-gray-400 mb-1">Date & Time</p>
                                    <p class="text-white font-semibold">
                                        {{ !empty($event->event_date ?? null) ? date('F j, Y', strtotime($event->event_date)) : 'TBD' }}
                                        •
                                        {{ !empty($event->event_time ?? null) ? date('g:i A', strtotime($event->event_time)) : 'TBD' }}
                                    </p>
                                </div>
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-gray-400 mb-1">Venue</p>
                                    <p class="text-white font-semibold">{{ $event->event_venue ?? 'Not set' }}</p>
                                </div>
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-gray-400 mb-1">Category</p>
                                    <p class="text-white font-semibold">{{ $event->category ?? 'Uncategorized' }}</p>
                                </div>
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <p class="text-gray-400 mb-1">Tickets</p>
                                    <p class="text-white font-semibold">
                                        {{ isset($event->tickets) ? $event->tickets->sum('original_qty') : 0 }} total slots
                                    </p>
                                </div>
                            </div>

                            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                <p class="text-gray-400 text-sm mb-2">Description</p>
                                <p class="text-gray-200 text-sm leading-relaxed whitespace-pre-line">{{ $event->description ?? 'No description provided.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 sm:p-8">
                    <h4 class="text-lg font-bold text-white mb-4">Approval Checklist</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="h-2.5 w-2.5 rounded-full bg-green-400"></span>
                            Title is complete and clear
                        </div>
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="h-2.5 w-2.5 rounded-full bg-green-400"></span>
                            Date, time, and venue are valid
                        </div>
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="h-2.5 w-2.5 rounded-full bg-yellow-400"></span>
                            Ticket setup reviewed
                        </div>
                        <div class="flex items-center gap-2 text-gray-300">
                            <span class="h-2.5 w-2.5 rounded-full bg-yellow-400"></span>
                            Description complies with content policy
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="rounded-xl border border-red-400/20 bg-red-500/10 p-4">
                            <h5 class="text-red-300 font-semibold mb-2">Reject Event</h5>
                            <textarea id="rejectionReason" rows="4"
                                class="w-full rounded-lg border border-white/10 bg-[#0c1222]/80 text-gray-200 text-sm p-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                                placeholder="Add a reason for rejection..."></textarea>
                            <button type="button" id="rejectEventBtn"
                                class="mt-3 w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-200 rounded-lg font-semibold transition-all">
                                Reject Event
                            </button>
                        </div>

                        <div class="rounded-xl border border-green-400/20 bg-green-500/10 p-4">
                            <h5 class="text-green-300 font-semibold mb-2">Approve Event</h5>
                            <p class="text-sm text-gray-300 mb-3">Approving will mark this event as publish-ready.</p>
                            <button type="button" id="approveEventBtn"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-green-500/20 hover:bg-green-500/30 text-green-200 rounded-lg font-semibold transition-all">
                                Approve Event
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const approveBtn = document.getElementById('approveEventBtn');
            const rejectBtn = document.getElementById('rejectEventBtn');

            if (approveBtn) {
                approveBtn.addEventListener('click', function() {
                    // Hook this button to your actual approval endpoint.
                    alert('Approval action is ready. Connect this button to your approval route.');
                });
            }

            if (rejectBtn) {
                rejectBtn.addEventListener('click', function() {
                    const reason = document.getElementById('rejectionReason')?.value?.trim();
                    if (!reason) {
                        alert('Please provide a rejection reason first.');
                        return;
                    }

                    // Hook this button to your actual rejection endpoint.
                    alert('Rejection action is ready. Connect this button to your rejection route.');
                });
            }
        });
    </script>
@endsection
