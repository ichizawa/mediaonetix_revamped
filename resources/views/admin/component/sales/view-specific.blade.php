@extends('layouts')
@section('content')
    <style>
        .tab-button.active {
            background: rgba(59, 130, 246, 0.2);
            color: rgb(96, 165, 250);
            border-color: rgba(59, 130, 246, 0.3);
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <!-- Header -->
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <a href="#" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Sales</a>
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <span class="text-sm text-white">Event Details</span>
                                </div>
                                <h2 class="text-2xl font-bold text-white">{{ $event->event_name }}</h2>
                                <p class="text-sm text-gray-400">View all sales and customer details</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button onclick="openPromoModal()" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <span class="hidden sm:inline">Add Promo</span>
                            </button>
                            <button class="flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
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
                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-blue-500/30 transition-all" onclick="filterSales('walkin')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Walk-in Sales</p>
                            <h3 class="text-3xl font-bold text-white">342</h3>
                            <p class="text-xs text-gray-500 mt-2">$17,850 revenue</p>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-green-500/30 transition-all" onclick="filterSales('online')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-green-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Online Sales</p>
                            <h3 class="text-3xl font-bold text-white">587</h3>
                            <p class="text-xs text-gray-500 mt-2">$28,420 revenue</p>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-yellow-500/30 transition-all" onclick="filterSales('pending')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Pending Sales</p>
                            <h3 class="text-3xl font-bold text-white">45</h3>
                            <p class="text-xs text-gray-500 mt-2">$2,180 pending</p>
                        </div>
                    </div>

                    <div class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden cursor-pointer hover:border-red-500/30 transition-all" onclick="filterSales('disabled')">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-red-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Disabled Sales</p>
                            <h3 class="text-3xl font-bold text-white">23</h3>
                            <p class="text-xs text-gray-500 mt-2">$1,150 canceled</p>
                        </div>
                    </div>
                </div>

                <!-- Sales List -->
                <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-white">Sales List</h3>
                        <div class="flex gap-2">
                            <button class="tab-button active px-4 py-2 text-sm bg-white/5 text-gray-400 rounded-lg font-medium transition-all" onclick="filterSales('all')">All Sales</button>
                            <button class="tab-button px-4 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all" onclick="filterSales('walkin')">Walk-in</button>
                            <button class="tab-button px-4 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all" onclick="filterSales('online')">Online</button>
                            <button class="tab-button px-4 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all" onclick="filterSales('pending')">Pending</button>
                            <button class="tab-button px-4 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all" onclick="filterSales('disabled')">Disabled</button>
                        </div>
                    </div>

                    <!-- Customer Sales Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Date/Time</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Name</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Email</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Contact</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Address</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">City</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Birthdate</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Ticket Type</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Quantity</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Total</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Payment</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Status</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">TXN ID</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Ref Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 15; $i++)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-all">
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div>
                                            <p class="text-white text-sm">Dec {{ $i }}, 2024</p>
                                            <p class="text-gray-400 text-xs">{{ sprintf('%02d', $i) }}:30 PM</p>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-white font-medium text-sm">John Doe {{ $i }}</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-gray-400 text-sm">johndoe{{ $i }}@email.com</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-gray-400 text-sm">+1 555-{{ 1000 + $i }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="text-gray-400 text-sm">{{ $i }}23 Main Street</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-gray-400 text-sm">New York</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-gray-400 text-sm">{{ 1985 + $i }}-05-15</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if($i % 3 == 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                            VIP
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                            Regular
                                        </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-white text-sm font-medium">{{ $i % 5 + 1 }}</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-white font-semibold">${{ 50 + ($i * 15) }}</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if($i % 4 == 0)
                                        <span class="text-gray-400 text-sm">Cash</span>
                                        @elseif($i % 3 == 0)
                                        <span class="text-gray-400 text-sm">PayPal</span>
                                        @else
                                        <span class="text-gray-400 text-sm">Card</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        @if($i % 5 == 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                            Pending
                                        </span>
                                        @elseif($i % 8 == 0)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                                            Disabled
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                                            Completed
                                        </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-white font-mono text-xs">TXN{{ 10000 + $i }}</span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="text-gray-400 font-mono text-xs">REF-{{ 50000 + $i }}</span>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-white/10">
                        <p class="text-sm text-gray-400">Showing 1 to 15 of 342 sales</p>
                        <div class="flex gap-2">
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                                Previous
                            </button>
                            <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg">1</button>
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">2</button>
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">3</button>
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                                Next
                            </button>
                        </div>
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

            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Promo Code</label>
                    <input type="text" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all" placeholder="SUMMER2024" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Discount Type</label>
                    <select class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 transition-all">
                        <option value="percentage">Percentage</option>
                        <option value="fixed">Fixed Amount</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Discount Value</label>
                    <input type="number" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all" placeholder="20" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Valid Until</label>
                    <input type="date" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 transition-all" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Usage Limit</label>
                    <input type="number" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all" placeholder="100" required>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closePromoModal()" class="flex-1 px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-medium transition-all">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-500 hover:to-purple-400 text-white rounded-lg font-semibold transition-all">
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

        function filterSales(type) {
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Add active class to clicked button
            event.target.classList.add('active');

            // Here you would typically filter the table data
            console.log('Filtering sales by:', type);
        }

        // Close modal when clicking outside
        document.getElementById('promoModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closePromoModal();
            }
        });
    </script>
@endsection
