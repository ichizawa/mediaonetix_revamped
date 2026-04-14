@extends('layouts')
@section('content')
    <style>
        .tab-pill.active-all {
            background: rgba(59, 130, 246, 0.15);
            color: rgb(96, 165, 250);
            border-color: rgba(59, 130, 246, 0.3);
        }
        .tab-pill.active-walkin {
            background: rgba(59, 130, 246, 0.15);
            color: rgb(96, 165, 250);
            border-color: rgba(59, 130, 246, 0.3);
        }
        .tab-pill.active-online {
            background: rgba(34, 197, 94, 0.15);
            color: rgb(74, 222, 128);
            border-color: rgba(34, 197, 94, 0.3);
        }
        .tab-pill.active-pending {
            background: rgba(250, 204, 21, 0.15);
            color: rgb(250, 204, 21);
            border-color: rgba(250, 204, 21, 0.3);
        }
        .tab-pill.active-disabled {
            background: rgba(248, 113, 113, 0.15);
            color: rgb(248, 113, 113);
            border-color: rgba(248, 113, 113, 0.3);
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.6);
            cursor: pointer;
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <!-- Header -->
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <a href="#" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <a href="{{ route('merchant.sales') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Sales</a>
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <span class="text-sm text-white">Event Details</span>
                                </div>
                                <h2 class="text-2xl font-bold text-white">{{ $event->event_name }}</h2>
                                <p class="text-sm text-gray-400">View all sales and customer details</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                            <button onclick="openPromoModal()"
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Add Promo</span>
                            </button>
                            <button onclick="openExportSalesModal()"
                                class="flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Export</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Sales Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-blue-500/30 transition-all"
                        onclick="setSaleFilter('walkin')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Walk-in Sales</p>
                            <h3 class="text-3xl font-bold text-white">{{ $walkin_sales_count ?? 0 }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Walk-in transactions</p>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-green-500/30 transition-all"
                        onclick="setSaleFilter('online')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-green-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Online Sales</p>
                            <h3 class="text-3xl font-bold text-white">{{ $online_sales_count ?? 0 }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Online transactions</p>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-yellow-500/30 transition-all"
                        onclick="setSaleFilter('pending')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Pending Sales</p>
                            <h3 class="text-3xl font-bold text-white">{{ $pending_sales_count ?? 0 }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Awaiting completion</p>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-red-500/30 transition-all"
                        onclick="setSaleFilter('disabled')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-red-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Disabled Sales</p>
                            <h3 class="text-3xl font-bold text-white">{{ $disabled_sales_count ?? 0 }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Cancelled transactions</p>
                        </div>
                    </div>
                </div>

                <!-- Sales List -->
                <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-4 sm:p-6">

                    <form id="salesFilterForm" method="GET" action="{{ route('merchant.sales.edit', ['slug' => $event->slug]) }}">
                        <input type="hidden" name="sale_filter" value="{{ $sale_filter ?? request('sale_filter', 'all') }}">

                        {{-- ── Row 1: Title + Search + Date range + Apply/Reset ── --}}
                        <div class="flex flex-col sm:flex-row sm:items-end gap-3 mb-4">

                            <h3 class="text-3xl font-bold text-white flex-shrink-0">Sales List</h3>

                            {{-- Search --}}
                            <div class="relative flex-1 min-w-0 sm:max-w-xs w-full">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
                                </svg>
                                <input id="salesSearchInput" type="text" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search name, email, txn ID, ref #"
                                    class="w-full h-11 pl-9 pr-3 bg-white/5 border border-white/10 rounded-lg
                                           text-white text-sm placeholder-gray-500
                                           focus:outline-none focus:border-blue-500 transition-colors">
                            </div>

                            {{-- Date range + buttons --}}
                            <div class="w-full sm:w-auto grid grid-cols-1 sm:flex items-end gap-2 sm:ml-auto">
                                <div class="w-full sm:w-36">
                                    <label for="startDateFilter" class="block text-xs text-gray-400 mb-1">Start Date</label>
                                    <input id="startDateFilter" type="date" name="start_date"
                                        value="{{ request('start_date') }}"
                                        max="{{ request('end_date') }}"
                                        class="w-full h-11 px-3 bg-white/5 border border-white/10 rounded-lg
                                               text-white text-sm focus:outline-none focus:border-blue-500 transition-colors">
                                </div>

                                <div class="w-full sm:w-36">
                                    <label for="endDateFilter" class="block text-xs text-gray-400 mb-1">End Date</label>
                                    <input id="endDateFilter" type="date" name="end_date"
                                        value="{{ request('end_date') }}"
                                        min="{{ request('start_date') }}"
                                        class="w-full h-11 px-3 bg-white/5 border border-white/10 rounded-lg
                                               text-white text-sm focus:outline-none focus:border-blue-500 transition-colors">
                                </div>

                                <button type="submit"
                                    class="h-11 w-full sm:w-auto px-4 bg-blue-600 hover:bg-blue-500 text-white rounded-lg text-sm font-medium transition-colors">
                                    Apply
                                </button>

                                <a href="{{ route('merchant.sales.edit', ['slug' => $event->slug]) }}"
                                    class="h-11 w-full sm:w-auto inline-flex items-center justify-center px-4 bg-white/5 hover:bg-white/10 border border-white/10
                                           text-gray-400 hover:text-white rounded-lg text-sm font-medium transition-colors">
                                    Reset
                                </a>
                            </div>
                        </div>

                        {{-- ── Row 2: Filter tab pills ── --}}
                        @php
                            $currentFilter = $sale_filter ?? request('sale_filter', 'all');
                            $totalCount = ($walkin_sales_count ?? 0)
                                        + ($online_sales_count ?? 0)
                                        + ($pending_sales_count ?? 0)
                                        + ($disabled_sales_count ?? 0);
                            $tabs = [
                                ['filter' => 'all',      'label' => 'All Sales', 'count' => $totalCount,                  'activeClass' => 'active-all'],
                                ['filter' => 'walkin',   'label' => 'Walk-in',   'count' => $walkin_sales_count ?? 0,   'activeClass' => 'active-walkin'],
                                ['filter' => 'online',   'label' => 'Online',    'count' => $online_sales_count ?? 0,   'activeClass' => 'active-online'],
                                ['filter' => 'pending',  'label' => 'Pending',   'count' => $pending_sales_count ?? 0,  'activeClass' => 'active-pending'],
                                ['filter' => 'disabled', 'label' => 'Disabled',  'count' => $disabled_sales_count ?? 0, 'activeClass' => 'active-disabled'],
                            ];
                        @endphp

                        <div class="border-t border-white/10 pt-4 mb-6">
                            <div class="flex gap-2 justify-start sm:justify-end overflow-x-auto pb-1">
                                @foreach($tabs as $tab)
                                    <button
                                        type="button"
                                        data-filter="{{ $tab['filter'] }}"
                                        data-active-class="{{ $tab['activeClass'] }}"
                                        onclick="setSaleFilter('{{ $tab['filter'] }}')"
                                        class="tab-pill shrink-0 flex items-center gap-2 px-3.5 py-1.5 rounded-full text-sm font-medium border transition-all
                                            {{ $currentFilter === $tab['filter']
                                                ? $tab['activeClass']
                                                : 'bg-white/5 text-gray-400 border-white/10 hover:bg-white/10 hover:text-white' }}">
                                        {{ $tab['label'] }}
                                        <span class="text-xs opacity-70 font-normal tabpill-count">{{ $tab['count'] }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </form>

                    <!-- Customer Sales Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[760px]">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Reference Number</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Customer</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Date</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Tickets</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Amount</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Status</th>
                                </tr>
                            </thead>
                            <tbody id="salesTableBody">
                                @forelse($sales as $sale)
                                    <tr onclick="openViewSalesModal({
                                                    ref: '{{ $sale->reference_number }}',
                                                    transactionId: '{{ addslashes($sale->transaction_id ?? 'N/A') }}',
                                                    status: '{{ $sale->status_label['label'] }}',
                                                    statusColor: '{{ $sale->status_label['color'] }}',
                                                    customerName: '{{ addslashes($sale->customer_name) }}',
                                                    customerEmail: '{{ addslashes($sale->customer_email) }}',
                                                    eventName: '{{ addslashes($event->event_name) }}',
                                                    ticketType: '{{ addslashes($sale->ticket->name) }}',
                                                    quantity: {{ $sale->quantity }},
                                                    unitPrice: '{{ number_format($sale->ticket->price, 2) }}',
                                                    totalAmount: '{{ number_format($sale->total_amount, 2) }}',
                                                    paymentMethod: '{{ addslashes($sale->payment_method ?? 'N/A') }}',
                                                    date: '{{ $sale->created_at->format('M d, Y • h:i A') }}'
                                                })" class="border-b border-white/5 hover:bg-white/5 transition-all cursor-pointer">
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <span class="text-white font-mono text-sm">
                                                {{ $sale->reference_number ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div>
                                                <p class="text-white font-medium text-sm">{{ $sale->customer_name }}</p>
                                                <p class="text-gray-400 text-xs break-all">{{ $sale->customer_email }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <span class="text-gray-400 text-sm">{{ $sale->created_at->format('M d, Y - h:i A') }}</span>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <div>
                                                <p class="text-white font-medium text-sm">{{ $sale->ticket->name }}</p>
                                                <p class="text-gray-400 text-xs">x {{ $sale->quantity }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <span class="text-white font-semibold">₱{{ $sale->total_amount }}</span>
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $sale->status_label['color'] }}/10 {{ $sale->status_label['color'] }} border {{ $sale->status_label['color'] }}/20">
                                                {{ $sale->status_label['label'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-10 px-4 text-center">
                                            <p class="text-gray-400 text-sm">No sales found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div id="salesPaginationWrapper" class="mt-4">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Promo Modal -->
    <div id="promoModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
        <div class="bg-[#0c1222] border border-white/10 rounded-2xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-white">Add Promo Code</h3>
                <button onclick="closePromoModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('merchant.promo_codes.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="event_id" value="{{ $event->id }}" hidden />
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Promo Code</label>
                    <input type="text" name="code"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                        placeholder="SUMMER2024" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Discount Type</label>
                    <select name="type"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 transition-all">
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed Amount</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Discount Value</label>
                    <input type="number" name="value"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                        placeholder="20" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Valid Until</label>
                    <input type="date" name="valid"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 transition-all"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Usage Limit</label>
                    <input type="number" name="limit"
                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                        placeholder="100" required>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closePromoModal()"
                        class="flex-1 px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-medium transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-white rounded-lg font-semibold transition-all">
                        Add Promo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPromoModal() {
            document.getElementById('promoModal').classList.remove('hidden');
            document.getElementById('promoModal').classList.add('flex');
        }

        function closePromoModal() {
            document.getElementById('promoModal').classList.add('hidden');
            document.getElementById('promoModal').classList.remove('flex');
        }

        function setSaleFilter(type) {
            const url = new URL(window.location.href);

            if (type === 'all') {
                url.searchParams.delete('sale_filter');
            } else {
                url.searchParams.set('sale_filter', type);
            }

            // When switching filter, always jump to first page.
            url.searchParams.delete('page');

            ajaxRefreshSalesFromUrl(url);
        }

        const salesFilterForm = document.getElementById('salesFilterForm');
        const searchInput = document.getElementById('salesSearchInput');
        const tableBody = document.getElementById('salesTableBody');
        const paginationWrapper = document.getElementById('salesPaginationWrapper');
        const startDateInput = document.getElementById('startDateFilter');
        const endDateInput = document.getElementById('endDateFilter');
        let salesSearchDebounce;

        function syncDateBounds() {
            if (startDateInput && endDateInput) {
                if (startDateInput.value) {
                    endDateInput.min = startDateInput.value;
                } else {
                    endDateInput.removeAttribute('min');
                }

                if (endDateInput.value) {
                    startDateInput.max = endDateInput.value;
                } else {
                    startDateInput.removeAttribute('max');
                }

                if (startDateInput.value && endDateInput.value && startDateInput.value > endDateInput.value) {
                    endDateInput.value = startDateInput.value;
                }
            }
        }

        async function ajaxRefreshSalesFromUrl(url) {
            if (!tableBody || !paginationWrapper) {
                return;
            }

            try {
                const response = await fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                });

                if (!response.ok) {
                    return;
                }

                const html = await response.text();
                const doc = new DOMParser().parseFromString(html, 'text/html');
                const nextBody = doc.querySelector('#salesTableBody');
                const nextPagination = doc.querySelector('#salesPaginationWrapper');
                const nextSearchInput = doc.querySelector('#salesSearchInput');
                const nextStartDateInput = doc.querySelector('#startDateFilter');
                const nextEndDateInput = doc.querySelector('#endDateFilter');

                if (nextBody) {
                    tableBody.innerHTML = nextBody.innerHTML;
                }

                if (nextPagination) {
                    paginationWrapper.innerHTML = nextPagination.innerHTML;
                }

                if (nextSearchInput && searchInput) {
                    searchInput.value = nextSearchInput.value;
                }

                if (nextStartDateInput && startDateInput) {
                    startDateInput.value = nextStartDateInput.value;
                }

                if (nextEndDateInput && endDateInput) {
                    endDateInput.value = nextEndDateInput.value;
                }

                const hiddenSaleFilterInput = salesFilterForm?.querySelector('input[name="sale_filter"]');
                if (hiddenSaleFilterInput) {
                    hiddenSaleFilterInput.value = url.searchParams.get('sale_filter') || 'all';
                }

                // Update active tab pill styles
                const activeFilter = url.searchParams.get('sale_filter') || 'all';
                document.querySelectorAll('.tab-pill').forEach((btn) => {
                    const filter = btn.dataset.filter;
                    const activeClass = btn.dataset.activeClass;

                    // Remove all possible active classes
                    btn.classList.remove('active-all', 'active-walkin', 'active-online', 'active-pending', 'active-disabled');
                    // Remove inactive styles
                    btn.classList.remove('bg-white/5', 'text-gray-400', 'border-white/10', 'hover:bg-white/10', 'hover:text-white');

                    if (filter === activeFilter) {
                        btn.classList.add(activeClass);
                    } else {
                        btn.classList.add('bg-white/5', 'text-gray-400', 'border-white/10', 'hover:bg-white/10', 'hover:text-white');
                    }
                });

                syncDateBounds();

                window.history.replaceState({}, '', url.toString());
            } catch (error) {
                console.error('Unable to refresh sales list', error);
            }
        }

        function ajaxRefreshSales(searchValue) {
            const url = new URL(window.location.href);
            if (searchValue) {
                url.searchParams.set('search', searchValue);
            } else {
                url.searchParams.delete('search');
            }

            url.searchParams.delete('page');
            ajaxRefreshSalesFromUrl(url);
        }

        startDateInput?.addEventListener('change', syncDateBounds);
        endDateInput?.addEventListener('change', syncDateBounds);
        syncDateBounds();

        salesFilterForm?.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(salesFilterForm);
            const url = new URL(window.location.href);

            ['start_date', 'end_date', 'search', 'sale_filter'].forEach((key) => {
                const value = (formData.get(key) || '').toString().trim();

                if (!value || (key === 'sale_filter' && value === 'all')) {
                    url.searchParams.delete(key);
                } else {
                    url.searchParams.set(key, value);
                }
            });

            url.searchParams.delete('page');
            ajaxRefreshSalesFromUrl(url);
        });

        salesFilterForm?.querySelector('a[href]')?.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(this.href);
            ajaxRefreshSalesFromUrl(url);
        });

        paginationWrapper?.addEventListener('click', function(e) {
            const link = e.target.closest('a[href]');
            if (!link) {
                return;
            }

            e.preventDefault();
            const nextUrl = new URL(link.href);
            ajaxRefreshSalesFromUrl(nextUrl);
        });

        searchInput?.addEventListener('input', function() {
            clearTimeout(salesSearchDebounce);
            salesSearchDebounce = setTimeout(() => {
                ajaxRefreshSales(this.value.trim());
            }, 300);
        });

        // Close modal when clicking outside
        document.getElementById('promoModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closePromoModal();
            }
        });
    </script>

    @include('merchant.component.sales.export-modal', [
        'exportPdfRoute' => route('merchant.sales.export.pdf', ['event_id' => $event->id]),
        'exportExcelRoute' => route('merchant.sales.export.excel', ['event_id' => $event->id]),
    ])

    @include('merchant.component.sales.view-sales')
@endsection