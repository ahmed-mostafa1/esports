@extends('layouts.app')

@section('title', __('Home'))

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/home.css') }}" />
@endpush

@section('content')

@php
  $homeLocale = app()->getLocale();
  $tournaments = \App\Models\TournamentCard::published()->ordered()->get();
  $partners = \App\Models\Partner::published()->ordered()->get();
  $testimonials = \App\Models\Testimonial::published()->ordered()->get();
  $heroRecord = \App\Models\Content::where('key', 'home.hero.image')->first();
  $heroMediaUrl = content_media('home.hero.image', 'img/home.png');
  $heroType = $heroRecord?->type;
  $heroIsVideo = $heroType === 'video';
  $heroEmbedUrl = null;

  if ($heroIsVideo && is_string($heroMediaUrl)) {
    if (preg_match('~youtu\.be/([^?]+)~i', $heroMediaUrl, $matches)) {
      $heroEmbedUrl = 'https://www.youtube.com/embed/' . $matches[1];
    } elseif (preg_match('~youtube\.com.*[?&]v=([^&]+)~i', $heroMediaUrl, $matches)) {
      $heroEmbedUrl = 'https://www.youtube.com/embed/' . $matches[1];
    } elseif (preg_match('~youtube\.com/embed/([^?]+)~i', $heroMediaUrl, $matches)) {
      $heroEmbedUrl = 'https://www.youtube.com/embed/' . $matches[1];
    } elseif (preg_match('~vimeo\.com/(\d+)~i', $heroMediaUrl, $matches)) {
      $heroEmbedUrl = 'https://player.vimeo.com/video/' . $matches[1];
    }
  }

  $countdownNow = now();
  $countdownDefaultTarget = (clone $countdownNow)->addMonths(3)->startOfMinute();
  $countdownTargetRaw = content('home.countdown.target_datetime', $countdownDefaultTarget->toIso8601String());

  try {
    $countdownTarget = \Carbon\Carbon::parse($countdownTargetRaw);
  } catch (\Throwable $e) {
    $countdownTarget = clone $countdownDefaultTarget;
  }

  $countdownTarget = $countdownTarget->timezone($countdownNow->timezone);

  if ($countdownTarget->lessThanOrEqualTo($countdownNow)) {
    $countdownMonths = $countdownDays = $countdownMinutes = 0;
  } else {
    $countdownInterval = $countdownNow->diff($countdownTarget);
    $countdownMonths = max(0, ($countdownInterval->y * 12) + $countdownInterval->m);
    $countdownDays = max(0, $countdownInterval->d);
    $countdownMinutes = max(0, $countdownInterval->i);
  }
@endphp

