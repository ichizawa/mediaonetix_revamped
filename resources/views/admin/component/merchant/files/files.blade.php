@extends('layouts')

@section('content')
    <style>
        .submission-card {
            transition: all 0.25s ease;
        }

        .submission-card:hover {
            transform: translateY(-3px);
        }

        .submission-modal {
            max-height: 90vh;
            overflow-y: auto;
        }

        .doc-thumb {
            transition: all 0.2s ease;
        }

        .doc-thumb.active {
            border-color: rgb(59 130 246 / 0.9);
            box-shadow: 0 0 0 1px rgb(59 130 246 / 0.4);
        }
    </style>

    <div class="min-h-screen bg-[#0c1222]">
        <div class="lg:ml-64">
            <header class="sticky top-0 z-40 bg-[#0c1222]/80 backdrop-blur-xl border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h2 class="text-2xl font-bold text-white">File Management</h2>
                            <p class="text-sm text-gray-400">Review event submissions from merchants</p>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-300">
                            <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10">Total {{ $stats['total'] }}</span>
                            <span class="px-3 py-1 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-300">Pending {{ $stats['pending'] }}</span>
                            <span class="px-3 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-300">Approved {{ $stats['approved'] }}</span>
                            <span class="px-3 py-1 rounded-full bg-red-500/10 border border-red-500/20 text-red-300">Rejected {{ $stats['rejected'] }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-6 lg:p-8">
                <div class="mb-6 rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-white/[0.02] p-5">
                    <p class="text-sm text-gray-400">Merchant</p>
                    <h3 class="text-xl font-bold text-white">{{ $merchant->name }}</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
                    @forelse($submissions as $submission)
                        <button type="button" onclick='openSubmissionModal(@json($submission))'
                            class="submission-card text-left rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-white/[0.02] p-5 hover:border-white/20">
                            <div class="flex items-start justify-between gap-4 mb-4">
                                <div>
                                    <p class="text-xs uppercase tracking-wider text-gray-500">Event</p>
                                    <h4 class="text-lg font-semibold text-white">{{ $submission['event_name'] }}</h4>
                                    <p class="text-sm text-gray-400">{{ $submission['merchant_name'] }}</p>
                                </div>
                                <span class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold border"
                                    style="background: {{ $submission['status']['color'] === 'green' ? 'rgba(34,197,94,0.12)' : ($submission['status']['color'] === 'red' ? 'rgba(239,68,68,0.12)' : 'rgba(234,179,8,0.12)') }}; border-color: rgba(255,255,255,0.12); color: {{ $submission['status']['color'] === 'green' ? '#86efac' : ($submission['status']['color'] === 'red' ? '#fca5a5' : '#fde68a') }}">
                                    {{ $submission['status']['label'] }}
                                </span>
                            </div>

                            <div class="grid grid-cols-3 gap-3 text-center">
                                <div class="rounded-xl bg-black/20 border border-white/5 py-3">
                                    <div class="text-lg font-bold text-white">{{ $submission['file_count'] }}</div>
                                    <div class="text-[11px] text-gray-400">Documents</div>
                                </div>
                                <div class="rounded-xl bg-black/20 border border-white/5 py-3">
                                    <div class="text-lg font-bold text-white">{{ $submission['event_date'] ? \Illuminate\Support\Carbon::parse($submission['event_date'])->format('M d') : '-' }}</div>
                                    <div class="text-[11px] text-gray-400">Event Date</div>
                                </div>
                                <div class="rounded-xl bg-black/20 border border-white/5 py-3">
                                    <div class="text-lg font-bold text-white">Review</div>
                                    <div class="text-[11px] text-gray-400">Open modal</div>
                                </div>
                            </div>
                        </button>
                    @empty
                        <div class="col-span-full rounded-2xl border border-white/10 bg-white/5 p-8 text-center text-gray-400">
                            No submitted event documents found for this merchant.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div id="submissionModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex min-h-screen items-center justify-center px-4 py-8">
            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" onclick="closeSubmissionModal()"></div>

            <div class="submission-modal relative w-full max-w-6xl rounded-2xl border border-white/10 bg-gradient-to-br from-gray-900 to-gray-800 shadow-2xl">
                <div class="flex items-start justify-between gap-4 border-b border-white/10 p-6">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Submission Review</p>
                        <h3 id="submissionTitle" class="text-2xl font-bold text-white">Event</h3>
                        <p id="submissionMerchant" class="text-sm text-gray-400"></p>
                        <p id="submissionReason" class="mt-2 hidden rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-white"></p>
                    </div>
                    <button type="button" onclick="closeSubmissionModal()" class="rounded-lg p-2 text-gray-400 hover:bg-white/10 hover:text-white">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="grid gap-6 p-6 lg:grid-cols-[1.1fr_0.9fr]">
                    <div>
                        <div class="mb-4 flex flex-wrap items-center gap-3">
                            <span id="submissionStatus" class="rounded-full border px-3 py-1 text-xs font-semibold"></span>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-gray-300" id="submissionCount"></span>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3" id="submissionDocs"></div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-black/20 p-5">
                        <div class="mb-4">
                            <p class="text-sm font-semibold text-white">Document Preview</p>
                        </div>

                        <div id="documentPreviewWrap" class="mb-4 overflow-hidden rounded-xl border border-white/10 bg-black/30"></div>

                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-medium text-white" for="rejectionReason">Reason for rejection</label>
                            <textarea id="rejectionReason" rows="4"
                                class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder-gray-500 focus:border-blue-500 focus:outline-none"
                                placeholder="Required only when rejecting a submission"></textarea>
                            <p class="mt-2 text-xs text-gray-500">This is stored with the merchant file record.</p>
                        </div>

                        <p id="reviewError" class="mb-4 hidden rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-200"></p>

                        <form id="reviewForm" method="POST" class="flex flex-wrap items-center gap-3">
                            @csrf
                            <input type="hidden" name="action" id="reviewAction" value="approve">
                            <button type="button" onclick="submitReview('approve')"
                                class="rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-500">
                                Accept
                            </button>
                            <button type="button" onclick="submitReview('reject')"
                                class="rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white hover:bg-red-500">
                                Reject
                            </button>
                            <button type="button" onclick="closeSubmissionModal()"
                                class="rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10">
                                Close
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentSubmission = null;
        const reviewRouteTemplate = @json(url('/admin/merchants/files/' . $merchant->id . '/review/__EVENT_ID__'));

        function openSubmissionModal(submission) {
            currentSubmission = submission;

            document.getElementById('submissionTitle').textContent = submission.event_name;
            document.getElementById('submissionMerchant').textContent = submission.merchant_name;
            document.getElementById('submissionCount').textContent = `${submission.file_count} uploaded documents`;
            document.getElementById('reviewError')?.classList.add('hidden');
            document.getElementById('rejectionReason').value = submission.rejection_reason || '';

            const statusBadge = document.getElementById('submissionStatus');
            const statusColor = submission.status_code === 1 ? '#86efac' : (submission.status_code === 2 ? '#fca5a5' : '#fde68a');
            const statusBg = submission.status_code === 1 ? 'rgba(34,197,94,0.12)' : (submission.status_code === 2 ? 'rgba(239,68,68,0.12)' : 'rgba(234,179,8,0.12)');
            statusBadge.style.background = statusBg;
            statusBadge.style.color = statusColor;
            statusBadge.style.borderColor = 'rgba(255,255,255,0.12)';
            statusBadge.textContent = submission.status.label;

            const reasonEl = document.getElementById('submissionReason');
            if (submission.status_code === 2 && submission.rejection_reason) {
                reasonEl.textContent = `Rejected reason: ${submission.rejection_reason}`;
                reasonEl.classList.remove('hidden');
            } else {
                reasonEl.classList.add('hidden');
            }

            renderDocuments(submission.files);
            document.getElementById('submissionModal').classList.remove('hidden');
        }

        function renderDocuments(files) {
            const docsContainer = document.getElementById('submissionDocs');
            docsContainer.innerHTML = '';

            files.forEach((file, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'doc-thumb rounded-xl border border-white/10 bg-white/5 p-3 text-left';
                button.innerHTML = `
                    <div class="mb-3 rounded-lg border border-white/10 bg-black/30 p-3">
                        ${file.is_image ? `<img src="${file.file_path}" alt="${escapeHtml(file.title)}" class="h-32 w-full rounded-md object-cover">` : `<div class="flex h-32 items-center justify-center rounded-md bg-white/5"><div class="text-center"><div class="text-4xl">${file.is_pdf ? 'PDF' : 'DOC'}</div><div class="mt-2 text-[11px] text-gray-400">${escapeHtml(file.extension || 'file')}</div></div></div>`}
                    </div>
                    <div class="space-y-1">
                        <div class="text-sm font-semibold text-white truncate">${escapeHtml(file.title)}</div>
                        <div class="text-[11px] text-gray-400 truncate">${escapeHtml(file.created_at || '')}</div>
                    </div>
                `;
                button.addEventListener('click', function() {
                    previewDocument(files, index);
                    docsContainer.querySelectorAll('.doc-thumb').forEach(item => item.classList.remove('active'));
                    button.classList.add('active');
                });
                docsContainer.appendChild(button);

                if (index === 0) {
                    setTimeout(() => button.click(), 0);
                }
            });

            if (!files.length) {
                document.getElementById('documentPreviewWrap').innerHTML = '<div class="p-8 text-center text-gray-400">No documents attached.</div>';
            }
        }

        function previewDocument(files, index) {
            const file = files[index];
            const previewWrap = document.getElementById('documentPreviewWrap');

            if (file.is_image) {
                previewWrap.innerHTML = `<img src="${file.file_path}" alt="${escapeHtml(file.title)}" class="w-full max-h-[60vh] object-contain bg-black/40">`;
                return;
            }

            if (file.is_pdf) {
                previewWrap.innerHTML = `<iframe src="${file.file_path}" class="h-[60vh] w-full" title="${escapeHtml(file.title)}"></iframe>`;
                return;
            }

            previewWrap.innerHTML = `
                <div class="flex h-[40vh] items-center justify-center p-8 text-center">
                    <div>
                        <div class="mb-4 text-5xl text-blue-300">DOC</div>
                        <h4 class="text-lg font-semibold text-white">${escapeHtml(file.title)}</h4>
                        <p class="mt-2 text-sm text-gray-400">Preview is not available for this file type.</p>
                    </div>
                </div>
            `;
        }

        function submitReview(action) {
            const errorEl = document.getElementById('reviewError');
            const reason = document.getElementById('rejectionReason').value.trim();

            if (!currentSubmission) return;

            if (action === 'reject' && !reason) {
                errorEl.textContent = 'Please provide a rejection reason before rejecting this submission.';
                errorEl.classList.remove('hidden');
                return;
            }

            errorEl.classList.add('hidden');
            document.getElementById('reviewAction').value = action;
            const form = document.getElementById('reviewForm');
            form.action = reviewRouteTemplate.replace('__EVENT_ID__', currentSubmission.event_id);

            let reasonInput = form.querySelector('input[name="reason"]');
            if (action === 'reject') {
                if (!reasonInput) {
                    reasonInput = document.createElement('input');
                    reasonInput.type = 'hidden';
                    reasonInput.name = 'reason';
                    form.appendChild(reasonInput);
                }
                reasonInput.value = reason;
            } else if (reasonInput) {
                reasonInput.remove();
            }

            form.submit();
        }

        function closeSubmissionModal() {
            document.getElementById('submissionModal').classList.add('hidden');
            currentSubmission = null;
        }

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSubmissionModal();
            }
        });
    </script>
@endsection
