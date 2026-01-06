<!-- Add Merchant Modal -->
<div id="addMerchantModal" class="fixed inset-0 z-[9999] hidden" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" onclick="closeAddMerchantModal()"></div>

        <!-- Modal panel -->
        <div class="relative bg-[#1a1f35] rounded-2xl shadow-2xl w-full max-w-4xl border border-white/10 my-8 opacity-0 transform scale-95 transition-all duration-200" id="modalContent">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600/10 to-purple-600/10 px-6 py-4 border-b border-white/10">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-white">Add New Merchant</h3>
                        <p class="text-sm text-gray-400 mt-1">Fill in the merchant details below</p>
                    </div>
                    <button type="button" onclick="closeAddMerchantModal()" class="p-2 hover:bg-white/10 rounded-lg transition-all">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form id="addMerchantForm" class="p-6 max-h-[calc(100vh-200px)] overflow-y-auto" onsubmit="handleMerchantSubmit(event)">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Business/Merchant Name -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Business Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter business name">
                    </div>

                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            First Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="first_name" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter first name">
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Last Name <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="last_name" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter last name">
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Username <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="username" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter username">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Email Address <span class="text-red-400">*</span>
                        </label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="merchant@example.com">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Phone Number <span class="text-red-400">*</span>
                        </label>
                        <input type="tel" name="phone_number" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="+1 234-567-8900">
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Date of Birth <span class="text-red-400">*</span>
                        </label>
                        <input type="date" name="dob" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Gender <span class="text-red-400">*</span>
                        </label>
                        <select name="gender" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <option value="">Select gender</option>
                            <option value="male" class="text-black">Male</option>
                            <option value="female" class="text-black">Female</option>
                            <option value="other" class="text-black">Other</option>
                            <option value="prefer_not_to_say" class="text-black">Prefer not to say</option>
                        </select>
                    </div>

                    <!-- Country -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Country <span class="text-red-400">*</span>
                        </label>
                        <select name="country" required
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

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            City <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="city" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter city">
                    </div>

                    <!-- Zip Code -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Zip Code <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="zip_code" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                            placeholder="Enter zip code">
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Address <span class="text-red-400">*</span>
                        </label>
                        <textarea name="address" rows="3" required
                            class="w-full px-4 py-2.5 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                            placeholder="Enter complete address"></textarea>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Password <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required minlength="8"
                                class="w-full px-4 py-2.5 pr-10 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Enter password (min. 8 characters)">
                            <button type="button" onclick="togglePasswordVisibility('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-semibold text-white mb-2">
                            Confirm Password <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8"
                                class="w-full px-4 py-2.5 pr-10 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="Confirm password">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Profile Image -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-white mb-2">
                            Profile Image
                        </label>
                        <div class="flex items-center gap-4">
                            <div id="imagePreview" class="w-20 h-20 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center text-white text-2xl font-bold overflow-hidden">
                                <svg class="w-10 h-10 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewMerchantImage(event)" class="hidden">
                                <label for="imageInput"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium cursor-pointer transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Upload Image
                                </label>
                                <p class="text-xs text-gray-400 mt-2">JPG, PNG or GIF (max. 2MB)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-white/10">
                    <button type="button" onclick="closeAddMerchantModal()"
                        class="px-6 py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 rounded-lg text-white font-medium transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Merchant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to open the add merchant modal
function openAddMerchantModal() {
    console.log('Opening modal...');
    const modal = document.getElementById('addMerchantModal');
    const modalContent = document.getElementById('modalContent');

    if (modal && modalContent) {
        modal.style.display = 'block';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Trigger animation
        setTimeout(() => {
            modalContent.style.opacity = '1';
            modalContent.style.transform = 'scale(1)';
        }, 10);
    } else {
        console.error('Modal elements not found');
    }
}

// Function to close the add merchant modal
function closeAddMerchantModal() {
    console.log('Closing modal...');
    const modal = document.getElementById('addMerchantModal');
    const modalContent = document.getElementById('modalContent');

    if (modal && modalContent) {
        // Animate out
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95)';

        setTimeout(() => {
            modal.style.display = 'none';
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';

            // Reset form
            const form = document.getElementById('addMerchantForm');
            if (form) {
                form.reset();
            }

            // Reset image preview
            const imagePreview = document.getElementById('imagePreview');
            if (imagePreview) {
                imagePreview.innerHTML = `
                    <svg class="w-10 h-10 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                `;
            }
        }, 200);
    }
}

// Function to toggle password visibility
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.type = input.type === 'password' ? 'text' : 'password';
    }
}

// Function to preview merchant image
function previewMerchantImage(event) {
    const file = event.target.files[0];
    if (file) {
        // Check file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB');
            event.target.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const imagePreview = document.getElementById('imagePreview');
            if (imagePreview) {
                imagePreview.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" alt="Preview">
                `;
            }
        };
        reader.readAsDataURL(file);
    }
}

// Function to handle form submission (mockup)
function handleMerchantSubmit(event) {
    event.preventDefault();

    const formData = new FormData(event.target);
    const password = formData.get('password');
    const passwordConfirmation = formData.get('password_confirmation');

    // Validate passwords match
    if (password !== passwordConfirmation) {
        alert('Passwords do not match!');
        return;
    }

    // Log form data (for mockup purposes)
    console.log('Form Data:', Object.fromEntries(formData));

    // Show success message
    alert('Merchant added successfully! (Mockup - No data was actually saved)');

    // Close modal and reset form
    closeAddMerchantModal();
}

// Close modal when pressing Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('addMerchantModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeAddMerchantModal();
        }
    }
});

// Close modal when clicking outside (on backdrop)
document.addEventListener('click', function(e) {
    const modal = document.getElementById('addMerchantModal');
    if (e.target === modal) {
        closeAddMerchantModal();
    }
});
</script>