<!-- Floating Social Rail (upper-right under navbar) -->
<nav class="social-rail" aria-label="{{ __('Social links') }}">
  <!-- the red skin with perfect notches -->
  <svg class="rail-skin" viewBox="0 0 56 100" preserveAspectRatio="none" aria-hidden="true">
    <defs>
      <!-- Mask coordinates are 0..1 so it scales with height -->
      <mask id="railCut" maskUnits="objectBoundingBox">
        <rect x="0" y="0" width="1" height="1" fill="#fff"/>
        <!-- top notch -->
        <circle cx="0" cy="0.22" r="0.22" fill="#000"/>
        <!-- bottom notch -->
        <circle cx="0" cy="0.78" r="0.22" fill="#000"/>
      </mask>
    </defs>
    <!-- red rounded bar with the mask applied -->
    <rect x="0" y="0" width="56" height="100%" rx="28" ry="28" fill="#f23b33" mask="url(#railCut)"/>
  </svg>

  <!-- content sits above the SVG skin -->
  <div class="rail-content">
    <a class="ico" href="#" aria-label="{{ __('Facebook') }}">
      <svg viewBox="0 0 24 24"><path d="M15 3h-2.2C10.6 3 9 4.7 9 6.9V9H7v3h2v9h3v-9h2.6l.4-3H12V7c0-.6.5-1 1.1-1H15V3z"/></svg>
    </a>
    <a class="ico" href="#" aria-label="{{ __('LinkedIn') }}">
      <svg viewBox="0 0 24 24"><path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.5 8.5h4V22h-4zM8 8.5h3.8v1.8h.1c.53-1 1.84-2.1 3.78-2.1 4.04 0 4.79 2.66 4.79 6.1V22h-4v-5.7c0-1.36-.02-3.11-1.9-3.11-1.9 0-2.19 1.49-2.19 3.02V22H8z"/></svg>
    </a>
    <a class="ico" href="#" aria-label="{{ __('YouTube') }}">
      <svg viewBox="0 0 24 24"><path d="M23.5 7.2a3.1 3.1 0 0 0-2.2-2.2C19.4 4.5 12 4.5 12 4.5s-7.4 0-9.3.5a3.1 3.1 0 0 0-2.2 2.2C0 9.1 0 12 0 12s0 2.9.5 4.8c.3 1 1.2 1.9 2.2 2.2C4.6 19.5 12 19.5 12 19.5s7.4 0 9.3-.5c1-.3 1.9-1.2 2.2-2.2.5-1.9.5-4.8.5-4.8s0-2.9-.5-4.8zM9.6 15.5v-7l6 3.5-6 3.5z"/></svg>
    </a>
    <a class="ico" href="#" aria-label="{{ __('WhatsApp') }}">
      <svg viewBox="0 0 24 24"><path d="M20 3.9A10 10 0 0 0 3.4 17.8L2 22l4.4-1.4A10 10 0 1 0 20 3.9zM12 20a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm4.2-5.8c-.2-.1-1.2-.6-1.3-.7-.2-.1-.3-.1-.5.1s-.6.7-.8.8-.3.1-.5 0-1-.4-1.9-1.2a7.2 7.2 0 0 1-1.3-1.6c-.1-.3 0-.4.1-.6l.4-.5c.1-.2.1-.3 0-.5l-.7-1.7c-.2-.4-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.1s1 2.4 1.1 2.6c.1.2 2 3 4.8 4.1.7.3 1.2.4 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.2-.6 1.4-1.1.2-.5.2-1 .1-1.1-.2-.2-.3-.2-.5-.3z"/></svg>
    </a>
    <a class="ico" href="#" aria-label="{{ __('Contact') }}">
      <svg viewBox="0 0 24 24"><path d="M12 21a9 9 0 1 1 0-18 9 9 0 0 1 0 18zm0-5c2.2 0 4-1.3 4-3h-8c0 1.7 1.8 3 4 3zm-3.5-7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm7 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/></svg>
    </a>
  </div>
</nav>


<!-- HERO -->
<section class="hero" id="home">
  <div class="container hero-inner">
    <!-- Left -->
    <aside class="hero-left" aria-hidden="false">
      <h1 class="hero-title">{{ content('home.hero.title', __('Your Title')) }}</h1>
      <h1 class="hero-title">{{ content('home.hero.subtitle', __('Your text...')) }}</h1>

      <p class="hero-desc">
        {{ content('home.hero.description', __('We are excited to announce that Tournament Community 2025 will take place this December 2025! Get ready for a month full of thrilling matches, friendly competition, and unforgettable moments.')) }}
      </p>


      <div class="countdown" role="timer" aria-live="polite">
        <div class="countbox">
          <div class="num">{{ str_pad($countdownMonths, 2, '0', STR_PAD_LEFT) }}</div>
          <div class="label">{{ content('home.countdown.months', __('Months')) }}</div>
        </div>
        <img src="{{ asset('./img/Star 8.png') }}" class="star-icon" alt="{{ __('Star Icon') }}" />
        <div class="countbox">
          <div class="num">{{ str_pad($countdownDays, 2, '0', STR_PAD_LEFT) }}</div>
          <div class="label">{{ content('home.countdown.days', __('Days')) }}</div>
        </div>
        <img src="{{ asset('./img/Star 8.png') }}" class="star-icon" alt="{{ __('Star Icon') }}" />
        <div class="countbox">
          <div class="num">{{ str_pad($countdownMinutes, 2, '0', STR_PAD_LEFT) }}</div>
          <div class="label">{{ content('home.countdown.minutes', __('Minutes')) }}</div>
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
        @if($heroIsVideo)
          @if($heroEmbedUrl)
            <iframe
              src="{{ $heroEmbedUrl }}"
              class="hero-media-el hero-media-iframe"
              title="{{ __('Hero video') }}"
              loading="lazy"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen></iframe>
          @else
            <video
              src="{{ $heroMediaUrl }}"
              class="hero-media-el hero-media-video"
              controls
              playsinline></video>
          @endif
        @else
          <img
            src="{{ $heroMediaUrl }}"
            class="hero-media-el"
            alt="{{ __('Esports showcase') }}" />
        @endif
        <div class="hero-tag">
          <small>{{ __('Ready For The') }}</small>
          <strong>
            {{ __('Suspension') }} <span id="swapword">{{ __('Esports') }}</span>
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
  <span class="progress-label">{{ __('Esports') }}</span>
