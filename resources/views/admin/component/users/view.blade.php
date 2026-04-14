<!-- User Details Modal -->
<div id="merchantModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-[#0c1222] border border-white/10 rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 border-b border-white/10 p-6">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-2xl">
                        <span id="modalInitial">T</span>
                    </div>
                    <div>
                        <h3 id="modalUserName" class="text-2xl font-bold text-white mb-1">Tech Events Co.</h3>
                        <p class="text-gray-400 text-sm">User ID: <span id="modalUserId" class="text-white font-mono">#MER-1000</span></p>
                    </div>
                </div>
                <button onclick="closeUserModal()" class="p-2 hover:bg-white/10 rounded-lg transition-all">
                    <svg class="w-6 h-6 text-gray-400 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="overflow-y-auto max-h-[calc(90vh-200px)]">
            <!-- User Info Section -->
            <div class="p-6 border-b border-white/10">
                <h4 class="text-lg font-semibold text-white mb-4">User Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Contact Person</p>
                        <p id="modalContactPerson" class="text-white font-medium">John Smith</p>
                    </div>
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Email Address</p>
                        <p id="modalEmail" class="text-white font-medium">john@techevents.com</p>
                    </div>
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Phone Number</p>
                        <p id="modalPhone" class="text-white font-medium">1 234-567-8901</p>
                    </div>
                    <div class="bg-white/5 rounded-lg p-4">
                        <p class="text-gray-400 text-sm mb-1">Status</p>
                        <span id="modalStatus" class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></span>
                            Active
                        </span>
                    </div>
                </div>
            </div>
            </div>


        <!-- Modal Footer -->
        <div class="border-t border-white/10 p-6 bg-white/5">
            <div class="flex flex-  col sm:flex-row gap-3 justify-end">
                <button onclick="closeUserModal()" class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                    Close
                </button>
                <button class="px-4 py-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit User
                    </span>
                </button>
   
            </div>
        </div>
    </div>
</div>

<script>
function openUserModal(details) {
    const modal = document.getElementById('merchantModal');
    const data = JSON.parse(details);

    console.log(JSON.parse(details));

    // // Set basic info
    document.getElementById('modalUserId').textContent = data.id;
    document.getElementById('modalUserName').textContent = data.name;
    document.getElementById('modalInitial').textContent = data.name.charAt(0).toUpperCase();
    document.getElementById('modalContactPerson').textContent = data.first_name + ' ' + data.last_name;
    document.getElementById('modalPhone').textContent = data.phone_number;
    document.getElementById('modalEmail').textContent = data.email;

    // // Set status
    const statusElement = document.getElementById('modalStatus');
    if (data.is_active === 1) {
        statusElement.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20';
        statusElement.innerHTML = '<span class="w-1.5 h-1.5 bg-green-400 rounded-full mr-1.5"></span>Active';
    } else if (data.is_active === 0) {
        statusElement.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-500/10 text-yellow-400 border border-yellow-500/20';
        statusElement.innerHTML = '<span class="w-1.5 h-1.5 bg-yellow-400 rounded-full mr-1.5"></span>Pending';
    } else {
        statusElement.className = 'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20';
        statusElement.innerHTML = '<span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1.5"></span>Inactive';
    }


    // Get events for this merchant
    
    // Build events list HTML
   

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeUserModal() {
    const modal = document.getElementById('merchantModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close modal when clicking outside
document.getElementById('merchantModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeUserModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeUserModal();
    }
});
</script>
