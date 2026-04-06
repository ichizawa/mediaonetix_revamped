@extends('layouts')
@section('content')
    <style>
        .sales-card {
            transition: all 0.3s ease;
        }

        .sales-card:hover {
            transform: translateY(-2px);
        }

        .status-badge {
            transition: all 0.2s ease;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .responsive-chip-row {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .responsive-chip-row::-webkit-scrollbar {
            display: none;
        }

        @media (max-width: 640px) {
            .chart-container {
                height: 220px;
            }
        }

        @media (max-width: 420px) {
            .chart-container {
                height: 200px;
            }
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <!-- Header -->
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-4">
                            <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Sales & Transactions</h2>
                                <p class="text-sm text-gray-400">Track your revenue and ticket sales</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 flex-wrap sm:flex-nowrap">
                            <button onclick="openSalesModal()"
                                class="flex items-center gap-2 px-3 sm:px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded-lg text-white font-medium transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="text-sm sm:text-base">Add Sale</span>
                            </button>
                            <button
                                class="flex items-center gap-2 px-3 sm:px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
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
                <!-- Revenue Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <div
                        class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +12.5%
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Revenue</p>
                            <h3 class="text-3xl font-bold text-white">₱{{ number_format($total_sales, 2) }}</h3>
                            <p class="text-xs text-gray-500 mt-2">vs last month</p>
                        </div>
                    </div>

                    <div
                        class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-purple-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +8.2%
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Sales</p>
                            <h3 class="text-3xl font-bold text-white">0</h3>
                            <p class="text-xs text-gray-500 mt-2">Tickets sold</p>
                        </div>
                    </div>

                    <div
                        class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-green-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +15.3%
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Completed</p>
                            <h3 class="text-3xl font-bold text-white">0</h3>
                            <p class="text-xs text-gray-500 mt-2">Successful transactions</p>
                        </div>
                    </div>

                    <div
                        class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-orange-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-yellow-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                        </path>
                                    </svg>
                                    158
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Pending</p>
                            <h3 class="text-3xl font-bold text-white">0</h3>
                            <p class="text-xs text-gray-500 mt-2">Awaiting payment</p>
                        </div>
                    </div>
                </div>

                <!-- Revenue Chart and Top Events -->
                <div class="grid lg:grid-cols-3 gap-6 mb-8">
                    <!-- Revenue Chart -->
                    <div
                        class="lg:col-span-2 bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-4 sm:p-6">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
                            <h3 class="text-lg sm:text-xl font-bold text-white">Revenue Overview</h3>
                            <div class="flex gap-2 w-full sm:w-auto overflow-x-auto responsive-chip-row pb-1">
                                <button type="button" data-revenue-period="week"
                                    class="revenue-period-btn shrink-0 px-3 py-1 text-sm bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-lg font-medium transition-all">Week</button>
                                <button type="button" data-revenue-period="month"
                                    class="revenue-period-btn shrink-0 px-3 py-1 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all">Month</button>
                                <button type="button" data-revenue-period="year"
                                    class="revenue-period-btn shrink-0 px-3 py-1 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all">Year</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Top Selling Events -->
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white mb-6">List of Events</h3>
                        <div class="space-y-4">
                            @forelse($events as $event)
                                <a href="{{ route('merchant.sales.edit', $event->slug) }}"
                                    class="flex items-center justify-between p-3 bg-white/5 rounded-xl hover:bg-white/10 transition-all cursor-pointer group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold group-hover:scale-110 transition-transform">
                                            {{ substr($event->event_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p
                                                class="text-white font-semibold text-sm group-hover:text-blue-400 transition-colors">
                                                {{ $event->event_name }}
                                            </p>
                                            {{-- <p class="text-gray-400 text-xs">{{ 450 - ($event->id * 50) }} tickets sold</p>
                                            --}}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="text-right">
                                            {{-- <p class="text-white font-bold">${{ 12500 - ($event->id * 1500) }}</p>
                                            <p class="text-green-400 text-xs">+{{ 20 - $event->id }}%</p> --}}
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-400 group-hover:translate-x-1 transition-all"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </a>
                            @empty
                                <p class="text-white text-sm">No events found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
                        <h3 class="text-xl font-bold text-white">Recent Transactions</h3>
                        <div class="flex gap-2 w-full sm:w-auto overflow-x-auto responsive-chip-row pb-1">
                            <button
                                class="shrink-0 px-3 py-1 text-xs sm:text-sm bg-white/5 hover:bg-white/10 text-gray-400 rounded-lg font-medium transition-all">All</button>
                            <button
                                class="shrink-0 px-3 py-1 text-xs sm:text-sm bg-white/5 hover:bg-white/10 text-gray-400 rounded-lg font-medium transition-all">Completed</button>
                            <button
                                class="shrink-0 px-3 py-1 text-xs sm:text-sm bg-white/5 hover:bg-white/10 text-gray-400 rounded-lg font-medium transition-all">Pending</button>
                            <button
                                class="shrink-0 px-3 py-1 text-xs sm:text-sm bg-white/5 hover:bg-white/10 text-gray-400 rounded-lg font-medium transition-all">Failed</button>
                        </div>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="space-y-3 md:hidden">
                        @forelse($sales as $sale)
                            <div onclick="openViewSalesModal({
                                    ref: '{{ $sale->reference_number }}',
                                    status: '{{ $sale->status_label['label'] }}',
                                    statusColor: '{{ $sale->status_label['color'] }}',
                                    customerName: '{{ addslashes($sale->customer_name) }}',
                                    customerEmail: '{{ addslashes($sale->customer_email) }}',
                                    eventName: '{{ addslashes($sale->event->event_name) }}',
                                    ticketType: '{{ addslashes($sale->ticket->name) }}',
                                    quantity: {{ $sale->quantity }},
                                    unitPrice: '{{ number_format($sale->ticket->price, 2) }}',
                                    totalAmount: '{{ number_format($sale->total_amount, 2) }}',
                                    paymentMethod: '{{ addslashes($sale->payment_method ?? 'N/A') }}',
                                    date: '{{ $sale->created_at->format('M d, Y • h:i A') }}'
                                })" class="bg-white/5 border border-white/10 rounded-xl p-4 cursor-pointer hover:bg-white/10 transition-all">
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <p class="text-white font-mono text-xs break-all">{{ $sale->reference_number }}</p>
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $sale->status_label['color'] }}/10 {{ $sale->status_label['color'] }} border {{ $sale->status_label['color'] }}/20">
                                        {{ $sale->status_label['label'] }}
                                    </span>
                                </div>

                                <div class="space-y-2 mb-3">
                                    <p class="text-white font-medium text-sm">{{ $sale->customer_name }}</p>
                                    <p class="text-gray-400 text-xs break-all">{{ $sale->customer_email }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-xs mb-4">
                                    <div>
                                        <p class="text-gray-400">Event</p>
                                        <p class="text-white mt-0.5">{{ $sale->event->event_name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400">Amount</p>
                                        <p class="text-white font-semibold mt-0.5">₱{{ $sale->total_amount }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400">Ticket</p>
                                        <p class="text-white mt-0.5">{{ $sale->ticket->name }} x {{ $sale->quantity }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-400">Date</p>
                                        <p class="text-white mt-0.5">{{ $sale->created_at->format('M d, Y - h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button onclick="event.stopPropagation()" class="p-1.5 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-white text-sm">No sales found.</p>
                        @endforelse
                    </div>

                    <!-- Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full min-w-[980px]">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Transaction ID</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Customer</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Event</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Date</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Tickets</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Amount</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Status</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sales as $sale)
                                    <tr onclick="openViewSalesModal({
                                                    ref: '{{ $sale->reference_number }}',
                                                    status: '{{ $sale->status_label['label'] }}',
                                                    statusColor: '{{ $sale->status_label['color'] }}',
                                                    customerName: '{{ addslashes($sale->customer_name) }}',
                                                    customerEmail: '{{ addslashes($sale->customer_email) }}',
                                                    eventName: '{{ addslashes($sale->event->event_name) }}',
                                                    ticketType: '{{ addslashes($sale->ticket->name) }}',
                                                    quantity: {{ $sale->quantity }},
                                                    unitPrice: '{{ number_format($sale->ticket->price, 2) }}',
                                                    totalAmount: '{{ number_format($sale->total_amount, 2) }}',
                                                    paymentMethod: '{{ addslashes($sale->payment_method ?? 'N/A') }}',
                                                    date: '{{ $sale->created_at->format('M d, Y • h:i A') }}'
                                                })" class="border-b border-white/5 hover:bg-white/10 transition-all cursor-pointer">
                                        <td class="py-4 px-4">
                                            <span class="text-white font-mono text-sm">{{ $sale->reference_number }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div>
                                                <p class="text-white font-medium text-sm">{{ $sale->customer_name }}</p>
                                                <p class="text-gray-400 text-xs break-all">{{ $sale->customer_email }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-white text-sm">{{ $sale->event->event_name }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="text-gray-400 text-sm">{{ $sale->created_at->format('M d, Y - h:i A') }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div>
                                                <p class="text-white font-medium text-sm">{{ $sale->ticket->name }}</p>
                                                <p class="text-gray-400 text-xs">x {{ $sale->quantity }}</p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-white font-semibold">₱{{ $sale->total_amount }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $sale->status_label['color'] }}/10 {{ $sale->status_label['color'] }} border {{ $sale->status_label['color'] }}/20">
                                                {{ $sale->status_label['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex gap-2">
                                                <button onclick="event.stopPropagation()" class="p-1.5 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-4 px-4">
                                            <p class="text-white text-sm">No sales found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{-- <div class="flex items-center justify-between mt-6 pt-4 border-t border-white/10">
                        <p class="text-sm text-gray-400">Showing 1 to 10 of 247 transactions</p>
                        <div class="flex gap-2">
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                                Previous
                            </button>
                            <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg">1</button>
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">2</button>
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">3</button>
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                                Next
                            </button>
                        </div>
                    </div> --}}
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
// --- Revenue Chart ---
        const ctx = document.getElementById('revenueChart');
        const isMobileViewport = window.matchMedia('(max-width: 640px)').matches;
        const revenuePeriods = @json($chartData ?? []);
        const revenuePeriodButtons = document.querySelectorAll('.revenue-period-btn');
        const activeRevenuePeriodClasses = ['bg-blue-500/20', 'text-blue-400', 'border', 'border-blue-500/30'];
        const inactiveRevenuePeriodClasses = ['bg-white/5', 'text-gray-400'];

        const defaultRevenueData = revenuePeriods.week ?? {
            labels: @json($labels),
            values: @json($values)
        };

        let revenueChart;

        function setActiveRevenuePeriod(period) {
            revenuePeriodButtons.forEach((button) => {
                const isActive = button.dataset.revenuePeriod === period;

                button.classList.remove(...activeRevenuePeriodClasses, ...inactiveRevenuePeriodClasses);

                if (isActive) {
                    button.classList.add(...activeRevenuePeriodClasses);
                } else {
                    button.classList.add(...inactiveRevenuePeriodClasses);
                }
            });
        }

        function updateRevenueChart(period) {
            if (!revenueChart || !revenuePeriods[period]) {
                return;
            }

            revenueChart.data.labels = revenuePeriods[period].labels;
            revenueChart.data.datasets[0].data = revenuePeriods[period].values;
            revenueChart.update();

            setActiveRevenuePeriod(period);
        }

        if (ctx) {
            revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: defaultRevenueData.labels,
                    datasets: [{
                        label: 'Revenue',
                        data: defaultRevenueData.values,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: isMobileViewport ? 2.5 : 4,
                        pointHoverRadius: isMobileViewport ? 4 : 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',
                            padding: isMobileViewport ? 10 : 12,
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return '₱' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.05)', drawBorder: false },
                            ticks: {
                                color: '#9ca3af',
                                maxTicksLimit: isMobileViewport ? 5 : 8,
                                font: { size: isMobileViewport ? 10 : 12 },
                                callback: function (value) { return '₱' + value.toLocaleString(); }
                            }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: {
                                color: '#9ca3af',
                                maxRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: isMobileViewport ? 4 : 7,
                                font: { size: isMobileViewport ? 10 : 12 }
                            }
                        }
                    }
                }
            });

            revenuePeriodButtons.forEach((button) => {
                button.addEventListener('click', function () {
                    updateRevenueChart(this.dataset.revenuePeriod);
                });
            });

            setActiveRevenuePeriod('week');
        }

        // --- "New Sale" Modal Functions ---
        function openSalesModal() {
            document.getElementById('salesModal').classList.add('active');
            
        }

        function closeSalesModal() {
            document.getElementById('salesModal').classList.remove('active');
        }


            // function updateTicketPrice() {
        //     const select = document.getElementById('ticketSelect');
        //     const price = select.value;
        //     document.getElementById('ticketPrice').textContent = price ? parseFloat(price).toFixed(2) : '0.00';
        //     calculateTotal();
        // }

        // function calculateTotal() {
        //     const price = parseFloat(document.getElementById('ticketSelect').value) || 0;
        //     const quantity = parseInt(document.getElementById('quantityInput').value) || 0;
        //     const total = price * quantity;
        //     document.getElementById('totalPrice').textContent = total.toFixed(2);
        // }
    </script>
@include('merchant.component.sales.modal')
@include('merchant.component.sales.view-sales')
@endsection