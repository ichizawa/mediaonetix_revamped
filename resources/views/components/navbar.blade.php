<!-- Navbar with inline JavaScript -->
<nav class="fixed top-0 left-0 right-0 z-40 lg:left-64 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white transition-colors">
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
                <!-- Notifications -->
                <button class="relative p-2 hover:bg-white/5 rounded-lg text-gray-400 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- System Status -->
                <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-green-500/10 border border-green-500/30 rounded-full">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-green-300 text-sm font-medium">System Online</span>
                </div>

                <!-- User Menu -->
                <div class="relative">
                    <button class="flex items-center gap-3 p-2 hover:bg-white/5 rounded-lg transition-colors">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">A</span>
                        </div>
                        <span class="hidden md:block text-white font-medium">Admin</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>