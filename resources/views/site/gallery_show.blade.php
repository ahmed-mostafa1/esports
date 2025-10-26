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

    <figure class="g-frame g-frame--video">
        {!! $item->embedHtml() !!}
        <span class="g-rail" aria-hidden="true"></span>
    </figure>

    <div class="mt-6 text-center">
        </div>
    </section>
    
    <section class="py-16 bg-black">
        <div class="container mx-auto px-6 max-w-5xl space-y-10">
            <div class="space-y-6">
                <h1 class="text-3xl font-bold text-white">
                    {{ $item->t('title', app()->getLocale()) }}
                </h1>
                <div class="text-gray-200 leading-relaxed space-y-4">
                    {!! nl2br(e($item->t('description', app()->getLocale()))) !!}
                </div>
            </div>
            <a
                href="{{ route('gallery') }}"
                class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-semibold transition"
            >
                Back to gallery
            </a>
        </div>
</section>
@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
