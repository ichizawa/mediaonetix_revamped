<!-- Delete Confirmation Modal -->
<div id="deleteStaffModal" class="fixed inset-0 z-[9999] hidden" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeDeleteStaffModal()"></div>
        <div class="relative bg-gradient-to-br from-[#1a2332] to-[#0c1222] border border-white/10 rounded-2xl p-8 w-full max-w-md shadow-2xl opacity-0 transform scale-95 transition-all duration-200" id="deleteStaffModalContent">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-white">Delete Staff</h3>
                <button onclick="closeDeleteStaffModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-white text-lg font-semibold mb-2">Are you sure you want to delete this user?</p>
                <p class="text-gray-400 text-sm">This action cannot be undone. All data related to this user will be permanently removed.</p>
            </div>
            <form id="deleteStaffFormModal" method="POST" action="#">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-white/10">
                    <button type="button" onclick="closeDeleteStaffModal()" class="px-6 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white rounded-lg font-semibold transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    let deleteStaffFormId = null;
    function openDeleteStaffModal(formId, actionUrl) {
        deleteStaffFormId = formId;
        const modal = document.getElementById('deleteStaffModal');
        const modalContent = document.getElementById('deleteStaffModalContent');
        const form = document.getElementById('deleteStaffFormModal');
        if (form) {
            form.action = actionUrl;
        }
        modal.style.display = 'block';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => {
            modalContent.style.opacity = '1';
            modalContent.style.transform = 'scale(1)';
        }, 10);
    }
    function closeDeleteStaffModal() {
        const modal = document.getElementById('deleteStaffModal');
        const modalContent = document.getElementById('deleteStaffModalContent');
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95)';
        setTimeout(() => {
            modal.style.display = 'none';
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 200);
    }
    // Close modal on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('deleteStaffModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeDeleteStaffModal();
            }
        }
    });
    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('deleteStaffModal');
        if (e.target === modal) {
            closeDeleteStaffModal();
        }
    });
</script>
