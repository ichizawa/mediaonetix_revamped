@extends('layouts')
@section('content')
    <style>
        .file-card {
            transition: all 0.3s ease;
        }

        .file-card:hover {
            transform: translateY(-2px);
        }

        .file-preview {
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
                                <h2 class="text-2xl font-bold text-white">File Management</h2>
                                <p class="text-sm text-gray-400">View and manage uploaded merchant files</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button
                                class="flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Filter</span>
                            </button>
                            <button onclick="openUploadModal()"
                                class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Upload File</span>
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
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                    </svg>
                                    +24
                                </span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Total Files</p>
                            <h3 class="text-3xl font-bold text-white">156</h3>
                            <p class="text-xs text-gray-500 mt-2">All uploaded files</p>
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
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-purple-400 text-sm font-semibold">89</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Documents</p>
                            <h3 class="text-3xl font-bold text-white">89</h3>
                            <p class="text-xs text-gray-500 mt-2">PDF, DOC, XLSX</p>
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
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-green-400 text-sm font-semibold">54</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Images</p>
                            <h3 class="text-3xl font-bold text-white">54</h3>
                            <p class="text-xs text-gray-500 mt-2">JPG, PNG</p>
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
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-orange-400 text-sm font-semibold">2.4 GB</span>
                            </div>
                            <p class="text-gray-400 text-sm mb-1">Storage Used</p>
                            <h3 class="text-3xl font-bold text-white">2.4 GB</h3>
                            <p class="text-xs text-gray-500 mt-2">of 10 GB</p>
                        </div>
                    </div>
                </div>

                <!-- Files Grid/List -->
                <div
                    class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                        <h3 class="text-xl font-bold text-white">All Files</h3>

                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <!-- Search -->
                            <div class="relative">
                                <input type="text" placeholder="Search files..."
                                    class="w-full sm:w-64 px-4 py-2 pl-10 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>

                            <!-- View Toggle -->
                            <div class="flex gap-2">
                                <button
                                    class="px-3 py-2 text-sm bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-lg font-medium">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                        </path>
                                    </svg>
                                </button>
                                <button
                                    class="px-3 py-2 text-sm bg-white/5 text-gray-400 hover:bg-white/10 rounded-lg font-medium transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Files Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @php
                            $files = [
                                ['name' => 'Business License.pdf', 'merchant' => 'Tech Events Co.', 'type' => 'pdf', 'size' => '2.4 MB', 'date' => '2024-01-05', 'thumbnail' => null],
                                ['name' => 'Event Banner.jpg', 'merchant' => 'Music Fest Ltd', 'type' => 'image', 'size' => '1.8 MB', 'date' => '2024-01-04', 'thumbnail' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400'],
                                ['name' => 'Contract Document.docx', 'merchant' => 'Sports Arena', 'type' => 'doc', 'size' => '856 KB', 'date' => '2024-01-03', 'thumbnail' => null],
                                ['name' => 'Venue Photo.png', 'merchant' => 'Art Gallery Events', 'type' => 'image', 'size' => '3.2 MB', 'date' => '2024-01-02', 'thumbnail' => 'https://images.unsplash.com/photo-1514306191717-452ec28c7814?w=400'],
                                ['name' => 'Financial Report.xlsx', 'merchant' => 'Conference Center', 'type' => 'excel', 'size' => '645 KB', 'date' => '2024-01-01', 'thumbnail' => null],
                                ['name' => 'Event Flyer.jpg', 'merchant' => 'Food Festival Inc', 'type' => 'image', 'size' => '2.1 MB', 'date' => '2023-12-30', 'thumbnail' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=400'],
                                ['name' => 'Insurance Certificate.pdf', 'merchant' => 'Theater Productions', 'type' => 'pdf', 'size' => '1.2 MB', 'date' => '2023-12-29', 'thumbnail' => null],
                                ['name' => 'Stage Setup.png', 'merchant' => 'Comedy Club', 'type' => 'image', 'size' => '4.5 MB', 'date' => '2023-12-28', 'thumbnail' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?w=400'],
                            ];
                        @endphp

                        @foreach($files as $index => $file)
                            <div
                                class="file-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden hover:border-white/20 cursor-pointer">
                                <!-- File Preview -->
                                <div class="relative h-48 bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden">
                                    @if($file['type'] === 'image' && $file['thumbnail'])
                                        <img src="{{ $file['thumbnail'] }}" alt="{{ $file['name'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @elseif($file['type'] === 'pdf')
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-600/20 to-red-800/20">
                                            <svg class="w-20 h-20 text-red-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @elseif($file['type'] === 'doc')
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-600/20 to-blue-800/20">
                                            <svg class="w-20 h-20 text-blue-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-600/20 to-green-800/20">
                                            <svg class="w-20 h-20 text-green-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif

                                    <!-- Hover Overlay -->
                                    <div
                                        class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                        <button onclick="viewFile('{{ $file['name'] }}', '{{ $file['type'] }}', '{{ $file['thumbnail'] ?? '' }}')"
                                            class="p-2 bg-blue-600 hover:bg-blue-500 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button
                                            class="p-2 bg-green-600 hover:bg-green-500 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                        </button>
                                        <button
                                            class="p-2 bg-red-600 hover:bg-red-500 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- File Info -->
                                <div class="p-4">
                                    <h4 class="text-white font-semibold text-sm mb-1 truncate">{{ $file['name'] }}</h4>
                                    <p class="text-gray-400 text-xs mb-2 truncate">{{ $file['merchant'] }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ $file['size'] }}</span>
                                        <span>{{ $file['date'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div
                        class="flex flex-col sm:flex-row items-center justify-between mt-6 pt-4 border-t border-white/10 gap-4">
                        <p class="text-sm text-gray-400">Showing 1 to 8 of 156 files</p>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                Previous
                            </button>
                            <button class="px-3 py-1.5 bg-blue-600 text-white rounded-lg">1</button>
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">2</button>
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">3</button>
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">...</button>
                            <button
                                class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">20</button>
                            <button class="px-3 py-1.5 bg-white/5 hover:bg-white/10 text-white rounded-lg transition-all">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- File Viewer Modal -->
    <div id="fileViewerModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeFileViewer()"></div>

            <div
                class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl border border-white/10 max-w-6xl w-full max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-white/10">
                    <div>
                        <h3 class="text-xl font-bold text-white" id="viewerFileName">File Viewer</h3>
                        <p class="text-sm text-gray-400">Preview document</p>
                    </div>
                    <button onclick="closeFileViewer()"
                        class="p-2 hover:bg-white/10 rounded-lg transition-all text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]" id="fileViewerContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function openUploadModal() {
            alert('Upload modal will open here - integrate with your existing upload functionality');
        }

        function viewFile(fileName, fileType, thumbnail) {
            const modal = document.getElementById('fileViewerModal');
            const fileNameEl = document.getElementById('viewerFileName');
            const contentEl = document.getElementById('fileViewerContent');

            fileNameEl.textContent = fileName;

            if (fileType === 'image' && thumbnail) {
                contentEl.innerHTML = `
                    <div class="flex items-center justify-center bg-black/20 rounded-xl overflow-hidden">
                        <img src="${thumbnail}" alt="${fileName}" class="max-w-full max-h-[70vh] object-contain">
                    </div>
                `;
            } else if (fileType === 'pdf') {
                contentEl.innerHTML = `
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] rounded-xl p-12 text-center">
                        <svg class="w-24 h-24 text-red-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                        <h4 class="text-xl font-bold text-white mb-2">PDF Document</h4>
                        <p class="text-gray-400 mb-6">PDF viewer will be embedded here</p>
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all">
                            Download PDF
                        </button>
                    </div>
                `;
            } else {
                contentEl.innerHTML = `
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] rounded-xl p-12 text-center">
                        <svg class="w-24 h-24 text-blue-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h4 class="text-xl font-bold text-white mb-2">Document Preview</h4>
                        <p class="text-gray-400 mb-6">Preview not available for this file type</p>
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all">
                            Download File
                        </button>
                    </div>
                `;
            }

            modal.classList.remove('hidden');
        }

        function closeFileViewer() {
            document.getElementById('fileViewerModal').classList.add('hidden');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeFileViewer();
            }
        });
    </script>
@endsection
