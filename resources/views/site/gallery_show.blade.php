@extends('layouts.app')

@section('title', $item->t('title', app()->getLocale()) ?: 'Gallery Item')

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
        <img src="{{ asset('./img/emirate.png') }}" alt="E-sports tournament highlight" />
        <button class="play" aria-label="Play video">
            <span class="play__ring"></span>
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8 5v14l11-7z" />
            </svg>
        </button>
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

<section class="py-16 bg-black">
    <div class="container mx-auto px-6 max-w-5xl space-y-10">
        <div class="w-full rounded-xl overflow-hidden bg-neutral-900/70 border border-neutral-800">
            {!! $item->embedHtml() !!}
        </div>

        <div class="space-y-6">
            <h1 class="text-3xl font-bold text-white">
                {{ $item->t('title', app()->getLocale()) }}
            </h1>
            <div class="text-gray-200 leading-relaxed space-y-4">
                {!! nl2br(e($item->t('description', app()->getLocale()))) !!}
            </div>
        </div>

        <div>
            <a
                href="{{ route('gallery') }}"
                class="inline-flex items-center text-purple-400 hover:text-purple-300 font-semibold transition"
            >
                <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to gallery
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
