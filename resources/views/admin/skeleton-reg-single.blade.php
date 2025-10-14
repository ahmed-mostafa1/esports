@extends('layouts.admin')

@section('title', 'Edit Single Player Registration Page')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Single Player Registration Page Editor</h1>

    <div class="space-y-8">
        
        {{-- Header Section --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Header Section</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                {{-- Main Title --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Main Title</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.header.title"
                           value="{{ content('single_registration.header.title', 'E-Sports') }}"
                           placeholder="E-Sports">
                </div>

                {{-- Subtitle --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.header.subtitle"
                           value="{{ content('single_registration.header.subtitle', 'Single Player Registration') }}"
                           placeholder="Single Player Registration">
                </div>

                {{-- Description --}}
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              data-content-key="single_registration.header.description"
                              placeholder="Register as an individual player for esports tournaments">{{ content('single_registration.header.description', 'Register as an individual player for esports tournaments') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Registration Form Section --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Registration Form</h2>
            
            {{-- Form Title --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Form Title</label>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       data-content-key="single_registration.form.title"
                       value="{{ content('single_registration.form.title', 'Player Registration Form') }}"
                       placeholder="Player Registration Form">
            </div>

            {{-- Personal Information Section --}}
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Personal Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Player Name Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Player Name Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.player_name"
                               value="{{ content('single_registration.form.player_name', 'Player Name') }}"
                               placeholder="Player Name">
                    </div>

                    {{-- Gamer Tag Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gamer Tag Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.gamer_tag"
                               value="{{ content('single_registration.form.gamer_tag', 'Gamer Tag') }}"
                               placeholder="Gamer Tag">
                    </div>

                    {{-- Email Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.email"
                               value="{{ content('single_registration.form.email', 'Email Address') }}"
                               placeholder="Email Address">
                    </div>

                    {{-- Phone Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.phone"
                               value="{{ content('single_registration.form.phone', 'Phone Number') }}"
                               placeholder="Phone Number">
                    </div>

                    {{-- Date of Birth Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.date_of_birth"
                               value="{{ content('single_registration.form.date_of_birth', 'Date of Birth') }}"
                               placeholder="Date of Birth">
                    </div>

                    {{-- Country Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Country Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.country"
                               value="{{ content('single_registration.form.country', 'Country') }}"
                               placeholder="Country">
                    </div>
                </div>
            </div>

            {{-- Gaming Information Section --}}
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Gaming Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Preferred Game Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Game Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.preferred_game"
                               value="{{ content('single_registration.form.preferred_game', 'Preferred Game') }}"
                               placeholder="Preferred Game">
                    </div>

                    {{-- Experience Level Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Experience Level Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.experience_level"
                               value="{{ content('single_registration.form.experience_level', 'Experience Level') }}"
                               placeholder="Experience Level">
                    </div>

                    {{-- Platform Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gaming Platform Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.platform"
                               value="{{ content('single_registration.form.platform', 'Gaming Platform') }}"
                               placeholder="Gaming Platform">
                    </div>

                    {{-- Previous Tournaments Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Previous Tournaments Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.previous_tournaments"
                               value="{{ content('single_registration.form.previous_tournaments', 'Previous Tournaments') }}"
                               placeholder="Previous Tournaments">
                    </div>

                    {{-- Tournament Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tournament Selection Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.tournament"
                               value="{{ content('single_registration.form.tournament', 'Select Tournament') }}"
                               placeholder="Select Tournament">
                    </div>

                    {{-- Skill Rating Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Rating Label</label>
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               data-content-key="single_registration.form.skill_rating"
                               value="{{ content('single_registration.form.skill_rating', 'Skill Rating') }}"
                               placeholder="Skill Rating">
                    </div>
                </div>
            </div>

            {{-- Additional Information --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes Label</label>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       data-content-key="single_registration.form.additional_notes"
                       value="{{ content('single_registration.form.additional_notes', 'Additional Notes') }}"
                       placeholder="Additional Notes">
            </div>

            {{-- Submit Button Text --}}
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Submit Button Text</label>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       data-content-key="single_registration.form.submit_button"
                       value="{{ content('single_registration.form.submit_button', 'Register Player') }}"
                       placeholder="Register Player">
            </div>
        </div>

        {{-- Social Media Section --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Social Media Links (Optional)</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Section Title --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.social.title"
                           value="{{ content('single_registration.social.title', 'Social Media (Optional)') }}"
                           placeholder="Social Media (Optional)">
                </div>

                {{-- Twitch Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Twitch Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.social.twitch"
                           value="{{ content('single_registration.social.twitch', 'Twitch Username') }}"
                           placeholder="Twitch Username">
                </div>

                {{-- YouTube Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">YouTube Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.social.youtube"
                           value="{{ content('single_registration.social.youtube', 'YouTube Channel') }}"
                           placeholder="YouTube Channel">
                </div>

                {{-- Discord Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Discord Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.social.discord"
                           value="{{ content('single_registration.social.discord', 'Discord Username') }}"
                           placeholder="Discord Username">
                </div>

                {{-- Steam Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Steam Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.social.steam"
                           value="{{ content('single_registration.social.steam', 'Steam Profile') }}"
                           placeholder="Steam Profile">
                </div>
            </div>
        </div>

        {{-- Success/Error Messages --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Messages</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Success Message --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Success Message</label>
                    <textarea rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              data-content-key="single_registration.messages.success"
                              placeholder="Registration successful! We will contact you soon with tournament details.">{{ content('single_registration.messages.success', 'Registration successful! We will contact you soon with tournament details.') }}</textarea>
                </div>

                {{-- Error Message --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Error Message</label>
                    <textarea rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              data-content-key="single_registration.messages.error"
                              placeholder="Registration failed. Please check your information and try again.">{{ content('single_registration.messages.error', 'Registration failed. Please check your information and try again.') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Terms and Conditions --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Terms and Conditions</h2>
            <div class="space-y-4">
                
                {{-- Terms Checkbox Label --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Terms Checkbox Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.terms.checkbox_label"
                           value="{{ content('single_registration.terms.checkbox_label', 'I agree to the Terms and Conditions') }}"
                           placeholder="I agree to the Terms and Conditions">
                </div>

                {{-- Privacy Policy Label --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Privacy Policy Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.terms.privacy_label"
                           value="{{ content('single_registration.terms.privacy_label', 'I have read and accept the Privacy Policy') }}"
                           placeholder="I have read and accept the Privacy Policy">
                </div>

                {{-- Age Confirmation Label --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Age Confirmation Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="single_registration.terms.age_confirmation"
                           value="{{ content('single_registration.terms.age_confirmation', 'I confirm that I am 13 years or older') }}"
                           placeholder="I confirm that I am 13 years or older">
                </div>
            </div>
        </div>

    </div>

    {{-- Save All Button --}}
    <div class="mt-8 flex justify-end">
        <button onclick="saveAllContent()" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
            Save All Changes
        </button>
    </div>
</div>

{{-- Success/Error Notifications --}}
<div id="notification" class="fixed top-4 right-4 z-50 hidden">
    <div id="notification-content" class="px-6 py-3 rounded-lg shadow-lg text-white font-medium">
        <!-- Notification message will be inserted here -->
    </div>
</div>

<script>
function saveAllContent() {
    const inputs = document.querySelectorAll('[data-content-key]');
    const updates = [];
    
    inputs.forEach(input => {
        const key = input.dataset.contentKey;
        const value = input.value || input.textContent;
        if (value) {
            updates.push({key, value});
        }
    });
    
    if (updates.length === 0) {
        showNotification('No changes to save', 'warning');
        return;
    }
    
    // Show loading state
    const button = event.target;
    const originalText = button.textContent;
    button.textContent = 'Saving...';
    button.disabled = true;
    
    // Send batch update
    fetch('{{ route("admin.content.batch-update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({updates})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(`Successfully updated ${data.updated_count} content items!`, 'success');
        } else {
            showNotification('Failed to save changes', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Failed to save changes', 'error');
    })
    .finally(() => {
        button.textContent = originalText;
        button.disabled = false;
    });
}

function showNotification(message, type) {
    const notification = document.getElementById('notification');
    const content = document.getElementById('notification-content');
    
    content.textContent = message;
    content.className = `px-6 py-3 rounded-lg shadow-lg text-white font-medium ${
        type === 'success' ? 'bg-green-500' : 
        type === 'warning' ? 'bg-yellow-500' : 'bg-red-500'
    }`;
    
    notification.classList.remove('hidden');
    
    setTimeout(() => {
        notification.classList.add('hidden');
    }, 3000);
}

// Auto-save individual fields on blur
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('[data-content-key]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            const key = this.dataset.contentKey;
            const value = this.value || this.textContent;
            
            if (!value) return;
            
            fetch('{{ route("admin.content.update-ajax") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({key, value})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Visual feedback - briefly highlight the field
                    this.classList.add('ring-2', 'ring-green-400');
                    setTimeout(() => {
                        this.classList.remove('ring-2', 'ring-green-400');
                    }, 1000);
                }
            })
            .catch(error => {
                console.error('Auto-save error:', error);
            });
        });
    });
});
</script>
@endsection