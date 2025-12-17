<aside id="sidebar" class="fixed top-0 left-0 h-screen w-64 bg-gradient-to-b from-[#111827] to-[#0c1222] border-r border-white/10 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-50 overflow-y-auto">
    <div class="flex flex-col h-full">
        <!-- Logo/Brand -->
        <div class="p-6 border-b border-white/10">
            <h1 class="text-2xl font-black text-white">
                MediaOne<span class="bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">TIX</span>
            </h1>
            <p class="text-sm text-gray-400 mt-1">Admin Dashboard</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500/20 border border-blue-500/30 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Overview</span>
            </a>

            <a href="{{ route('admin.events') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.events*') ? 'bg-blue-500/20 border border-blue-500/30 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="font-medium">Events</span>
            </a>

            <a href="{{ route('admin.sales') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.sales*') ? 'bg-blue-500/20 border border-blue-500/30 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
                <span class="font-medium">Sales</span>
            </a>

            <!-- <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.analytics*') ? 'bg-blue-500/20 border border-blue-500/30 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="font-medium">Analytics</span>
            </a> -->

            <a href="{{ route('admin.staffs') }}" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.users*') ? 'bg-blue-500/20 border border-blue-500/30 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <span class="font-medium">Staff</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.orders*') ? 'bg-blue-500/20 border border-blue-500/30 text-blue-400' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="font-medium">Orders</span>
            </a>
        </nav>

        <!-- Bottom Actions -->
        <div class="p-6 space-y-2 border-t border-white/10">
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-gray-400 hover:text-white transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="font-medium">Settings</span>
            </a>
            <form method="POST" action="#">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500/10 text-gray-400 hover:text-red-400 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden hidden"></div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (sidebar && overlay) {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }
</script>