@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/home.css') }}" />
@endpush

@section('content')

@php
  $homeLocale = app()->getLocale();
  $tournaments = \App\Models\TournamentCard::published()->ordered()->get();
  $partners = \App\Models\Partner::published()->ordered()->get();
  $testimonials = \App\Models\Testimonial::published()->ordered()->get();
@endphp


<!-- HERO -->
<section class="hero" id="home">
  <div class="container hero-inner">
    <!-- Left -->
    <aside class="hero-left" aria-hidden="false">
      <h1 class="hero-title">{{ content('home.hero.title', 'Your Title') }}</h1>
      <h1 class="hero-title">{{ content('home.hero.subtitle', 'Your text...') }}</h1>

      <p class="hero-desc">
        We are excited to announce that Tournament Community 2025 will
        take place this December 2025! Get ready for a month full of
        thrilling matches, friendly competition, and unforgettable
        moments.
      </p>


      <div class="countdown" role="timer" aria-live="polite">
        <div class="countbox">
          <div class="num">03</div>
          <div class="label">Months</div>
        </div>
        <img src="{{ asset('./img/Star 8.png') }}" class="star-icon" alt="Star Icon" />
        <div class="countbox">
          <div class="num">23</div>
          <div class="label">Days</div>
        </div>
        <img src="{{ asset('./img/Star 8.png') }}" class="star-icon" alt="Star Icon" />
        <div class="countbox">
          <div class="num">48</div>
          <div class="label">Minutes</div>
        </div>
      </div>

      <div class="hero-actions">
        <a href="./tournaments.html">
          <img href="" src="{{ asset('./img/register-now.png') }}" /></a>
      </div>
    </aside>

    <!-- Right -->
    <div class="hero-right">
      <div class="hero-media">
        <img
          src="{{ content_media('home.hero.image', 'img/home.png') }}"
          class="hero-img"
          alt="Esports showcase" />
        <button class="play" aria-label="Play"></button>
        <div class="hero-tag">
          <small>Ready For The</small>
          <strong>
            Suspension <span id="swapword">Esports</span>
          </strong>
        </div>
      </div>
    </div>
  </div>

</section>
<div class="progress-container">
  <div class="progress-bar">
    <div class="progress-fill"></div>
  </div>
  <span class="progress-label">Esports</span>
</div>


<!-- SERVICES -->
<section class="services-section" data-reveal="fade-right" data-reveal-delay="150">
  <div class="container">
    <h2 class="title">
      Our Services and <span>Speciality</span>
    </h2>
    <div class="curved-underline">
      <svg viewBox="0 0 220 20" xmlns="http://www.w3.org/2000/svg">
        <path class="serv-line"
          d="M 60 30 Q 200 1 300 40"
          stroke="#fff"
          stroke-width="3"
          fill="transparent"
          stroke-linecap="round" />
      </svg>
    </div>

    <div class="cards">
      <div class="card">
        <div class="img-wrapper">
          <img src="{{ asset('./img/Subtract(1).png') }}" alt="Experienced Trainers" />
        </div>
        <div class="img-desc">
          <h3>Experienced Trainers</h3>
          <p>Endless action that keeps players coming back.</p>
        </div>
      </div>

      <div class="card">
        <div class="img-wrapper">
          <img src="{{ asset('./img/Subtract.png') }}" alt="Every Console" />
        </div>
        <div class="img-desc">
          <h3>Every Console</h3>
          <p>We deliver the complete esports experience.</p>
        </div>
      </div>

      <div class="card">
        <div class="img-wrapper">
          <img src="{{ asset('./img/Subtract(2).png') }}" alt="Live Streaming" />
        </div>
        <div class="img-desc">
          <h3>Live Streaming</h3>
          <p>One destination for unforgettable events.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- POPULAR TOURNAMENTS (dark grid) -->