</div>


<!-- SERVICES -->
<section class="services-section" data-reveal="fade-right" data-reveal-delay="150">
  <div class="container">
    <h2 class="title">
      {{ __('Our Services and') }} <span>{{ __('Speciality') }}</span>
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
          <img src="{{ asset('./img/Subtract(1).png') }}" alt="{{ __('Experienced Trainers') }}" />
        </div>
        <div class="img-desc">
          <h3>{{ __('Experienced Trainers') }}</h3>
          <p>{{ __('Endless action that keeps players coming back.') }}</p>
        </div>
      </div>

      <div class="card">
        <div class="img-wrapper">
          <img src="{{ asset('./img/Subtract.png') }}" alt="{{ __('Every Console') }}" />
        </div>
        <div class="img-desc">
          <h3>{{ __('Every Console') }}</h3>
          <p>{{ __('We deliver the complete esports experience.') }}</p>
        </div>
      </div>

      <div class="card">
        <div class="img-wrapper">
          <img src="{{ asset('./img/Subtract(2).png') }}" alt="{{ __('Live Streaming') }}" />
        </div>
        <div class="img-desc">
          <h3>{{ __('Live Streaming') }}</h3>
          <p>{{ __('One destination for unforgettable events.') }}</p>
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
        <h2 class="title">{{ content('home.tournaments.title', __('Most Popular Tournaments')) }}</h2>
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
        <p class="subtitle">{{ content('home.tournaments.subtitle', __('Community Organizing Team')) }}</p>
      </div>
    </div>

    <div class="slider slider--tournaments" id="tr-slider" role="region" aria-label="{{ __('Popular tournaments') }}">
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
            $tournamentTitle = $t->titleFor($homeLocale) ?: 'Tournament';
            $tournamentNameClass = strlen($tournamentTitle) > 18 ? 'wrap' : '';
          @endphp
          <figure class="card-partner card-tournament">
            <div class="media">
              <img
                src="{{ $t->imageUrl() ?? content_media('tournaments.card.image','img/tournaments-inner.png') }}"
                alt="{{ $tournamentTitle }}"
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
            <figcaption class="name {{ $tournamentNameClass }}">
              <a href="{{ route('tournaments.register', $t->slug) }}">
                {{ $tournamentTitle }}
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
    </div>
    <div class="mp-header mp-header--controls">
      <div class="dots-partner dots-partner--inline" id="tr-dots" aria-label="Slider pagination"></div>
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
    <h2 class="wwa-title">{{ __('Who We Are?') }}</h2>
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
        <h3 class="wwa-h3">{{ __('Our Story') }}</h3>
        <p class="wwa-p">
          {{ __('In early winter 2020, amid a global pandemic, FOUR04 ESPORTS was born. Our goal is to reinvent the regions sluggish esports atmosphere. By bringing together a diverse group of experts in managing offline and online tournaments, we aim to deliver events that are ten times better. We encourage and inspire the regions gaming youth to explore their passions and consider building a career in esports, a prospect that once felt far-fetched.') }}
        </p>
      </div>

      <div class="wwa-col">
        <h3 class="wwa-h3">{{ __('Our Mission') }}</h3>
        <p class="wwa-p">
          {{ __('We are building a self-sustaining and steadily scalable esports platform in the Middle East while growing a local and international community that connects solutions and opportunities for players and brands to engage with esports across the region.') }}
        </p>
      </div>

      <div class="wwa-col">
        <h3 class="wwa-h3">{{ __('Our Vision') }}</h3>
        <p class="wwa-p wwa-center">
          {{ __('The healing is fresh! I cannot wait for my next session. I feel energetic, and I stay committed to the quality of my mental health and happiness no matter what I face.') }}
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
        placeholder="{{ __('Enter your email address') }}"
        aria-label="{{ __('Email address') }}" />
      <button class="wwa-btn" type="submit">{{ __('Subscribe') }}</button>
    </form>
  </div>
</section>

@endsection
@push('scripts')
@vite('../../../public/js/home.js')
@endpush
