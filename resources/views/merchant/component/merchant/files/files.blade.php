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
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-white">File Management</h2>
                            <p class="text-sm text-gray-400">View and manage uploaded merchant files</p>
                        </div>

                        <button onclick="openUploadModal()"
                            class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <span class="hidden sm:inline">Upload File</span>
                        </button>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <h3 class="text-xl font-bold text-white">All Files</h3>
                        <p class="text-sm text-gray-400">Showing {{ $files->firstItem() ?? 0 }} to {{ $files->lastItem() ?? 0 }} of {{ $files->total() }} files</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @forelse($files as $file)
                            @php
                                $fileExtension = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                                $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $isPdf = $fileExtension === 'pdf';
                                $previewUrl = asset($file->file_path);
                                $fileTitle = $file->document_title ?? $file->file_name;
                                $eventName = $file->event->event_name ?? 'No event attached';
                                $merchantName = $file->merchant->name ?? 'Unknown';
                            @endphp

                            <div class="file-card group relative bg-gradient-to-br from-white/5 to-white/[0.02] backdrop-blur-sm border border-white/10 rounded-xl overflow-hidden hover:border-white/20 cursor-pointer">
                                <div class="relative h-48 bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden">
                                    @if ($isImage)
                                        <img src="{{ $previewUrl }}" alt="{{ $fileTitle }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @elseif ($isPdf)
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-600/20 to-red-800/20">
                                            <svg class="w-20 h-20 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-600/20 to-blue-800/20">
                                            <svg class="w-20 h-20 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="absolute top-3 right-3 px-2 py-1 rounded-full text-[11px] font-semibold bg-black/60 text-white border border-white/10">
                                        {{ $eventName }}
                                    </div>

                                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                                        <button type="button"
                                            onclick='viewFile(@json($fileTitle), @json($isImage ? "image" : ($isPdf ? "pdf" : "doc")), @json($isImage ? $previewUrl : ""))'
                                            class="p-2 bg-blue-600 hover:bg-blue-500 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                        <a href="{{ asset($file->file_path) }}" download
                                            class="p-2 bg-green-600 hover:bg-green-500 rounded-lg transition-all">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="p-4">
                                    <h4 class="text-white font-semibold text-sm mb-1 truncate">{{ $fileTitle }}</h4>
                                    <p class="text-gray-400 text-xs mb-1 truncate">Merchant: {{ $merchantName }}</p>
                                    <p class="text-gray-400 text-xs mb-2 truncate">Event: {{ $eventName }}</p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>{{ strtoupper($fileExtension) }}</span>
                                        <span>{{ $file->created_at?->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full rounded-xl border border-white/10 bg-white/5 p-8 text-center text-gray-400">
                                No submitted documents found for this merchant.
                            </div>
                        @endforelse
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-between mt-6 pt-4 border-t border-white/10 gap-4">
                        <div class="text-sm text-gray-400">
                            {{ $files->total() ? $files->total() . ' files' : 'No files' }}
                        </div>
                        <div class="pagination-dark text-sm text-white">
                            {{ $files->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fileViewerModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeFileViewer()"></div>
            <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl border border-white/10 max-w-6xl w-full max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between p-6 border-b border-white/10">
                    <div>
                        <h3 class="text-xl font-bold text-white" id="viewerFileName">File Viewer</h3>
                        <p class="text-sm text-gray-400">Preview document</p>
                    </div>
                    <button onclick="closeFileViewer()" class="p-2 hover:bg-white/10 rounded-lg transition-all text-gray-400 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto max-h-[calc(90vh-140px)]" id="fileViewerContent"></div>
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
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <h4 class="text-xl font-bold text-white mb-2">PDF Document</h4>
                        <p class="text-gray-400 mb-6">PDF viewer will be embedded here</p>
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all">Download PDF</button>
                    </div>
                `;
            } else {
                contentEl.innerHTML = `
                    <div class="bg-gradient-to-br from-white/5 to-white/[0.02] rounded-xl p-12 text-center">
                        <svg class="w-24 h-24 text-blue-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h4 class="text-xl font-bold text-white mb-2">Document Preview</h4>
                        <p class="text-gray-400 mb-6">Preview not available for this file type</p>
                        <button class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition-all">Download File</button>
                    </div>
                `;
            }

            modal.classList.remove('hidden');
        }

        function closeFileViewer() {
            document.getElementById('fileViewerModal').classList.add('hidden');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeFileViewer();
            }
        });
    </script>
@endsection