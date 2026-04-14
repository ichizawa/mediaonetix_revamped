<div id="editUserModal" class="fixed inset-0 z-[9999] hidden" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeUsersEditModal()">
        </div>

        <div class="relative bg-[#1a1f35] rounded-2xl shadow-2xl w-full max-w-4xl border border-white/10 my-8 opacity-0 transform scale-95 transition-all duration-200"
            id="editUserModalContent">
            <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 px-6 py-4 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Edit User</h3>
                        <p class="text-sm text-gray-400 mt-1">Update the user details below</p>
                    </div>
                    <button type="button" onclick="closeUsersEditModal()"
                        class="p-2 hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <form id="editUserForm" class="p-6 max-h-[calc(100vh-200px)] overflow-y-auto"
                action="{{ route('admin.users.update', ['id' => $user->id ?? '']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Select Role <span class="text-red-400">*</span>
                        </label>
                        <select name="role_id" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            First Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter first name">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Last Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter last name">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Username <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="username" value="{{ $user->username }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter username">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Email Address <span class="text-red-400">*</span>
                        </label>
                        <input type="email" name="email" value="{{ $user->email }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="user@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Phone Number <span class="text-red-400">*</span>
                        </label>
                        <input type="tel" name="phone_number" value="{{ $user->phone_number }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="+1 234-567-8900">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Date of Birth <span class="text-red-400">*</span>
                        </label>
                        <input type="date" name="dob" value="{{ $user->dob }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Gender <span class="text-red-400">*</span>
                        </label>
                        <select name="gender" value="{{ $user->gender }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Select gender</option>
                            <option value="male" class="text-black">Male</option>
                            <option value="female" class="text-black">Female</option>
                            <option value="other" class="text-black">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Country <span class="text-red-400">*</span>
                        </label>
                        <select name="country" value="{{ $user->country }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="" class="text-black">Select country</option>
                            <option value="US" class="text-black">United States</option>
                            <option value="CA" class="text-black">Canada</option>
                            <option value="GB" class="text-black">United Kingdom</option>
                            <option value="AU" class="text-black">Australia</option>
                            <option value="PH" class="text-black">Philippines</option>
                            <option value="IN" class="text-black">India</option>
                            <option value="SG" class="text-black">Singapore</option>
                            <option value="MY" class="text-black">Malaysia</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            City <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="city" value="{{ $user->city }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter city">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Zip Code <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="zip_code" value="{{ $user->zip_code }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter zip code">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Address <span class="text-red-400">*</span>
                        </label>
                        <textarea name="address" rows="3" value="{{ $user->address }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                            placeholder="Enter complete address"></textarea>
                    </div>


                </div>

                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-white/10">
                    <button type="button" onclick="closeUsersEditModal()"
                        class="px-6 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Accept user object as parameter
    function openUsersEditModal(user) {
        if (typeof closeUserModal === 'function') closeUserModal();
        console.log("User Data Received:", user);
        const modal = document.getElementById('editUserModal');
        const modalContent = document.getElementById('editUserModalContent');
        const form = document.getElementById('editUserForm');

        if (modal && modalContent && form) {
            // Open first to avoid perceived no-op if any field mapping fails.
            modal.style.display = 'block';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            form.action = `/admin/users/update/${user.id}`;
            // Defensive assignment so missing fields don't block modal opening.
            if (form.elements['user_id']) form.elements['user_id'].value = user.id || '';
            if (form.elements['role_id']) {
                const roleId = user.role_id ?? user.role?.id ?? '';
                form.elements['role_id'].value = roleId ? String(roleId) : '';
            }
            if (form.elements['name']) form.elements['name'].value = user.name || '';
            if (form.elements['first_name']) form.elements['first_name'].value = user.first_name || '';
            if (form.elements['last_name']) form.elements['last_name'].value = user.last_name || '';
            if (form.elements['username']) form.elements['username'].value = user.username || '';
            if (form.elements['email']) form.elements['email'].value = user.email || '';
            if (form.elements['phone_number']) form.elements['phone_number'].value = user.phone_number || '';
            if (form.elements['dob']) form.elements['dob'].value = user.dob || '';
            const genderSelect = form.elements['gender'];
            const genderValueMap = {
                0: 'male',
                1: 'female',
                2: 'other',
            };
            const rawGender = user.gender;
            const targetGender = typeof rawGender === 'number'
                ? (genderValueMap[rawGender] || '')
                : String(rawGender || '').toLowerCase();
            if (genderSelect) genderSelect.value = targetGender;

            // 2. Handle Country (Fixes Data "Philippines" vs HTML value "PH")
            const countrySelect = form.elements['country'];
            const targetCountry = user.country || '';
            if (countrySelect) {
                countrySelect.value = '';
                Array.from(countrySelect.options).forEach(option => {
                    if (option.value === targetCountry || option.text === targetCountry) {
                        option.selected = true;
                    }
                });
            }
            if (form.elements['city']) form.elements['city'].value = user.city || '';
            if (form.elements['zip_code']) form.elements['zip_code'].value = user.zip_code || '';
            if (form.elements['address']) form.elements['address'].value = user.address || '';

            // Trigger animation
            setTimeout(() => {
                modalContent.style.opacity = '1';
                modalContent.style.transform = 'scale(1)';
            }, 10);
        }
    }

    function closeUsersEditModal() {
        const modal = document.getElementById('editUserModal');
        const modalContent = document.getElementById('editUserModalContent');

        if (modal && modalContent) {
            modalContent.style.opacity = '0';
            modalContent.style.transform = 'scale(0.95)';

            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';

                const form = document.getElementById('editUserForm');
                if (form) {
                    form.reset();
                }
            }, 200);
        }
    }

    function togglePasswordVisibility(inputId) {
        const input = document.getElementById(inputId);
        if (input) {
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    }

    // Modal click-outside handler
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('editUserModal');
        if (e.target.classList.contains('backdrop-blur-sm') && e.target.closest('#editUserModal')) {
            closeUsersEditModal();
        }
    });

    // Close modal when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('editUserModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeUsersEditModal();
            }
        }
    });

    // Backward compatibility for existing inline handlers.
    window.openEditUserModal = openUsersEditModal;
    window.closeEditUserModal = closeUsersEditModal;

    // Bind edit buttons via data attributes to avoid inline JSON/event collisions.
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.js-open-user-edit');
        if (!trigger) return;

        e.preventDefault();
        e.stopPropagation();

        const payload = trigger.getAttribute('data-user');
        if (!payload) return;

        try {
            const user = JSON.parse(payload);
            openUsersEditModal(user);
        } catch (err) {
            console.error('Failed to parse user payload for edit modal:', err);
        }
    });
</script>
