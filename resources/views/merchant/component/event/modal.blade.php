<div id="eventModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/70 backdrop-blur-sm p-4">

    <div
        class="modal-content w-full max-w-4xl bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-5 sm:p-6 shadow-2xl relative max-h-[90vh] overflow-y-auto [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full">
        <div class="flex items-center justify-between mb-4">
            <h3 id="modalTitle" class="text-2xl font-bold text-white">Add New Event</h3>
            <button onclick="closeModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <form id="eventForm" action="{{ route('merchant.events.store') }}" method="POST" class="space-y-3"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="eventId" name="id" value="">
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 space-y-3">
                    <div class="relative rounded-2xl border border-white/10 bg-white/5 p-3"
                        style="z-index: 30; overflow: visible;">
                        <div class="relative rounded-xl overflow-hidden group"
                            style="height: 280px; border: 1px solid rgba(199,199,199,0.7); background: #e5e5e5; isolation: isolate;">
                            <div id="eventImagePlaceholder"
                                class="absolute inset-0 flex items-center justify-center w-full p-4 sm:p-5"
                                style="z-index: 12;">
                                <label id="eventDropZone" for="eventImage"
                                    class="flex flex-col items-center justify-center w-full h-full border border-dashed border-[#9ca3af] rounded-2xl cursor-pointer hover:bg-[#d8dce2] transition-colors transition-opacity duration-200 text-[#1f2937]"
                                    style="min-height: 100%;">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                                        <svg class="w-8 h-8 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-[#1f2937]"><span class="font-semibold">Click to
                                                upload Event Image</span></p>
                                        <p class="text-xs text-[#374151]">or drag and drop</p>
                                    </div>
                                </label>
                            </div>

                            <input id="eventImage" type="file" name="image" accept="image/*" class="hidden" />

                            <div id="eventPreviewContainer" class="hidden absolute inset-0 w-full h-full z-20">
                                <img id="previewImage" class="h-full w-full object-cover" src="" alt="Image preview">
                                <div id="removeEventImageBtn"
                                    class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer duration-200"
                                    style="background-color: rgba(93, 87, 87, 0.36);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 drop-shadow-sm"
                                        viewBox="0 0 448 512">
                                        <path fill="#dc2626"
                                            d="M136.7 5.9C141.1-7.2 153.3-16 167.1-16l113.9 0c13.8 0 26 8.8 30.4 21.9L320 32 416 32c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 8.7-26.1zM32 144l384 0 0 304c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-304zm88 64c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24z" />
                                    </svg>
                                    <span class="font-bold text-lg" style="color: #ffffff;">Remove Photo</span>
                                </div>
                            </div>
                        </div>

                        <div class="absolute flex gap-2"
                            style="pointer-events:auto; right:26px; bottom:26px; top:auto; left:auto; z-index: 100;">

                            <input type="hidden" id="eventCategory" name="category" value="Music">
                            <div class="custom-select-wrapper flex-none w-[160px] min-w-[160px]"
                                data-target="eventCategory" style="position:relative">
                                <button type="button"
                                    class="custom-select-btn w-full px-4 py-2 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/20 rounded-full text-white text-sm flex justify-between items-center focus:outline-none focus:border-blue-500 shadow-md">
                                    <span class="custom-select-label flex-1 text-left truncate mr-2"
                                        data-default-text="Select Category">Category</span>
                                    <svg class="w-4 h-4 flex-none text-gray-300 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="custom-select-dropdown hidden border border-white/10 rounded-lg overflow-y-auto overflow-x-hidden shadow-2xl max-h-32 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full"
                                    style="position:absolute; top:100%; margin-top:6px; width:100%; z-index:1100; background-color:#1a2332;">
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Music">Music</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Sports">Sports</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Arts">Arts</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Festival">Festival</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Conference">Conference</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Workshop">Workshop</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Networking">Networking</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm text-white hover:bg-blue-600/50 cursor-pointer transition-colors"
                                        data-value="Other">Other</div>
                                </div>
                            </div>

                            <input type="hidden" id="eventStatus" name="status" value="0">
                            <div class="custom-select-wrapper w-[140px] shrink-0" data-target="eventStatus"
                                style="position:relative">
                                <button type="button"
                                    class="custom-select-btn w-full px-4 py-2 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/20 rounded-full text-white text-left text-sm flex justify-between items-center focus:outline-none focus:border-blue-500 shadow-md">
                                    <span class="custom-select-label truncate mr-2"
                                        data-default-text="Status">Status</span>
                                    <svg class="w-4 h-4 shrink-0 text-gray-300 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="custom-select-dropdown hidden border border-white/10 rounded-lg overflow-y-auto overflow-x-hidden shadow-2xl max-h-32 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full"
                                    style="position:absolute; top:100%; margin-top:6px; width:100%; z-index:1100; background-color:#1a2332;">
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors"
                                        data-value="0" style="color:#c084fc">Upcoming</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium flex items-center gap-2 transition-colors"
                                        data-value="1" style="color:#4ade80">
                                        <span class="relative flex h-2 w-2 shrink-0">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75"
                                                style="background-color:#4ade80"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2"
                                                style="background-color:#4ade80"></span>
                                        </span>
                                        <span class="truncate">Active</span>
                                    </div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors"
                                        data-value="2" style="color:#60a5fa">Ongoing</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors"
                                        data-value="3" style="color:#9ca3af">Completed</div>
                                    <div class="custom-select-option px-3 py-1.5 text-sm hover:bg-white/10 cursor-pointer font-medium transition-colors"
                                        data-value="4" style="color:#f87171">Cancelled</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                        <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Event
                            Name</label>
                        <input type="text" id="eventName" name="name"
                            class="mt-2 w-full px-0 py-1.5 bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0"
                            placeholder="Write event name..." required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <label class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Date
                                &amp; Time</label>
                            <div class="mt-2 grid grid-cols-2 gap-2">
                                <input type="date" id="eventDate" name="date"
                                    class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0"
                                    required style="color-scheme: dark;">
                                <input type="time" id="eventTime" name="time"
                                    class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0"
                                    required style="color-scheme: dark;">
                            </div>
                        </div>

                        <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                            <label
                                class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Location</label>
                            <input type="text" id="eventLocation" name="location"
                                class="mt-2 w-full px-0 py-1.5 bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0"
                                placeholder="Write location..." required>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 flex flex-col h-full">
                    <!-- Description field with expand button -->
                    <div class="rounded-xl border border-white/10 bg-white/5 p-3 h-[120px] sm:h-[140px]">
                        <div class="flex items-center justify-between mb-2">
                            <label
                                class="inline-flex px-2.5 py-1 text-xs rounded-lg bg-white/10 text-gray-300">Description</label>
                            <button type="button" onclick="openDescriptionExpand()" title="Expand editor"
                                class="p-1.5 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all group">
                                <svg class="w-4 h-4 transition-transform group-hover:scale-110" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 8V6a2 2 0 012-2h2M4 16v2a2 2 0 002 2h2m8-16h2a2 2 0 012 2v2m0 8v2a2 2 0 01-2 2h-2" />
                                </svg>
                            </button>
                        </div>
                        <textarea id="eventDescription" name="description" rows="4"
                            class="h-[60px] sm:h-[76px] w-full resize-none bg-transparent border-0 text-white placeholder-gray-500 focus:outline-none focus:ring-0 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-gray-500/50 [&::-webkit-scrollbar-thumb]:rounded-full text-sm"
                            placeholder="Write event details..."></textarea>
                    </div>

                    <div class="flex items-center justify-center w-full mb-8">
                        <div class="relative w-full h-64">
                            <label for="seatPlanImage"
                                class="flex flex-col items-center justify-center w-full h-full bg-white/5 border border-dashed border-white/20 rounded-xl cursor-pointer hover:bg-white/10 transition-colors overflow-hidden">
                                <div id="seatPlanPlaceholder"
                                    class="flex flex-col items-center justify-center pt-5 pb-6 transition-opacity duration-200">
                                    <svg class="w-8 h-8 mb-4 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h3a3 3 0 0 0 0-6h-.025a5.56 5.56 0 0 0 .025-.5A5.5 5.5 0 0 0 7.207 9.021C7.137 9.017 7.071 9 7 9a4 4 0 1 0 0 8h2.167M12 19v-9m0 0-2 2m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-center text-gray-300"><span
                                            class="font-semibold text-white">Click to upload Seat Plan</span></p>
                                    <p class="text-sm text-center text-gray-400">or drag and drop</p>
                                </div>
                                <input id="seatPlanImage" name="seat_plan" type="file" class="hidden"
                                    accept="image/*" />
                            </label>

                            <div id="seatPlanPreviewContainer"
                                class="hidden absolute inset-0 w-full h-full rounded-xl overflow-hidden group">
                                <img id="seatPlanPreview" class="w-full h-full object-contain bg-black/50 p-2" src=""
                                    alt="Seat Plan Preview">
                                <div id="removeSeatPlanBtn"
                                    class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer duration-200"
                                    style="background-color: rgba(93, 87, 87, 0.36);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 drop-shadow-sm"
                                        viewBox="0 0 448 512">
                                        <path fill="#dc2626"
                                            d="M136.7 5.9C141.1-7.2 153.3-16 167.1-16l113.9 0c13.8 0 26 8.8 30.4 21.9L320 32 416 32c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 8.7-26.1zM32 144l384 0 0 304c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-304zm88 64c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24z" />
                                    </svg>
                                    <span class="font-bold text-lg" style="color: #ffffff;">Remove Photo</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn"
                        class="mt-auto w-full px-4 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-blue-500/25">
                        Create Event
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Description Expand Overlay -->
<div id="descriptionExpandOverlay" class="hidden fixed inset-0 items-center justify-center p-4"
    style="z-index: 9999; background: rgba(0,0,0,0.75); backdrop-filter: blur(12px);">
    <div id="descriptionExpandPanel"
        class="w-full max-w-2xl bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl shadow-2xl overflow-hidden flex flex-col"
        style="max-height: calc(100vh - 2rem);">

        <!-- Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/10 shrink-0">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 bg-blue-600/20 border border-blue-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h10" />
                    </svg>
                </div>
                <span class="text-white font-semibold">Event Description</span>
            </div>
            <div class="flex items-center gap-2">
                <span id="descCharCount" class="text-xs text-gray-500">0 characters</span>
                <button type="button" onclick="closeDescriptionExpand()"
                    class="p-1.5 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-all"
                    title="Collapse">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 9L4 4m0 0h5m-5 0v5M15 9l5-5m0 0h-5m5 0v5M9 15l-5 5m0 0h5m-5 0v-5M15 15l5 5m0 0h-5m5 0v-5" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Formatting Toolbar -->
        <div class="flex items-center gap-1 px-4 py-2 border-b border-white/10 bg-white/[0.02] flex-wrap shrink-0">
            <button type="button" onmousedown="event.preventDefault(); applyFormat('undo')" title="Undo (Ctrl+Z)"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 0 1 8 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
            </button>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('redo')" title="Redo (Ctrl+Y/Ctrl+Shift+Z)"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10h-10a8 8 0 0 0 -8 8v2M21 10l-6 6m6-6l-6-6" />
                </svg>
            </button>
            <div class="w-px h-5 bg-white/10 mx-1"></div>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('bold')" title="Bold (Ctrl+B)"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z" />
                    <path d="M6 12h9a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z" />
                </svg>
            </button>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('italic')" title="Italic (Ctrl+I)"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 4h4l-4 16H6z" />
                    <path d="M14 4h4M6 20h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('underline')"
                title="Underline (Ctrl+U)"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 4v6a6 6 0 0 0 12 0V4M4 20h16" />
                </svg>
            </button>
            <div class="w-px h-5 bg-white/10 mx-1"></div>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('insertUnorderedList')"
                title="Bullet List"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                </svg>
            </button>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('insertOrderedList')"
                title="Numbered List"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6h11M10 12h11M10 18h11" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h1v4M4 10h2M4 14l2-2a1 1 0 0 1 0 2H4a1 1 0 0 1 0 2h2" />
                </svg>
            </button>
            <div class="w-px h-5 bg-white/10 mx-1"></div>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('h1')" title="Heading 1"
                class="fmt-btn px-2 py-1.5 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all text-xs font-bold">
                H1
            </button>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('h2')" title="Heading 2"
                class="fmt-btn px-2 py-1.5 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all text-xs font-semibold">
                H2
            </button>
            <div class="w-px h-5 bg-white/10 mx-1"></div>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('blockquote')" title="Blockquote"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z" />
                    <path
                        d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z" />
                </svg>
            </button>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('divider')" title="Divider"
                class="fmt-btn p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
                </svg>
            </button>
            <div class="w-px h-5 bg-white/10 mx-1"></div>
            <button type="button" onmousedown="event.preventDefault(); applyFormat('removeFormat')"
                title="Clear formatting"
                class="fmt-btn p-2 rounded-lg hover:bg-red-500/10 text-gray-400 hover:text-red-400 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- WYSIWYG Editor -->
        <div class="flex-1 overflow-y-auto px-4 py-3 min-h-0
                    [&::-webkit-scrollbar]:w-1.5
                    [&::-webkit-scrollbar-track]:bg-transparent
                    [&::-webkit-scrollbar-thumb]:bg-transparent
                    [&::-webkit-scrollbar-thumb]:rounded-full
                    hover:[&::-webkit-scrollbar-thumb]:bg-gray-500/50">
            <div id="descriptionWysiwyg" contenteditable="true" spellcheck="true"
                class="wysiwyg-editor outline-none text-sm text-gray-200 leading-relaxed min-h-[300px] w-full"
                data-placeholder="Write a detailed event description...">
            </div>
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between gap-3 px-5 py-4 border-t border-white/10 shrink-0">
            <span class="text-xs text-gray-600">Ctrl+B / Ctrl+I / Ctrl+U for quick formatting</span>
            <div class="flex gap-3">
                <button type="button" onclick="closeDescriptionExpand()"
                    class="px-4 py-2 bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white rounded-lg text-sm font-medium transition-all">
                    Cancel
                </button>
                <button type="button" onclick="applyDescriptionExpand()"
                    class="px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg text-sm font-semibold transition-all shadow-lg shadow-blue-500/20">
                    Apply
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes descBackdropIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes descBackdropOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    @keyframes descPanelIn {
        from {
            opacity: 0;
            transform: scale(0.92) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes descPanelOut {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        to {
            opacity: 0;
            transform: scale(0.92) translateY(20px);
        }
    }

    #descriptionExpandOverlay.desc-opening {
        animation: descBackdropIn 0.22s ease forwards;
    }

    #descriptionExpandOverlay.desc-closing {
        animation: descBackdropOut 0.22s ease forwards;
    }

    #descriptionExpandOverlay.desc-opening #descriptionExpandPanel {
        animation: descPanelIn 0.28s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
    }

    #descriptionExpandOverlay.desc-closing #descriptionExpandPanel {
        animation: descPanelOut 0.2s ease forwards;
    }

    .fmt-btn:active {
        transform: scale(0.9);
    }

    /* Placeholder */
    .wysiwyg-editor:empty:before {
        content: attr(data-placeholder);
        color: #6b7280;
        pointer-events: none;
        display: block;
    }

    /* WYSIWYG rendered styles */
    .wysiwyg-editor h1 {
        font-size: 1.4em;
        font-weight: 700;
        color: #ffffff;
        margin: 0.6em 0 0.3em;
    }

    .wysiwyg-editor h2 {
        font-size: 1.1em;
        font-weight: 600;
        color: #e2e8f0;
        margin: 0.5em 0 0.2em;
    }

    .wysiwyg-editor strong,
    .wysiwyg-editor b {
        font-weight: 700;
        color: #ffffff;
    }

    .wysiwyg-editor em,
    .wysiwyg-editor i {
        font-style: italic;
        color: #cbd5e1;
    }

    .wysiwyg-editor u {
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    .wysiwyg-editor ul {
        list-style: disc;
        padding-left: 1.4em;
        margin: 0.3em 0;
    }

    .wysiwyg-editor ol {
        list-style: decimal;
        padding-left: 1.4em;
        margin: 0.3em 0;
    }

    .wysiwyg-editor li {
        margin: 0.15em 0;
    }

    .wysiwyg-editor blockquote {
        border-left: 3px solid #3b82f6;
        padding-left: 0.8em;
        color: #94a3b8;
        margin: 0.5em 0;
        font-style: italic;
    }

    .wysiwyg-editor hr {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0.8em 0;
    }

    .wysiwyg-editor p {
        margin: 0.2em 0;
    }
</style>

<script>
    function applyFormat(command) {
        const editor = document.getElementById('descriptionWysiwyg');
        editor.focus();

        if (command === 'h1' || command === 'h2') {
            document.execCommand('formatBlock', false, command);
        } else if (command === 'blockquote') {
            document.execCommand('formatBlock', false, 'blockquote');
        } else if (command === 'divider') {
            document.execCommand('insertHTML', false, '<hr><p><br></p>');
        } else {
            document.execCommand(command, false, null);
        }

        syncWysiwygToTextarea();
        updateDescCharCount(editor.innerText);
    }

    function syncWysiwygToTextarea() {
        const editor = document.getElementById('descriptionWysiwyg');
        document.getElementById('eventDescription').value = editor.innerHTML;
    }

    function openDescriptionExpand() {
        const main = document.getElementById('eventDescription');
        const editor = document.getElementById('descriptionWysiwyg');
        const overlay = document.getElementById('descriptionExpandOverlay');

        const existing = main.value.trim();
        if (existing) {
            // If HTML tags present, use as-is; otherwise wrap plain lines in <p>
            if (/<[a-z][\s\S]*>/i.test(existing)) {
                editor.innerHTML = existing;
            } else {
                editor.innerHTML = existing
                    .split('\n')
                    .map(line => line.trim() ? `<p>${line}</p>` : '<p><br></p>')
                    .join('');
            }
        } else {
            editor.innerHTML = '';
        }

        updateDescCharCount(editor.innerText);

        overlay.classList.remove('hidden', 'desc-closing');
        overlay.classList.add('flex', 'desc-opening');
        overlay.addEventListener('animationend', () => overlay.classList.remove('desc-opening'), { once: true });

        setTimeout(() => {
            editor.focus();
            const range = document.createRange();
            const sel = window.getSelection();
            range.selectNodeContents(editor);
            range.collapse(false);
            sel.removeAllRanges();
            sel.addRange(range);
        }, 50);
    }

    function closeDescriptionExpand() {
        const overlay = document.getElementById('descriptionExpandOverlay');
        overlay.classList.remove('desc-opening');
        overlay.classList.add('desc-closing');
        overlay.addEventListener('animationend', () => {
            overlay.classList.remove('flex', 'desc-closing');
            overlay.classList.add('hidden');
        }, { once: true });
    }

    function applyDescriptionExpand() {
        syncWysiwygToTextarea();
        closeDescriptionExpand();
    }

    function updateDescCharCount(text) {
        const len = (text || '').replace(/\s/g, '').length;
        document.querySelectorAll('#descCharCount').forEach(el => {
            el.textContent = `${len} character${len !== 1 ? 's' : ''}`;
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const editor = document.getElementById('descriptionWysiwyg');
        if (editor) {
            editor.addEventListener('input', function () {
                syncWysiwygToTextarea();
                updateDescCharCount(this.innerText);
            });

            editor.addEventListener('keydown', function (e) {
                if (e.ctrlKey || e.metaKey) {
                    if (e.key.toLowerCase() === 'z') { e.preventDefault(); e.shiftKey ? applyFormat('redo') : applyFormat('undo'); }
                    if (e.key.toLowerCase() === 'y') { e.preventDefault(); applyFormat('redo'); }
                    if (e.key.toLowerCase() === 'b') { e.preventDefault(); applyFormat('bold'); }
                    if (e.key.toLowerCase() === 'i') { e.preventDefault(); applyFormat('italic'); }
                    if (e.key.toLowerCase() === 'u') { e.preventDefault(); applyFormat('underline'); }
                }
            });
        }

        const overlay = document.getElementById('descriptionExpandOverlay');
        if (overlay) {
            overlay.addEventListener('click', e => { if (e.target === overlay) closeDescriptionExpand(); });
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                const overlay = document.getElementById('descriptionExpandOverlay');
                if (overlay && !overlay.classList.contains('hidden')) closeDescriptionExpand();
            }
        });
    });
    // ── Seat Plan Image Preview ──────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {

        // ── Event Image ──────────────────────────────────────────────────────
        const eventImageInput = document.getElementById('eventImage');
        const previewImage = document.getElementById('previewImage');
        const eventPreviewContainer = document.getElementById('eventPreviewContainer');
        const eventImagePlaceholder = document.getElementById('eventImagePlaceholder');
        const removeEventImageBtn = document.getElementById('removeEventImageBtn');

        eventImageInput?.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            
            if (file.size > 15 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'The event image must not exceed 15MB.',
                    background: '#1a2332',
                    color: '#fff'
                });
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                previewImage.src = e.target.result;
                eventPreviewContainer.classList.remove('hidden');
                eventImagePlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });

        removeEventImageBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            previewImage.src = '';
            eventImageInput.value = '';
            eventPreviewContainer.classList.add('hidden');
            eventImagePlaceholder.classList.remove('hidden');
        });

        // ── Drag & Drop for Event Image ───────────────────────────────────────
        const eventDropZone = document.getElementById('eventDropZone');
        eventDropZone?.addEventListener('dragover', e => { e.preventDefault(); eventDropZone.classList.add('bg-[#c8cdd4]'); });
        eventDropZone?.addEventListener('dragleave', () => eventDropZone.classList.remove('bg-[#c8cdd4]'));
        eventDropZone?.addEventListener('drop', function (e) {
            e.preventDefault();
            eventDropZone.classList.remove('bg-[#c8cdd4]');
            const file = e.dataTransfer.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            eventImageInput.files = dt.files;
            eventImageInput.dispatchEvent(new Event('change'));
        });

        // ── Seat Plan Image ───────────────────────────────────────────────────
        const seatPlanInput = document.getElementById('seatPlanImage');
        const seatPlanPreview = document.getElementById('seatPlanPreview');
        const seatPlanPreviewContainer = document.getElementById('seatPlanPreviewContainer');
        const seatPlanPlaceholder = document.getElementById('seatPlanPlaceholder');
        const removeSeatPlanBtn = document.getElementById('removeSeatPlanBtn');
        const seatPlanLabel = seatPlanInput?.closest('label');

        seatPlanInput?.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (file.size > 15 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'The seat plan image must not exceed 15MB.',
                    background: '#1a2332',
                    color: '#fff'
                });
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                seatPlanPreview.src = e.target.result;
                seatPlanPreviewContainer.classList.remove('hidden');
                seatPlanPlaceholder.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });

        removeSeatPlanBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();          // prevent re-opening the file dialog
            seatPlanPreview.src = '';
            seatPlanInput.value = '';
            seatPlanPreviewContainer.classList.add('hidden');
            seatPlanPlaceholder.classList.remove('hidden');
        });

        // ── Drag & Drop for Seat Plan ─────────────────────────────────────────
        const seatDropTarget = document.querySelector('label[for="seatPlanImage"]');
        seatDropTarget?.addEventListener('dragover', e => { e.preventDefault(); seatDropTarget.classList.add('bg-white/20'); });
        seatDropTarget?.addEventListener('dragleave', () => seatDropTarget.classList.remove('bg-white/20'));
        seatDropTarget?.addEventListener('drop', function (e) {
            e.preventDefault();
            seatDropTarget.classList.remove('bg-white/20');
            const file = e.dataTransfer.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            seatPlanInput.files = dt.files;
            seatPlanInput.dispatchEvent(new Event('change'));
        });
    });
</script>