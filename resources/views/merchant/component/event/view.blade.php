<!-- View Event Modal -->
<div id="viewEventModal" class="modal">
    <div
        class="modal-content w-full max-w-3xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl overflow-hidden">
        <div class="relative h-64 bg-gradient-to-br from-blue-600/20 to-purple-600/20">
            <div id="viewEventImage" class="absolute inset-0 bg-cover bg-center opacity-40"></div>
            <button onclick="closeViewModal()"
                class="absolute top-4 right-4 p-2 bg-black/50 hover:bg-black/70 backdrop-blur-sm rounded-lg transition-all">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div class="absolute bottom-4 left-6">
                <span id="viewEventStatus"
                    class="px-3 py-1 bg-green-500/20 backdrop-blur-sm border border-green-500/30 rounded-full text-xs font-semibold text-green-400">Active</span>
            </div>
        </div>

        <div class="p-6">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <h3 id="viewEventName" class="text-3xl font-bold text-white mb-2">Event Name</h3>
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        <span id="viewEventCategory" class="text-sm">Category</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Starting from</p>
                    <p id="viewEventPrice" class="text-3xl font-bold text-white">$45</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Date & Time</p>
                            <p id="viewEventDateTime" class="text-white font-semibold">August 15, 2024 • 8:00 PM</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-xl p-4">
                    <div class="flex items-center gap-3 mb-2">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Location</p>
                            <p id="viewEventLocation" class="text-white font-semibold">Event Location</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h4 class="text-lg font-semibold text-white mb-2">Description</h4>
                <p id="viewEventDescription" class="text-gray-400 leading-relaxed">Event description goes here</p>
            </div>

            <div class="mb-6">
                <div class="flex justify-between items-center mb-3">
                    <h4 class="text-lg font-semibold text-white">Ticket Sales</h4>
                    <span id="viewEventPercentage" class="text-blue-400 font-semibold">68%</span>
                </div>
                <div class="w-full h-3 bg-gray-700 rounded-full overflow-hidden mb-2">
                    <div id="viewEventProgress" class="h-full bg-gradient-to-r from-blue-600 to-blue-400 transition-all"
                        style="width: 68%"></div>
                </div>
                <div class="flex justify-between text-sm text-gray-400">
                    <span id="viewEventSold">342 sold</span>
                    <span id="viewEventTotal">of 500 tickets</span>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-white/10">
                <button onclick="openEditModalFromView()"
                    class="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Event
                </button>
                <button onclick="closeViewModal()"
                    class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Add/Edit Event Modal -->
<div id="eventModal" class="modal">
    <div
        class="modal-content w-full max-w-2xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 id="modalTitle" class="text-2xl font-bold text-white">Add New Event</h3>
            <button onclick="closeModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <form id="eventForm" action="#" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="eventId" name="id">
            <input type="hidden" id="formMethod" name="_method" value="">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Event Name</label>
                    <input type="text" id="eventName" name="name"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select id="eventCategory" name="category"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                        <option value="Music">Music</option>
                        <option value="Sports">Sports</option>
                        <option value="Arts">Arts</option>
                        <option value="Festival">Festival</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea id="eventDescription" name="description" rows="3"
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                    <input type="date" id="eventDate" name="date"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Time</label>
                    <input type="time" id="eventTime" name="time"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                <input type="text" id="eventLocation" name="location"
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Total Tickets</label>
                    <input type="number" id="eventTotalTickets" name="total_tickets"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Price ($)</label>
                    <input type="number" id="eventPrice" name="price" step="0.01"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Event Image</label>
                <input type="file" id="eventImage" name="image"
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                <p class="text-xs text-gray-400 mt-1" id="currentImageText" style="display: none;">Current image will be
                    kept if no new image is selected</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                <select id="eventStatus" name="status"
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    <option value="active">Active</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" id="submitBtn"
                    class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                    Create Event
                </button>
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
