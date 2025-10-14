@extends('admin.layout')

@section('title', 'Edit Team Registration Page')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Team Registration Page Editor</h1>

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
                           data-content-key="team_registration.header.title"
                           value="{{ content('team_registration.header.title', 'E-Sports') }}"
                           placeholder="E-Sports">
                </div>

                {{-- Subtitle --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.header.subtitle"
                           value="{{ content('team_registration.header.subtitle', 'Team Registration') }}"
                           placeholder="Team Registration">
                </div>

                {{-- Description --}}
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              data-content-key="team_registration.header.description"
                              placeholder="Register your team for upcoming esports tournaments">{{ content('team_registration.header.description', 'Register your team for upcoming esports tournaments') }}</textarea>
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
                       data-content-key="team_registration.form.title"
                       value="{{ content('team_registration.form.title', 'Team Registration Form') }}"
                       placeholder="Team Registration Form">
            </div>

            {{-- Form Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Team Name Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Team Name Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.team_name"
                           value="{{ content('team_registration.form.team_name', 'Team Name') }}"
                           placeholder="Team Name">
                </div>

                {{-- Captain Name Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Captain Name Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.captain_name"
                           value="{{ content('team_registration.form.captain_name', 'Captain\'s Name') }}"
                           placeholder="Captain's Name">
                </div>

                {{-- Captain Email Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Captain Email Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.captain_email"
                           value="{{ content('team_registration.form.captain_email', 'Captain\'s Email') }}"
                           placeholder="Captain's Email">
                </div>

                {{-- Captain Phone Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Captain Phone Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.captain_phone"
                           value="{{ content('team_registration.form.captain_phone', 'Captain\'s Phone') }}"
                           placeholder="Captain's Phone">
                </div>

                {{-- Team Size Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Team Size Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.team_size"
                           value="{{ content('team_registration.form.team_size', 'Team Size') }}"
                           placeholder="Team Size">
                </div>

                {{-- Game Type Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Game Type Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.game_type"
                           value="{{ content('team_registration.form.game_type', 'Game Type') }}"
                           placeholder="Game Type">
                </div>

                {{-- Experience Level Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Experience Level Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.experience_level"
                           value="{{ content('team_registration.form.experience_level', 'Experience Level') }}"
                           placeholder="Experience Level">
                </div>

                {{-- Tournament Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tournament Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.tournament"
                           value="{{ content('team_registration.form.tournament', 'Select Tournament') }}"
                           placeholder="Select Tournament">
                </div>
            </div>

            {{-- Additional Notes Field --}}
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes Label</label>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       data-content-key="team_registration.form.additional_notes"
                       value="{{ content('team_registration.form.additional_notes', 'Additional Notes') }}"
                       placeholder="Additional Notes">
            </div>

            {{-- Submit Button Text --}}
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Submit Button Text</label>
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       data-content-key="team_registration.form.register_button"
                       value="{{ content('team_registration.form.register_button', 'Register Team') }}"
                       placeholder="Register Team">
            </div>
        </div>

        {{-- Tabs Section --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Navigation Tabs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Tournament Tab --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tournament Tab Text</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.tabs.tournament"
                           value="{{ content('team_registration.tabs.tournament', 'Tournament Registrations') }}"
                           placeholder="Tournament Registrations">
                </div>

                {{-- Register Tab --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Register Tab Text</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.tabs.register"
                           value="{{ content('team_registration.tabs.register', 'Register – now') }}"
                           placeholder="Register – now">
                </div>

                {{-- Team Tab --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Team Tab Text</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.tabs.team"
                           value="{{ content('team_registration.tabs.team', 'Team') }}"
                           placeholder="Team">
                </div>
            </div>
        </div>

        {{-- Additional Form Fields --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Additional Form Fields</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Captain Logo Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Captain Logo Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.captain_logo"
                           value="{{ content('team_registration.form.captain_logo', 'Captain\'s Logo') }}"
                           placeholder="Captain's Logo">
                </div>

                {{-- Team Logo Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Team Logo Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.team_logo"
                           value="{{ content('team_registration.form.team_logo', 'Team Logo') }}"
                           placeholder="Team Logo">
                </div>

                {{-- Upload Placeholder --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Placeholder Text</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.upload_placeholder"
                           value="{{ content('team_registration.form.upload_placeholder', 'Click to upload') }}"
                           placeholder="Click to upload">
                </div>

                {{-- Game ID Field --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Game ID Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.game_id"
                           value="{{ content('team_registration.form.game_id', 'Game ID') }}"
                           placeholder="Game ID">
                </div>
            </div>
        </div>

        {{-- Team Members Section --}}
        <div class="border border-gray-300 rounded-lg p-6 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Team Members Section</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Section Title --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.team_members"
                           value="{{ content('team_registration.form.team_members', 'Team Members') }}"
                           placeholder="Team Members">
                </div>

                {{-- Member 1 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member 1 Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.member1"
                           value="{{ content('team_registration.form.member1', 'Member 1') }}"
                           placeholder="Member 1">
                </div>

                {{-- Member 2 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member 2 Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.member2"
                           value="{{ content('team_registration.form.member2', 'Member 2') }}"
                           placeholder="Member 2">
                </div>

                {{-- Member 3 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member 3 Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.member3"
                           value="{{ content('team_registration.form.member3', 'Member 3') }}"
                           placeholder="Member 3">
                </div>

                {{-- Member 4 --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member 4 Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.form.member4"
                           value="{{ content('team_registration.form.member4', 'Member 4') }}"
                           placeholder="Member 4">
                </div>

                {{-- Member Role Label --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member Role Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.members.role_label"
                           value="{{ content('team_registration.members.role_label', 'Role/Position') }}"
                           placeholder="Role/Position">
                </div>

                {{-- Member Email Label --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Member Email Label</label>
                    <input type="text" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           data-content-key="team_registration.members.email_label"
                           value="{{ content('team_registration.members.email_label', 'Email Address') }}"
                           placeholder="Email Address">
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
                              data-content-key="team_registration.messages.success"
                              placeholder="Team registered successfully! We will contact you soon.">{{ content('team_registration.messages.success', 'Team registered successfully! We will contact you soon.') }}</textarea>
                </div>

                {{-- Error Message --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Error Message</label>
                    <textarea rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              data-content-key="team_registration.messages.error"
                              placeholder="Registration failed. Please try again.">{{ content('team_registration.messages.error', 'Registration failed. Please try again.') }}</textarea>
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