@extends('layouts')

@section('content')
    <style>
        .control-card {
            transition: all 0.3s ease;
        }

        .control-card:hover {
            transform: translateY(-2px);
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.1);
            transition: 0.3s;
            border-radius: 34px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
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
                                <h2 class="text-2xl font-bold text-white">System Control Panel</h2>
                                <p class="text-sm text-gray-400">Manage ticketing system settings and maintenance</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center gap-2 px-4 py-2 bg-green-500/10 border border-green-500/20 rounded-lg">
                                <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
                                <span class="text-green-400 text-sm font-medium">System Online</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 lg:p-8">

                <!-- Control Panels -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- System Controls -->
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            System Controls
                        </h3>

                        <div class="space-y-4">
                            <form action="">
                                @csrf
                                <!-- Maintenance Mode -->
                                <div
                                    class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-orange-600 to-orange-400 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold">Maintenance Mode</h4>
                                            <p class="text-gray-400 text-sm">Disable public access for system updates</p>
                                        </div>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="maintenanceToggle" {{ $mntnce_mode->value ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
    
                                <!-- Ticket Sales -->
                                <div
                                    class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold">Ticket Sales</h4>
                                            <p class="text-gray-400 text-sm">Enable/disable ticket purchasing</p>
                                        </div>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="ticketSalesToggle" {{ $ticket_sales->value ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
    
                                <!-- User Registration -->
                                <div
                                    class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-400 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold">User Registration</h4>
                                            <p class="text-gray-400 text-sm">Allow new user signups</p>
                                        </div>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="registrationToggle" {{ $user_registration->value ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
    
                                <!-- Email Notifications -->
                                <div
                                    class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10 hover:bg-white/10 transition-all">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-semibold">Email Notifications</h4>
                                            <p class="text-gray-400 text-sm">Send automated email alerts</p>
                                        </div>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="emailToggle" {{ $email_notifications->value ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div
                        class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Quick Actions
                        </h3>

                        <form action="{{ route('admin.control-panel.control') }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <input type="text" id="quick_action" name="quick_action" hidden/>
                                <button
                                    type="submit"
                                    onclick="document.getElementById('quick_action').value = 'restart';"
                                    class="w-full flex items-center gap-3 p-4 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 rounded-xl transition-all text-white font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                    Restart Services
                                </button>

                                <button
                                    type="submit"
                                    onclick="document.getElementById('quick_action').value = 'clear-cache';"
                                    class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                                        </path>
                                    </svg>
                                    Clear Cache
                                </button>

                                <button
                                    type="submit"
                                    onclick="document.getElementById('quick_action').value = 'system-logs';"
                                    class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    View System Logs
                                </button>

                                <button
                                    type="submit"
                                    onclick="document.getElementById('quick_action').value = 'export-reports';"
                                    class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Export Reports
                                </button>

                                <button
                                    type="submit"
                                    onclick="document.getElementById('quick_action').value = 'backup';"
                                    class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                        </path>
                                    </svg>
                                    Backup Database
                                </button>

                                <button
                                    type="submit"
                                    onclick="document.getElementById('quick_action').value = 'shutdown';"
                                    class="w-full flex items-center gap-3 p-4 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 rounded-xl transition-all text-red-400 font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Emergency Shutdown
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- System Status -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        System Status
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="p-4 bg-white/5 rounded-xl border border-white/10">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm">API Status</span>
                                <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
                            </div>
                            <p class="text-white font-semibold text-lg">Online</p>
                        </div>

                        <div class="p-4 bg-white/5 rounded-xl border border-white/10">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm">Database</span>
                                <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
                            </div>
                            <p class="text-white font-semibold text-lg">Connected</p>
                        </div>

                        <div class="p-4 bg-white/5 rounded-xl border border-white/10">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm">Payment Gateway</span>
                                <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
                            </div>
                            <p class="text-white font-semibold text-lg">Active</p>
                        </div>

                        <div class="p-4 bg-white/5 rounded-xl border border-white/10">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-400 text-sm">Email Service</span>
                                <span class="w-2 h-2 bg-green-400 rounded-full pulse-dot"></span>
                            </div>
                            <p class="text-white font-semibold text-lg">Running</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle handlers with confirmation for critical actions
        document.getElementById('maintenanceToggle').addEventListener('change', function () {
            if (this.checked) {
                if (confirm('Are you sure you want to enable maintenance mode? This will disable public access to the ticketing system.')) {
                    console.log('Maintenance mode enabled');
                    // Add your maintenance mode logic here
                } else {
                    this.checked = false;
                }
            } else {
                console.log('Maintenance mode disabled');
                // Add your maintenance mode disable logic here
            }
        });

        document.getElementById('ticketSalesToggle').addEventListener('change', function () {
            console.log('Ticket sales:', this.checked ? 'enabled' : 'disabled');
            // Add your ticket sales toggle logic here
        });

        document.getElementById('registrationToggle').addEventListener('change', function () {
            console.log('User registration:', this.checked ? 'enabled' : 'disabled');
            // Add your registration toggle logic here
        });

        document.getElementById('emailToggle').addEventListener('change', function () {
            console.log('Email notifications:', this.checked ? 'enabled' : 'disabled');
            // Add your email toggle logic here
        });
    </script>
@endsection