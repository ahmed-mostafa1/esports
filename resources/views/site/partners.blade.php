@extends('layouts.app')

@section('title', 'Our Partners')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('./css/partners.css') }}" />
@endpush

@section('content')

<section class="partners" aria-labelledby="partners-title">

      <div class="right-panel">
        <div class="form-header" style=" margin: 50px;">
          <button
            class="tab-btn active"
            style="font-size: 20px; border-radius: 10px;"
          >
            E-Sports
          </button>
        </div>
      </div>

  <!-- cards -->
  <ul class="partners__grid">
    <li class="p-card">
      <figure class="p-card__thumb">
        <img src="{{ asset('./img/partners.banner.png') }}" alt="Partner showcase: team playing">
      </figure>
      <p class="p-card__desc">
        The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic  and I know care of the quality for my mental health and
        Happiness no matter what I face.
      </p>
      <button class="btn-more" type="button">Read More</button>
    </li>

    <li class="p-card">
      <figure class="p-card__thumb">
        <!-- use the same or another team collage here -->
        <img src="{{ asset('./img/image 13.png') }}" alt="Partner showcase: esports collage">
      </figure>
      <p class="p-card__desc">
        The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic  and I know care of the quality for my mental health and
        Happiness no matter what I face.
      </p>
      <button class="btn-more" type="button">Read More</button>
    </li>

    <li class="p-card">
      <figure class="p-card__thumb">
        <img src="{{ asset('./img/image 13(1).png') }}" alt="Partner ambassador portrait">
      </figure>
      <p class="p-card__desc">
        The Healing is fresh!!! can not wait to take my next session, really I feel so Energetic  and I know care of the quality for my mental health and
        Happiness no matter what I face.
      </p>
      <button class="btn-more" type="button">Read More</button>
    </li>
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