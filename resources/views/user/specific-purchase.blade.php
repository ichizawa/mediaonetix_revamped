<div id="specificPurchaseModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 opacity-0 pointer-events-none transition-all duration-200 ease-out" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="absolute inset-0 bg-[#0C1222]/80 backdrop-blur-sm transition-all duration-200 js-close-purchase-modal"></div>

    <div id="specificPurchaseModalPanel" class="relative w-full max-w-md bg-[#0C1222] rounded-3xl border border-white/20 shadow-2xl transform scale-95 opacity-0 transition-all duration-200 ease-out flex flex-col" style="max-height: min(90vh, 700px);">

        <div class="bg-gradient-to-br from-[#0C1222] via-[#151f38] to-[#0C1222] text-white px-5 sm:px-6 pt-8 sm:pt-10 pb-5 sm:pb-6 text-center relative border-b border-white/10 overflow-hidden rounded-t-3xl flex-shrink-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.1),transparent_50%)]"></div>

            <div class="relative z-10 space-y-3 sm:space-y-4 max-w-[85%] mx-auto">
                <div class="inline-flex items-center justify-center px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-500/20 text-blue-100 text-xs sm:text-sm font-semibold rounded-full border border-blue-500/30 mx-auto w-fit">
                    <span class="mr-1.5 text-sm leading-none">•</span>
                    <span>Purchase Details</span>
                </div>

                <h3 class="text-xl sm:text-2xl md:text-3xl font-black tracking-tight drop-shadow-2xl leading-tight line-clamp-2" id="modal-title">
                    <span id="modalEventName">N/A</span>
                </h3>

                <p class="text-white/70 text-xs sm:text-sm font-medium" id="modalDate">N/A</p>

                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-white/20 text-white/95 text-xs font-mono font-bold rounded-2xl border border-white/30 backdrop-blur-sm mx-auto w-fit shadow-md">
                    <span id="modalReferenceId" data-full="N/A" data-masked="N/A">N/A</span>
                    <button
                        type="button"
                        class="inline-flex items-center justify-center w-5 h-5 rounded-full border border-white/30 bg-white/10 hover:bg-white/20 transition-all js-modal-ref-toggle"
                        aria-pressed="false"
                        aria-label="Show full reference number"
                    >
                        <svg class="modal-ref-icon-eye w-3 h-3 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/>
                            <circle cx="12" cy="12" r="3" stroke-width="2"/>
                        </svg>
                        <svg class="modal-ref-icon-eye-off w-3 h-3 text-white/90 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.94 17.94A10.94 10.94 0 0112 19C5 19 1 12 1 12a21.74 21.74 0 015.06-6.94M9.9 4.24A10.94 10.94 0 0112 5c7 0 11 7 11 7a21.86 21.86 0 01-2.16 3.19M1 1l22 22"/>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="button" class="absolute top-4 sm:top-6 right-4 sm:right-6 p-2 sm:p-2.5 rounded-2xl bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-all duration-200 border border-white/30 hover:border-white/50 shadow-lg group focus:outline-none focus:ring-2 focus:ring-white/50 js-close-purchase-modal" aria-label="Close modal">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white/90 group-hover:text-white transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-5 sm:px-6 pb-6 sm:pb-8 pt-5 sm:pt-6 text-white custom-scrollbar space-y-6 sm:space-y-8 scrollbar-thin scrollbar-thumb-white/25 scrollbar-track-transparent">

            <section class="border-b border-white/10 pb-6 sm:pb-8">
                <h4 class="text-xs font-bold text-white/60 uppercase tracking-widest mb-4 sm:mb-6 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Purchase Details
                </h4>
                <div class="space-y-0 text-xs sm:text-sm">
                    <div class="flex justify-between items-start gap-3 py-2 border-b border-white/5">
                        <span class="text-white/70 font-medium flex-shrink-0">Event</span>
                        <span class="font-semibold text-white text-right line-clamp-1 max-w-[60%]" id="modalEventNameBody">N/A</span>
                    </div>
                    <div class="flex justify-between items-center gap-3 py-2 border-b border-white/5">
                        <span class="text-white/70 font-medium flex-shrink-0">Ticket Name</span>
                        <span class="font-semibold text-white/90 text-right line-clamp-1 max-w-[60%]" id="modalTicketName">N/A</span>
                    </div>
                    <div class="flex justify-between items-center gap-3 py-2 font-semibold">
                        <span class="text-white/80 flex-shrink-0">Transaction ID</span>
                        <span class="text-white font-bold break-all text-right max-w-[65%]" id="modalTransactionId">N/A</span>
                    </div>
                </div>
            </section>

            <section class="border-b border-white/10 pb-6 sm:pb-8">
                <h4 class="text-xs font-bold text-white/60 uppercase tracking-widest mb-4 sm:mb-6 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Payment
                </h4>
                <div class="space-y-0 text-xs sm:text-sm">
                    <div class="flex justify-between items-center gap-3 py-2 border-b border-white/5">
                        <span class="text-white/70 flex-shrink-0">Payment Method</span>
                        <span class="font-semibold text-white/90 line-clamp-1 max-w-[55%] bg-white/5 px-2 py-1 rounded-lg text-xs sm:text-sm" id="modalPaymentType">N/A</span>
                    </div>
                    <div class="flex justify-between items-center gap-3 py-2 font-semibold">
                        <span class="text-white/80 flex-shrink-0">Total Payment</span>
                        <span class="text-white font-bold" id="modalTotalPayment">N/A</span>
                    </div>
                </div>
            </section>

            <section class="space-y-2">
                <div class="text-center pt-2">
                    <p class="text-xs text-white/50 uppercase tracking-widest mb-1">Purchase Date</p>
                    <p class="text-xs sm:text-sm font-semibold text-white/90" id="modalDateFooter">N/A</p>
                </div>
            </section>

        </div>

        <div class="px-5 sm:px-6 pb-6 sm:pb-8 pt-4 sm:pt-6 bg-white/5 border-t border-white/10 backdrop-blur-sm rounded-b-3xl flex-shrink-0">
            <button type="button" class="w-full px-6 sm:px-8 py-3.5 sm:py-4 text-base sm:text-lg font-black text-white bg-white/15 backdrop-blur-sm border-2 border-white/30 rounded-2xl hover:bg-white/25 hover:border-white/40 hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-white/40 shadow-lg js-close-purchase-modal">
                Close
            </button>
        </div>

    </div>