<section class="mp-section" data-reveal="fade-left" data-reveal-delay="150">
  <div class="container">
    <!-- Title + swoosh -->
    <div class="mp-header mp-header--top">
      <div class="popular-title">
        <h2 class="title">{{ content('home.tournaments.title', 'Most Popular Tournaments') }}</h2>
        <div class="title-swoosh curved-underline">
          <svg
            viewBox="0 0 260 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <!-- slight upward arc that dips at ends, like the source -->
            <path
              d="M10 12 Q130 2 400 20"
              fill="none"
              stroke="#fff"
              stroke-width="4"
              stroke-linecap="round" />
          </svg>
        </div>

        <!-- Subtitle -->
        <p class="subtitle">{{ content('home.tournaments.subtitle', 'Community Organizing Team') }}</p>
      </div>
    </div>

    <div class="slider slider--tournaments" id="tr-slider" role="region" aria-label="Popular tournaments">
      <div class="track" id="tr-track">
        @forelse($tournaments as $t)
          @php
            $status = match($t->status) {
              'open' => __('Open'),
              'finished' => __('Finished'),
              default => __('Closed'),
            };
            $statusClass = match($t->status) {
              'open' => 'live--open',
              'finished' => 'live--finished',
              default => 'live--closed',
            };
          @endphp
          <figure class="card-partner card-tournament">
            <div class="media">
              <img
                src="{{ $t->imageUrl() ?? content_media('tournaments.card.image','img/tournaments-inner.png') }}"
                alt="{{ $t->titleFor($homeLocale) ?: 'Tournament' }}"
                loading="lazy" />

              <span class="live {{ $statusClass }}">{{ $status }}</span>

              <figcaption class="overlay">
                <div class="meta-title">
                  {{ optional($t->date)->format('d/m/Y') ?? __('Date TBD') }}
                </div>
                <div class="meta-sub">
                  {{ $t->time ?: __('Time TBD') }} • {{ $t->prize ?: __('Prize TBD') }}
                </div>
              </figcaption>
            </div>
            <figcaption class="name">
              <a href="{{ route('tournaments.register', $t->slug) }}">
                {{ $t->titleFor($homeLocale) ?: 'Tournament' }}
              </a>
            </figcaption>
          </figure>
        @empty
          <figure class="card-partner card-tournament card-tournament--empty">
            <div class="media">
              <div class="media-empty">{{ __('No tournaments available right now.') }}</div>
            </div>
            <figcaption class="name">{{ __('Check back soon for new tournaments') }}</figcaption>
          </figure>
        @endforelse
      </div>

      <div class="dots-partner" id="tr-dots" aria-label="Slider pagination"></div>

      <div class="nav nav--tournaments">
        <button class="pill light" id="tr-prev" aria-label="Previous">
          <span class="chev">‹</span>
        </button>
        <button class="pill dark" id="tr-next" aria-label="Next">
          <span class="chev">›</span>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- PARTNERS -->
<section class="partners-section" data-reveal="fade-right" data-reveal-delay="150">
  <div class="container">
    <!-- Title -->
    <h2 class="title">{{ content('home.partners.title', 'Our Partners') }}</h2>
    <div class="title-swoosh" aria-hidden="true">
      <svg viewBox="0 0 260 22" xmlns="http://www.w3.org/2000/svg">
        <!-- gentle upward “smile” like the source -->
        <path
          d="M6 12 Q130 2 254 12"
          fill="none"
          stroke="#fff"
          stroke-width="4"
          stroke-linecap="round" />
      </svg>
    </div>

    <!-- Slider -->
    <div class="slider" id="partners-slider">
      <div class="track">
        @forelse($partners as $partner)
          <figure class="card-partner">
            <div class="media {{ $loop->even ? 'placeholder alt' : 'placeholder' }}">
              @if($partner->media_type === 'video' && $partner->video_url)
                <div class="ratio-16x9">
                  <iframe src="{{ $partner->video_url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
              @elseif($partner->media_type === 'image' && $partner->image_path)
                <img src="{{ asset($partner->image_path) }}" alt="{{ $partner->displayName($homeLocale) }}">
              @else
                <div class="ratio-16x9">
                  <div class="ratio-16x9__inner">{{ __('Media unavailable') }}</div>
                </div>
              @endif
              <span class="live">{{ content('home.partners.live_indicator', '● Live') }}</span>
              <button class="play" aria-label="Play"></button>
              <figcaption class="overlay">
                <div class="meta-title">{{ content('home.partners.live_title', 'LIVE: Nemiga vs Fornite') }}</div>
                <div class="meta-sub">{{ content('home.partners.live_subtitle', 'Agung Zero Dark Channel') }}</div>
              </figcaption>
            </div>
            <figcaption class="name {{ $partner->displayName($homeLocale) && strlen($partner->displayName($homeLocale)) > 18 ? 'wrap' : '' }}">
              {{ $partner->displayName($homeLocale) ?: content('home.partners.title', 'Our Partners') }}
            </figcaption>
          </figure>
        @empty
          <figure class="card-partner">
            <div class="media placeholder">
              <div class="ratio-16x9">
                <div class="ratio-16x9__inner">{{ __('Partners coming soon') }}</div>
              </div>
              <span class="live">{{ content('home.partners.live_indicator', '● Live') }}</span>
              <button class="play" aria-label="Play"></button>
            </div>
            <figcaption class="name">{{ content('home.partners.title', 'Our Partners') }}</figcaption>
          </figure>
        @endforelse
      </div>


    </div>
    <div class="mp-header mp-header--controls">
      <!-- Dots -->
      <div
        class="dots-partner dots-partner--inline"
        id="p-dots"
        aria-label="Slider pagination">
        @php($partnerDotCount = max(1, min(5, $partners->count())))
        @for($i = 0; $i < $partnerDotCount; $i++)
          <span class="dot {{ $i === 0 ? 'active' : '' }}"></span>
        @endfor
      </div>

      <!-- Arrow pills (bottom-right) -->
      <div class="nav nav--partners">
        <button class="pill light" id="p-prev" aria-label="Previous">
          <span class="chev">‹</span>
        </button>
        <button class="pill dark" id="p-next" aria-label="Next">
          <span class="chev">›</span>
        </button>
      </div>
    </div>
  </div>

