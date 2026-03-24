<!-- Combined Add/Edit Event Modal -->
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
        <form id="eventForm" action="{{ route('admin.events.store') }}" method="POST" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            <!-- Hidden field for edit mode -->
            <input type="hidden" id="eventId" name="id" value="">
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <input type="hidden" id="approvedAt" name="approved_at" value="">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Event Name</label>
                    <input type="text" id="eventName" name="name" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <select id="eventCategory" name="category" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled>
                        <option value="Music" class="text-black">Music</option>
                        <option value="Sports" class="text-black">Sports</option>
                        <option value="Arts" class="text-black">Arts</option>
                        <option value="Festival" class="text-black">Festival</option>
                        <option value="Conference" class="text-black">Conference</option>
                        <option value="Workshop" class="text-black">Workshop</option>
                        <option value="Networking" class="text-black">Networking</option>
                        <option value="Other" class="text-black">Other</option>
                        
                    </select >
                </div>
            </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea id="eventDescription" name="description" rows="3" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled></textarea>
                </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                    <input type="date" id="eventDate" name="date" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Time</label>
                    <input type="time" id="eventTime" name="time" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                <input type="text" id="eventLocation" name="location" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled>
            </div>
            <!-- <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Total Tickets</label>
                    <input type="number" id="eventTotalTickets" name="total_tickets" min="1" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" disabled>
                </div>
            </div> -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Event Image</label>
                <div class="relative">
                    <input type="file" id="eventImage" name="image" accept="image/*" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500" disabled>
                </div>
                <p id="currentImageInfo" class="text-xs text-gray-400 mt-2 hidden">
                    <span id="currentImageName" class="text-green-400"></span>
                    <span id="currentImageText">(Current image will be kept if no new image is selected)</span>
                </p>
                <div id="imagePreview" class="mt-2 hidden">
                    <img id="previewImage" class="w-32 h-32 object-cover rounded-lg border border-white/10" src=""
                        alt="Image preview">
                </div>
            </div>
            <div class="relative">
                <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                <input type="hidden" id="eventStatus" name="status" value="0">
                <div id="customStatusSelect" class="w-full px-4 py-2 bg-dark border border-white/10 rounded-lg text-white flex items-center justify-between opacity-60 cursor-not-allowed select-none" tabindex="-1">
                    <span id="selectedStatusLabel" class="font-medium" style="color:#c084fc">Upcoming</span>
                    <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </div>
                <div id="statusDropdown" class="custom-select-dropdown hidden border border-white/10 rounded-lg overflow-hidden shadow-xl pointer-events-none" style="position:absolute; bottom:100%; margin-bottom:4px; width:100%; z-index:999; background-color:#1a2332;">
                    <div class="custom-select-option px-4 py-2 font-medium" data-value="0" style="color:#c084fc">Upcoming</div>
                    <div class="custom-select-option px-4 py-2 font-medium flex items-center gap-2" data-value="1" style="color:#4ade80">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color:#4ade80"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2" style="background-color:#4ade80"></span>
                        </span>
                        Active
                    </div>
                    <div class="custom-select-option px-4 py-2 font-medium" data-value="2" style="color:#60a5fa">Ongoing</div>
                    <div class="custom-select-option px-4 py-2 font-medium" data-value="3" style="color:#9ca3af">Completed</div>
                    <div class="custom-select-option px-4 py-2 font-medium" data-value="4" style="color:#f87171">Cancelled</div>
                </div>
            </div>
         
        
        </form>

            <div class="flex gap-3 pt-8">
                <form id="approveEventForm" method="POST" action="" class="flex-1">
                    @csrf
                    <button type="submit" id="approveBtn" class="w-full px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                        Approve Event
                    </button>
                </form>
            
            
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Cancel
                </button>
            </div>
    </div>
</div>