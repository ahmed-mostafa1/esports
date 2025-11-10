@extends('layouts.app')

@section('title', $partner->displayName(app()->getLocale()) ?: __('Partner'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/partners.css') }}" />
@endpush

@section('content')
@php($locale = app()->getLocale())
@php($description = $partner->displayText($partner->description, $locale))
@php($history = $partner->displayText($partner->history, $locale))

<section class="partner-show container mx-auto px-4 py-12" style="max-width: 1100px;">
  <div class="mb-6">
    <a href="{{ route('partners') }}" class="btn-more inline-flex items-center gap-2">
      ← {{ __('Back to Partners') }}
    </a>
  </div>

  <header class="mb-8 text-center">
    <h1 class="text-4xl font-semibold text-white">{{ $partner->displayName($locale) }}</h1>
  </header>

  <figure class="mb-8">
    @if($partner->media_type === 'video' && $partner->video_url)
      <div class="ratio-16x9 rounded overflow-hidden bg-black">
        <iframe src="{{ $partner->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    @elseif($partner->media_type === 'image' && $partner->image_path)
      <img src="{{ asset($partner->image_path) }}" alt="{{ $partner->displayName($locale) }}" class="w-full rounded shadow-lg">
    @else
      <div class="ratio-16x9 rounded bg-neutral-800 flex items-center justify-center text-gray-400">
        {{ __('Media unavailable') }}
      </div>
    @endif
  </figure>

  <article class="space-y-8 leading-relaxed text-gray-200">
    @if($description)
      <section>
        <h2 class="text-2xl font-semibold mb-3">{{ __('Description') }}</h2>
        <p>{{ $description }}</p>
      </section>
    @endif

    @if($history)
      <section>
        <h2 class="text-2xl font-semibold mb-3">{{ __('History') }}</h2>
        <p>{{ $history }}</p>
      </section>
    @endif
  </article>
</section>
@endsection
