<!-- View Event Modal -->
<div id="viewEventModal" class="hidden fixed inset-0 items-center justify-center"
    style="background: rgba(0,0,0,0.8); backdrop-filter: blur(8px); z-index: 50;">
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

            <!-- Status badge — bottom left -->
            <div class="absolute bottom-4 left-6" id="viewEventStatusContainer">
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
                    <!-- Seat Plan button — below price, right-aligned -->
                    <div id="viewSeatPlanBtn" class="hidden justify-end mt-2">
                        <button onclick="openSeatPlanLightbox()"
                            class="flex items-center gap-2 px-3 py-2 bg-white/5 hover:bg-white/10 backdrop-blur-sm border border-white/10 hover:border-white/30 rounded-full text-white text-xs font-semibold transition-all group ml-auto">
                            <svg class="w-3.5 h-3.5 text-blue-400 group-hover:scale-110 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                            Seat Plan
                        </button>
                    </div>
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
                <div id="viewEventDescription" class="text-gray-400 leading-relaxed desc-preview"
                    style="max-height: 280px; overflow-y: auto; overscroll-behavior: contain;">
                </div>
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

<div class="flex flex-wrap justify-end gap-3 pt-4 border-t border-white/10">
    <button id="openEditModalFromView"
        class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
            </path>
        </svg>
        Edit Event
    </button>
    <a id="viewManageTicketsBtn" href="#"
        class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 -1 17 18">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M4 4.85v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9zm-7 1.8v.9h1v-.9zm7 0v.9h1v-.9z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M1.5 3A1.5 1.5 0 0 0 0 4.5V6a.5.5 0 0 0 .5.5 1.5 1.5 0 1 1 0 3 .5.5 0 0 0-.5.5v1.5A1.5 1.5 0 0 0 1.5 13h13a1.5 1.5 0 0 0 1.5-1.5V10a.5.5 0 0 0-.5-.5 1.5 1.5 0 0 1 0-3A.5.5 0 0 0 16 6V4.5A1.5 1.5 0 0 0 14.5 3zM1 4.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1.05a2.5 2.5 0 0 0 0 4.9v1.05a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1.05a2.5 2.5 0 0 0 0-4.9z">
            </path>
        </svg>
        Manage Tickets
    </a>
    <form id="viewDeleteEventForm" method="POST" onsubmit="confirmDelete(event, this)"
        class="w-full sm:w-auto">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-300 rounded-lg font-semibold transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                </path>
            </svg>
            Delete
        </button>
    </form>
    <button onclick="closeViewModal()"
        class="w-full sm:w-auto px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
        Close
    </button>
</div>
</div>

<!-- Seat Plan Lightbox -->
<div id="seatPlanLightbox" class="hidden fixed inset-0 items-center justify-center p-4"
    style="z-index: 99999; background: rgba(0,0,0,0.88); backdrop-filter: blur(16px);">
    <div class="relative w-full flex flex-col items-center" style="max-width: 28.8rem;">
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
            <img id="seatPlanLightboxImg" src="" alt="Seat Plan" class="w-full h-auto max-h-[42vh] object-contain">
        </div>
        <p class="text-gray-500 text-xs mt-3">Click outside or press Esc to close</p>
    </div>
</div>

