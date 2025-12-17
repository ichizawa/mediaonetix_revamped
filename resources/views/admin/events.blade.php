@extends('layouts')
@section('content')
    <style>
        .event-card {
            transition: all 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-4px);
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(8px);
            z-index: 50;
        }
        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            max-height: 90vh;
            overflow-y: auto;
        }
        .tab-btn {
            background: transparent;
            color: #9ca3af;
        }
        .tab-btn.active {
            background: linear-gradient(to right, rgba(59, 130, 246, 0.2), rgba(147, 51, 234, 0.2));
            color: white;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
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
                                <h2 class="text-2xl font-bold text-white">Events Management</h2>
                                <p class="text-sm text-gray-400">Manage and create your events</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button onclick="openModal()" class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span class="hidden sm:inline">Add Event</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Total Events</p>
                        <h3 class="text-3xl font-bold text-white">23</h3>
                    </div>
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Active Events</p>
                        <h3 class="text-3xl font-bold text-white">18</h3>
                    </div>
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Tickets Sold</p>
                        <h3 class="text-3xl font-bold text-white">1,247</h3>
                    </div>
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-400 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm mb-1">Upcoming</p>
                        <h3 class="text-3xl font-bold text-white">12</h3>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                    <button class="tab-btn active px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">All Events</button>
                    <button class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Upcoming</button>
                    <button class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Ongoing</button>
                    <button class="tab-btn px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap">Completed</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for($i = 0; $i < 6; $i++)
                    <div class="event-card bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                        <div class="relative h-48 bg-gradient-to-br from-blue-600/20 to-purple-600/20">
                            <div class="absolute inset-0 bg-cover bg-center opacity-40"></div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-green-500/20 backdrop-blur-sm border border-green-500/30 rounded-full text-xs font-semibold text-green-400">Active</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-gray-400">August 15, 2024 • 8:00 PM</span>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Event Name {{ $i + 1 }}</h3>
                            <p class="text-gray-400 text-sm mb-4">Event description goes here</p>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-400">Event Location</span>
                            </div>
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-400">342 / 500 sold</span>
                                    <span class="text-blue-400 font-semibold">68%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-600 to-blue-400 transition-all" style="width: 68%"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-white/10">
                                <div>
                                    <p class="text-sm text-gray-400">Starting from</p>
                                    <p class="text-xl font-bold text-white">$45</p>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button class="p-2 bg-white/5 hover:bg-white/10 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all">
                                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div id="eventModal" class="modal">
        <div class="modal-content w-full max-w-2xl mx-4 bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white">Add New Event</h3>
                <button onclick="closeModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Event Name</label>
                        <input type="text" name="name" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <select name="category" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                            <option>Music</option>
                            <option>Sports</option>
                            <option>Arts</option>
                            <option>Festival</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                        <input type="date" name="date" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Time</label>
                        <input type="time" name="time" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                    <input type="text" name="location" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Total Tickets</label>
                        <input type="number" name="total_tickets" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Price ($)</label>
                        <input type="number" name="price" step="0.01" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Event Image</label>
                    <input type="file" name="image" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                        Create Event
                    </button>
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('eventModal').classList.add('active');
        }
        function closeModal() {
            document.getElementById('eventModal').classList.remove('active');
        }
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
@endsection