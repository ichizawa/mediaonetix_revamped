<div id="editMerchantModal" class="fixed inset-0 z-[9999] hidden" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeEditMerchantModal()">
        </div>

        <div class="relative bg-[#1a1f35] rounded-2xl shadow-2xl w-full max-w-4xl border border-white/10 my-8 opacity-0 transform scale-95 transition-all duration-200"
            id="editModalContent">
            <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 px-6 py-4 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Edit Merchant</h3>
                        <p class="text-sm text-gray-400 mt-1">Update the merchant details below</p>
                    </div>
                    <button type="button" onclick="closeEditMerchantModal()"
                        class="p-2 hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <form id="editMerchantForm" class="p-6 max-h-[calc(100vh-200px)] overflow-y-auto"
                action="{{ route('admin.merchants.update', ['id' => $merchant->id ?? '']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="merchant_id" id="edit_merchant_id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Business Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name" value="{{ $merchant->name }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter business name">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            First Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="first_name" value="{{ $merchant->first_name }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter first name">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Last Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="last_name" value="{{ $merchant->last_name }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter last name">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Username <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="username" value="{{ $merchant->username }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter username">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Email Address <span class="text-red-400">*</span>
                        </label>
                        <input type="email" name="email" value="{{ $merchant->email }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="merchant@example.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Phone Number <span class="text-red-400">*</span>
                        </label>
                        <input type="tel" name="phone_number" value="{{ $merchant->phone_number }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="+1 234-567-8900">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Date of Birth <span class="text-red-400">*</span>
                        </label>
                        <input type="date" name="dob" value="{{ $merchant->dob }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Gender <span class="text-red-400">*</span>
                        </label>
                        <select name="gender" value="{{ $merchant->gender }}" required
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
                        <select name="country" value="{{ $merchant->country }}" required
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
                        <input type="text" name="city" value="{{ $merchant->city }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter city">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Zip Code <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="zip_code" value="{{ $merchant->zip_code }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter zip code">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Address <span class="text-red-400">*</span>
                        </label>
                        <textarea name="address" rows="3" value="{{ $merchant->address }}" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                            placeholder="Enter complete address"></textarea>
                    </div>


                </div>

                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-white/10">
                    <button type="button" onclick="closeEditMerchantModal()"
                        class="px-6 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Update Merchant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Accept merchant object as parameter
    function openEditMerchantModal(merchant) {
        console.log("Merchant Data Received:", merchant);
        const modal = document.getElementById('editMerchantModal');
        const modalContent = document.getElementById('editModalContent');
        const form = document.getElementById('editMerchantForm');

        if (modal && modalContent && form) {
            form.action = `/admin/merchants/update/${merchant.id}`;
            // The JavaScript will overwrite the Blade values with the specific merchant you clicked
            form.elements['merchant_id'].value = merchant.id;
            form.elements['name'].value = merchant.name || '';
            form.elements['first_name'].value = merchant.first_name || '';
            form.elements['last_name'].value = merchant.last_name || '';
            form.elements['username'].value = merchant.username || '';
            form.elements['email'].value = merchant.email || '';
            form.elements['phone_number'].value = merchant.phone_number || '';
            form.elements['dob'].value = merchant.dob || '';
            const genderSelect = form.elements['gender'];
            const targetGender = (merchant.gender || '').toLowerCase();
            Array.from(genderSelect.options).forEach(option => {
                if (option.value.toLowerCase() === targetGender) {
                    option.selected = true;
                }
            });

            // 2. Handle Country (Fixes Data "Philippines" vs HTML value "PH")
            const countrySelect = form.elements['country'];
            const targetCountry = merchant.country || '';
            Array.from(countrySelect.options).forEach(option => {
                // This checks if EITHER the HTML value ("PH") OR the visible text ("Philippines") matches
                if (option.value === targetCountry || option.text === targetCountry) {
                    option.selected = true;
                }
            });
            form.elements['city'].value = merchant.city || '';
            form.elements['zip_code'].value = merchant.zip_code || '';

            // For textarea, setting .value in JS is the correct approach
            form.elements['address'].value = merchant.address || '';



            modal.style.display = 'block';
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Trigger animation
            setTimeout(() => {
                modalContent.style.opacity = '1';
                modalContent.style.transform = 'scale(1)';
            }, 10);
        }
    }

    function closeEditMerchantModal() {
        const modal = document.getElementById('editMerchantModal');
        const modalContent = document.getElementById('editModalContent');

        if (modal && modalContent) {
            modalContent.style.opacity = '0';
            modalContent.style.transform = 'scale(0.95)';

            setTimeout(() => {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';

                const form = document.getElementById('editMerchantForm');
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
        const modal = document.getElementById('editMerchantModal');
        if (e.target.classList.contains('backdrop-blur-sm') && e.target.closest('#editMerchantModal')) {
            closeEditMerchantModal();
        }
    });

    // Close modal when pressing Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('editMerchantModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeEditMerchantModal();
            }
        }
    });
</script>
