@extends('admin.layout')

@section('title', 'Edit Partners Page - Skeleton View')

@section('content')
<div class="skeleton-editor">
    <!-- Mode Indicator -->
    <div class="skeleton-mode-indicator">
        🎨 SKELETON EDIT MODE
    </div>

    <!-- Header -->
    <div class="skeleton-header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-semibold text-white">Partners Page - Visual Editor</h1>
                <p class="text-sm text-gray-400">Click any content element to edit it inline</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.contents.page', 'partners') }}" 
                   class="px-3 py-1 text-sm bg-neutral-700 text-gray-300 rounded hover:bg-neutral-600">
                    Standard Editor
                </a>
                <a href="{{ route('partners') }}" 
                   class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700" 
                   target="_blank">
                    Preview Page
                </a>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="skeleton-content">
        <div class="skeleton-instructions">
            <h3>How to use the Skeleton Editor:</h3>
            <ul>
                <li><span style="color: #60a5fa;">Blue highlighted areas</span> are text content - click to edit text in multiple languages</li>
                <li><span style="color: #34d399;">Green highlighted areas</span> are images - click to upload new images</li>
                <li>Changes are saved instantly and will update the live site</li>
                <li>Hover over any content to see its content key identifier</li>
            </ul>
        </div>

        <!-- PARTNERS Section -->
        <section class="partners bg-gray-900 text-white p-8 rounded-lg">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold mb-8">
                    <span data-content-key="partners.header.text" 
                          data-content-type="text"
                          data-content-value="{{ $contents['partners.header.text']->value ?? '{}' }}">
                        {{ content('partners.header.text', 'E-Sports') }}
                    </span>
                </h1>
            </div>

            <!-- Section 1 - Partnership Benefits -->
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold mb-4">
                    <span data-content-key="partners.section1.title" 
                          data-content-type="text"
                          data-content-value="{{ $contents['partners.section1.title']->value ?? '{}' }}">
                        {{ content('partners.section1.title', 'Our Partnership Benefits') }}
                    </span>
                </h2>
                <p class="text-gray-400 text-lg max-w-3xl mx-auto"
                   data-content-key="partners.section1.text" 
                   data-content-type="text"
                   data-content-value="{{ $contents['partners.section1.text']->value ?? '{}' }}">
                    {{ content('partners.section1.text', 'Discover how partnering with us can elevate your brand and connect you with the esports community.') }}
                </p>
            </div>

            <!-- Partner Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Partner Card 1 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all">
                    <div class="aspect-w-16 aspect-h-9">
                        <span data-content-key="partners.banner.image" 
                              data-content-type="image"
                              data-content-value="{{ $contents['partners.banner.image']->value ?? '{}' }}"
                              data-image-url="{{ content_media('partners.banner.image', 'content-images/partners.banner.png') }}">
                            <img src="{{ content_media('partners.banner.image', 'content-images/partners.banner.png') }}" 
                                 alt="Partner Banner" 
                                 class="w-full h-48 object-cover" />
                        </span>
                    </div>
                    
                    <div class="p-6">
                        <p class="text-gray-300 leading-relaxed mb-6"
                           data-content-key="partners.intro.text" 
                           data-content-type="text"
                           data-content-value="{{ $contents['partners.intro.text']->value ?? '{}' }}">
                            {{ content('partners.intro.text', 'The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic and I know care of the quality for my mental health and Happiness no matter what I face.') }}
                        </p>
                        
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition-colors">
                            <span data-content-key="partners.card.cta" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['partners.card.cta']->value ?? '{}' }}">
                                {{ content('partners.card.cta', 'Read More') }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Partner Card 2 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ asset('img/image 13.png') }}" 
                             alt="Partner showcase: esports collage" 
                             class="w-full h-48 object-cover" />
                    </div>
                    
                    <div class="p-6">
                        <p class="text-gray-300 leading-relaxed mb-6"
                           data-content-key="partners.intro.text" 
                           data-content-type="text"
                           data-content-value="{{ $contents['partners.intro.text']->value ?? '{}' }}">
                            {{ content('partners.intro.text', 'The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic and I know care of the quality for my mental health and Happiness no matter what I face.') }}
                        </p>
                        
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition-colors">
                            <span data-content-key="partners.card.cta" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['partners.card.cta']->value ?? '{}' }}">
                                {{ content('partners.card.cta', 'Read More') }}
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Partner Card 3 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ asset('img/image 13(1).png') }}" 
                             alt="Partner ambassador portrait" 
                             class="w-full h-48 object-cover" />
                    </div>
                    
                    <div class="p-6">
                        <p class="text-gray-300 leading-relaxed mb-6"
                           data-content-key="partners.intro.text" 
                           data-content-type="text"
                           data-content-value="{{ $contents['partners.intro.text']->value ?? '{}' }}">
                            {{ content('partners.intro.text', 'The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic and I know care of the quality for my mental health and Happiness no matter what I face.') }}
                        </p>
                        
                        <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded transition-colors">
                            <span data-content-key="partners.card.cta" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['partners.card.cta']->value ?? '{}' }}">
                                {{ content('partners.card.cta', 'Read More') }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Partnership Call to Action -->
            <div class="text-center">
                <h3 class="text-xl font-semibold mb-4">
                    <span data-content-key="partners.cta.title" 
                          data-content-type="text"
                          data-content-value="{{ $contents['partners.cta.title']->value ?? '{}' }}">
                        {{ content('partners.cta.title', 'Ready to Partner With Us?') }}
                    </span>
                </h3>
                <p class="text-gray-400 mb-6 max-w-2xl mx-auto"
                   data-content-key="partners.cta.description" 
                   data-content-type="text"
                   data-content-value="{{ $contents['partners.cta.description']->value ?? '{}' }}">
                    {{ content('partners.cta.description', 'Join our growing network of partners and be part of the esports revolution. Contact us to discuss partnership opportunities.') }}
                </p>
                <button class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                    <span data-content-key="partners.cta.button" 
                          data-content-type="text"
                          data-content-value="{{ $contents['partners.cta.button']->value ?? '{}' }}">
                        {{ content('partners.cta.button', 'Contact Us') }}
                    </span>
                </button>
            </div>
        </section>
    </div>
</div>

<!-- Include Modal -->
@include('admin.components.edit-modal')

<!-- Include Styles -->
@include('admin.components.skeleton-styles')

<!-- Include Scripts -->
@include('admin.components.skeleton-scripts')
@endsection