@extends('layouts')
@section('content')
    <style>
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
        }
        .progress-bar {
            transition: width 1s ease;
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <!-- Main Content -->
        <div class="lg:ml-64">
            <!-- Header -->
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button id="openSidebar" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Dashboard</h2>
                                <p class="text-sm text-gray-400">Welcome back, Admin</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-green-500/10 border border-green-500/30 rounded-full">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-green-300 text-sm font-medium">System Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <!-- Stat Card 1 -->
                    <div class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +12.5%
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Revenue</p>
                            <h3 class="text-3xl font-bold text-white">$48,521</h3>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +8.2%
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Tickets Sold</p>
                            <h3 class="text-3xl font-bold text-white">1,247</h3>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    +3
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Active Events</p>
                            <h3 class="text-3xl font-bold text-white">23</h3>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500 rounded-full filter blur-[60px] opacity-20"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +15.3%
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Users</p>
                            <h3 class="text-3xl font-bold text-white">8,492</h3>
                        </div>
                    </div>
                </div>

                <!-- Two Column Layout -->
                <div class="grid lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Events -->
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-white">Recent Events</h3>
                            <a href="#" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View All</a>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">Electronic Paradise</h4>
                                    <p class="text-sm text-gray-400">Aug 15, 2024</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-400 mb-1">342 / 500 sold</p>
                                    <div class="w-24 h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="progress-bar h-full bg-gradient-to-r from-blue-600 to-blue-400" style="width: 68%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">Rock The Night</h4>
                                    <p class="text-sm text-gray-400">Sep 20, 2024</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-400 mb-1">198 / 300 sold</p>
                                    <div class="w-24 h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="progress-bar h-full bg-gradient-to-r from-purple-600 to-purple-400" style="width: 66%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">Smooth Jazz Night</h4>
                                    <p class="text-sm text-gray-400">Oct 5, 2024</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-400 mb-1">156 / 200 sold</p>
                                    <div class="w-24 h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="progress-bar h-full bg-gradient-to-r from-blue-600 to-blue-400" style="width: 78%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">Summer Fest</h4>
                                    <p class="text-sm text-gray-400">Jul 28, 2024</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-400 mb-1">289 / 400 sold</p>
                                    <div class="w-24 h-2 bg-gray-700 rounded-full overflow-hidden">
                                        <div class="progress-bar h-full bg-gradient-to-r from-purple-600 to-purple-400" style="width: 72%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-white">Recent Orders</h3>
                            <a href="#" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View All</a>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">#TIX-1247</h4>
                                    <p class="text-sm text-gray-400">John Smith</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-white mb-1">$178</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400">Completed</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">#TIX-1246</h4>
                                    <p class="text-sm text-gray-400">Sarah Johnson</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-white mb-1">$250</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400">Completed</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">#TIX-1245</h4>
                                    <p class="text-sm text-gray-400">Mike Wilson</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-white mb-1">$130</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400">Pending</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-white mb-1">#TIX-1244</h4>
                                    <p class="text-sm text-gray-400">Emily Brown</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-white mb-1">$356</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400">Completed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <h3 class="text-xl font-bold text-white mb-6">Quick Actions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <button class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-blue-600/20 to-blue-400/10 border border-blue-500/30 rounded-xl hover:border-blue-500/50 transition-all group">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Create Event</span>
                        </button>

                        <button class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-purple-600/20 to-purple-400/10 border border-purple-500/30 rounded-xl hover:border-purple-500/50 transition-all group">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Sell Tickets</span>
                        </button>

                        <button class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-blue-600/20 to-blue-400/10 border border-blue-500/30 rounded-xl hover:border-blue-500/50 transition-all group">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">View Reports</span>
                        </button>

                        <button class="flex flex-col items-center justify-center p-6 bg-gradient-to-br from-purple-600/20 to-purple-400/10 border border-purple-500/30 rounded-xl hover:border-purple-500/50 transition-all group">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <span class="text-white font-semibold">Manage Users</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection