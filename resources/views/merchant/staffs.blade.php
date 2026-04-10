@extends('layouts')
@section('content')
    <style>
        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
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
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
                            <button id="toggleSidebar" class="lg:hidden p-2 hover:bg-white/5 rounded-lg text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h2 class="text-2xl font-bold text-white">Staff Management</h2>
                                <p class="text-sm text-gray-400">Manage your team and access credentials</p>
                            </div>
                        </div>

                        <button id="addStaffBtn"
                            class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Staff
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <!-- Stat Card 1 -->
                    <div
                        class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Staff</p>
                            <h3 class="text-3xl font-bold text-white">{{ $users->count() }}</h3>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div
                        class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-green-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Active Now</p>
                            <h3 class="text-3xl font-bold text-white">{{ $active }}</h3>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div
                        class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-purple-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Scans Today</p>
                            <h3 class="text-3xl font-bold text-white">{{ $scans }}</h3>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div
                        class="stat-card relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-24 h-24 bg-blue-500 rounded-full filter blur-[60px] opacity-20">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-400 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Access Passes</p>
                            <h3 class="text-3xl font-bold text-white">{{ $access }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Staff List -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">
                    <!-- Search and Filter -->
                    <div class="p-6 border-b border-white/10">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-1 relative">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <input type="text" placeholder="Search staff..."
                                    class="w-full pl-10 pr-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50">
                            </div>
                            <select
                                class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500/50">
                                <option>All Roles</option>
                                <option>Scanner</option>
                                <option>Manager</option>
                                <option>Admin</option>
                            </select>
                            <select
                                class="px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500/50">
                                <option>All Status</option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Staff Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Staff Member</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Role</th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Last Active</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Scans Today</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">

                                @forelse($users as $staffs)
                                    <!-- Staff Row 1 -->
                                    <tr class="hover:bg-white/5 transition-all">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-full flex items-center justify-center text-white font-semibold">
                                                    JD
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-white">{{ $staffs->name }}</p>
                                                    <p class="text-sm text-gray-400">{{ $staffs->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400">
                                                {{ $staffs->role->name }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="text-sm text-gray-300">{{ $staffs->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="px-6 py-4 ">
                                            <span
                                                class="text-sm  font-semibold text-white">{{ $staffs->scans_today ?? 0 }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400">
                                                <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                                                {{ $staffs->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <button
                                                    class="p-1.5 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button
                                                    class="p-1.5 hover:bg-white/10 rounded-lg text-gray-400 hover:text-red-400 transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="9" class="py-4 px-4">
                                            <p class="text-white text-sm">No staff members found.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-white/10 flex items-center justify-between">
                        <p class="text-sm text-gray-400">Showing 1 to 4 of 24 staff members</p>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-white hover:bg-white/10 transition-all disabled:opacity-50"
                                disabled>
                                Previous
                            </button>
                            <button
                                class="px-3 py-1 bg-blue-600 border border-blue-500 rounded-lg text-white hover:bg-blue-500 transition-all">
                                1
                            </button>
                            <button
                                class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-white hover:bg-white/10 transition-all">
                                2
                            </button>
                            <button
                                class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-white hover:bg-white/10 transition-all">
                                3
                            </button>
                            <button
                                class="px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-white hover:bg-white/10 transition-all">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Staff Modal -->
    <div id="addStaffModal" class="modal">
        <div
            class="modal-content w-full max-w-2xl mx-4 bg-gradient-to-br from-[#1a2234] to-[#0c1222] border border-white/10 rounded-2xl shadow-2xl">
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-white">Add New Staff Member</h3>
                    <button id="closeModal"
                        class="p-2 hover:bg-white/10 rounded-lg text-gray-400 hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <form class="p-6 space-y-6" id="staffForm" action="{{ route('merchant.organizers.store') }}" method="POST"
                class="space-y-4" enctype="multipart/form-data">
                @csrf
                <!-- Personal Information -->
                <div>

                    <h4 class="text-lg font-semibold text-white mb-4">Personal Information</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">First Name</label>
                            <input type="text" name="first_name"
                                class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Last Name</label>
                            <input type="text" name="last_name"
                                class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                                placeholder="Doe" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email"
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                            placeholder="john.doe@example.com" required>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Phone Number</label>
                        <input type="tel" name="phone_number"
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                            placeholder="+1 (555) 000-0000" required>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                            <input type="text" name="username"
                                class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                                placeholder="username" required>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                                placeholder="Enter password" required>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Event</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Assign to Event</label>
                            <select name="event_id"
                                class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500/50">
                                <option value="">Select an event</option>
                                @if (isset($events) && count($events))
                                    @foreach ($events as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                @else
                                    <option value="">No events available</option>
                                @endif
                            </select>
                        </div>

                    </div>
                </div>


                <!-- Role & Access -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Access & Permission</h4>

                </div>

                <!-- Access Pin -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Security</h4>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Access PIN (4-6 digits)</label>
                        <input type="password" maxlength="6" name="security_pin"
                            class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500/50"
                            placeholder="Enter PIN" required>
                        <p class="mt-2 text-xs text-gray-400">This PIN will be used for QR code scanner authentication
                        </p>
                    </div>
                </div>

                <!-- Permissions -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Permissions</h4>
                    <div class="space-y-3">
                        <label
                            class="flex items-center gap-3 p-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-all">
                            <input type="checkbox" name="permission_name[]"
                                class="w-5 h-5 rounded border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 bg-white/5"
                                value="scan_tickets">
                            <div class="flex-1">
                                <p class="text-white font-medium">Scan Tickets</p>
                                <p class="text-xs text-gray-400">Allow scanning QR codes for ticket validation</p>
                            </div>
                        </label>
                        <label
                            class="flex items-center gap-3 p-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-all">
                            <input type="checkbox" name="permission_name[]"
                                class="w-5 h-5 rounded border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 bg-white/5"
                                value="view_reports">
                            <div class="flex-1">
                                <p class="text-white font-medium">View Reports</p>
                                <p class="text-xs text-gray-400">Access to scanning reports and analytics</p>
                            </div>
                        </label>
                        <label
                            class="flex items-center gap-3 p-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-all">
                            <input type="checkbox" name="permission_name[]"
                                class="w-5 h-5 rounded border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 bg-white/5"
                                value="manage_events">
                            <div class="flex-1">
                                <p class="text-white font-medium">Manage Events</p>
                                <p class="text-xs text-gray-400">Create and modify events</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4">
                    <button type="button" id="cancelBtn"
                        class="flex-1 px-6 py-3 bg-white/5 border border-white/10 rounded-lg text-white font-semibold hover:bg-white/10 transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-semibold rounded-lg transition-all">
                        Add Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const addStaffBtn = document.getElementById('addStaffBtn');
        const addStaffModal = document.getElementById('addStaffModal');
        const closeModal = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelBtn');





        addStaffBtn.addEventListener('click', () => {


            addStaffModal.classList.add('active');

            console.log('Opening modal...');
            const modal = document.getElementById('addStaff Modal');
            const modalContent = document.getElementById('modalContent');

            if (modal && modalContent) {
                modal.style.display = 'block';
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                // Trigger animation
                setTimeout(() => {
                    modalContent.style.opacity = '1';
                    modalContent.style.transform = 'scale(1)';
                }, 10);
            } else {
                console.error('Modal elements not found');
            }
        });



        closeModal.addEventListener('click', () => {
            addStaffModal.classList.remove('active');
        });

        cancelBtn.addEventListener('click', () => {
            addStaffModal.classList.remove('active');
        });

        addStaffModal.addEventListener('click', (e) => {
            if (e.target === addStaffModal) {
                addStaffModal.classList.remove('active');
            }
        });

        const params = new URLSearchParams(window.location.search);
        if (params.get('add') === '1' && addStaffModal) {
            setTimeout(() => addStaffModal.classList.add('active'), 200);
        }
    </script>
@endsection
