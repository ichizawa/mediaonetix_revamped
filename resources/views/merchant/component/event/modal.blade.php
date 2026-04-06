<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>

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

            <input type="hidden" name="crop_x" id="cropX" value="">
            <input type="hidden" name="crop_y" id="cropY" value="">
            <input type="hidden" name="crop_width" id="cropWidth" value="">
            <input type="hidden" name="crop_height" id="cropHeight" value="">
            <input type="hidden" name="crop_natural_width" id="cropNaturalWidth" value="">
            <input type="hidden" name="crop_natural_height" id="cropNaturalHeight" value="">

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
                                    class="flex flex-col items-center justify-center w-full h-full border border-dashed border-[#9ca3af] rounded-2xl cursor-pointer hover:bg-[#d8dce2] transition-colors duration-200 text-[#1f2937]"
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
                                <img id="previewImage"
                                    style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:50% 50%;transform:scale(1);transform-origin:50% 50%;transition:transform 0.3s ease,object-position 0.3s ease;"
                                    src="" alt="Image preview">

                                <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                                    style="background-color:rgba(93,87,87,0.36);">

                                    <button type="button" id="recropEventImageBtn" onclick="openCropper()"
                                        class="mb-2 flex items-center gap-2 px-4 py-2 rounded-full bg-blue-600/90 hover:bg-blue-500 text-white text-sm font-semibold shadow-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 17V7h10M7 7l10 10" />
                                        </svg>
                                        Edit Image
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="absolute flex gap-2"
                            style="pointer-events:auto; right:26px; bottom:26px; top:auto; left:auto; z-index:100;">

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
                                    style="position:absolute;top:100%;margin-top:6px;width:100%;z-index:1100;background-color:#1a2332;">
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
                                    style="position:absolute;top:100%;margin-top:6px;width:100%;z-index:1100;background-color:#1a2332;">
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
                                    required style="color-scheme:dark;">
                                <input type="time" id="eventTime" name="time"
                                    class="w-full px-0 py-1.5 bg-transparent border-0 text-white focus:outline-none focus:ring-0"
                                    required style="color-scheme:dark;">
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
                            placeholder="Write event details..." required></textarea>
                    </div>

                    <div class="flex items-center justify-center w-full mb-8">
                        <div class="relative w-full h-64">
                            <label for="seatPlanImage"
                                class="flex flex-col items-center justify-center w-full h-full bg-white/5 border border-dashed border-white/20 rounded-xl cursor-pointer hover:bg-white/10 transition-colors overflow-hidden">
                                <div id="seatPlanPlaceholder"
                                    class="flex flex-col items-center justify-center pt-5 pb-6 transition-opacity duration-200">
                                    <svg class="w-8 h-8 mb-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
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
                                    style="background-color:rgba(93,87,87,0.36);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mb-3 drop-shadow-sm"
                                        viewBox="0 0 448 512">
                                        <path fill="#dc2626"
                                            d="M136.7 5.9C141.1-7.2 153.3-16 167.1-16l113.9 0c13.8 0 26 8.8 30.4 21.9L320 32 416 32c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 8.7-26.1zM32 144l384 0 0 304c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-304zm88 64c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24z" />
                                    </svg>
                                    <span class="font-bold text-lg" style="color:#ffffff;">Remove Photo</span>
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