</div>

<style>
    .custom-scrollbar {
      scrollbar-width: thin;
      scrollbar-color: rgba(255,255,255,0.25) transparent;
    }
    .custom-scrollbar::-webkit-scrollbar {
      width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: transparent;
      margin: 8px 0;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.25);
      border-radius: 12px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: rgba(255,255,255,0.45);
    }
    .line-clamp-1 {
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
</style>

<script>
    (function () {
        const modal = document.getElementById('specificPurchaseModal');
        const panel = document.getElementById('specificPurchaseModalPanel');
        if (!modal || !panel) return;

        const fieldEvent = document.getElementById('modalEventName');
        const fieldEventBody = document.getElementById('modalEventNameBody');
        const fieldDate = document.getElementById('modalDate');
        const fieldDateFooter = document.getElementById('modalDateFooter');
        const fieldTicket = document.getElementById('modalTicketName');
        const fieldReference = document.getElementById('modalReferenceId');
        const fieldTransactionId = document.getElementById('modalTransactionId');
        const refToggle = document.querySelector('.js-modal-ref-toggle');
        const refEye = refToggle?.querySelector('.modal-ref-icon-eye');
        const refEyeOff = refToggle?.querySelector('.modal-ref-icon-eye-off');
        const fieldPaymentType = document.getElementById('modalPaymentType');
        const fieldTotalPayment = document.getElementById('modalTotalPayment');

        const setFieldText = (el, value) => {
            if (!el) return;
            el.textContent = value && String(value).trim() !== '' ? value : 'N/A';
        };

        const maskSensitiveValue = (value) => {
            const text = value && String(value).trim() !== '' ? String(value) : 'N/A';
            if (text === 'N/A' || text.length <= 4) return text;
            return '*'.repeat(text.length - 4) + text.slice(-4);
        };

        const setRefToggleState = (isVisible) => {
            if (!refToggle) return;
            refToggle.setAttribute('aria-pressed', isVisible ? 'true' : 'false');
            refToggle.setAttribute('aria-label', isVisible ? 'Hide full reference number' : 'Show full reference number');
            if (refEye) refEye.classList.toggle('hidden', isVisible);
            if (refEyeOff) refEyeOff.classList.toggle('hidden', !isVisible);
        };

        const resetModalSensitiveValues = (referenceValue, transactionValue) => {
            const fullReference = referenceValue && String(referenceValue).trim() !== '' ? String(referenceValue) : 'N/A';
            const maskedReference = maskSensitiveValue(fullReference);
            const fullTransaction = transactionValue && String(transactionValue).trim() !== '' ? String(transactionValue) : 'N/A';
            const maskedTransaction = maskSensitiveValue(fullTransaction);

            if (fieldReference) {
                fieldReference.dataset.full = fullReference;
                fieldReference.dataset.masked = maskedReference;
                fieldReference.textContent = maskedReference;
            }

            if (fieldTransactionId) {
                fieldTransactionId.dataset.full = fullTransaction;
                fieldTransactionId.dataset.masked = maskedTransaction;
                fieldTransactionId.textContent = maskedTransaction;
            }

            setRefToggleState(false);
        };

        const toggleModalReference = () => {
            if (!refToggle) return;

            const isVisible = refToggle.getAttribute('aria-pressed') === 'true';
            if (isVisible) {
                if (fieldReference) {
                    const maskedReference = fieldReference.dataset.masked || 'N/A';
                    fieldReference.textContent = maskedReference;
                }
                if (fieldTransactionId) {
                    const maskedTransaction = fieldTransactionId.dataset.masked || 'N/A';
                    fieldTransactionId.textContent = maskedTransaction;
                }
                setRefToggleState(false);
            } else {
                if (fieldReference) {
                    const fullReference = fieldReference.dataset.full || 'N/A';
                    fieldReference.textContent = fullReference;
                }
                if (fieldTransactionId) {
                    const fullTransaction = fieldTransactionId.dataset.full || 'N/A';
                    fieldTransactionId.textContent = fullTransaction;
                }
                setRefToggleState(true);
            }
        };

        const openModalFromCard = (card) => {
            const eventName = card.dataset.modalEvent;
            const date = card.dataset.modalDate;

            setFieldText(fieldEvent, eventName);
            setFieldText(fieldEventBody, eventName);
            setFieldText(fieldDate, date);
            setFieldText(fieldDateFooter, date);
            setFieldText(fieldTicket, card.dataset.modalTicket);
            resetModalSensitiveValues(card.dataset.modalReference, card.dataset.modalTransaction);
            setFieldText(fieldPaymentType, card.dataset.modalPaymentType);
            setFieldText(fieldTotalPayment, card.dataset.modalTotal);

            modal.classList.remove('opacity-0', 'pointer-events-none');
            panel.style.opacity = '1';
            panel.style.transform = 'scale(1) translateY(0)';
            document.body.style.overflow = 'hidden';
        };

        const closeModal = () => {
            panel.style.transform = 'scale(0.95) translateY(-8px)';
            panel.style.opacity = '0';

            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
                document.body.style.overflow = '';
            }, 140);
        };

        document.addEventListener('click', (event) => {
            if (event.target.closest('.js-modal-ref-toggle')) {
                toggleModalReference();
                return;
            }

            if (event.target.closest('.js-close-purchase-modal')) {
                closeModal();
                return;
            }

            const card = event.target.closest('.js-open-purchase-modal');
            if (!card) return;

            if (event.target.closest('.js-ref-toggle')) return;
            openModalFromCard(card);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.classList.contains('opacity-0')) {
                closeModal();
                return;
            }

            if ((event.key === 'Enter' || event.key === ' ') && event.target.closest('.js-modal-ref-toggle')) {
                event.preventDefault();
                toggleModalReference();
                return;
            }

            if (event.target.closest('.js-ref-toggle')) return;

            const card = event.target.closest('.js-open-purchase-modal');
            if (!card) return;

            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                openModalFromCard(card);
            }
        });
    })();
</script>
