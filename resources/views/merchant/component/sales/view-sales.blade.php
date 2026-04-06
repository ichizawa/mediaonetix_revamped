<div id="viewSalesModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 opacity-0 pointer-events-none transition-all duration-200 ease-out" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#0C1222]/80 backdrop-blur-sm transition-all duration-200" 
         onclick="closeViewSalesModal()"></div>

    <!-- Receipt-Style Transaction Modal -->
    <div id="viewSalesModalPanel" class="relative w-full max-w-md bg-[#0C1222] rounded-3xl border border-white/20 shadow-2xl transform scale-95 opacity-0 transition-all duration-200 ease-out flex flex-col" style="max-height: min(90vh, 700px);">
        
        <!-- Receipt Header -->
        <div class="bg-gradient-to-br from-[#0C1222] via-[#151f38] to-[#0C1222] text-white px-5 sm:px-6 pt-8 sm:pt-10 pb-5 sm:pb-6 text-center relative border-b border-white/10 overflow-hidden rounded-t-3xl flex-shrink-0">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(255,255,255,0.1),transparent_50%)]"></div>
            
            <div class="relative z-10 space-y-3 sm:space-y-4 max-w-[85%] mx-auto">
                <!-- Status Badge -->
                <div id="viewSaleStatusBadge" class="inline-flex items-center justify-center px-3 sm:px-4 py-1.5 sm:py-2 bg-green-500/20 text-green-100 text-xs sm:text-sm font-semibold rounded-full border border-green-500/30 mx-auto w-fit">
                    <span id="viewSaleStatusIcon" class="mr-1.5 text-sm leading-none">✓</span>
                    <span id="viewSaleStatus">—</span>
                </div>
                
                <!-- Customer Name -->
                <h3 class="text-xl sm:text-2xl md:text-3xl font-black tracking-tight drop-shadow-2xl leading-tight line-clamp-2" id="modal-title">
                    <span id="viewSaleCustomerName">—</span>
                </h3>
                
                <!-- Email -->
                <p class="text-white/70 text-xs sm:text-sm font-medium" id="viewSaleCustomerEmail">—</p>
                
                <!-- Transaction ID Pill -->
                <div class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-white/20 text-white/95 text-xs font-mono font-bold rounded-2xl border border-white/30 backdrop-blur-sm mx-auto w-fit shadow-md">
                    <span id="viewSaleRefNumber">#—</span>
                </div>
            </div>
            
            <!-- Close Button -->
            <button type="button" onclick="closeViewSalesModal()" 
                    class="absolute top-4 sm:top-6 right-4 sm:right-6 p-2 sm:p-2.5 rounded-2xl bg-white/20 backdrop-blur-sm hover:bg-white/30 transition-all duration-200 border border-white/30 hover:border-white/50 shadow-lg group focus:outline-none focus:ring-2 focus:ring-white/50">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white/90 group-hover:text-white transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Receipt Body -->
        <div class="flex-1 overflow-y-auto px-5 sm:px-6 pb-6 sm:pb-8 pt-5 sm:pt-6 text-white custom-scrollbar space-y-6 sm:space-y-8 scrollbar-thin scrollbar-thumb-white/25 scrollbar-track-transparent">
            
            <!-- Purchase Details -->
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
                        <span class="font-semibold text-white text-right line-clamp-1 max-w-[60%]" id="viewSaleEventName">—</span>
                    </div>
                    <div class="flex justify-between items-center gap-3 py-2 border-b border-white/5">
                        <span class="text-white/70 font-medium flex-shrink-0">Ticket Type</span>
                        <span class="font-semibold text-white/90 text-right line-clamp-1 max-w-[60%]" id="viewSaleTicketType">—</span>
                    </div>
                    <div class="flex justify-between items-center gap-3 py-2 font-semibold">
                        <span class="text-white/80 flex-shrink-0">Quantity</span>
                        <span class="text-white font-bold" id="viewSaleQuantity">—</span>
                    </div>
                </div>
            </section>

            <!-- Payment Breakdown -->
            <section class="border-b border-white/10 pb-6 sm:pb-8">
                <h4 class="text-xs font-bold text-white/60 uppercase tracking-widest mb-4 sm:mb-6 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                    Payment
                </h4>
                <div class="space-y-0 text-xs sm:text-sm">
                    <div class="flex justify-between items-center gap-3 py-2 border-b border-white/5">
                        <span class="text-white/70 flex-shrink-0">Unit Price</span>
                        <span class="font-semibold text-white/90" id="viewSaleUnitPrice">₱—</span>
                    </div>
                    <div class="flex justify-between items-center gap-3 py-2 font-semibold">
                        <span class="text-white/80 flex-shrink-0">Payment Method</span>
                        <span class="text-white/90 line-clamp-1 max-w-[55%] bg-white/5 px-2 py-1 rounded-lg text-xs sm:text-sm" id="viewSalePaymentMethod">—</span>
                    </div>
                </div>
            </section>

            <!-- Total & Date -->
            <section class="space-y-4">
                <div class="flex justify-between items-center gap-3 pt-2">
                    <span class="text-xs sm:text-sm font-semibold text-white/60 uppercase tracking-wider flex-shrink-0">Total Paid</span>
                    <span class="text-2xl sm:text-3xl font-black text-white tracking-tight" id="viewSaleTotalAmount">₱—</span>
                </div>
                <div class="text-center pt-4 border-t border-white/10">
                    <p class="text-xs text-white/50 uppercase tracking-widest mb-1">Purchase Date</p>
                    <p class="text-xs sm:text-sm font-semibold text-white/90" id="viewSaleDate">—</p>
                </div>
            </section>

        </div>

        <!-- Close Button -->
        <div class="px-5 sm:px-6 pb-6 sm:pb-8 pt-4 sm:pt-6 bg-white/5 border-t border-white/10 backdrop-blur-sm rounded-b-3xl flex-shrink-0">
            <button type="button" 
                    onclick="closeViewSalesModal()" 
                    class="w-full px-6 sm:px-8 py-3.5 sm:py-4 text-base sm:text-lg font-black text-white bg-white/15 backdrop-blur-sm border-2 border-white/30 rounded-2xl hover:bg-white/25 hover:border-white/40 hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-white/40 shadow-lg">
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
    const statusStyleMap = {
        'text-green-400':  { bg: 'rgba(34,197,94,0.2)',   border: 'rgba(34,197,94,0.4)',   color: 'rgb(220,252,231)' },
        'text-yellow-400': { bg: 'rgba(234,179,8,0.2)',   border: 'rgba(234,179,8,0.4)',   color: 'rgb(254,249,195)' },
        'text-red-400':    { bg: 'rgba(239,68,68,0.2)',   border: 'rgba(239,68,68,0.4)',   color: 'rgb(254,226,226)' },
        'text-blue-400':   { bg: 'rgba(59,130,246,0.2)',  border: 'rgba(59,130,246,0.4)',  color: 'rgb(219,234,254)' },
        'text-gray-400':   { bg: 'rgba(156,163,175,0.2)', border: 'rgba(156,163,175,0.4)', color: 'rgb(243,244,246)' },
    };

    function openViewSalesModal(sale) {
        const modal = document.getElementById('viewSalesModal');
        const panel = document.getElementById('viewSalesModalPanel');

        if (sale) {
            document.getElementById('viewSaleStatus').textContent        = sale.status || '—';
            document.getElementById('viewSaleCustomerName').textContent  = sale.customerName || '—';
            document.getElementById('viewSaleCustomerEmail').textContent = sale.customerEmail || '—';
            document.getElementById('viewSaleRefNumber').textContent     = '#' + (sale.ref || '—');
            document.getElementById('viewSaleEventName').textContent     = sale.eventName || '—';
            document.getElementById('viewSaleTicketType').textContent    = sale.ticketType || '—';
            document.getElementById('viewSaleQuantity').textContent      = (sale.quantity || 0) + ' ticket' + ((sale.quantity || 0) !== 1 ? 's' : '');
            document.getElementById('viewSaleUnitPrice').textContent     = '₱' + formatCurrency(sale.unitPrice || 0);
            document.getElementById('viewSalePaymentMethod').textContent = sale.paymentMethod || '—';
            document.getElementById('viewSaleTotalAmount').textContent   = '₱' + formatCurrency(sale.totalAmount || 0);
            document.getElementById('viewSaleDate').textContent          = formatDate(sale.date) || '—';

            const badge = document.getElementById('viewSaleStatusBadge');
            const styles = statusStyleMap[sale.statusColor] || statusStyleMap['text-gray-400'];
            badge.style.backgroundColor = styles.bg;
            badge.style.borderColor     = styles.border;
            badge.style.color           = styles.color;

            const iconMap = {
                'text-green-400':  '✓',
                'text-yellow-400': '⏳',
                'text-red-400':    '✕',
                'text-blue-400':   'ℹ',
                'text-gray-400':   '•',
            };
            document.getElementById('viewSaleStatusIcon').textContent = iconMap[sale.statusColor] || '•';
        }

        modal.classList.remove('opacity-0', 'pointer-events-none');
        panel.style.opacity   = '1';
        panel.style.transform = 'scale(1) translateY(0)';
    }

    function formatCurrency(amount) {
        const num = parseFloat(String(amount).replace(/,/g, ''));
        if (isNaN(num)) return '—';
        return num.toLocaleString('en-PH', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function formatDate(dateStr) {
        if (!dateStr) return '—';
        const date = new Date(dateStr);
        if (isNaN(date.getTime())) return dateStr;
        return date.toLocaleDateString('en-PH', {
            year: 'numeric', month: 'long', day: 'numeric'
        }) + ' · ' + date.toLocaleTimeString('en-PH', {
            hour: '2-digit', minute: '2-digit', hour12: true
        });
    }

    function closeViewSalesModal() {
        const modal = document.getElementById('viewSalesModal');
        const panel = document.getElementById('viewSalesModalPanel');

        panel.style.transform = 'scale(0.95) translateY(-8px)';
        panel.style.opacity   = '0';

        setTimeout(() => {
            modal.classList.add('opacity-0', 'pointer-events-none');
        }, 150);
    }
</script>