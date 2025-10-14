@extends('admin.layout')

@section('title', 'Edit Services Page - Skeleton View')

@section('content')
<div class="skeleton-editor">
    <!-- Mode Indicator -->
    <div class="skeleton-mode-indicator">
        🎨 SKELETON EDIT MODE - COMPLETE SERVICES PAGE
    </div>

    <!-- Header -->
    <div class="skeleton-header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-white">Services Page - Visual Editor (Complete)</h1>
                <p class="text-sm text-gray-400">Click any content element to edit it inline - All 6 service cards visible</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.contents.page', 'services') }}" 
                   class="px-3 py-1 text-sm bg-neutral-700 text-gray-300 rounded hover:bg-neutral-600">
                    📋 Standard Editor
                </a>
                <a href="{{ route('services') }}" 
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
            <h3>How to use the Complete Services Skeleton Editor:</h3>
            <ul>
                <li><span style="color: #60a5fa;">Blue highlighted areas</span> are text content - click to edit text in multiple languages</li>
                <li><span style="color: #34d399;">Green highlighted areas</span> are images - click to upload new images</li>
                <li><strong>This skeleton shows ALL 6 service cards</strong> with icons, titles, and feature lists</li>
                <li>Changes are saved instantly and will update the live site</li>
                <li>Hover over any content to see its content key identifier</li>
            </ul>
        </div>

        <!-- SERVICES PAGE HEADER -->
        <section id="services-header" class="bg-gradient-to-r from-blue-900 to-blue-800 text-white p-8 mb-8 rounded-lg border-l-4 border-blue-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-blue-400 mb-2">🛠️ SERVICES HEADER SECTION</h2>
                <p class="text-gray-300 text-sm">Main page title and header content</p>
            </div>
            
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">
                    <span data-content-key="services.header.title" 
                          data-content-type="text"
                          data-content-value="{{ $contents['services.header.title']->value ?? '{}' }}">
                        {{ content('services.header.title', 'Our Services') }}
                    </span>
                </h1>
            </div>
        </section>

        <!-- SERVICE CARDS SECTION -->
        <section id="services-cards" class="bg-gradient-to-r from-indigo-900 to-indigo-800 text-white p-8 mb-8 rounded-lg border-l-4 border-indigo-500">
            <div class="section-header mb-6">
                <h2 class="text-2xl font-bold text-indigo-400 mb-2">🎯 SERVICE CARDS SECTION</h2>
                <p class="text-gray-300 text-sm">Six service cards with icons, titles, and feature lists</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1: Technology & Platform -->
                <div class="bg-indigo-700 p-6 rounded-lg border border-indigo-600">
                    <div class="flex items-center mb-4">
                        <span data-content-key="services.card1.icon" 
                              data-content-type="image"
                              data-content-value="{{ $contents['services.card1.icon']->value ?? '{}' }}"
                              data-image-url="{{ content_media('services.card1.icon', 'img/services-icon.png') }}">
                            <img src="{{ content_media('services.card1.icon', 'img/services-icon.png') }}" 
                                 alt="Service 1 Icon" 
                                 class="w-12 h-12 border-2 border-green-400 rounded" />
                        </span>
                        <h3 class="text-xl font-bold ml-4">
                            <span data-content-key="services.card1.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card1.title']->value ?? '{}' }}">
                                {{ content('services.card1.title', 'Technology & Platform Development') }}
                            </span>
                        </h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card1.item1" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card1.item1']->value ?? '{}' }}">
                                {{ content('services.card1.item1', 'Custom tournament platforms and registration portals') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card1.item2" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card1.item2']->value ?? '{}' }}">
                                {{ content('services.card1.item2', 'Score tracking dashboards and live updates') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card1.item3" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card1.item3']->value ?? '{}' }}">
                                {{ content('services.card1.item3', 'Integration with Discord, Twitch, and other gaming tools') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card1.item4" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card1.item4']->value ?? '{}' }}">
                                {{ content('services.card1.item4', 'Mobile-first responsive design') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Service Card 2: Event Management -->
                <div class="bg-indigo-700 p-6 rounded-lg border border-indigo-600">
                    <div class="flex items-center mb-4">
                        <span data-content-key="services.card2.icon" 
                              data-content-type="image"
                              data-content-value="{{ $contents['services.card2.icon']->value ?? '{}' }}"
                              data-image-url="{{ content_media('services.card2.icon', 'img/services-icon.png') }}">
                            <img src="{{ content_media('services.card2.icon', 'img/services-icon.png') }}" 
                                 alt="Service 2 Icon" 
                                 class="w-12 h-12 border-2 border-green-400 rounded" />
                        </span>
                        <h3 class="text-xl font-bold ml-4">
                            <span data-content-key="services.card2.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card2.title']->value ?? '{}' }}">
                                {{ content('services.card2.title', 'Event Management & Production') }}
                            </span>
                        </h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card2.item1" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card2.item1']->value ?? '{}' }}">
                                {{ content('services.card2.item1', 'Tournament planning and execution') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card2.item2" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card2.item2']->value ?? '{}' }}">
                                {{ content('services.card2.item2', 'Live streaming and broadcast services') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card2.item3" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card2.item3']->value ?? '{}' }}">
                                {{ content('services.card2.item3', 'Professional commentary and analysis') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card2.item4" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card2.item4']->value ?? '{}' }}">
                                {{ content('services.card2.item4', 'Venue coordination and logistics') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Service Card 3: Community Building -->
                <div class="bg-indigo-700 p-6 rounded-lg border border-indigo-600">
                    <div class="flex items-center mb-4">
                        <span data-content-key="services.card3.icon" 
                              data-content-type="image"
                              data-content-value="{{ $contents['services.card3.icon']->value ?? '{}' }}"
                              data-image-url="{{ content_media('services.card3.icon', 'img/services-icon.png') }}">
                            <img src="{{ content_media('services.card3.icon', 'img/services-icon.png') }}" 
                                 alt="Service 3 Icon" 
                                 class="w-12 h-12 border-2 border-green-400 rounded" />
                        </span>
                        <h3 class="text-xl font-bold ml-4">
                            <span data-content-key="services.card3.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card3.title']->value ?? '{}' }}">
                                {{ content('services.card3.title', 'Community Building & Engagement') }}
                            </span>
                        </h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card3.item1" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card3.item1']->value ?? '{}' }}">
                                {{ content('services.card3.item1', 'Discord server setup and management') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card3.item2" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card3.item2']->value ?? '{}' }}">
                                {{ content('services.card3.item2', 'Social media strategy and content creation') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card3.item3" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card3.item3']->value ?? '{}' }}">
                                {{ content('services.card3.item3', 'Player networking and team formation') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card3.item4" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card3.item4']->value ?? '{}' }}">
                                {{ content('services.card3.item4', 'Regular community events and activities') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Service Card 4: Training & Coaching -->
                <div class="bg-indigo-700 p-6 rounded-lg border border-indigo-600">
                    <div class="flex items-center mb-4">
                        <span data-content-key="services.card4.icon" 
                              data-content-type="image"
                              data-content-value="{{ $contents['services.card4.icon']->value ?? '{}' }}"
                              data-image-url="{{ content_media('services.card4.icon', 'img/services-icon.png') }}">
                            <img src="{{ content_media('services.card4.icon', 'img/services-icon.png') }}" 
                                 alt="Service 4 Icon" 
                                 class="w-12 h-12 border-2 border-green-400 rounded" />
                        </span>
                        <h3 class="text-xl font-bold ml-4">
                            <span data-content-key="services.card4.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card4.title']->value ?? '{}' }}">
                                {{ content('services.card4.title', 'Training & Coaching Services') }}
                            </span>
                        </h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card4.item1" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card4.item1']->value ?? '{}' }}">
                                {{ content('services.card4.item1', 'One-on-one coaching sessions') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card4.item2" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card4.item2']->value ?? '{}' }}">
                                {{ content('services.card4.item2', 'Team strategy development') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card4.item3" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card4.item3']->value ?? '{}' }}">
                                {{ content('services.card4.item3', 'Performance analysis and improvement') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card4.item4" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card4.item4']->value ?? '{}' }}">
                                {{ content('services.card4.item4', 'Mental health and wellness support') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Service Card 5: Broadcasting -->
                <div class="bg-indigo-700 p-6 rounded-lg border border-indigo-600">
                    <div class="flex items-center mb-4">
                        <span data-content-key="services.card5.icon" 
                              data-content-type="image"
                              data-content-value="{{ $contents['services.card5.icon']->value ?? '{}' }}"
                              data-image-url="{{ content_media('services.card5.icon', 'img/services-icon.png') }}">
                            <img src="{{ content_media('services.card5.icon', 'img/services-icon.png') }}" 
                                 alt="Service 5 Icon" 
                                 class="w-12 h-12 border-2 border-green-400 rounded" />
                        </span>
                        <h3 class="text-xl font-bold ml-4">
                            <span data-content-key="services.card5.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card5.title']->value ?? '{}' }}">
                                {{ content('services.card5.title', 'Broadcasting & Media Production') }}
                            </span>
                        </h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card5.item1" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card5.item1']->value ?? '{}' }}">
                                {{ content('services.card5.item1', 'Multi-platform streaming setup') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card5.item2" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card5.item2']->value ?? '{}' }}">
                                {{ content('services.card5.item2', 'Professional video production') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card5.item3" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card5.item3']->value ?? '{}' }}">
                                {{ content('services.card5.item3', 'Graphics and overlay design') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card5.item4" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card5.item4']->value ?? '{}' }}">
                                {{ content('services.card5.item4', 'Post-event highlight reels') }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Service Card 6: Sponsorship -->
                <div class="bg-indigo-700 p-6 rounded-lg border border-indigo-600">
                    <div class="flex items-center mb-4">
                        <span data-content-key="services.card6.icon" 
                              data-content-type="image"
                              data-content-value="{{ $contents['services.card6.icon']->value ?? '{}' }}"
                              data-image-url="{{ content_media('services.card6.icon', 'img/services-icon.png') }}">
                            <img src="{{ content_media('services.card6.icon', 'img/services-icon.png') }}" 
                                 alt="Service 6 Icon" 
                                 class="w-12 h-12 border-2 border-green-400 rounded" />
                        </span>
                        <h3 class="text-xl font-bold ml-4">
                            <span data-content-key="services.card6.title" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card6.title']->value ?? '{}' }}">
                                {{ content('services.card6.title', 'Sponsorship & Partnership') }}
                            </span>
                        </h3>
                    </div>
                    
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card6.item1" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card6.item1']->value ?? '{}' }}">
                                {{ content('services.card6.item1', 'Brand partnership development') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card6.item2" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card6.item2']->value ?? '{}' }}">
                                {{ content('services.card6.item2', 'Sponsorship activation strategies') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card6.item3" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card6.item3']->value ?? '{}' }}">
                                {{ content('services.card6.item3', 'Marketing campaign execution') }}
                            </span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-indigo-300 mr-2">•</span>
                            <span data-content-key="services.card6.item4" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['services.card6.item4']->value ?? '{}' }}">
                                {{ content('services.card6.item4', 'ROI tracking and reporting') }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Completion Summary -->
        <div class="completion-summary bg-green-900/30 border border-green-700 rounded-lg p-6 text-center">
            <h3 class="text-xl font-bold text-green-400 mb-4">✅ Complete Services Page Skeleton</h3>
            <p class="text-gray-300 mb-4">The services page skeleton includes:</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                <div class="bg-blue-800/30 px-3 py-2 rounded">🛠️ Page Header</div>
                <div class="bg-indigo-800/30 px-3 py-2 rounded">🎯 6 Service Cards</div>
                <div class="bg-purple-800/30 px-3 py-2 rounded">📝 Feature Lists</div>
                <div class="bg-green-800/30 px-3 py-2 rounded">🖼️ Service Icons</div>
            </div>
            <p class="text-gray-400 text-sm mt-4">
                Click any highlighted content to edit. All service cards, icons, and descriptions are editable.
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