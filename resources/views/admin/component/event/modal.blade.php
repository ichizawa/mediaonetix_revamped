<!-- Combined Add/Edit Event Modal -->
<div id="eventModal" class="modal">
    <div
        class="modal-content w-full max-w-4xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-5 sm:p-6">
        <div class="flex items-center justify-between mb-4 gap-3">
            <h3 id="modalTitle" class="text-xl sm:text-2xl font-bold text-white pr-2">Event Details</h3>
            <button onclick="closeModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <form id="eventForm" action="{{ route('admin.events.store') }}" method="POST" class="space-y-3"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="eventId" name="id" value="">
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <input type="hidden" id="approvedAt" name="approved_at" value="">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 space-y-3">
                    <div class="relative rounded-2xl border border-white/10 bg-white/5 p-3">
                        <div class="relative rounded-xl overflow-hidden group"
                            style="height: clamp(220px, 42vw, 280px); border: 1px solid rgba(199,199,199,0.35); background: #111827; isolation: isolate;">

                            <div id="eventImagePlaceholder"
                                class="absolute inset-0 flex items-center justify-center w-full p-4 sm:p-5 text-gray-400">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                                    <svg class="w-8 h-8 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm">No event image available</p>
                                </div>
                            </div>

                            <input id="eventImage" type="file" name="image" accept="image/*" class="hidden" disabled />

                            <div id="eventPreviewContainer" class="hidden absolute inset-0 w-full h-full z-20 event-card-media">
                                <img id="previewImage" class="w-full h-full object-cover" src="" alt="Image preview">
                            </div>
                        </div>

                        <div class="absolute right-3 bottom-3 sm:right-4 sm:bottom-4 flex items-center justify-end gap-1.5"
                            style="pointer-events:none; z-index:100;">
                            <span id="eventCategoryBadge"
                                class="px-3 py-1.5 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/20 rounded-full text-white text-xs">Category</span>
                            <span id="eventStatusBadge"
                                class="px-3 py-1.5 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/20 rounded-full text-white text-xs">Status</span>
                        </div>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                        <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Event Name</label>
                        <input type="text" id="eventName" name="name"
                            class="mt-2 w-full px-0 py-1.5 bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0"
                            disabled>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Date
                                &amp; Time</label>
                            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <input type="date" id="eventDate" name="date"
                                    class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0"
                                    disabled style="color-scheme:dark;">
                                <input type="time" id="eventTime" name="time"
                                    class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0"
                                    disabled style="color-scheme:dark;">
                            </div>
                        </div>
                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Location</label>
                            <input type="text" id="eventLocation" name="location"
                                class="mt-2 w-full px-0 py-1.5 bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0"
                                disabled>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 flex flex-col h-full">
                    <div class="rounded-xl border border-white/10 bg-white/5 p-3 h-[120px] sm:h-[140px]">
                        <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Description</label>
                        <textarea id="eventDescription" name="description" rows="4"
                            class="h-[60px] sm:h-[76px] w-full resize-none bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0 text-sm"
                            disabled></textarea>
                    </div>

                    <div class="flex items-center justify-center w-full">
                        <div class="relative w-full h-44 sm:h-56">
                            <div
                                class="flex flex-col items-center justify-center w-full h-full bg-white/5 border border-dashed border-white/20 rounded-xl overflow-hidden">
                                <div id="seatPlanPlaceholder"
                                    class="flex flex-col items-center justify-center px-4 text-center text-gray-400">
                                    <svg class="w-8 h-8 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-5l-4 4v-4H5a2 2 0 01-2-2V5z" />
                                    </svg>
                                    <p class="text-sm text-white">No seat plan uploaded</p>
                                </div>
                            </div>

                            <div id="seatPlanPreviewContainer"
                                class="hidden absolute inset-0 w-full h-full rounded-xl overflow-hidden border border-white/10 bg-black/30 cursor-zoom-in"
                                title="Click to view seat plan" onclick="openSeatPlanLightbox()">
                                <img id="seatPlanPreview" class="w-full h-full object-contain p-2" src=""
                                    alt="Seat Plan Preview">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div id="currentImageInfo" class="hidden">
                <span id="currentImageName"></span>
                <span id="currentImageText"></span>
            </div>

            <div id="imagePreview" class="hidden"></div>

            <input type="hidden" id="eventCategory" name="category" value="">
            <input type="hidden" id="eventStatus" name="status" value="0">
            <select id="eventStatusDisplay" class="hidden" disabled>
                <option value="0">Upcoming</option>
                <option value="1">Active</option>
                <option value="2">Ongoing</option>
                <option value="3">Completed</option>
                <option value="4">Cancelled</option>
            </select>

            <button type="button" id="submitBtn" class="hidden" disabled>Create Event</button>


        </form>

        <div class="flex gap-3 pt-6">
            <form id="approveEventForm" method="POST" action="" class="flex-1">
                @csrf
                @if (isset($event) && is_null($event->approved_at))
                    <button type="submit" id="approveBtn"
                        class="w-full h-12 px-4 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-blue-500/25">
                        Approve Event
                    </button>
                @endif
            </form>

            <button type="button" onclick="closeModal()"
                class="w-40 h-12 px-4 bg-white/[0.04] hover:bg-white/10 text-gray-300 hover:text-white rounded-xl font-medium transition-all border border-white/10">
                Close
            </button>
        </div>
    </div>
</div>

<div id="seatPlanLightbox" class="hidden fixed inset-0 items-center justify-center p-3 sm:p-4"
    style="z-index: 99999; background: rgba(0,0,0,0.88); backdrop-filter: blur(16px);">
    <div id="seatPlanLightboxPanel" class="relative w-full flex flex-col items-center" style="max-width: min(94vw, 64rem);">
        <div class="flex items-center justify-between w-full mb-3 px-1">
            <span class="text-white font-semibold text-sm tracking-wide">Seat Plan</span>
            <button onclick="closeSeatPlanLightbox()"
                class="p-1.5 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="rounded-2xl overflow-hidden border border-white/10 shadow-2xl w-full bg-black/40">
            <img id="seatPlanLightboxImg" src="" alt="Seat Plan" class="w-full h-auto max-h-[82vh] object-contain">
        </div>
        <p class="text-gray-500 text-xs mt-3">Click outside or press Esc to close</p>
    </div>
</div>
