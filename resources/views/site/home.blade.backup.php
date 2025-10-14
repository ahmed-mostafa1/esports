@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/home.css') }}" />
@endpush

@section('content')


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
    <div class="mp-header">
      <div class="popular-title">
        <h2 class="title">Most Popular Tournaments</h2>
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
        <p class="subtitle">Community Organizing Team</p>
      </div>
      <!-- Dots-->
      <div class="dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
      <!-- nav btn -->
      <div class="nav-arrows">
        <button class="nav-btn prev" aria-label="Previous">
          <span class="chev">&lsaquo;</span>
        </button>
        <button class="nav-btn next" aria-label="Next">
          <span class="chev">&rsaquo;</span>
        </button>
      </div>
    </div>
    <!-- 3-column list -->
    <div class="list-grid">
      <!-- Column 1 -->
      <ul class="mp-list">
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html"> Dubai Police Esports Tournament</div></a>
          </div>
        </li>
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html">Que Club 1v1 League of Legends Showdown </div></a>
          </div>
        </li>
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html"> Dubai Police Esports Tournament</div></a>
          </div>
        </li>
      </ul>

      <!-- Column 2 -->
      <ul class="mp-list">
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html"> Dubai Police Esports Tournament</div></a>
          </div>
        </li>
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div></div>
            <div><a class="txt" href="./tours-reg.html">EMIRATES ESPORTS FESTIVAL 22 </div></a>
          </div>
        </li>
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html"> Dubai Police Esports Tournament</div></a>
          </div>
        </li>
      </ul>

      <!-- Column 3 -->
      <ul class="mp-list">
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html"> Dubai Police Esports Tournament</div></a>
          </div>
        </li>
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html">Manchester City FIFA Cup powered by MIDEA </div></a>
          </div>
        </li>
        <li class="mp-item">
          <span class="badge"><img src="{{ asset('./img/badge.png') }}" /></span>
          <div class="txt">
            <div><a class="txt" href="./tours-reg.html">DOTA 2 MENA TOURNAMENT </div></a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>

