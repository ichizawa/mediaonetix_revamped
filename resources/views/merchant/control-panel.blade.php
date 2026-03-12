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

    /* Coming Soon Editor */
    .editor-tabs button.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border-bottom: 2px solid #3b82f6;
    }

    #coming-soon-code {
        font-family: 'Fira Code', 'Cascadia Code', 'Courier New', monospace;
        font-size: 13px;
        line-height: 1.6;
        resize: none;
        tab-size: 2;
        outline: none;
        caret-color: #60a5fa;
    }

    #coming-soon-code:focus {
        box-shadow: inset 0 0 0 1px rgba(96, 165, 250, 0.4);
    }

    .preview-device-btn.active {
        background-color: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        border-color: rgba(59, 130, 246, 0.4);
    }

    #preview-wrapper {
        transition: all 0.3s ease;
    }

    #preview-wrapper.device-desktop {
        width: 100%;
    }

    #preview-wrapper.device-tablet {
        width: 768px;
        margin: 0 auto;
    }

    #preview-wrapper.device-mobile {
        width: 375px;
        margin: 0 auto;
    }

    .editor-line-nums {
        counter-reset: line;
        width: 36px;
        text-align: right;
        padding-right: 10px;
        color: rgba(255, 255, 255, 0.15);
        font-family: 'Fira Code', monospace;
        font-size: 13px;
        line-height: 1.6;
        user-select: none;
        overflow: hidden;
    }

    .save-btn-pulse {
        animation: savePulse 0.6s ease;
    }

    @keyframes savePulse {
        0% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
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
                        <!-- ComingSoon Mode -->
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
                                    <h4 class="text-white font-semibold">Coming Soon Mode</h4>
                                    <p class="text-gray-400 text-sm">Show the coming soon page</p>
                                </div>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" name="coming_soon_mode" id="comingSoonToggle" {{ $coming_soon_mode?->value ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

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
                                <input type="checkbox" name="maintenance_mode" id="maintenanceToggle" {{ $mntnce_mode->value ? 'checked' : '' }}>
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
                                <input type="checkbox" name="ticket_sales" id="ticketSalesToggle" {{ $ticket_sales->value ? 'checked' : '' }}>
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
                                <input type="checkbox" name="user_registration" id="registrationToggle" {{ $user_registration->value ? 'checked' : '' }}>
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
                                <input type="checkbox" name="email_notifications" id="emailToggle" {{ $email_notifications->value ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
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
                            <input type="text" id="quick_action" name="quick_action" hidden />
                            <button type="submit" onclick="document.getElementById('quick_action').value = 'restart';"
                                class="w-full flex items-center gap-3 p-4 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 rounded-xl transition-all text-white font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Restart Services
                            </button>

                            <button type="submit"
                                onclick="document.getElementById('quick_action').value = 'clear-cache';"
                                class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                                    </path>
                                </svg>
                                Clear Cache
                            </button>

                            <button type="submit"
                                onclick="document.getElementById('quick_action').value = 'system-logs';"
                                class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                View System Logs
                            </button>

                            <button type="submit"
                                onclick="document.getElementById('quick_action').value = 'export-reports';"
                                class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Export Reports
                            </button>

                            <button type="submit" onclick="document.getElementById('quick_action').value = 'backup';"
                                class="w-full flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-all text-white font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                    </path>
                                </svg>
                                Backup Database
                            </button>

                            <button type="submit" onclick="document.getElementById('quick_action').value = 'shutdown';"
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
                class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6 mb-8">
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

            <!-- =============================================
                                             COMING SOON PAGE EDITOR
                                             ============================================= -->
            <div
                class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl overflow-hidden">

                <!-- Editor Header -->
                <div
                    class="px-6 py-4 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-cyan-600 to-blue-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Coming Soon Page Editor</h3>
                            <p class="text-gray-400 text-sm">Edit the custom HTML shown during maintenance mode</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Unsaved indicator -->
                        <span id="unsaved-badge"
                            class="hidden items-center gap-1.5 px-3 py-1 bg-amber-500/10 border border-amber-500/30 rounded-full text-amber-400 text-xs font-medium">
                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full"></span>
                            Unsaved changes
                        </span>

                        <!-- Save button -->
                        <button id="saveComingSoonBtn"
                            class="flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white font-semibold rounded-xl transition-all text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Save Page
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex border-b border-white/10 editor-tabs px-6 gap-1 pt-2">
                    <button id="tab-editor" onclick="switchTab('editor')"
                        class="active px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors rounded-t-lg">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Editor
                        </span>
                    </button>
                    <button id="tab-preview" onclick="switchTab('preview')"
                        class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors rounded-t-lg">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                            Preview
                        </span>
                    </button>
                    <button id="tab-split" onclick="switchTab('split')"
                        class="px-4 py-2 text-sm text-gray-400 hover:text-white transition-colors rounded-t-lg">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7">
                                </path>
                            </svg>
                            Split
                        </span>
                    </button>
                </div>

                <!-- Editor Body -->
                <div class="p-4">

                    <!-- Toolbar -->
                    <div class="flex flex-wrap items-center gap-2 mb-3 px-1">
                        <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Insert:</span>
                        <button onclick="insertSnippet('heading')"
                            class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-gray-300 transition-colors">H1</button>
                        <button onclick="insertSnippet('countdown')"
                            class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-gray-300 transition-colors">Countdown</button>
                        <button onclick="insertSnippet('email-form')"
                            class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-gray-300 transition-colors">Email
                            Form</button>
                        <button onclick="insertSnippet('progress')"
                            class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-gray-300 transition-colors">Progress
                            Bar</button>
                        <button onclick="insertSnippet('social')"
                            class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-gray-300 transition-colors">Social
                            Links</button>

                        <div class="ml-auto flex items-center gap-1">
                            <button onclick="formatCode()" title="Format HTML"
                                class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-gray-300 transition-colors flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h8m-8 6h16"></path>
                                </svg>
                                Format
                            </button>
                            <button onclick="resetToDefault()" title="Reset to default template"
                                class="px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-white/10 rounded-md text-xs text-red-400 transition-colors">
                                Reset
                            </button>
                        </div>
                    </div>

                    <!-- Editor + Preview layout -->
                    <div id="editor-area" class="flex gap-4" style="min-height: 480px;">

                        <!-- Code Editor Panel -->
                        <div id="editor-panel"
                            class="flex-1 flex rounded-xl overflow-hidden border border-white/10 bg-[#0d1117]"
                            style="min-height: 480px;">
                            <!-- Line Numbers -->
                            <div id="line-numbers"
                                class="editor-line-nums py-4 pl-3 select-none bg-[#0d1117] border-r border-white/5 text-right"
                                style="min-width:40px;"></div>
                            <!-- Textarea -->
                            <textarea id="coming-soon-code" name="coming_soon_html"
                                class="flex-1 bg-[#0d1117] text-gray-200 p-4 w-full h-full border-none"
                                spellcheck="false" placeholder="Enter your custom HTML for the Coming Soon page..."
                                style="min-height: 480px;">{{ $coming_soon_html ?? '' }}</textarea>
                        </div>

                        <!-- Preview Panel -->
                        <div id="preview-panel"
                            class="hidden flex-1 flex-col rounded-xl overflow-hidden border border-white/10 bg-[#111827]"
                            style="min-height: 480px;">
                            <!-- Preview toolbar -->
                            <div
                                class="flex items-center justify-between px-4 py-2 bg-[#0d1117] border-b border-white/10">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-3 h-3 rounded-full bg-red-500/60"></span>
                                    <span class="w-3 h-3 rounded-full bg-yellow-500/60"></span>
                                    <span class="w-3 h-3 rounded-full bg-green-500/60"></span>
                                </div>
                                <span class="text-xs text-gray-500 font-medium">Live Preview</span>
                                <!-- Device switcher -->
                                <div class="flex items-center gap-1">
                                    <button onclick="setDevice('desktop')" id="dev-desktop" title="Desktop"
                                        class="preview-device-btn active p-1.5 rounded border border-white/10 text-gray-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button onclick="setDevice('tablet')" id="dev-tablet" title="Tablet"
                                        class="preview-device-btn p-1.5 rounded border border-white/10 text-gray-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button onclick="setDevice('mobile')" id="dev-mobile" title="Mobile"
                                        class="preview-device-btn p-1.5 rounded border border-white/10 text-gray-400 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- iframe wrapper for device simulation -->
                            <div class="flex-1 overflow-auto p-3 bg-[#111827]">
                                <div id="preview-wrapper" class="device-desktop h-full transition-all duration-300">
                                    <iframe id="preview-frame" class="w-full h-full rounded-lg border border-white/10"
                                        style="min-height: 420px;" sandbox="allow-scripts"></iframe>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Character / line count -->
                    <div class="flex items-center justify-between mt-2 px-1">
                        <span id="code-stats" class="text-xs text-gray-600">0 lines · 0 characters</span>
                        <span class="text-xs text-gray-600">HTML · UTF-8</span>
                    </div>
                </div>
            </div>
            <!-- END COMING SOON EDITOR -->

        </div>
    </div>
</div>

<script>
    /* ==================== TOGGLE HANDLERS ==================== */
    function apicall(data) {
        $.ajax({
            url: "{{ route('admin.control-panel.quick-action') }}"
            , data: data
            , type: 'POST'
            , success: function (response) {
                console.log(response);
            }
            , error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    // comingSoonToggle
    document.getElementById('comingSoonToggle').addEventListener('change', function () {
        if (this.checked) {
            if (confirm('Are you sure you want to enable coming soon mode? This will show the coming soon page as its landing page.')) {
                apicall({
                    type: 'coming_soon'
                    , coming_soon: true
                    , _token: '{{ csrf_token() }}'
                });
            } else {
                this.checked = false;
            }
        } else {
            apicall({
                type: 'coming_soon'
                , coming_soon: false
                , _token: '{{ csrf_token() }}'
            });
        }
    });

    document.getElementById('maintenanceToggle').addEventListener('change', function () {
        if (this.checked) {
            if (confirm('Are you sure you want to enable maintenance mode? This will disable public access to the ticketing system.')) {
                apicall({
                    type: 'maintenance'
                    , maintenance_mode: true
                    , _token: '{{ csrf_token() }}'
                });
            } else {
                this.checked = false;
            }
        } else {
            apicall({
                type: 'maintenance'
                , maintenance_mode: false
                , _token: '{{ csrf_token() }}'
            });
        }
    });

    document.getElementById('ticketSalesToggle').addEventListener('change', function () {
        apicall({
            type: 'ticket_sales'
            , ticket_sales: this.checked
            , _token: '{{ csrf_token() }}'
        });
    });

    document.getElementById('registrationToggle').addEventListener('change', function () {
        apicall({
            type: 'user_registration'
            , user_registration: this.checked
            , _token: '{{ csrf_token() }}'
        });
    });

    document.getElementById('emailToggle').addEventListener('change', function () {
        apicall({
            type: 'email_notifications'
            , email_notifications: this.checked
            , _token: '{{ csrf_token() }}'
        });
    });

    /* ==================== COMING SOON EDITOR ==================== */
    const codeEditor = document.getElementById('coming-soon-code');
    const lineNumbers = document.getElementById('line-numbers');
    const previewFrame = document.getElementById('preview-frame');
    const unsavedBadge = document.getElementById('unsaved-badge');
    let currentTab = 'split';
    let previewDebounce;

    // Default template
    const defaultTemplate = `<!DOCTYPE html>
            <html lang="en">
              <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Coming Soon</title>
                <style>
                    * { margin: 0; padding: 0; box-sizing: border-box; }
                    body {
                        min-height: 100vh;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        background: #0c1222;
                        font-family: 'Segoe UI', sans-serif;
                        color: #fff;
                        text-align: center;
                        padding: 2rem;
                    }
                    .container { max-width: 560px; }
                    h1 { font-size: 3rem; font-weight: 800; margin-bottom: 1rem; background: linear-gradient(135deg, #60a5fa, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
                    p  { color: #9ca3af; font-size: 1.1rem; margin-bottom: 2rem; line-height: 1.6; }
                    .badge { display: inline-block; padding: .4rem 1rem; border: 1px solid rgba(96,165,250,.3); border-radius: 999px; color: #60a5fa; font-size: .85rem; margin-bottom: 1.5rem; }
                </style>
              </head>
              <body>
                <div class="container">
                  <div class="badge">🚧 Under Maintenance</div>
                  <h1>Coming Soon</h1>
                  <p>We're working hard to bring you something amazing. Check back shortly!</p>
                </div>
              </body>
            </html>`;

    // Init editor
    if (!codeEditor.value.trim()) {
        codeEditor.value = defaultTemplate;
    }
    formatCode();
    updateLineNumbers();
    updateStats();
    switchTab('split');
    // Line numbers
    function updateLineNumbers() {
        const lines = codeEditor.value.split('\n').length;
        lineNumbers.innerHTML = Array.from({
            length: lines
        }, (_, i) => `<div>${i + 1}</div>`).join('');
    }

    // Stats
    function updateStats() {
        const lines = codeEditor.value.split('\n').length;
        const chars = codeEditor.value.length;
        document.getElementById('code-stats').textContent = `${lines} lines · ${chars.toLocaleString()} characters`;
    }

    // Sync line number scroll
    codeEditor.addEventListener('scroll', () => {
        lineNumbers.scrollTop = codeEditor.scrollTop;
    });

    // Track changes
    codeEditor.addEventListener('input', () => {
        updateLineNumbers();
        updateStats();
        unsavedBadge.classList.remove('hidden');
        unsavedBadge.classList.add('flex');

        // Debounced preview refresh
        clearTimeout(previewDebounce);
        previewDebounce = setTimeout(() => {
            if (currentTab === 'preview' || currentTab === 'split') refreshPreview();
        }, 500);
    });

    // Tab key support
    codeEditor.addEventListener('keydown', (e) => {
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = codeEditor.selectionStart;
            const end = codeEditor.selectionEnd;
            codeEditor.value = codeEditor.value.substring(0, start) + '  ' + codeEditor.value.substring(end);
            codeEditor.selectionStart = codeEditor.selectionEnd = start + 2;
            updateLineNumbers();
        }
    });

    // Tab switcher
    function switchTab(tab) {
        currentTab = tab;
        const editorPanel = document.getElementById('editor-panel');
        const previewPanel = document.getElementById('preview-panel');

        ['editor', 'preview', 'split'].forEach(t => {
            document.getElementById('tab-' + t).classList.remove('active');
        });
        document.getElementById('tab-' + tab).classList.add('active');

        if (tab === 'editor') {
            editorPanel.classList.remove('hidden');
            editorPanel.style.flex = '1';
            previewPanel.classList.add('hidden');
        } else if (tab === 'preview') {
            editorPanel.classList.add('hidden');
            previewPanel.classList.remove('hidden');
            previewPanel.classList.add('flex');
            previewPanel.style.flex = '1';
            refreshPreview();
        } else { // split
            editorPanel.classList.remove('hidden');
            editorPanel.style.flex = '1';
            previewPanel.classList.remove('hidden');
            previewPanel.classList.add('flex');
            previewPanel.style.flex = '1';
            refreshPreview();
        }
    }

    // Refresh iframe
    function refreshPreview() {
        const blob = new Blob([codeEditor.value], {
            type: 'text/html'
        });
        previewFrame.src = URL.createObjectURL(blob);
    }

    // Device switcher
    function setDevice(device) {
        document.getElementById('preview-wrapper').className = 'device-' + device + ' transition-all duration-300';
        ['desktop', 'tablet', 'mobile'].forEach(d => {
            document.getElementById('dev-' + d).classList.remove('active');
        });
        document.getElementById('dev-' + device).classList.add('active');
    }

    // Snippets
    const snippets = {
        heading: `<h1 style="font-size:2.5rem;font-weight:800;color:#fff;">Coming Soon</h1>\n`
        , countdown: `<div id="countdown" style="display:flex;gap:1rem;justify-content:center;font-size:2rem;font-weight:700;color:#60a5fa;margin:2rem 0;"></div>
                        <script>
                          (function(){
                            var target = new Date();
                            target.setDate(target.getDate() + 7);
                            function tick(){
                              var diff = target - new Date();
                              if(diff < 0){ document.getElementById('countdown').textContent='Launched!'; return; }
                              var d=Math.floor(diff/86400000), h=Math.floor((diff%86400000)/3600000),
                                  m=Math.floor((diff%3600000)/60000), s=Math.floor((diff%60000)/1000);
                              document.getElementById('countdown').innerHTML =
                                '<span>'+d+'d</span><span>'+h+'h</span><span>'+m+'m</span><span>'+s+'s</span>';
                              setTimeout(tick,1000);
                            }
                            tick();
                          })();
                        <\/script>`
        , 'email-form': `<form onsubmit="return false;" style="display:flex;gap:.5rem;max-width:400px;margin:0 auto;">
                          <input type="email" placeholder="Enter your email" style="flex:1;padding:.75rem 1rem;border-radius:.5rem;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.05);color:#fff;outline:none;" />
                          <button type="submit" style="padding:.75rem 1.5rem;background:#3b82f6;color:#fff;border:none;border-radius:.5rem;cursor:pointer;font-weight:600;">Notify Me</button>
                        </form>`
        , progress: `<div style="max-width:400px;margin:1.5rem auto;">
                          <div style="display:flex;justify-content:space-between;color:#9ca3af;font-size:.85rem;margin-bottom:.5rem;">
                            <span>Progress</span><span>75%</span>
                          </div>
                          <div style="height:8px;background:rgba(255,255,255,.1);border-radius:999px;overflow:hidden;">
                            <div style="height:100%;width:75%;background:linear-gradient(90deg,#3b82f6,#8b5cf6);border-radius:999px;"></div>
                          </div>
                        </div>`
        , social: `<div style="display:flex;gap:1rem;justify-content:center;margin-top:2rem;">
                          <a href="#" style="color:#9ca3af;text-decoration:none;font-size:.9rem;">Twitter</a>
                          <a href="#" style="color:#9ca3af;text-decoration:none;font-size:.9rem;">Instagram</a>
                          <a href="#" style="color:#9ca3af;text-decoration:none;font-size:.9rem;">Facebook</a>
                        </div>`
        ,
    };

    function insertSnippet(key) {
        const snippet = snippets[key];
        if (!snippet) return;
        const start = codeEditor.selectionStart;
        codeEditor.value = codeEditor.value.substring(0, start) + snippet + codeEditor.value.substring(codeEditor.selectionEnd);
        codeEditor.selectionStart = codeEditor.selectionEnd = start + snippet.length;
        codeEditor.focus();
        updateLineNumbers();
        updateStats();
        unsavedBadge.classList.remove('hidden');
        unsavedBadge.classList.add('flex');
    }

    function formatCode() {
        let html = codeEditor.value;

        // First, format CSS inside <style> tags
        html = html.replace(/<style>([\s\S]*?)<\/style>/gi, function (match, css) {
            let formatted = css
                .replace(/\s*{\s*/g, ' {\n')
                .replace(/;\s*/g, ';\n')
                .replace(/\s*}\s*/g, '\n}\n')
                .split('\n')
                .map(line => line.trim())
                .filter(line => line.length > 0)
                .map(line => {
                    if (line.endsWith('{')) return '    ' + line;
                    if (line === '}') return '  }';
                    return '      ' + line;
                })
                .join('\n');
            return '<style>\n' + formatted + '\n  </style>';
        });

        // Then format HTML tags
        const voidElements = /^(area|base|br|col|embed|hr|img|input|link|meta|param|source|track|wbr)$/i;
        let indent = 0;
        let result = '';
        const tokens = html.match(/(<[^>]+>|[^<]+)/g) || [];

        tokens.forEach(token => {
            const trimmed = token.trim();
            if (!trimmed) return;

            if (trimmed.startsWith('</')) {
                indent = Math.max(0, indent - 1);
                result += '  '.repeat(indent) + trimmed + '\n';
            } else if (trimmed.startsWith('<') && !trimmed.startsWith('<!--')) {
                result += '  '.repeat(indent) + trimmed + '\n';
                const tagName = (trimmed.match(/^<(\w+)/) || [])[1] || '';
                if (!voidElements.test(tagName) && !trimmed.endsWith('/>')) {
                    indent++;
                }
            } else {
                result += '  '.repeat(indent) + trimmed + '\n';
            }
        });

        codeEditor.value = result.trimEnd();
        updateLineNumbers();
        updateStats();
        if (currentTab === 'preview' || currentTab === 'split') refreshPreview();
    }

    function resetToDefault() {
        if (confirm('Reset to the default Coming Soon template? This will overwrite your current code.')) {
            codeEditor.value = defaultTemplate;
            updateLineNumbers();
            updateStats();
            unsavedBadge.classList.remove('hidden');
            unsavedBadge.classList.add('flex');
        }
    }

    // Save handler
    document.getElementById('saveComingSoonBtn').addEventListener('click', function () {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = `<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Saving...`;

        $.ajax({
            url: "{{ route('admin.control-panel.update.coming.soon') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                html: codeEditor.value
            },
            success: function () {
                btn.disabled = false;
                btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Saved!`;
                btn.classList.add('save-btn-pulse');
                unsavedBadge.classList.add('hidden');
                unsavedBadge.classList.remove('flex');
                setTimeout(() => {
                    btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg> Save Page`;
                    btn.classList.remove('save-btn-pulse');
                }, 2000);
            },
            error: function (xhr) {
                btn.disabled = false;
                btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Error!`;
                setTimeout(() => {
                    btn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg> Save Page`;
                }, 2000);
                console.error(xhr.responseJSON?.message ?? 'Save failed');
            }
        });
    });

    // Warn on page leave with unsaved changes
    window.addEventListener('beforeunload', function (e) {
        if (!unsavedBadge.classList.contains('hidden')) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

</script>
@endsection