</section>

<!-- TESTIMONIALS -->
<section class="ts-section" data-reveal="fade-up" data-reveal-delay="150">
  <div class="ts-container">
    <div class="ts-head">
      <h2 class="ts-title">{{ content('home.testimonials.title', 'Client') }} <span>{{ content('home.testimonials.subtitle', 'Testimonial') }}</span></h2>
      <div class="ts-swoosh" aria-hidden="true">
        <svg viewBox="0 0 240 22" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M6 12 Q130 2 254 12"
            fill="none"
            stroke="#fff"
            stroke-width="4"
            stroke-linecap="round" />
        </svg>
      </div>
      <p class="ts-sub">{{ content('home.testimonials.description', 'Our Client feedback is overseas and Localy') }}</p>
    </div>

    <div class="ts-slider" id="ts-slider">
      <div class="ts-track">
        @forelse($testimonials as $t)
          <article class="ts-card">
            <div class="ts-avatar {{ $loop->even ? 'ts-alt' : '' }}">
              <img src="{{ $t->avatar_path ? asset($t->avatar_path) : content_media('home.testimonial1.avatar', 'img/Rectangle 28.png') }}" />
            </div>
            <div class="ts-inner">
              <h3 class="ts-name">{{ $t->name[$homeLocale] ?? ($t->name['en'] ?? '') }}</h3>
              <div class="ts-role">{{ $t->role[$homeLocale] ?? ($t->role['en'] ?? '') }}</div>
              <div class="ts-q ts-ql">“</div>
              <p class="ts-text">“{{ $t->text[$homeLocale] ?? ($t->text['en'] ?? '') }}”</p>
              <div class="ts-q ts-qr">”</div>
            </div>
          </article>
        @empty
          <article class="ts-card ts-card--empty">
            <div class="ts-inner text-center">
              <h3 class="ts-name">{{ __('No testimonials available right now.') }}</h3>
              <p class="ts-text">“{{ __('Check back soon to hear from our community.') }}”</p>
            </div>
          </article>
        @endforelse
      </div>

      <!-- Dots -->
      <div
        class="ts-dots"
        id="ts-dots"
        aria-label="Slider pagination"></div>

      <!-- Arrows -->
      <div class="ts-nav">
        <button
          class="ts-pill ts-light"
          id="ts-prev"
          aria-label="Previous">
          <span class="ts-chev">‹</span>
        </button>
        <button class="ts-pill ts-red" id="ts-next" aria-label="Next">
          <span class="ts-chev">›</span>
        </button>
      </div>
    </div>
  </div>

</section>

<!-- ABOUT -->
<section class="wwa-section" data-reveal="fade-left" data-reveal-delay="150">
  <div class="wwa-container">
    <!-- Heading -->
    <h2 class="wwa-title">WHO WE ARE ?</h2>
    <div class="wwa-swoosh" aria-hidden="true">
      <svg viewBox="0 0 260 24" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M6 14 Q130 4 254 14"
          fill="none"
          stroke="#fff"
          stroke-width="4"
          stroke-linecap="round" />
      </svg>
    </div>

    <!-- 3 columns -->
    <div class="wwa-grid">
      <div class="wwa-col">
        <h3 class="wwa-h3">Our Story</h3>
        <p class="wwa-p">
          In early winter 2020, amidst a raging pandemic, FOUR04 ESPORTS
          was born. Our goal is to reinvent the region’s droopy eSports
          atmosphere. By bringing together a diverse group of experts in
          managing offline and online tournaments, we aim to execute
          events that are tenfold better. We want to encourage and inspire
          the gaming youth in our region to explore their passions and
          consider building a career in eSports—a prospect that once
          seemed far-fetched.
        </p>
      </div>

      <div class="wwa-col">
        <h3 class="wwa-h3">Our Mission</h3>
        <p class="wwa-p">
          Establish a self-sustaining and progressively scalable eSports
          platform in the Middle East while also aiming to build a local
          and international eSports community that brings together
          solutions and vocations for players and for brands to get
          involved with eSports in the region.
        </p>
      </div>

      <div class="wwa-col">
        <h3 class="wwa-h3">Our Vision</h3>
        <p class="wwa-p wwa-center">
          The Healing is fresh!!! can not wait to take my next session,
          really i feel so Energetic and i know care of the quality for my
          mental health and Happiness no matter what i face.
        </p>
      </div>
    </div>

    <!-- Subscribe pill -->
    <form
      class="wwa-subscribe"
      action="#"
      method="post"
      onsubmit="return false;">
      <input
        class="wwa-input"
        type="email"
        placeholder="Enter your email address"
        aria-label="Email address" />
      <button class="wwa-btn" type="submit">Subscribe</button>
    </form>
  </div>
</section>

@endsection
@push('scripts')
@vite('../../../public/js/home.js')
@endpush