<!-- PARTNERS -->
<section class="partners-section" data-reveal="fade-right" data-reveal-delay="150">
  <div class="container">
    <!-- Title -->
    <h2 class="title">Our Partners</h2>
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
        <!-- Slide -->
        <figure class="card-partner">
          <div class="media placeholder">
            <img src="{{ asset('./img/dubi.png') }}" />
            <span class="live">● Live</span>
            <button class="play" aria-label="Play"></button>
            <figcaption class="overlay">
              <div class="meta-title">LIVE: Nemiga vs Fornite</div>
              <div class="meta-sub">Agung Zero Dark Channel</div>
            </figcaption>
          </div>
          <figcaption class="name">Dubai Police</figcaption>
        </figure>

        <!-- Slide -->
        <figure class="card-partner">
          <div class="media placeholder alt">
            <img src="{{ asset('./img/que.png') }}" />
            <span class="live">● Live</span>
            <button class="play" aria-label="Play"></button>
            <figcaption class="overlay">
              <div class="meta-title">LIVE: Nemiga vs Fornite</div>
              <div class="meta-sub">Agung Zero Dark Channel</div>
            </figcaption>
          </div>
          <figcaption class="name">Que Club</figcaption>
        </figure>

        <!-- Slide -->
        <figure class="card-partner">
          <div class="media placeholder">
            <img src="{{ asset('./img/emirate.png') }}" />
            <span class="live">● Live</span>
            <button class="play" aria-label="Play"></button>
            <figcaption class="overlay">
              <div class="meta-title">LIVE: Nemiga vs Fornite</div>
              <div class="meta-sub">Agung Zero Dark Channel</div>
            </figcaption>
          </div>
          <figcaption class="name wrap">
            EMIRATES ESPORTS FESTIVAL
          </figcaption>
        </figure>

        <!-- Slide -->
        <figure class="card-partner">
          <div class="media placeholder alt">
            <img src="{{ asset('./img/dotta.png') }}" />
            <span class="live">● Live</span>
            <button class="play" aria-label="Play"></button>
            <figcaption class="overlay">
              <div class="meta-title">LIVE: Nemiga vs Fornite</div>
              <div class="meta-sub">Agung Zero Dark Channel</div>
            </figcaption>
          </div>
          <figcaption class="name wrap">
            DOTA 2 MENA TOURNAMENT
          </figcaption>
        </figure>

        <!-- extra slides (placeholders) to demonstrate pagination -->
        <figure class="card-partner">
          <div class="media placeholder">
            <img src="{{ asset('./img/emirate.png') }}" />
            <button class="play" aria-label="Play"></button>
          </div>
          <figcaption class="name">Partner Five</figcaption>
        </figure>
        <figure class="card-partner">
          <div class="media placeholder alt">
            <img src="{{ asset('./img/emirate.png') }}" />
            <button class="play" aria-label="Play"></button>
          </div>
          <figcaption class="name">Partner Six</figcaption>
        </figure>
        <figure class="card-partner">
          <div class="media placeholder">
            <img src="{{ asset('./img/emirate.png') }}" />
            <button class="play" aria-label="Play"></button>
          </div>
          <figcaption class="name">Partner Seven</figcaption>
        </figure>
        <figure class="card-partner">
          <div class="media placeholder alt">
            <img src="{{ asset('./img/emirate.png') }}" />
            <button class="play" aria-label="Play"></button>
          </div>
          <figcaption class="name">Partner Eight</figcaption>
        </figure>
      </div>


    </div>
    <div class="mp-header">
      <!-- Dots -->
      <div
        class="dots-partner"
        id="p-dots"
        aria-label="Slider pagination">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>

      <!-- Arrow pills (bottom-right) -->
      <div class="nav">
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
      <h2 class="ts-title">Client <span>Testimonial</span></h2>
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
      <p class="ts-sub">Our Client feedback is overseas and Localy</p>
    </div>

    <div class="ts-slider" id="ts-slider">
      <div class="ts-track">
        <!-- Card 1 -->
        <article class="ts-card">
          <div class="ts-avatar">
            <img src="{{ asset('./img/Rectangle 28.png') }}" />
          </div>
          <div class="ts-inner">
            <h3 class="ts-name">Mickdad Abbas</h3>
            <div class="ts-role">Founder</div>
            <div class="ts-q ts-ql">“</div>
            <p class="ts-text">
              “The tournament was organized with such professionalism and
              excitement. From the stage setup to the smooth coordination
              of matches, everything felt world-class. I truly enjoyed
              being part of it and can’t wait to join their next esports
              event!”
            </p>
            <div class="ts-q ts-qr">”</div>
          </div>
        </article>

        <!-- Card 2 -->
        <article class="ts-card">
          <div class="ts-avatar ts-alt">
            <img src="{{ asset('./img/Rectangle 28.png') }}" />
          </div>
          <div class="ts-inner">
            <h3 class="ts-name">Wysten Night</h3>
            <div class="ts-role">CEO</div>
            <div class="ts-q ts-ql">“</div>
            <p class="ts-text">
              “We know how to bring the esports community together! The
              energy, the atmosphere, and the attention to detail made the
              event unforgettable. It was more than just a competition —
              it was an experience I’ll always remember.”
            </p>
            <div class="ts-q ts-qr">”</div>
          </div>
        </article>

        <!-- Card 3 -->
        <article class="ts-card">
          <div class="ts-avatar">
            <img src="{{ asset('./img/Rectangle 28.png') }}" />
          </div>
          <div class="ts-inner">
            <h3 class="ts-name">Amira Saeed</h3>
            <div class="ts-role">Head of Events</div>
            <div class="ts-q ts-ql">“</div>
            <p class="ts-text">
              “Top-tier production and smooth scheduling—fans loved every
              moment.”
            </p>
            <div class="ts-q ts-qr">”</div>
          </div>
        </article>

        <!-- Card 4 -->
        <article class="ts-card">
          <div class="ts-avatar ts-alt">
            <img src="{{ asset('./img/Rectangle 28.png') }}" />
          </div>
          <div class="ts-inner">
            <h3 class="ts-name">Rashid Al Nuaimi</h3>
            <div class="ts-role">Operations Lead</div>
            <div class="ts-q ts-ql">“</div>
            <p class="ts-text">
              “Superb coordination and hospitality—easily the best esports
              crew we’ve worked with.”
            </p>
            <div class="ts-q ts-qr">”</div>
          </div>
        </article>
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
