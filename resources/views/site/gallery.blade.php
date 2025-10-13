@extends('layouts.app')

@section('title', 'Gallery')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('./css/gallery.css') }}" />
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

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush