@extends('layouts.app')

@section('title', 'Gallery')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/gallery.css') }}" />
@endpush

@section('content')


<section class="gallery" aria-labelledby="gallery-title">

    <div class="right-panel">
        <div class="form-header">
            <button
                class="tab-btn active"
                style="font-size: 20px; border-radius: 10px">
                E-Sports
            </button>
        </div>
    </div>


    <!-- hero frame -->
    <figure class="g-frame">
        <!-- replace with your hero image if different -->
        <img src="{{ asset('./img/emirate.png') }}" alt="E-sports tournament highlight" />
        <!-- glass play button -->
        <button class="play" aria-label="Play video">
            <span class="play__ring"></span>
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8 5v14l11-7z" />
            </svg>
        </button>
        <!-- decorative red rail -->
        <span class="g-rail" aria-hidden="true"></span>
    </figure>

    <!-- controls -->
    <div class="g-controls">
        <div class="dots" role="tablist" aria-label="Gallery slides">
            <button class="dot is-active" aria-current="true" aria-label="Slide 1"></button>
            <button class="dot" aria-label="Slide 2"></button>
            <button class="dot" aria-label="Slide 3"></button>
            <button class="dot" aria-label="Slide 4"></button>
        </div>

        <div class="nav">
            <button class="nav__btn nav__btn--prev" aria-label="Previous">
                <svg viewBox="0 0 24 24">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
            </button>
            <button class="nav__btn nav__btn--next" aria-label="Next">
                <svg viewBox="0 0 24 24">
                    <path d="M9 6l6 6-6 6" />
                </svg>
            </button>
        </div>
    </div>
</section>

<section class="gallery-grid py-16 bg-black" aria-label="Gallery items">
    <div class="container mx-auto px-6">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($items as $item)
                <article class="bg-neutral-900/70 border border-neutral-800 rounded-xl overflow-hidden flex flex-col">
                    <a href="{{ route('gallery.show', $item->slug) }}" class="block group">
                        <img
                            src="{{ $item->thumbnailUrl() ?? asset('img/placeholder-gallery.jpg') }}"
                            alt="{{ $item->t('title', app()->getLocale()) }}"
                            class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105"
                        >
                    </a>
                    <div class="p-6 flex-1 flex flex-col space-y-4">
                        <h3 class="text-xl font-semibold text-white">
                            <a href="{{ route('gallery.show', $item->slug) }}" class="hover:text-purple-400 transition">
                                {{ $item->t('title', app()->getLocale()) }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-300 flex-1 leading-relaxed">
                            {{ $item->excerpt(app()->getLocale(), 40) }}
                        </p>
                        <div>
                            <a
                                href="{{ route('gallery.show', $item->slug) }}"
                                class="inline-flex items-center text-purple-400 hover:text-purple-300 text-sm font-semibold transition"
                            >
                                Read more
                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center text-gray-400 py-20 border border-dashed border-neutral-700 rounded-xl">
                    <p class="text-lg">Gallery items are coming soon. Please check back later.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $items->withQueryString()->links() }}
        </div>
    </div>
</section>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
