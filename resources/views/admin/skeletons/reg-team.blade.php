@extends('admin.layout')

@section('title', 'Edit Team Registration Page - Skeleton View')

@section('content')
<div class="skeleton-editor">
    <!-- Mode Indicator -->
    <div class="skeleton-mode-indicator">
        🎨 SKELETON EDIT MODE - TEAM REGISTRATION PAGE
    </div>

    <!-- Header -->
    <div class="skeleton-header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-white">Team Registration Page - Visual Editor</h1>
                <p class="text-sm text-gray-400">Click any content element to edit it inline - Complete form with all fields</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.contents.page', 'team_registration') }}" 
                   class="px-3 py-1 text-sm bg-neutral-700 text-gray-300 rounded hover:bg-neutral-600">
                    📋 Standard Editor
                </a>
                <a href="{{ route('reg-team') }}" 
                   class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700" 
                   target="_blank">
                    👁️ Preview Page
                </a>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="skeleton-content">
        <div class="skeleton-instructions">
            <h3>How to use the Team Registration Skeleton Editor:</h3>
            <ul>
                <li><span style="color: #60a5fa;">Blue highlighted areas</span> are text content - click to edit text in multiple languages</li>
                <li><span style="color: #34d399;">Green highlighted areas</span> are images - click to upload new images</li>
                <li><strong>This skeleton shows the complete team registration form</strong> with all form fields and labels</li>
                <li>Changes are saved instantly and will update the live site</li>
                <li>Hover over any content to see its content key identifier</li>
            </ul>
        </div>

        <!-- TEAM REGISTRATION HEADER -->
        <section id="team-reg-header" class="bg-gradient-to-r from-red-900 to-red-800 text-white p-8 mb-8 rounded-lg border-l-4 border-red-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-red-400 mb-2">🏆 TEAM REGISTRATION HEADER</h2>
                <p class="text-gray-300 text-sm">Page title and navigation tabs</p>
            </div>
            
            <div class="text-center space-y-6">
                <div class="inline-block">
                    <h1 class="text-4xl font-bold px-8 py-4 bg-red-600 rounded-lg">
                        <span data-content-key="team_registration.header.title" 
                              data-content-type="text"
                              data-content-value="{{ $contents['team_registration.header.title']->value ?? '{}' }}">
                            {{ content('team_registration.header.title', 'E-Sports') }}
                        </span>
                    </h1>
                </div>
                
                <!-- Navigation Tabs -->
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="px-4 py-2 bg-gray-600 text-white rounded">
                        <span data-content-key="team_registration.tabs.tournament" 
                              data-content-type="text"
                              data-content-value="{{ $contents['team_registration.tabs.tournament']->value ?? '{}' }}">
                            {{ content('team_registration.tabs.tournament', 'Tournament Registrations') }}
                        </span>
                    </div>
                    <div class="px-4 py-2 bg-red-600 text-white rounded font-bold">
                        <span data-content-key="team_registration.tabs.register" 
                              data-content-type="text"
                              data-content-value="{{ $contents['team_registration.tabs.register']->value ?? '{}' }}">
                            {{ content('team_registration.tabs.register', 'Register – now') }}
                        </span>
                    </div>
                    <div class="px-3 py-1 bg-gray-600 text-white rounded text-sm">
                        <span data-content-key="team_registration.tabs.team" 
                              data-content-type="text"
                              data-content-value="{{ $contents['team_registration.tabs.team']->value ?? '{}' }}">
                            {{ content('team_registration.tabs.team', 'Team') }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- TEAM REGISTRATION FORM -->
        <section id="team-reg-form" class="bg-gradient-to-r from-slate-900 to-slate-800 text-white p-8 mb-8 rounded-lg border-l-4 border-slate-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-slate-400 mb-2">📋 TEAM REGISTRATION FORM</h2>
                <p class="text-gray-300 text-sm">Complete form with team details, captain info, and team members</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Phoenix Image -->
                <div class="lg:col-span-1">
                    <div class="bg-slate-700 p-6 rounded-lg border border-slate-600">
                        <h3 class="text-lg font-semibold mb-4 text-center">Phoenix Character</h3>
                        <div class="text-center">
                            <span data-content-key="team_registration.phoenix_image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['team_registration.phoenix_image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('team_registration.phoenix_image', 'img/Phoenix.png') }}">
                                <img src="{{ content_media('team_registration.phoenix_image', 'img/Phoenix.png') }}" 
                                     alt="Phoenix Character" 
                                     class="max-w-full h-auto rounded border-2 border-green-400" />
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right: Form Content -->
                <div class="lg:col-span-2">
                    <div class="bg-slate-700 p-6 rounded-lg border border-slate-600">
                        <!-- Avatar Image -->
                        <div class="text-center mb-6">
                            <span data-content-key="team_registration.avatar_image" 
                                  data-content-type="image"
                                  data-content-value="{{ $contents['team_registration.avatar_image']->value ?? '{}' }}"
                                  data-image-url="{{ content_media('team_registration.avatar_image', 'img/reg-sinle.png') }}">
                                <img src="{{ content_media('team_registration.avatar_image', 'img/reg-sinle.png') }}" 
                                     alt="Team Avatar" 
                                     class="w-24 h-24 mx-auto rounded-full border-2 border-green-400" />
                            </span>
                        </div>

                        <!-- Team Name Field -->
                        <div class="mb-6 p-4 bg-slate-600 rounded border">
                            <label class="block text-sm font-medium mb-2">
                                <span data-content-key="team_registration.form.team_name" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['team_registration.form.team_name']->value ?? '{}' }}">
                                    {{ content('team_registration.form.team_name', 'Team Name') }}
                                </span>
                            </label>
                            <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                <span data-content-key="team_registration.form.team_name_placeholder" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['team_registration.form.team_name_placeholder']->value ?? '{}' }}">
                                    {{ content('team_registration.form.team_name_placeholder', 'Enter your team name') }}
                                </span>
                            </div>
                        </div>

                        <!-- Captain Information -->
                        <div class="mb-6 p-4 bg-slate-600 rounded border">
                            <h4 class="text-lg font-semibold mb-4 text-slate-200">Captain Information</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Captain Name -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.captain_name" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_name']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_name', 'Captain\'s Name') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.captain_name_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_name_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_name_placeholder', 'Enter captain\'s name') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Captain Logo -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.captain_logo" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_logo']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_logo', 'Captain\'s Logo') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.upload_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.upload_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.upload_placeholder', 'Click to upload') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Captain Email -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.captain_email" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_email']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_email', 'Captain\'s Email') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.captain_email_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_email_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_email_placeholder', 'Enter captain\'s email') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Team Logo -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.team_logo" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.team_logo']->value ?? '{}' }}">
                                            {{ content('team_registration.form.team_logo', 'Team Logo') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.upload_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.upload_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.upload_placeholder', 'Click to upload') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Captain Phone -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.captain_phone" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_phone']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_phone', 'Captain\'s Phone') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.captain_phone_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.captain_phone_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.captain_phone_placeholder', 'Enter captain\'s phone') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Game ID -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.game_id" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.game_id']->value ?? '{}' }}">
                                            {{ content('team_registration.form.game_id', 'Game ID') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.game_id_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.game_id_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.game_id_placeholder', 'Enter Game ID') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Members Section -->
                        <div class="mb-6 p-4 bg-slate-600 rounded border">
                            <h4 class="text-lg font-semibold mb-4 text-slate-200">
                                <span data-content-key="team_registration.form.team_members" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['team_registration.form.team_members']->value ?? '{}' }}">
                                    {{ content('team_registration.form.team_members', 'Team Members') }}
                                </span>
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Member 1 -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.member1" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member1']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member1', 'Member 1') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.member1_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member1_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member1_placeholder', 'Enter member 1\'s name') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Member 2 -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.member2" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member2']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member2', 'Member 2') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.member2_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member2_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member2_placeholder', 'Enter member 2\'s name') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Member 3 -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.member3" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member3']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member3', 'Member 3') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.member3_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member3_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member3_placeholder', 'Enter member 3\'s name') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Member 4 -->
                                <div>
                                    <label class="block text-sm font-medium mb-2">
                                        <span data-content-key="team_registration.form.member4" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member4']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member4', 'Member 4') }}
                                        </span>
                                    </label>
                                    <div class="w-full px-3 py-2 bg-slate-800 border border-slate-500 rounded text-gray-300">
                                        <span data-content-key="team_registration.form.member4_placeholder" 
                                              data-content-type="text"
                                              data-content-value="{{ $contents['team_registration.form.member4_placeholder']->value ?? '{}' }}">
                                            {{ content('team_registration.form.member4_placeholder', 'Enter member 4\'s name') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg">
                                <span data-content-key="team_registration.form.register_button" 
                                      data-content-type="text"
                                      data-content-value="{{ $contents['team_registration.form.register_button']->value ?? '{}' }}">
                                    {{ content('team_registration.form.register_button', 'Register Team') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Completion Summary -->
        <div class="completion-summary bg-green-900/30 border border-green-700 rounded-lg p-6 text-center">
            <h3 class="text-xl font-bold text-green-400 mb-4">✅ Complete Team Registration Skeleton</h3>
            <p class="text-gray-300 mb-4">The team registration skeleton includes:</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                <div class="bg-red-800/30 px-3 py-2 rounded">🏆 Page Header</div>
                <div class="bg-slate-800/30 px-3 py-2 rounded">📋 Complete Form</div>
                <div class="bg-purple-800/30 px-3 py-2 rounded">👥 Team Members</div>
                <div class="bg-green-800/30 px-3 py-2 rounded">🖼️ Images & Avatar</div>
            </div>
            <p class="text-gray-400 text-sm mt-4">
                Click any highlighted content to edit. All form labels, placeholders, and images are editable.
            </p>
        </div>
    </div>
</div>

<!-- Include Modal -->
@include('admin.components.edit-modal')

<!-- Include Styles -->
@include('admin.components.skeleton-styles')

<!-- Include Scripts -->
@include('admin.components.skeleton-scripts')
@endsection