<div id="editStaffModal" class="fixed inset-0 z-[9999] hidden" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditStaffModal()"></div>

        <div class="relative bg-[#1a1f35] rounded-2xl shadow-2xl w-full max-w-4xl border border-white/10 my-8 opacity-0 transform scale-95 transition-all duration-200" id="editModalContent">
            <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 px-6 py-4 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Edit Staff</h3>
                        <p class="text-sm text-gray-400 mt-1">Update the staff details below</p>
                    </div>
                    <button type="button" onclick="closeEditStaffModal()" class="p-2 hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <form id="editStaffForm" class="p-6 max-h-[calc(100vh-200px)] overflow-y-auto" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">First Name <span class="text-red-400">*</span></label>
                        <input type="text" name="first_name" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Enter first name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Last Name <span class="text-red-400">*</span></label>
                        <input type="text" name="last_name" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Enter last name">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Username <span class="text-red-400">*</span></label>
                        <input type="text" name="username" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Enter username">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Email Address <span class="text-red-400">*</span></label>
                        <input type="email" name="email" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="staff@example.com">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Phone Number <span class="text-red-400">*</span></label>
                        <input type="tel" name="phone_number" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="+1 234-567-8900">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Password <span class="text-gray-400">(leave blank to keep current)</span></label>
                        <input type="password" name="password" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Enter new password">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Security PIN <span class="text-gray-400">(leave blank to keep current)</span></label>
                        <input type="password" maxlength="6" name="security_pin" class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Enter PIN">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">Assign to Event <span class="text-red-400">*</span></label>
                        <select name="event_id" required class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
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
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">Permissions <span class="text-red-400">*</span></label>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-all">
                                <input type="checkbox" name="permission_name[]" value="scan_tickets" class="w-5 h-5 rounded border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 bg-white/5">
                                <div class="flex-1">
                                    <p class="text-white font-medium">Scan Tickets</p>
                                    <p class="text-xs text-gray-400">Allow scanning QR codes for ticket validation</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-3 bg-white/5 rounded-lg cursor-pointer hover:bg-white/10 transition-all">
                                <input type="checkbox" name="permission_name[]" value="view_reports" class="w-5 h-5 rounded border-white/20 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 bg-white/5">
                                <div class="flex-1">
                                    <p class="text-white font-medium">View Reports</p>
                                    <p class="text-xs text-gray-400">Access to scanning reports and analytics</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-white/10">
                    <button type="button" onclick="closeEditStaffModal()" class="px-6 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">Cancel</button>
                    <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Update Staff
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditStaffModal(staff) {
        const modal = document.getElementById('editStaffModal');
        const modalContent = document.getElementById('editModalContent');
        const form = document.getElementById('editStaffForm');

        if (modal && modalContent && form) {
            // Set the correct route for updates based on merchants.php
            form.action = `/merchant/organizers/update/${staff.id}`;
            
            // Populate form fields
            form.elements['first_name'].value = staff.first_name || '';
            form.elements['last_name'].value = staff.last_name || '';
            form.elements['username'].value = staff.username || '';
            form.elements['email'].value = staff.email || '';
            form.elements['phone_number'].value = staff.phone_number || '';
            
            // Populate select dropdown
            const eventSelect = form.elements['event_id'];
            if(staff.event_id) {
                Array.from(eventSelect.options).forEach(option => {
                    if (option.value == staff.event_id) {
                        option.selected = true;
                    }
                });
            }

            modal.style.display = 'block';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                modalContent.style.opacity = '1';
                modalContent.style.transform = 'scale(1)';
            }, 10);
        }
    }

    function closeEditStaffModal() {
        const modal = document.getElementById('editStaffModal');
        const modalContent = document.getElementById('editModalContent');

        if (modal && modalContent) {
            modalContent.style.opacity = '0';
            modalContent.style.transform = 'scale(0.95)';

            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';

                const form = document.getElementById('editStaffForm');
                if (form) {
                    form.reset();
                }
            }, 200);
        }
    }

    // Modal click-outside handler
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('backdrop-blur-sm') && e.target.closest('#editStaffModal')) {
            closeEditStaffModal();
        }
    });

    // Close modal when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('editStaffModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditStaffModal();
            }
        }
    });
</script>