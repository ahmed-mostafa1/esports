@extends('admin.layout')

@section('title', 'Edit Gallery Page - Skeleton View')

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
                <h1 class="text-xl font-semibold text-white">Gallery Page - Visual Editor</h1>
                <p class="text-sm text-gray-400">Click any content element to edit it inline</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('gallery') }}" 
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

        <!-- GALLERY Section -->
        <section class="gallery bg-gray-900 text-white p-8 rounded-lg">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold">
                    <span data-content-key="gallery.header.title" 
                          data-content-type="text"
                          data-content-value="{{ $contents['gallery.header.title']->value ?? '{}' }}">
                        {{ content('gallery.header.title', 'Gallery') }}
                    </span>
                </h1>
                <p class="text-gray-400 mt-4"
                   data-content-key="gallery.header.subtitle" 
                   data-content-type="text"
                   data-content-value="{{ $contents['gallery.header.subtitle']->value ?? '{}' }}">
                    {{ content('gallery.header.subtitle', 'Explore our amazing esports moments and tournaments') }}
                </p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gallery Image 1 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all">
                    <span data-content-key="gallery.image1" 
                          data-content-type="image"
                          data-content-value="{{ $contents['gallery.image1']->value ?? '{}' }}"
                          data-image-url="{{ content_media('gallery.image1', 'img/placeholder-gallery.jpg') }}">
                        <img src="{{ content_media('gallery.image1', 'img/placeholder-gallery.jpg') }}" 
                             alt="Gallery Image 1" 
                             class="w-full h-48 object-cover" />
                    </span>
                    <div class="p-4">
                        <h3 class="font-semibold">
                            <span data-content-key="gallery.image1.caption" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['gallery.image1.caption']->value ?? '{}' }}">
                                {{ content('gallery.image1.caption', 'Tournament Action') }}
                            </span>
                        </h3>
                    </div>
                </div>

                <!-- Gallery Image 2 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all">
                    <span data-content-key="gallery.image2" 
                          data-content-type="image"
                          data-content-value="{{ $contents['gallery.image2']->value ?? '{}' }}"
                          data-image-url="{{ content_media('gallery.image2', 'img/placeholder-gallery.jpg') }}">
                        <img src="{{ content_media('gallery.image2', 'img/placeholder-gallery.jpg') }}" 
                             alt="Gallery Image 2" 
                             class="w-full h-48 object-cover" />
                    </span>
                    <div class="p-4">
                        <h3 class="font-semibold">
                            <span data-content-key="gallery.image2.caption" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['gallery.image2.caption']->value ?? '{}' }}">
                                {{ content('gallery.image2.caption', 'Championship Winners') }}
                            </span>
                        </h3>
                    </div>
                </div>

                <!-- Gallery Image 3 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all">
                    <span data-content-key="gallery.image3" 
                          data-content-type="image"
                          data-content-value="{{ $contents['gallery.image3']->value ?? '{}' }}"
                          data-image-url="{{ content_media('gallery.image3', 'img/placeholder-gallery.jpg') }}">
                        <img src="{{ content_media('gallery.image3', 'img/placeholder-gallery.jpg') }}" 
                             alt="Gallery Image 3" 
                             class="w-full h-48 object-cover" />
                    </span>
                    <div class="p-4">
                        <h3 class="font-semibold">
                            <span data-content-key="gallery.image3.caption" 
                                  data-content-type="text"
                                  data-content-value="{{ $contents['gallery.image3.caption']->value ?? '{}' }}">
                                {{ content('gallery.image3.caption', 'Team Competition') }}
                            </span>
                        </h3>
                    </div>
                </div>
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
