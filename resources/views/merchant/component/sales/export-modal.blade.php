<!-- Export Sales Modal -->
<div id="exportSalesModal" class="fixed inset-0 z-[100] hidden opacity-0 transition-opacity duration-300">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeExportSalesModal()">
    </div>

    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen px-4 pb-20 text-center sm:p-0 pointer-events-none">
        <div id="exportSalesModalContent"
            class="relative inline-block align-bottom bg-[#1a2235] border border-white/10 rounded-2xl text-left overflow-hidden shadow-2xl transform scale-95 opacity-0 transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-lg w-full pointer-events-auto">
            <div class="px-6 py-6 sm:p-8">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Export Sales</h3>
                        <p class="text-sm text-gray-400 mt-1">Select a date range to filter your export.</p>
                    </div>
                    <button onclick="closeExportSalesModal()"
                        class="p-2 text-gray-400 hover:text-white hover:bg-white/5 rounded-xl transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form id="exportSalesForm" method="GET" action="" target="_blank">
                    <div class="space-y-5">
                        <!-- Date Range Selector -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Date Filter</label>
                            <select id="exportDateFilter" onchange="toggleExportCustomDates()"
                                class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all appearance-none cursor-pointer">
                                <option value="today" class="bg-[#1a2235]">Today</option>
                                <option value="yesterday" class="bg-[#1a2235]">Yesterday</option>
                                <option value="last_7_days" class="bg-[#1a2235]">Last 7 Days</option>
                                <option value="last_30_days" class="bg-[#1a2235]">Last 30 Days</option>
                                <option value="this_month" class="bg-[#1a2235]">This Month</option>
                                <option value="last_month" class="bg-[#1a2235]">Last Month</option>
                                <option value="all_time" class="bg-[#1a2235]" selected>All Time</option>
                                <option value="custom" class="bg-[#1a2235]">Custom Date Range</option>
                            </select>
                        </div>

                        <!-- Custom Dates Container (Hidden by default) -->
                        <div id="exportCustomDates" class="hidden grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Start Date</label>
                                <input type="date" id="exportStartDate" name="start_date"
                                    class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 transition-all [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert cursor-pointer">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">End Date</label>
                                <input type="date" id="exportEndDate" name="end_date"
                                    class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 transition-all [&::-webkit-calendar-picker-indicator]:filter [&::-webkit-calendar-picker-indicator]:invert cursor-pointer">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex gap-3 sm:flex-row flex-col">
                        <button type="button" onclick="closeExportSalesModal()"
                            class="flex-1 px-4 py-3 bg-white/5 hover:bg-white/10 border border-white/10 text-white rounded-xl font-medium transition-all">
                            Cancel
                        </button>
                        <button type="button"
                            onclick="submitExport('{{ $exportPdfRoute ?? route('merchant.sales.export.pdf') }}')"
                            class="flex-1 px-4 py-3 bg-red-600/20 text-red-400 hover:bg-red-600/30 border border-red-500/30 rounded-xl font-medium transition-all flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export PDF
                        </button>
                        <button type="button"
                            onclick="submitExport('{{ $exportExcelRoute ?? route('merchant.sales.export.excel') }}')"
                            class="flex-1 px-4 py-3 bg-green-600/20 text-green-400 hover:bg-green-600/30 border border-green-500/30 rounded-xl font-medium transition-all flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openExportSalesModal() {
        const modal = document.getElementById('exportSalesModal');
        const content = document.getElementById('exportSalesModalContent');

        modal.classList.remove('hidden');

        // Timeout ensures the browser registers the display change before animating
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    const params = new URLSearchParams(window.location.search);
    if (params.get('add') === '2' && typeof openExportSalesModal === 'function') {
        setTimeout(() => openExportSalesModal(), 200);
    }

    function closeExportSalesModal() {
        const modal = document.getElementById('exportSalesModal');
        const content = document.getElementById('exportSalesModalContent');

        modal.classList.add('opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // 300ms matches the duration in the tailwind class
    }

    function toggleExportCustomDates() {
        const filter = document.getElementById('exportDateFilter').value;
        const customDatesContainer = document.getElementById('exportCustomDates');
        if (filter === 'custom') {
            customDatesContainer.classList.remove('hidden');
        } else {
            customDatesContainer.classList.add('hidden');
        }
    }

    function submitExport(url) {
        let actionUrl = new URL(url);
        const filter = document.getElementById('exportDateFilter').value;

        const today = new Date();
        let startDate = '';
        let endDate = '';

        if (filter === 'custom') {
            startDate = document.getElementById('exportStartDate').value;
            endDate = document.getElementById('exportEndDate').value;
        } else if (filter !== 'all_time') {
            const start = new Date();
            const end = new Date();

            switch (filter) {
                case 'today':
                    // already today
                    break;
                case 'yesterday':
                    start.setDate(today.getDate() - 1);
                    end.setDate(today.getDate() - 1);
                    break;
                case 'last_7_days':
                    start.setDate(today.getDate() - 7);
                    break;
                case 'last_30_days':
                    start.setDate(today.getDate() - 30);
                    break;
                case 'this_month':
                    start.setDate(1);
                    break;
                case 'last_month':
                    start.setMonth(today.getMonth() - 1);
                    start.setDate(1);
                    end.setMonth(today.getMonth());
                    end.setDate(0);
                    break;
            }

            startDate = start.toISOString().split('T')[0];
            endDate = end.toISOString().split('T')[0];
        }

        if (startDate && endDate) {
            actionUrl.searchParams.set('start_date', startDate);
            actionUrl.searchParams.set('end_date', endDate);
        }

        actionUrl.searchParams.set('filter', filter);

        // Submit to the final URL
        window.open(actionUrl.toString(), '_blank');
        closeExportSalesModal();
    }
</script>
