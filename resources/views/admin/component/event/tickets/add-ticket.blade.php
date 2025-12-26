<div id="ticketModal" class="modal">
    <div class="modal-content bg-gradient-to-br from-[#1a2234] to-[#0c1222] border border-white/10 rounded-2xl w-full max-w-2xl mx-4">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <h3 id="ticketModalTitle" class="text-2xl font-bold text-white">Add Ticket Type</h3>
                <button onclick="closeTicketModal()" class="p-2 hover:bg-white/5 rounded-lg transition-all">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <form id="ticketForm" action="#" method="POST">
            @csrf
            <input type="hidden" id="ticketId" name="ticket_id">
            <input type="hidden" id="ticketFormMethod" name="_method" value="POST">
            <input type="hidden" name="event_id" value="{{ $event_id ?? '' }}">

            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Name <span class="text-red-400">*</span></label>
                    <input type="text" id="ticketName" name="name" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                        placeholder="e.g., VIP Pass, General Admission, Early Bird">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Type <span class="text-red-400">*</span></label>
                    <input type="text" id="ticketType" name="type" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                        placeholder="e.g., VIP, Standard, Premium">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Status <span class="text-red-400">*</span></label>
                    <select id="ticketStatus" name="status" required
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white focus:outline-none focus:border-blue-500 transition-all appearance-none cursor-pointer">
                        <option value="" disabled selected class="bg-[#1a2234]">Select status</option>
                        <option value="active" class="bg-[#1a2234]">Active</option>
                        <option value="inactive" class="bg-[#1a2234]">Inactive</option>
                        <option value="out_of_stock" class="bg-[#1a2234]">Out of Stock</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ticket Color</label>
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 gap-3 mb-3">
                        <button type="button" onclick="selectColor('#EF4444')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #EF4444" data-color="#EF4444">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#F97316')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #F97316" data-color="#F97316">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#F59E0B')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #F59E0B" data-color="#F59E0B">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#EAB308')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #EAB308" data-color="#EAB308">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#84CC16')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #84CC16" data-color="#84CC16">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#10B981')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #10B981" data-color="#10B981">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#14B8A6')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #14B8A6" data-color="#14B8A6">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#06B6D4')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #06B6D4" data-color="#06B6D4">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#3B82F6')" class="color-option w-full aspect-square rounded-lg border-2 border-white/40 transition-all" style="background: #3B82F6" data-color="#3B82F6">
                            <svg class="w-6 h-6 text-white mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#6366F1')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #6366F1" data-color="#6366F1">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#8B5CF6')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #8B5CF6" data-color="#8B5CF6">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#A855F7')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #A855F7" data-color="#A855F7">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#D946EF')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #D946EF" data-color="#D946EF">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#EC4899')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #EC4899" data-color="#EC4899">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#F43F5E')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #F43F5E" data-color="#F43F5E">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#FFD700')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #FFD700" data-color="#FFD700">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <button type="button" onclick="selectColor('#94A3B8')" class="color-option w-full aspect-square rounded-lg border-2 border-transparent hover:border-white/40 transition-all" style="background: #94A3B8" data-color="#94A3B8">
                            <svg class="w-6 h-6 text-white mx-auto hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </button>
                        <!-- Custom Color Button -->
                        <button type="button" onclick="openCustomColorPicker()" class="color-option w-full aspect-square rounded-lg border-2 border-dashed border-white/20 hover:border-white/40 transition-all flex items-center justify-center bg-white/5">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Custom Color Picker Section (Hidden by default) -->
                    <div id="customColorSection" class="mt-4 hidden">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">Custom Color Picker</label>
                                <input type="color" id="customColorPicker" 
                                    class="w-full h-10 cursor-pointer rounded-lg border border-white/10 bg-transparent"
                                    value="#3B82F6">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-300 mb-2">Hex Color Code</label>
                                <div class="flex gap-2">
                                    <input type="text" id="customColorInput" 
                                        class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                                        placeholder="#RRGGBB" maxlength="7">
                                    <button type="button" onclick="applyCustomColor()" 
                                        class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all text-sm whitespace-nowrap">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="ticketColor" name="color" value="#3B82F6">
                    <div class="flex items-center gap-2 text-sm text-gray-400 mt-3">
                        <div class="w-6 h-6 rounded border border-white/20" id="selectedColorPreview" style="background: #3B82F6"></div>
                        <span>Selected: <span id="selectedColorText">#3B82F6</span></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Price (₱) <span class="text-red-400">*</span></label>
                        <input type="number" id="ticketPrice" name="price" step="0.01" min="0" required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                            placeholder="0.00">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Quantity <span class="text-red-400">*</span></label>
                        <input type="number" id="ticketQuantity" name="quantity" min="1" required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                            placeholder="100">
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-white/10 flex gap-3 justify-end">
                <button type="button" onclick="closeTicketModal()"
                    class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white rounded-lg font-semibold transition-all">
                    Cancel
                </button>
                <button type="submit" id="ticketSubmitBtn"
                    class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 text-white rounded-lg font-semibold transition-all">
                    Create Ticket Type
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let selectedCustomColor = null;