<div id="imageCropperModal" class="hidden fixed inset-0 items-center justify-center p-4"
    style="z-index:99999; background:rgba(0,0,0,0.85); backdrop-filter:blur(16px);">

    <div id="imageCropperPanel"
        class="w-full max-w-2xl bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl shadow-2xl overflow-hidden flex flex-col"
        style="max-height:calc(100vh - 2rem);">

        {{-- Header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/10 shrink-0">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 bg-blue-600/20 border border-blue-500/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 17V7h10M7 7l10 10" />
                    </svg>
                </div>
                <div>
                    <span class="text-white font-semibold block leading-tight">Select Display Region</span>
                    <span class="text-xs text-gray-500">Choose which part of the photo to show · full image is always
                        saved</span>
                </div>
            </div>
            <button type="button" onclick="closeCropper()"
                class="p-1.5 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Toolbar --}}
        <div class="flex items-center gap-1 px-4 py-2.5 border-b border-white/10 bg-white/[0.02] flex-wrap shrink-0">
            <span class="text-xs text-gray-500 mr-1">Ratio</span>
            <button type="button" onclick="setCropAspect(16/9)" id="cropBtn-16-9"
                class="crop-ratio-btn px-2.5 py-1 rounded-lg text-xs font-medium border border-white/10 text-gray-300 hover:bg-white/10 hover:text-white transition-all">16:9</button>
            <button type="button" onclick="setCropAspect(4/3)" id="cropBtn-4-3"
                class="crop-ratio-btn px-2.5 py-1 rounded-lg text-xs font-medium border border-white/10 text-gray-300 hover:bg-white/10 hover:text-white transition-all">4:3</button>
            <button type="button" onclick="setCropAspect(1)" id="cropBtn-1-1"
                class="crop-ratio-btn px-2.5 py-1 rounded-lg text-xs font-medium border border-white/10 text-gray-300 hover:bg-white/10 hover:text-white transition-all">1:1</button>
            <button type="button" onclick="setCropAspect(NaN)" id="cropBtn-free"
                class="crop-ratio-btn px-2.5 py-1 rounded-lg text-xs font-medium border border-white/10 text-gray-300 hover:bg-white/10 hover:text-white transition-all">Free</button>

            <div class="w-px h-5 bg-white/10 mx-1"></div>

            <button type="button" onclick="cropperInstance && cropperInstance.rotate(-90)" title="Rotate left"
                class="p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h10a8 8 0 0 1 8 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
            </button>
            <button type="button" onclick="cropperInstance && cropperInstance.rotate(90)" title="Rotate right"
                class="p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 10h-10a8 8 0 0 0-8 8v2M21 10l-6 6m6-6l-6-6" />
                </svg>
            </button>
            <button type="button"
                onclick="cropperInstance && cropperInstance.scaleX(cropperInstance.getData().scaleX === -1 ? 1 : -1)"
                title="Flip horizontal"
                class="p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4" />
                </svg>
            </button>
            <button type="button"
                onclick="cropperInstance && cropperInstance.scaleY(cropperInstance.getData().scaleY === -1 ? 1 : -1)"
                title="Flip vertical"
                class="p-2 rounded-lg hover:bg-white/10 text-gray-400 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 17H4m0 0l4 4m-4-4l4-4M8 7h12m0 0l-4-4m4 4l-4 4" />
                </svg>
            </button>

            <div class="w-px h-5 bg-white/10 mx-1"></div>

            <button type="button" onclick="cropperInstance && cropperInstance.reset()" title="Reset"
                class="p-2 rounded-lg hover:bg-red-500/10 text-gray-400 hover:text-red-400 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>

        {{-- ✅ Cropper canvas (was missing!) --}}
        <div class="flex-1 overflow-hidden min-h-0 flex items-center justify-center bg-black/40"
            style="max-height:420px;">
            <div style="width:100%;height:100%;max-height:420px;overflow:hidden;position:relative;">
                <img id="cropperImage" src="" alt="Crop preview"
                    style="display:block;max-width:100%;max-height:420px;width:auto;">
            </div>
        </div>

        {{-- Footer --}}
        <div
            class="flex flex-col gap-3 px-5 py-4 border-t border-white/10 shrink-0 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row sm:items-center">
                <button type="button" onclick="document.getElementById('eventImage').click(); closeCropper();"
                    class="cropper-footer-secondary-btn flex w-full items-center justify-center gap-1.5 rounded-lg border border-white/10 bg-white/5 px-3.5 py-2 text-sm font-medium text-gray-300 transition-all hover:bg-white/10 hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Replace
                </button>

                <button type="button" onclick="closeCropper(); clearImageState();"
                    class="cropper-footer-secondary-btn flex w-full items-center justify-center gap-1.5 rounded-lg border border-red-500/20 bg-red-600/10 px-3.5 py-2 text-sm font-medium text-red-400 transition-all hover:bg-red-600/25 hover:text-red-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Delete
                </button>
            </div>

            <div class="flex w-full flex-col gap-3 sm:w-auto sm:flex-row">
                <button type="button" onclick="closeCropper()"
                    class="w-full rounded-lg bg-white/5 px-4 py-2 text-sm font-medium text-gray-300 transition-all hover:bg-white/10 hover:text-white sm:w-auto">
                    Cancel
                </button>
                <button type="button" onclick="applyCrop()"
                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-blue-500 px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-500/20 transition-all hover:from-blue-500 hover:to-blue-400 sm:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Apply
                </button>
            </div>
        </div>

    </div>
</div>

<div id="descriptionExpandOverlay" class="hidden fixed inset-0 items-center justify-center p-4"
    style="z-index:9999; background:rgba(0,0,0,0.75); backdrop-filter:blur(12px);">
    <div id="descriptionExpandPanel"
        class="w-full max-w-4xl bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl shadow-2xl overflow-hidden flex flex-col"
        style="max-height:calc(100vh - 2rem);">
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/10">
            <h4 class="text-white font-semibold">Edit Description</h4>
            <div id="descCharCount" class="text-xs text-gray-400">0 characters</div>
        </div>

        <div class="flex items-center gap-2 px-4 py-3 border-b border-white/10 bg-white/[0.02] flex-wrap">
            <button type="button" title="Undo" aria-label="Undo"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('undo')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 14L4 9m0 0 5-5M4 9h9a7 7 0 110 14h-1" />
                </svg>
            </button>

            <button type="button" title="Redo" aria-label="Redo"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('redo')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 14l5-5m0 0-5-5m5 5h-9a7 7 0 100 14h1" />
                </svg>
            </button>

            <div class="w-px h-5 bg-white/10"></div>

            <button type="button" title="Bold" aria-label="Bold"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('bold')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 5h6a3 3 0 010 6H7zm0 6h7a3 3 0 010 6H7z" />
                </svg>
            </button>

            <button type="button" title="Italic" aria-label="Italic"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('italic')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 4h-4m4 16h-4M10 4l4 16" />
                </svg>
            </button>

            <button type="button" title="Underline" aria-label="Underline"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('underline')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 4v6a5 5 0 0010 0V4M5 20h14" />
                </svg>
            </button>

            <div class="w-px h-5 bg-white/10"></div>

            <button type="button" title="Heading 1" aria-label="Heading 1"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('h1')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 5v14M12 5v14M4 12h8M17 9l2-1v10" />
                </svg>
            </button>

            <button type="button" title="Heading 2" aria-label="Heading 2"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('h2')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 5v14M12 5v14M4 12h8M16 10a2 2 0 114 0c0 1.5-1.2 2.2-2.1 2.8-.9.6-1.9 1.3-1.9 2.7V16h4" />
                </svg>
            </button>

            <button type="button" title="Bulleted List" aria-label="Bulleted List"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('insertUnorderedList')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 6h11M9 12h11M9 18h11M4 6h.01M4 12h.01M4 18h.01" />
                </svg>
            </button>

            <button type="button" title="Numbered List" aria-label="Numbered List"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('insertOrderedList')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6h10M10 12h10M10 18h10M4 6h2v4M4 14h2v4M4 18h2" />
                </svg>
            </button>

            <button type="button" title="Quote" aria-label="Quote"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('blockquote')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 10h4v4H7v4H3v-4a4 4 0 014-4zm10 0h4v4h-4v4h-4v-4a4 4 0 014-4z" />
                </svg>
            </button>

            <button type="button" title="Divider" aria-label="Divider"
                class="fmt-btn h-11 w-11 flex items-center justify-center rounded-lg text-gray-300 hover:bg-white/10"
                onclick="applyFormat('divider')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
                </svg>
            </button>
        </div>

        <div class="p-4 sm:p-5 overflow-y-auto" style="max-height:50vh;">
            <div id="descriptionWysiwyg" contenteditable="true"
                class="wysiwyg-editor min-h-[220px] w-full rounded-xl border border-white/10 bg-white/5 p-4 text-sm text-gray-200 focus:outline-none"
                data-placeholder="Write event details..."></div>
        </div>

        <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-white/10">
            <button type="button" onclick="closeDescriptionExpand()"
                class="px-4 py-2 bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white rounded-lg text-sm font-medium transition-all">
                Cancel
            </button>
            <button type="button" onclick="applyDescriptionExpand()"
                class="px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg text-sm font-semibold transition-all">
                Apply
            </button>
        </div>
    </div>
</div>


<style>
    @keyframes cropperIn {
        from {
            opacity: 0;
            transform: scale(0.92) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes cropperOut {
        from {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        to {
            opacity: 0;
            transform: scale(0.92) translateY(20px);
        }
    }

    @keyframes backdropIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes backdropOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    #imageCropperModal.cropper-opening {
        animation: backdropIn 0.2s ease forwards;
    }

    #imageCropperModal.cropper-closing {
        animation: backdropOut 0.2s ease forwards;
    }

    #imageCropperModal.cropper-opening #imageCropperPanel {
        animation: cropperIn 0.28s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
    }

    #imageCropperModal.cropper-closing #imageCropperPanel {
        animation: cropperOut 0.2s ease forwards;
    }

    .crop-ratio-btn.active {
        background: rgba(37, 99, 235, 0.3);
        border-color: rgba(59, 130, 246, 0.6);
        color: #93c5fd;
    }

    .cropper-view-box {
        outline-color: #3b82f6;
    }

    .cropper-point {
        background-color: #3b82f6;
    }

    .cropper-line {
        background-color: rgba(59, 130, 246, 0.6);
    }

    .cropper-face {
        background-color: rgba(59, 130, 246, 0.05);
    }

    .cropper-footer-secondary-btn {
        width: 100%;
    }

    @media (min-width: 640px) {
        .cropper-footer-secondary-btn {
            width: 190px !important;
            min-width: 190px;
        }
    }

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

    .wysiwyg-editor:empty:before {
        content: attr(data-placeholder);
        color: #6b7280;
        pointer-events: none;
        display: block;
    }

    .wysiwyg-editor h1 {
        font-size: 1.4em;
        font-weight: 700;
        color: #fff;
        margin: .6em 0 .3em;
    }

    .wysiwyg-editor h2 {
        font-size: 1.1em;
        font-weight: 600;
        color: #e2e8f0;
        margin: .5em 0 .2em;
    }

    .wysiwyg-editor strong,
    .wysiwyg-editor b {
        font-weight: 700;
        color: #fff;
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
        margin: .3em 0;
    }

    .wysiwyg-editor ol {
        list-style: decimal;
        padding-left: 1.4em;
        margin: .3em 0;
    }

    .wysiwyg-editor li {
        margin: .15em 0;
    }

    .wysiwyg-editor blockquote {
        border-left: 3px solid #3b82f6;
        padding-left: .8em;
        color: #94a3b8;
        margin: .5em 0;
        font-style: italic;
    }

    .wysiwyg-editor hr {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin: .8em 0;
    }

    .wysiwyg-editor p {
        margin: .2em 0;
    }
</style>


<script>
    let cropperInstance = null;
    let currentAspect = 16 / 9;
    let appliedCropData = null;

    function openCropper(imageSrc) {
        const modal = document.getElementById('imageCropperModal');
        const imgEl = document.getElementById('cropperImage');
        const previewImg = document.getElementById('previewImage');

        const src = imageSrc || previewImg.dataset.originalSrc || previewImg.src;
        if (src && !previewImg.dataset.originalSrc) {
            previewImg.dataset.originalSrc = src;
        }

        imgEl.src = src;

        modal.classList.remove('hidden', 'cropper-closing');
        modal.classList.add('flex', 'cropper-opening');
        modal.addEventListener('animationend', () => modal.classList.remove('cropper-opening'), { once: true });

        setActiveCropBtn('cropBtn-16-9');

        imgEl.onload = function () {
            if (cropperInstance) { cropperInstance.destroy(); cropperInstance = null; }

            cropperInstance = new Cropper(imgEl, {
                aspectRatio: currentAspect,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.85,
                responsive: true,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
                ready() {
                    if (appliedCropData) cropperInstance.setData(appliedCropData);
                }
            });
        };

        if (imgEl.complete && imgEl.naturalWidth) imgEl.onload();
    }

    function closeCropper() {
        const modal = document.getElementById('imageCropperModal');
        modal.classList.remove('cropper-opening');
        modal.classList.add('cropper-closing');
        modal.addEventListener('animationend', () => {
            modal.classList.remove('flex', 'cropper-closing');
            modal.classList.add('hidden');
            if (cropperInstance) { cropperInstance.destroy(); cropperInstance = null; }
        }, { once: true });
    }

    function applyCrop() {
        if (!cropperInstance) return;

        const crop = cropperInstance.getData(true);
        const imgData = cropperInstance.getImageData();
        const natW = imgData.naturalWidth;
        const natH = imgData.naturalHeight;

        appliedCropData = cropperInstance.getData();

        document.getElementById('cropX').value = crop.x;
        document.getElementById('cropY').value = crop.y;
        document.getElementById('cropWidth').value = crop.width;
        document.getElementById('cropHeight').value = crop.height;
        document.getElementById('cropNaturalWidth').value = natW;
        document.getElementById('cropNaturalHeight').value = natH;

        // Show container FIRST so offsetWidth/offsetHeight are non-zero
        // when applyFocalPreview reads them for the background-size calculation.
        const previewContainer = document.getElementById('eventPreviewContainer');
        previewContainer.classList.remove('hidden');
        document.getElementById('eventImagePlaceholder').classList.add('hidden');

        // Use requestAnimationFrame to guarantee the browser has painted the
        // container (and thus computed its layout dimensions) before we calculate.
        requestAnimationFrame(() => applyFocalPreview(crop, natW, natH));

        closeCropper();
    }

    function applyFocalPreview(crop, natW, natH) {
        const container = document.getElementById('eventPreviewContainer');
        const img = document.getElementById('previewImage');

        img.style.display = 'none';

        const containerW = container.offsetWidth;
        const containerH = container.offsetHeight;

        // In edit mode the container may still be hidden on first call.
        // Re-run after layout is ready so dimensions are non-zero.
        if (!containerW || !containerH) {
            requestAnimationFrame(() => applyFocalPreview(crop, natW, natH));
            return;
        }

        const scaleX = containerW / crop.width;
        const scaleY = containerH / crop.height;
        const scale = Math.max(scaleX, scaleY);

        const scaledW = natW * scale;
        const scaledH = natH * scale;

        const offsetX = -(crop.x * scale);
        const offsetY = -(crop.y * scale);

        const src = img.dataset.originalSrc || img.src;

        container.style.backgroundImage = `url('${src}')`;
        container.style.backgroundSize = `${scaledW}px ${scaledH}px`;
        container.style.backgroundPosition = `${offsetX}px ${offsetY}px`;
        container.style.backgroundRepeat = 'no-repeat';
    }

    function resetPreviewStyles() {
        const container = document.getElementById('eventPreviewContainer');
        const img = document.getElementById('previewImage');

        img.style.display = '';
        img.style.objectFit = 'cover';
        img.style.objectPosition = '50% 50%';
        img.style.transform = 'scale(1)';
        img.style.transformOrigin = '50% 50%';

        container.style.backgroundImage = '';
        container.style.backgroundSize = '';
        container.style.backgroundPosition = '';
        container.style.backgroundRepeat = '';
    }

    function clearImageState() {
        appliedCropData = null;
        ['cropX', 'cropY', 'cropWidth', 'cropHeight', 'cropNaturalWidth', 'cropNaturalHeight']
            .forEach(id => { const el = document.getElementById(id); if (el) el.value = ''; });

        const img = document.getElementById('previewImage');
        img.src = '';
        img.removeAttribute('data-original-src');
        resetPreviewStyles();

        document.getElementById('eventImage').value = '';
        document.getElementById('eventPreviewContainer').classList.add('hidden');
        document.getElementById('eventImagePlaceholder').classList.remove('hidden');
    }

    function editEventSetPreview(serverImageUrl, cropX, cropY, cropW, cropH, natW, natH) {
        if (!serverImageUrl) return;

        const container = document.getElementById('eventPreviewContainer');
        const img = document.getElementById('previewImage');

        container.classList.remove('hidden');
        document.getElementById('eventImagePlaceholder').classList.add('hidden');

        img.src = serverImageUrl;
        img.dataset.originalSrc = serverImageUrl;

        if (cropW && cropH && natW && natH) {
            const crop = { x: +cropX, y: +cropY, width: +cropW, height: +cropH };
            appliedCropData = crop;

            document.getElementById('cropX').value = cropX;
            document.getElementById('cropY').value = cropY;
            document.getElementById('cropWidth').value = cropW;
            document.getElementById('cropHeight').value = cropH;
            document.getElementById('cropNaturalWidth').value = natW;
            document.getElementById('cropNaturalHeight').value = natH;

            img.onload = () => requestAnimationFrame(() => applyFocalPreview(crop, +natW, +natH));
            if (img.complete && img.naturalWidth) requestAnimationFrame(() => applyFocalPreview(crop, +natW, +natH));
        } else {
            appliedCropData = null;
            resetPreviewStyles();
        }
    }

    function setCropAspect(ratio) {
        currentAspect = ratio;
        if (cropperInstance) cropperInstance.setAspectRatio(ratio);
        const map = { [16 / 9]: 'cropBtn-16-9', [4 / 3]: 'cropBtn-4-3', [1]: 'cropBtn-1-1' };
        setActiveCropBtn(isNaN(ratio) ? 'cropBtn-free' : map[ratio]);
    }

    function setActiveCropBtn(activeId) {
        document.querySelectorAll('.crop-ratio-btn').forEach(btn => btn.classList.remove('active'));
        const el = document.getElementById(activeId);
        if (el) el.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('eventImage')?.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (file.size > 15 * 1024 * 1024) {
                Swal.fire({ icon: 'error', title: 'File Too Large', text: 'The event image must not exceed 15MB.', background: '#1a2332', color: '#fff' });
                this.value = '';
                return;
            }

            appliedCropData = null;

            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('previewImage');
                img.src = e.target.result;
                img.dataset.originalSrc = e.target.result;
                openCropper(e.target.result);
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('removeEventImageBtn')?.addEventListener('click', function (e) {
            e.preventDefault();
            clearImageState();
        });

        const eventDropZone = document.getElementById('eventDropZone');
        eventDropZone?.addEventListener('dragover', e => { e.preventDefault(); eventDropZone.classList.add('bg-[#c8cdd4]'); });
        eventDropZone?.addEventListener('dragleave', () => eventDropZone.classList.remove('bg-[#c8cdd4]'));
        eventDropZone?.addEventListener('drop', function (e) {
            e.preventDefault();
            eventDropZone.classList.remove('bg-[#c8cdd4]');
            const file = e.dataTransfer.files[0];
            if (!file || !file.type.startsWith('image/')) return;
            appliedCropData = null;
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('eventImage').files = dt.files;
            const reader = new FileReader();
            reader.onload = ev => {
                const img = document.getElementById('previewImage');
                img.src = ev.target.result;
                img.dataset.originalSrc = ev.target.result;
                openCropper(ev.target.result);
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('imageCropperModal')?.addEventListener('click', e => {
            if (e.target === document.getElementById('imageCropperModal')) closeCropper();
        });

        document.addEventListener('keydown', e => {
            if (e.key !== 'Escape') return;
            const cm = document.getElementById('imageCropperModal');
            if (cm && !cm.classList.contains('hidden')) { closeCropper(); return; }
            const dm = document.getElementById('descriptionExpandOverlay');
            if (dm && !dm.classList.contains('hidden')) closeDescriptionExpand();
        });

        const seatPlanInput = document.getElementById('seatPlanImage');
        const seatPlanPreview = document.getElementById('seatPlanPreview');
        const seatPlanPreviewContainer = document.getElementById('seatPlanPreviewContainer');
        const seatPlanPlaceholder = document.getElementById('seatPlanPlaceholder');
        const removeSeatPlanBtn = document.getElementById('removeSeatPlanBtn');

        seatPlanInput?.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            if (file.size > 15 * 1024 * 1024) {
                Swal.fire({ icon: 'error', title: 'File Too Large', text: 'The seat plan image must not exceed 15MB.', background: '#1a2332', color: '#fff' });
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
            e.stopPropagation();
            seatPlanPreview.src = '';
            seatPlanInput.value = '';
            seatPlanPreviewContainer.classList.add('hidden');
            seatPlanPlaceholder.classList.remove('hidden');
        });

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

    function applyFormat(command) {
        const editor = document.getElementById('descriptionWysiwyg');
        editor.focus();
        if (command === 'h1' || command === 'h2') { document.execCommand('formatBlock', false, command); }
        else if (command === 'blockquote') { document.execCommand('formatBlock', false, 'blockquote'); }
        else if (command === 'divider') { document.execCommand('insertHTML', false, '<hr><p><br></p>'); }
        else { document.execCommand(command, false, null); }
        syncWysiwygToTextarea();
        updateDescCharCount(editor.innerText);
    }

    function syncWysiwygToTextarea() {
        const w = document.getElementById('descriptionWysiwyg');
        if (w) document.getElementById('eventDescription').value = w.innerHTML;
    }

    function openDescriptionExpand() {
        const main = document.getElementById('eventDescription');
        const editor = document.getElementById('descriptionWysiwyg');
        const overlay = document.getElementById('descriptionExpandOverlay');
        if (!main || !editor || !overlay) return;
        const existing = main.value.trim();
        editor.innerHTML = existing
            ? (/<[a-z][\s\S]*>/i.test(existing) ? existing : existing.split('\n').map(l => l.trim() ? `<p>${l}</p>` : '<p><br></p>').join(''))
            : '';
        updateDescCharCount(editor.innerText);
        overlay.classList.remove('hidden', 'desc-closing');
        overlay.classList.add('flex', 'desc-opening');
        overlay.addEventListener('animationend', () => overlay.classList.remove('desc-opening'), { once: true });
        setTimeout(() => {
            editor.focus();
            const r = document.createRange(), s = window.getSelection();
            r.selectNodeContents(editor); r.collapse(false);
            s.removeAllRanges(); s.addRange(r);
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

    function applyDescriptionExpand() { syncWysiwygToTextarea(); closeDescriptionExpand(); }

    function updateDescCharCount(text) {
        const len = (text || '').replace(/\s/g, '').length;
        document.querySelectorAll('#descCharCount').forEach(el => el.textContent = `${len} character${len !== 1 ? 's' : ''}`);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const editor = document.getElementById('descriptionWysiwyg');
        if (editor) {
            editor.addEventListener('input', function () { syncWysiwygToTextarea(); updateDescCharCount(this.innerText); });
            editor.addEventListener('keydown', function (e) {
                if (e.ctrlKey || e.metaKey) {
                    const k = e.key.toLowerCase();
                    if (k === 'z') { e.preventDefault(); e.shiftKey ? applyFormat('redo') : applyFormat('undo'); }
                    if (k === 'y') { e.preventDefault(); applyFormat('redo'); }
                    if (k === 'b') { e.preventDefault(); applyFormat('bold'); }
                    if (k === 'i') { e.preventDefault(); applyFormat('italic'); }
                    if (k === 'u') { e.preventDefault(); applyFormat('underline'); }
                }
            });
        }
        const overlay = document.getElementById('descriptionExpandOverlay');
        overlay?.addEventListener('click', e => { if (e.target === overlay) closeDescriptionExpand(); });
    });
</script>