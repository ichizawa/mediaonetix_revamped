<!-- Merchant Details Modal -->
<div id="merchantModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-[#0c1222] border border-white/10 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 border-b border-white/10 p-6">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl">
                        <span id="modalInitial">T</span>
                    </div>
                    <div>
                        <h3 id="modalMerchantName" class="text-2xl font-bold text-white mb-1">Tech Events Co.</h3>
                        <p class="text-gray-400 text-sm">Merchant ID: <span id="modalMerchantId" class="text-white font-mono">#MER-1000</span></p>
                    </div>
                </div>
                <button onclick="closeMerchantModal()" class="p-2 hover:bg-white/10 rounded-lg transition-all">
                    <svg class="w-6 h-6 text-gray-400 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="overflow-y-auto max-h-[calc(90vh-200px)]">
            <!-- Merchant Info Section -->
            <div class="p-6 border-b border-white/10">
                <h4 class="text-lg font-semibold text-white mb-4">Merchant Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Contact Person</p>
                        <p id="modalContactPerson" class="text-white font-medium">John Smith</p>
                    </div>
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Email Address</p>
                        <p id="modalEmail" class="text-white font-medium">john@techevents.com</p>
                    </div>
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Phone Number</p>
                        <p id="modalPhone" class="text-white font-medium">+1 234-567-8901</p>
                    </div>
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Status</p>
                        <span id="modalStatus" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></span>
                            Active
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="p-6 border-b border-white/10">
                <h4 class="text-lg font-semibold text-white mb-4">Statistics</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-br from-blue-500/10 to-blue-600/5 border border-blue-500/20 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Total Events</p>
                        <p id="modalTotalEvents" class="text-2xl font-bold text-white">24</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-500/10 to-green-600/5 border border-green-500/20 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Total Revenue</p>
                        <p id="modalRevenue" class="text-2xl font-bold text-white">$125,000</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-500/10 to-purple-600/5 border border-purple-500/20 rounded-lg p-4 col-span-2 md:col-span-1">
                        <p class="text-gray-400 text-sm mb-1">Avg. Event Price</p>
                        <p id="modalAvgPrice" class="text-2xl font-bold text-white">$145</p>
                    </div>
                </div>
            </div>

            <!-- Ongoing Events Section -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-semibold text-white">Ongoing Events</h4>
                    <span class="text-sm text-gray-400"><span id="modalOngoingCount" class="text-white font-semibold">8</span> Active Events</span>
                </div>

                <div id="modalEventsList" class="space-y-3">
                    <!-- Event items will be dynamically inserted here -->
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="border-t border-white/10 p-6 bg-white/5">
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <button onclick="closeMerchantModal()" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                    Close
                </button>
                <button class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Merchant
                    </span>
                </button>
                <button class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        View All Events
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openMerchantModal(details) {
    const modal = document.getElementById('merchantModal');

    // // Set basic info
    // document.getElementById('modalMerchantName').textContent = name;
    // document.getElementById('modalInitial').textContent = name.charAt(0).toUpperCase();
    // document.getElementById('modalContactPerson').textContent = contact;
    // document.getElementById('modalEmail').textContent = email;
    // document.getElementById('modalTotalEvents').textContent = events;
    // document.getElementById('modalRevenue').textContent = '$' + revenue.toLocaleString();

    // // Set status
    // const statusElement = document.getElementById('modalStatus');
    // if (status === 'active') {
    //     statusElement.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20';
    //     statusElement.innerHTML = '<span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></span>Active';
    // } else if (status === 'pending') {
    //     statusElement.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20';
    //     statusElement.innerHTML = '<span class="w-1.5 h-1.5 bg-yellow-400 rounded-full mr-1.5"></span>Pending';
    // } else {
    //     statusElement.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20';
    //     statusElement.innerHTML = '<span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1.5"></span>Inactive';
    // }

    // // Get events for this merchant
    // const events_list = merchantEvents[name] || [];
    // const eventsList = document.getElementById('modalEventsList');
    // document.getElementById('modalOngoingCount').textContent = events_list.length;

    // // Calculate average price
    // const avgPrice = events_list.length > 0
    //     ? Math.round(events_list.reduce((sum, e) => sum + e.price, 0) / events_list.length)
    //     : 0;
    // document.getElementById('modalAvgPrice').textContent = '$' + avgPrice;

    // // Build events list HTML
    // if (events_list.length > 0) {
    //     eventsList.innerHTML = events_list.map(event => `
    //         <div class="bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg p-4 transition-all">
    //             <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
    //                 <div class="flex-1">
    //                     <div class="flex items-start gap-3">
    //                         <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center flex-shrink-0">
    //                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    //                             </svg>
    //                         </div>
    //                         <div class="flex-1 min-w-0">
    //                             <h5 class="text-white font-semibold mb-1">${event.name}</h5>
    //                             <div class="flex flex-wrap items-center gap-3 text-sm text-gray-400">
    //                                 <span class="flex items-center gap-1">
    //                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    //                                     </svg>
    //                                     ${event.date}
    //                                 </span>
    //                                 <span class="flex items-center gap-1">
    //                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
    //                                     </svg>
    //                                     ${event.category}
    //                                 </span>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //                 <div class="flex sm:flex-col items-center sm:items-end gap-3 sm:gap-1">
    //                     <div class="text-right flex-1 sm:flex-none">
    //                         <p class="text-2xl font-bold text-white">${event.price === 0 ? 'FREE' : '$' + event.price}</p>
    //                         <p class="text-xs text-gray-400">per ticket</p>
    //                     </div>
    //                     <div class="flex-1 sm:flex-none">
    //                         <div class="bg-white/10 rounded-lg px-3 py-2">
    //                             <p class="text-xs text-gray-400 mb-1">Tickets Sold</p>
    //                             <p class="text-sm font-semibold text-white">${event.sold} / ${event.tickets}</p>
    //                             <div class="mt-1 bg-white/10 rounded-full h-1.5 overflow-hidden">
    //                                 <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-full rounded-full" style="width: ${(event.sold / event.tickets * 100).toFixed(1)}%"></div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     `).join('');
    // } else {
    //     eventsList.innerHTML = `
    //         <div class="text-center py-8">
    //             <svg class="w-16 h-16 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    //                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
    //             </svg>
    //             <p class="text-gray-400">No ongoing events</p>
    //         </div>
    //     `;
    // }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeMerchantModal() {
    const modal = document.getElementById('merchantModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('merchantModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeMerchantModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMerchantModal();
    }
});
</script>
