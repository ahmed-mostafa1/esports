@extends('layouts.app')

@section('title', 'Our Partners')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/partners.css') }}" />
@endpush

@section('content')

<section class="partners" aria-labelledby="partners-title">

      <div class="right-panel">
        <div class="form-header" style=" margin: 50px;">
          <button
            class="tab-btn active"
            style="font-size: 20px; border-radius: 10px;"
          >
            {{ content('partners.header.text', 'E-Sports') }}
          </button>
        </div>
      </div>

  <!-- Section 1 -->
  <div class="section1" style="margin: 20px; text-align: center;">
    <h2 class="section1__title">{{ content('partners.section1.title', 'Our Partnership Benefits') }}</h2>
    <p class="section1__text">{{ content('partners.section1.text', 'Discover how partnering with us can elevate your brand and connect you with the esports community.') }}</p>
  </div>

  @php($partners = \App\Models\Partner::published()->ordered()->get())
  <ul class="partners__grid">
    @forelse($partners as $partner)
      <li class="p-card">
        <figure class="p-card__thumb">
          @if($partner->media_type === 'image' && $partner->image_path)
            <img src="{{ asset($partner->image_path) }}" alt="{{ $partner->displayName(app()->getLocale()) ?: content('partners.header.text') }}">
          @elseif($partner->media_type === 'video' && $partner->video_url)
            <div class="ratio-16x9">
              <iframe src="{{ $partner->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
          @else
            <div class="ratio-16x9 placeholder">
              <div class="ratio-16x9__inner">{{ __('Media unavailable') }}</div>
            </div>
          @endif
        </figure>
        <p class="p-card__desc">
          {{ content('partners.intro.text', 'The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic and I know care of the quality for my mental health and Happiness no matter what I face.') }}
        </p>
        <button class="btn-more" type="button">{{ content('partners.card.cta', 'Read More') }}</button>
      </li>
    @empty
      <li class="p-card">
        <figure class="p-card__thumb">
          <div class="ratio-16x9">
            <div class="ratio-16x9__inner">{{ __('No partners available at the moment.') }}</div>
          </div>
        </figure>
        <p class="p-card__desc">
          {{ __('Check back soon to see our latest partnerships.') }}
        </p>
        <button class="btn-more" type="button">{{ content('partners.card.cta', 'Read More') }}</button>
      </li>
    @endforelse
  </ul>

  <!-- pager + nav -->
  <div class="partners__controls">
    <div class="dots" role="tablist" aria-label="Partners slides">
      <button class="dot is-active" aria-current="true" aria-label="Slide 1"></button>
      <button class="dot" aria-label="Slide 2"></button>
      <button class="dot" aria-label="Slide 3"></button>
      <button class="dot" aria-label="Slide 4"></button>
    </div>

    <div class="nav">
      <button class="nav__btn nav__btn--prev" aria-label="Previous">
        <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <button class="nav__btn nav__btn--next" aria-label="Next">
        <svg viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>
      </button>
    </div>
  </div>
</section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
