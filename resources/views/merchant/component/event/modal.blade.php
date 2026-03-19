<div id="eventModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/70 backdrop-blur-sm p-4">
    
    <div class="modal-content w-full max-w-4xl bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-5 sm:p-6 shadow-2xl relative max-h-[90vh] overflow-y-auto [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full">
        <div class="flex items-center justify-between mb-4">
            <h3 id="modalTitle" class="text-2xl font-bold text-white">Add New Event</h3>
            <button onclick="closeModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="eventForm" action="{{ route('merchant.events.store') }}" method="POST" class="space-y-3" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="eventId" name="id" value="">
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 space-y-3">
                    <div class="relative rounded-2xl border border-white/10 bg-white/5 p-3" style="z-index: 30; overflow: visible;">
                        <div class="relative rounded-xl overflow-hidden group" style="height: 280px; border: 1px solid rgba(199,199,199,0.7); background: #e5e5e5; isolation: isolate;">
                            <div id="eventImagePlaceholder" class="absolute inset-0 flex items-center justify-center w-full p-4 sm:p-5" style="z-index: 12;">
                                <label id="eventDropZone" for="eventImage" class="flex flex-col items-center justify-center w-full h-full border border-dashed border-[#9ca3af] rounded-2xl cursor-pointer hover:bg-[#d8dce2] transition-colors text-[#1f2937]" style="min-height: 100%;">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                                        <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-[#1f2937]"><span class="font-semibold">Click to upload Event Image</span></p>
                                        <p class="text-xs text-[#374151]">  or drag and drop</p>
                                    </div>
                                </label>
                            </div>

                            <input id="eventImage" type="file" name="image" accept="image/*" class="hidden" />
                            
                            <div id="eventPreviewContainer" class="hidden absolute inset-0 w-full h-full z-20">
                                <img id="previewImage" class="h-full w-full object-cover" src="" alt="Image preview">
                                <div id="removeEventImageBtn" class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer duration-200" style="background-color: rgba(93, 87, 87, 0.36);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 drop-shadow-sm" viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path fill="#dc2626" d="M136.7 5.9C141.1-7.2 153.3-16 167.1-16l113.9 0c13.8 0 26 8.8 30.4 21.9L320 32 416 32c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 8.7-26.1zM32 144l384 0 0 304c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-304zm88 64c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24z"/></svg>
                                    <span class="font-bold text-lg" style="color: #ffffff;">Remove Photo</span>
                                </div>
                            </div>
                        </div>

                        <div class="absolute flex gap-2" style="pointer-events:auto; right:26px; bottom:26px; top:auto; left:auto; z-index: 100;">
                            
                        <input type="hidden" id="eventCategory" name="category" value="Music">
                        <div class="custom-select-wrapper flex-none w-[160px] min-w-[160px]" data-target="eventCategory" style="position:relative">
                            <button type="button" class="custom-select-btn w-full px-4 py-2 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/20 rounded-full text-white text-sm flex justify-between items-center focus:outline-none focus:border-blue-500 shadow-md">
                                <span class="custom-select-label flex-1 text-left truncate mr-2" data-default-text="Select Category">Category</span>
                                <svg class="w-4 h-4 flex-none text-gray-300 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                                <div class="custom-select-dropdown hidden border border-white/10 rounded-lg overflow-y-auto overflow-x-hidden shadow-2xl max-h-32 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full" style="position:absolute; top:100%; margin-top:6px; width:100%; z-index:1100; background-color:#1a2332;">        <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Music">Music</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Sports">Sports</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Arts">Arts</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Festival">Festival</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Conference">Conference</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Workshop">Workshop</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Networking">Networking</div>
                                <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors" data-value="Other">Other</div>
                            </div>
                        </div>

                            <input type="hidden" id="eventStatus" name="status" value="0">
                            <div class="custom-select-wrapper w-[140px] shrink-0" data-target="eventStatus" style="position:relative">
                                <button type="button" class="custom-select-btn w-full px-4 py-2 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/20 rounded-full text-white text-left text-sm flex justify-between items-center focus:outline-none focus:border-blue-500 shadow-md">
                                    <span class="custom-select-label truncate mr-2" data-default-text="Status">Status</span>
                                    <svg class="w-4 h-4 shrink-0 text-gray-300 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                    <div class="custom-select-dropdown hidden border border-white/10 rounded-lg overflow-y-auto overflow-x-hidden shadow-2xl max-h-32 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full" style="position:absolute; top:100%; margin-top:6px; width:100%; z-index:1100; background-color:#1a2332;">                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors" data-value="0" style="color:#c084fc">Upcoming</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium flex items-center gap-2 transition-colors" data-value="1" style="color:#4ade80">
                                        <span class="relative flex h-2 w-2 shrink-0">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color:#4ade80"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2" style="background-color:#4ade80"></span>
                                        </span>
                                        <span class="truncate">Active</span>
                                    </div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors" data-value="2" style="color:#60a5fa">Ongoing</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors" data-value="3" style="color:#9ca3af">Completed</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors" data-value="4" style="color:#f87171">Cancelled</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                        <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Event Name</label>
                        <input type="text" id="eventName" name="name" class="mt-2 w-full px-0 py-1.5 bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0" placeholder="Write event name..." required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Date &amp; Time</label>
                            <div class="mt-2 grid grid-cols-2 gap-2">
                                <input type="date" id="eventDate" name="date" class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0" required style="color-scheme: dark;">
                                <input type="time" id="eventTime" name="time" class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0" required style="color-scheme: dark;">
                            </div>
                        </div>

                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Location</label>
                            <input type="text" id="eventLocation" name="location" class="mt-2 w-full px-0 py-1.5 bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0" placeholder="Write location..." required>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 flex flex-col h-full">
                    <div class="h-[120px] sm:h-[140px] rounded-xl border border-white/10 bg-white/5 p-3">
                        <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Description</label>
                        <textarea id="eventDescription" name="description" rows="4" class="mt-2 h-[80px] sm:h-[96px] w-full resize-none bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full" placeholder="Write event details..."></textarea>
                    </div>

                <div class="flex items-center justify-center w-full mb-8">
                    <div class="relative w-full h-64">
                        <label for="seatPlanImage" class="flex flex-col items-center justify-center w-full h-full bg-white/5 border border-dashed border-white/20 rounded-xl cursor-pointer hover:bg-white/10 transition-colors overflow-hidden">
                            <div id="seatPlanPlaceholder" class="flex flex-col items-center justify-center pt-5 pb-6 transition-opacity duration-200">
                                <svg class="w-8 h-8 mb-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2"/></svg>
                                <p class="mb-2 text-sm text-center text-gray-300"><span class="font-semibold text-white">Click to upload Seat Plan </span></p> 
                                <p class="text-sm text-center text-gray-400">or drag and drop</p>                        
                            </div>
                            <input id="seatPlanImage" name="seat_plan" type="file" class="hidden" accept="image/*" />
                        </label>

                        <div id="seatPlanPreviewContainer" class="hidden absolute inset-0 w-full h-full rounded-xl overflow-hidden group">
                            <img id="seatPlanPreview" class="w-full h-full object-contain bg-black/50 p-2" src="" alt="Seat Plan Preview">
                            <div id="removeSeatPlanBtn" class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer duration-200" style="background-color: rgba(93, 87, 87, 0.36);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 drop-shadow-sm" viewBox="0 0 448 512"><path fill="#dc2626" d="M136.7 5.9C141.1-7.2 153.3-16 167.1-16l113.9 0c13.8 0 26 8.8 30.4 21.9L320 32 416 32c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 8.7-26.1zM32 144l384 0 0 304c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-304zm88 64c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24z"/></svg>
                                <span class="font-bold text-lg" style="color: #ffffff;">Remove Photo</span>
                            </div>
                        </div>
                    </div>
                </div> 
                    <button type="submit" id="submitBtn" class="mt-auto w-full px-4 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-blue-500/25">
                        Create Event
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
          
            const btn = e.target.closest('.custom-select-btn');
            if (btn) {
                const wrapper = btn.closest('.custom-select-wrapper');
                const dropdown = wrapper.querySelector('.custom-select-dropdown');
                const icon = btn.querySelector('svg');
                
                
                document.querySelectorAll('.custom-select-dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.add('hidden');
                });
                document.querySelectorAll('.custom-select-btn svg').forEach(i => {
                    if (i !== icon) i.style.transform = 'rotate(0deg)';
                });

                
                dropdown.classList.toggle('hidden');
                if (icon) {
                    icon.style.transform = dropdown.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
                }
                return;
            }

           
            const option = e.target.closest('.custom-select-option');
            if (option) {
                const wrapper = option.closest('.custom-select-wrapper');
                const label = wrapper.querySelector('.custom-select-label');
                const hiddenInputId = wrapper.getAttribute('data-target');
                const hiddenInput = document.getElementById(hiddenInputId);
                const dropdown = wrapper.querySelector('.custom-select-dropdown');
                const icon = wrapper.querySelector('.custom-select-btn svg');

                if (hiddenInput) hiddenInput.value = option.getAttribute('data-value');
                if (label) label.textContent = option.textContent.trim();
                
                if (hiddenInput) hiddenInput.dispatchEvent(new Event('change'));

                dropdown.classList.add('hidden');
                if (icon) icon.style.transform = 'rotate(0deg)';
                return;
            }

            if (!e.target.closest('.custom-select-wrapper')) {
                document.querySelectorAll('.custom-select-dropdown').forEach(d => d.classList.add('hidden'));
                document.querySelectorAll('.custom-select-btn svg').forEach(i => i.style.transform = 'rotate(0deg)');
            }
        });
    });

    const eventImageInput = document.getElementById('eventImage');
    const previewImage = document.getElementById('previewImage');
    const eventDropZone = document.getElementById('eventDropZone');
    const eventPreviewContainer = document.getElementById('eventPreviewContainer');
    const removeEventImageBtn = document.getElementById('removeEventImageBtn');

    if (eventImageInput) {
        eventImageInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    eventPreviewContainer.classList.remove('hidden');
                    eventDropZone.style.opacity = '0'; 
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    if (removeEventImageBtn) {
        removeEventImageBtn.addEventListener('click', function(e) {
             e.preventDefault();
             e.stopPropagation();
             eventImageInput.value = '';
             previewImage.src = '';
             eventPreviewContainer.classList.add('hidden');
             eventDropZone.style.opacity = '1';
        });
    }

    const seatPlanInput = document.getElementById('seatPlanImage');
    const seatPlanPreview = document.getElementById('seatPlanPreview');
    const seatPlanPlaceholder = document.getElementById('seatPlanPlaceholder');
    const seatPlanPreviewContainer = document.getElementById('seatPlanPreviewContainer');
    const removeSeatPlanBtn = document.getElementById('removeSeatPlanBtn');

    if (seatPlanInput) {
        seatPlanInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    seatPlanPreview.src = e.target.result;
                    seatPlanPreviewContainer.classList.remove('hidden');
                    seatPlanPlaceholder.classList.add('opacity-0');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    if (removeSeatPlanBtn) {
        removeSeatPlanBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            seatPlanInput.value = '';
            seatPlanPreview.src = '';
            seatPlanPreviewContainer.classList.add('hidden');
            seatPlanPlaceholder.classList.remove('opacity-0');
        });
    }
</script>