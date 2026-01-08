@extends('layouts')
@include('admin.component.merchant.view')
@include('admin.component.merchant.add')

@section('content')
    <style>
        .merchant-card {
            transition: all 0.3s ease;
        }

        .merchant-card:hover {
            transform: translateY(-2px);
        }

        .status-badge {
            transition: all 0.2s ease;
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <!-- Header -->
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button id="openSidebar" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Merchant Management</h2>
                                <p class="text-sm text-gray-400">Manage and monitor all registered merchants</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button
                                class="flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Export</span>
                            </button>
                            <button onclick="openAddMerchantModal()" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="hidden sm:inline">Add Merchant</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Stats Overview -->
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
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +12
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Merchants</p>
                            <h3 class="text-3xl font-bold text-white">{{ $users->count()}}</h3>
                            <p class="text-xs text-gray-500 mt-2">Registered merchants</p>
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
                                <span class="text-green-400 text-sm font-semibold">94.3%</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Active Merchants</p>
                            <h3 class="text-3xl font-bold text-white">{{ $active }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Currently active</p>
                        </div>
                    </div>

                    <div
                        class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-yellow-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-yellow-400 text-sm font-semibold">8</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Pending Review</p>
                            <h3 class="text-3xl font-bold text-white">{{ $pending }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Awaiting approval</p>
                        </div>
                    </div>

                    <div
                        class="relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-red-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-red-600 to-red-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-red-400 text-sm font-semibold">6</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Inactive</p>
                            <h3 class="text-3xl font-bold text-white">{{ $inactive }}</h3>
                            <p class="text-xs text-gray-500 mt-2">Suspended/Inactive</p>
                        </div>
                    </div>
                </div>

                <!-- Merchants Table -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <h3 class="text-xl font-bold text-white">All Merchants</h3>

                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <!-- Search -->
                            <div class="relative">
                                <input type="text" placeholder="Search merchants..."
                                    class="w-full sm:w-64 px-4 py-2 pl-10 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- Filter Buttons -->
                            <div class="flex gap-2">
                                <button
                                    class="px-3 py-2 text-sm bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-lg font-medium">All</button>
                                <button
                                    class="px-3 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all">Active</button>
                                <button
                                    class="px-3 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all">Pending</button>
                                <button
                                    class="px-3 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all">Inactive</button>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Merchant ID</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Business Name</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Contact Person</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Email</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Phone</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Events</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Revenue</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Status</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $merchant)
                                    <tr class="border-b border-white/5 hover:bg-white/5 transition-all">
                                        <td class="py-4 px-4">
                                            <span class="text-white font-mono text-sm">{{ $merchant['id'] }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold">
                                                    {{ strtoupper(substr($merchant['name'], 0, 1)) }}
                                                </div>
                                                <span class="text-white font-medium text-sm">{{ $merchant['name'] }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-white text-sm">{{ $merchant['first_name'] }} {{ $merchant['last_name'] }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-gray-400 text-sm">{{ $merchant['email'] }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-gray-400 text-sm">{{ $merchant['phone_number'] }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="text-white font-semibold text-sm">{{ $merchant['events_count'] }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="text-white font-semibold">${{ number_format($merchant['revenue']) }}</span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-{{ $merchant->status['color'] }}-500/10 text-{{ $merchant->status['color'] }}-400 border border-{{ $merchant->status['color'] }}-500/20">
                                                <span class="w-1.5 h-1.5 bg-{{ $merchant->status['color'] }}-400 rounded-full mr-1.5"></span>
                                                {{ $merchant->status['label'] }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex gap-2">
                                                <button
                                                    onclick="openMerchantModal('{{ $merchant }}')"
                                                    class="p-1.5 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/20 rounded-lg transition-all group">
                                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button class="p-1.5 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button
                                                    class="p-1.5 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 rounded-lg transition-all">
                                                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <a href="{{ route('admin.merchants.files', $merchant['id']) }}"
                                                    class="p-1.5 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="py-4 px-4">
                                            <p class="text-white text-sm">No merchants found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