<style>
    /* ── Modal open/close animations ─────────────────────────────────────── */
    @keyframes modalIn {
        from {
            opacity: 0;
            transform: scale(0.96);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes modalOut {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.96);
        }
    }

    #viewEventModal.modal-opening {
        animation: modalIn 0.22s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
    }

    #viewEventModal.modal-closing {
        animation: modalOut 0.18s ease forwards;
    }

    /* ── Modal content scrollbar ─────────────────────────────────────────── */
    #viewEventModal .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    #viewEventModal .modal-content::-webkit-scrollbar-track {
        background: transparent;
    }

    #viewEventModal .modal-content::-webkit-scrollbar-thumb {
        background-color: transparent;
        border-radius: 9999px;
        transition: background-color 0.3s ease;
    }

    #viewEventModal .modal-content:hover::-webkit-scrollbar-thumb,
    #viewEventModal .modal-content.is-scrolling::-webkit-scrollbar-thumb {
        background-color: rgba(107, 114, 128, 0.5);
    }

    /* ── Description scrollbar ───────────────────────────────────────────── */
    #viewEventDescription::-webkit-scrollbar {
        width: 6px;
    }

    #viewEventDescription::-webkit-scrollbar-track {
        background: transparent;
    }

    #viewEventDescription::-webkit-scrollbar-thumb {
        background-color: transparent;
        border-radius: 9999px;
        transition: background-color 0.3s ease;
    }

    #viewEventDescription:hover::-webkit-scrollbar-thumb,
    #viewEventDescription.is-scrolling::-webkit-scrollbar-thumb {
        background-color: rgba(107, 114, 128, 0.5);
    }

    /* ── WYSIWYG rendering in view modal ─────────────────────────────────── */
    #viewEventDescription h1 {
        font-size: 1.4em;
        font-weight: 700;
        color: #ffffff;
        margin: 0.6em 0 0.3em;
        display: block;
    }

    #viewEventDescription h2 {
        font-size: 1.1em;
        font-weight: 600;
        color: #e2e8f0;
        margin: 0.5em 0 0.2em;
        display: block;
    }

    #viewEventDescription strong,
    #viewEventDescription b {
        font-weight: 700;
        color: #ffffff;
    }

    #viewEventDescription em,
    #viewEventDescription i {
        font-style: italic;
        color: #cbd5e1;
    }

    #viewEventDescription u {
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    #viewEventDescription ul {
        list-style: disc;
        padding-left: 1.4em;
        margin: 0.3em 0;
        display: block;
    }

    #viewEventDescription ol {
        list-style: decimal;
        padding-left: 1.4em;
        margin: 0.3em 0;
        display: block;
    }

    #viewEventDescription li {
        margin: 0.15em 0;
        display: list-item;
    }

    #viewEventDescription blockquote {
        border-left: 3px solid #3b82f6;
        padding-left: 0.8em;
        color: #94a3b8;
        margin: 0.5em 0;
        font-style: italic;
        display: block;
    }

    #viewEventDescription hr {
        border: none;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin: 0.8em 0;
        display: block;
    }

    #viewEventDescription p {
        margin: 0.2em 0;
    }

    /* ── Seat Plan lightbox animations ───────────────────────────────────── */
    @keyframes seatPlanIn {
        from {
            opacity: 0;
            transform: scale(0.94);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes seatPlanOut {
        from {
            opacity: 1;
            transform: scale(1);
        }

        to {
            opacity: 0;
            transform: scale(0.94);
        }
    }

    #seatPlanLightbox.sp-opening {
        animation: seatPlanIn 0.22s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
    }

    #seatPlanLightbox.sp-closing {
        animation: seatPlanOut 0.18s ease forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Scrollbar "is-scrolling" class ────────────────────────────────
        const scrollables = [
            document.getElementById('viewEventDescription'),
            document.querySelector('#viewEventModal .modal-content')
        ];

        scrollables.forEach(el => {
            if (!el) return;
            let timer = null;
            el.addEventListener('scroll', () => {
                el.classList.add('is-scrolling');
                clearTimeout(timer);
                timer = setTimeout(() => el.classList.remove('is-scrolling'), 1000);
            });
        });

        // ── View modal — backdrop click ───────────────────────────────────
        document.getElementById('viewEventModal')?.addEventListener('click', function (e) {
            if (e.target === this) closeViewModal();
        });

        // ── Seat plan lightbox — backdrop click ───────────────────────────
        document.getElementById('seatPlanLightbox')?.addEventListener('click', function (e) {
            if (e.target === this) closeSeatPlanLightbox();
        });

        // ── Escape key ────────────────────────────────────────────────────
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                const lb = document.getElementById('seatPlanLightbox');
                if (lb && !lb.classList.contains('hidden')) {
                    closeSeatPlanLightbox();
                    return;
                }
                const vm = document.getElementById('viewEventModal');
                if (vm && !vm.classList.contains('hidden')) closeViewModal();
            }
        });
    });

    // ── View modal open / close ───────────────────────────────────────────
    function openViewModal() {
        const modal = document.getElementById('viewEventModal');
        modal.classList.remove('hidden', 'modal-closing');
        modal.classList.add('flex', 'modal-opening');
        modal.addEventListener('animationend', () => modal.classList.remove('modal-opening'), { once: true });
    }

    function closeViewModal() {
        const modal = document.getElementById('viewEventModal');
        modal.classList.remove('modal-opening');
        modal.classList.add('modal-closing');
        modal.addEventListener('animationend', () => {
            modal.classList.remove('flex', 'modal-closing');
            modal.classList.add('hidden');
        }, { once: true });
    }

    // ── Seat Plan lightbox open / close ───────────────────────────────────
    function openSeatPlanLightbox() {
        const lb = document.getElementById('seatPlanLightbox');
        lb.classList.remove('hidden', 'sp-closing');
        lb.classList.add('flex', 'sp-opening');
        lb.addEventListener('animationend', () => lb.classList.remove('sp-opening'), { once: true });
    }

    function closeSeatPlanLightbox() {
        const lb = document.getElementById('seatPlanLightbox');
        lb.classList.remove('sp-opening');
        lb.classList.add('sp-closing');
        lb.addEventListener('animationend', () => {
            lb.classList.remove('flex', 'sp-closing');
            lb.classList.add('hidden');
        }, { once: true });
    }
</script>