function selectColor(color) {
    // Remove selection from all color options
    document.querySelectorAll('.color-option').forEach(option => {
        option.classList.remove('border-white/40');
        option.classList.add('border-transparent');
        const svg = option.querySelector('svg');
        if (svg) svg.classList.add('hidden');
    });
    
    // Add selection to clicked option
    const clickedOption = document.querySelector(`.color-option[data-color="${color}"]`);
    if (clickedOption) {
        clickedOption.classList.remove('border-transparent');
        clickedOption.classList.add('border-white/40');
        const svg = clickedOption.querySelector('svg');
        if (svg) svg.classList.remove('hidden');
    }
    
    // Update the hidden input and preview
    document.getElementById('ticketColor').value = color;
    document.getElementById('selectedColorPreview').style.background = color;
    document.getElementById('selectedColorText').textContent = color;
    
    // Hide custom color section if it's open
    document.getElementById('customColorSection').classList.add('hidden');
    selectedCustomColor = null;
}

function openCustomColorPicker() {
    const customColorSection = document.getElementById('customColorSection');
    const isHidden = customColorSection.classList.contains('hidden');
    
    if (isHidden) {
        // Open custom color picker
        customColorSection.classList.remove('hidden');
        
        // Deselect all predefined colors
        document.querySelectorAll('.color-option').forEach(option => {
            option.classList.remove('border-white/40');
            option.classList.add('border-transparent');
            const svg = option.querySelector('svg');
            if (svg) svg.classList.add('hidden');
        });
        
        // Set current color in picker
        const currentColor = document.getElementById('ticketColor').value;
        document.getElementById('customColorPicker').value = currentColor;
        document.getElementById('customColorInput').value = currentColor;
        
        // Highlight the custom color button
        const customBtn = document.querySelector('[onclick="openCustomColorPicker()"]');
        customBtn.classList.remove('border-dashed', 'border-white/20');
        customBtn.classList.add('border-white/40', 'border-solid');
    } else {
        // Close custom color picker
        closeCustomColorPicker();
    }
}

function closeCustomColorPicker() {
    document.getElementById('customColorSection').classList.add('hidden');
    const customBtn = document.querySelector('[onclick="openCustomColorPicker()"]');
    customBtn.classList.remove('border-white/40', 'border-solid');
    customBtn.classList.add('border-dashed', 'border-white/20');
}

function applyCustomColor() {
    let color = document.getElementById('customColorInput').value;
    
    // Validate hex color format
    if (!color.startsWith('#')) {
        color = '#' + color;
    }
    
    // Validate hex color
    const hexRegex = /^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/;
    if (!hexRegex.test(color)) {
        alert('Please enter a valid hex color code (e.g., #FF5733 or #FFF)');
        return;
    }
    
    // Expand 3-digit hex to 6-digit
    if (color.length === 4) {
        color = '#' + color[1] + color[1] + color[2] + color[2] + color[3] + color[3];
    }
    
    // Update all color inputs
    document.getElementById('customColorPicker').value = color;
    document.getElementById('customColorInput').value = color;
    document.getElementById('ticketColor').value = color;
    document.getElementById('selectedColorPreview').style.background = color;
    document.getElementById('selectedColorText').textContent = color;
    
    // Highlight the custom color button
    const customBtn = document.querySelector('[onclick="openCustomColorPicker()"]');
    customBtn.style.background = color;
    customBtn.classList.remove('border-dashed', 'border-white/20', 'bg-white/5');
    customBtn.classList.add('border-white/40', 'border-solid');
    
    selectedCustomColor = color;
}

// Update custom color input when color picker changes
document.getElementById('customColorPicker').addEventListener('input', function(e) {
    document.getElementById('customColorInput').value = e.target.value;
});

// Apply custom color when Enter is pressed in the input
document.getElementById('customColorInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        applyCustomColor();
    }
});

// Initialize modal close function
function closeTicketModal() {
    document.getElementById('ticketModal').classList.remove('active');
    closeCustomColorPicker();
}

// When editing a ticket, set the custom color if it's not a predefined color
function setTicketColorForEdit(color) {
    const predefinedColors = [
        '#EF4444', '#F97316', '#F59E0B', '#EAB308', '#84CC16', '#10B981',
        '#14B8A6', '#06B6D4', '#3B82F6', '#6366F1', '#8B5CF6', '#A855F7',
        '#D946EF', '#EC4899', '#F43F5E', '#FFD700', '#94A3B8'
    ];
    
    if (predefinedColors.includes(color)) {
        selectColor(color);
    } else {
        // It's a custom color
        document.getElementById('ticketColor').value = color;
        document.getElementById('selectedColorPreview').style.background = color;
        document.getElementById('selectedColorText').textContent = color;
        
        // Update custom color inputs
        document.getElementById('customColorPicker').value = color;
        document.getElementById('customColorInput').value = color;
        
        // Highlight the custom color button
        const customBtn = document.querySelector('[onclick="openCustomColorPicker()"]');
        customBtn.style.background = color;
        customBtn.classList.remove('border-dashed', 'border-white/20', 'bg-white/5');
        customBtn.classList.add('border-white/40', 'border-solid');
        
        selectedCustomColor = color;
    }
}
</script>