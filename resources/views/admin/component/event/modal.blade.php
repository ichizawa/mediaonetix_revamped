<!-- Combined Add/Edit Event Modal -->
<div id="eventModal" class="modal">
    <div class="modal-content w-full max-w-2xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 id="modalTitle" class="text-2xl font-bold text-white">Add New Event</h3>
            <button onclick="closeModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="eventForm" action="#" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            <!-- Hidden field for edit mode -->
            <input type="hidden" id="eventId" name="id" value="">
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Event Name</label>
                    <input type="text" id="eventName" name="name" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select id="eventCategory" name="category" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                        <option value="Music">Music</option>
                        <option value="Sports">Sports</option>
                        <option value="Arts">Arts</option>
                        <option value="Festival">Festival</option>
                        <option value="Conference">Conference</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Networking">Networking</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea id="eventDescription" name="description" rows="3" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                    <input type="date" id="eventDate" name="date" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Time</label>
                    <input type="time" id="eventTime" name="time" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                <input type="text" id="eventLocation" name="location" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Total Tickets</label>
                    <input type="number" id="eventTotalTickets" name="total_tickets" min="1" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Price ($)</label>
                    <input type="number" id="eventPrice" name="price" step="0.01" min="0" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Event Image</label>
                <div class="relative">
                    <input type="file" id="eventImage" name="image" accept="image/*" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
                </div>
                <p id="currentImageInfo" class="text-xs text-gray-400 mt-2 hidden">
                    <span id="currentImageName" class="text-green-400"></span>
                    <span id="currentImageText">(Current image will be kept if no new image is selected)</span>
                </p>
                <div id="imagePreview" class="mt-2 hidden">
                    <img id="previewImage" class="w-32 h-32 object-cover rounded-lg border border-white/10" src="" alt="Image preview">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                <select id="eventStatus" name="status" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    <option value="upcoming">Upcoming</option>
                    <option value="active">Active</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" id="submitBtn" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                    Create Event
                </button>
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
