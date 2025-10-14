@extends('layouts.app')

@section('title', 'Services')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/ourservices.css') }}" />
@endpush

@section('content')


    <section class="services" aria-labelledby="services-title">
      <div class="right-panel">
        <div class="form-header" style=" margin-bottom: 50px;">
          <button
            class="tab-btn active"
            style="font-size: 20px; border-radius: 10px;"
          >
            {{ content('services.header.title', 'Our Services') }}
          </button>
        </div>
      </div>

      <!-- grid -->
      <ul class="services__grid">
        <!-- card x6 -->
        <li class="svc-card">
          <article class="svc-card__inner">
            <div class="svc-card__tab">
              <span class="svc-card__puzzle" aria-hidden="true">
                <img src="{{ asset('./img/services-icon.png') }}" />
              </span>
              <span class="svc-card__label"
                >{{ content('services.card1.title', 'Technology & Platform Development') }}</span
              >
            </div>

            <div class="svc-card__body">
              <ul class="svc-list">
                <li>{{ content('services.card1.item1', 'Custom tournament platforms and registration portals') }}</li>
                <li>{{ content('services.card1.item2', 'Score tracking dashboards and live updates') }}</li>
                <li>
                  {{ content('services.card1.item3', 'Integration with Discord, Twitch, and other gaming tools') }}
                </li>
                <li>{{ content('services.card1.item4', 'Mobile-first responsive design') }}</li>
              </ul>
            </div>
          </article>
        </li>

        <!-- Copy the card 5 more times (change content if needed) -->
        <li class="svc-card">
          <article class="svc-card__inner">
            <div class="svc-card__tab">
              <span class="svc-card__puzzle" aria-hidden="true"
                >
              <img src="{{ asset('./img/services-icon.png') }}" />
              </span>
              <span class="svc-card__label"
                >Technology &amp; Platform Development</span
              >
            </div>
            <div class="svc-card__body">
              <ul class="svc-list">
                <li>Custom tournament platforms and registration portals</li>
                <li>Score tracking dashboards and live updates</li>
                <li>
                  Integration with Discord, Twitch, and other gaming tools
                </li>
                <li>Mobile-first responsive design</li>
              </ul>
            </div>
          </article>
        </li>

        <li class="svc-card">
          <article class="svc-card__inner">
            <div class="svc-card__tab">
              <span class="svc-card__puzzle" aria-hidden="true"
                >
                <img src="{{ asset('./img/services-icon.png') }}" />
              </span>
              <span class="svc-card__label"
                >Technology &amp; Platform Development</span
              >
            </div>
            <div class="svc-card__body">
              <ul class="svc-list">
                <li>Custom tournament platforms and registration portals</li>
                <li>Score tracking dashboards and live updates</li>
                <li>
                  Integration with Discord, Twitch, and other gaming tools
                </li>
                <li>Mobile-first responsive design</li>
              </ul>
            </div>
          </article>
        </li>

        <li class="svc-card">
          <article class="svc-card__inner">
            <div class="svc-card__tab">
              <span class="svc-card__puzzle" aria-hidden="true"
                >
              <img src="{{ asset('./img/services-icon.png') }}" />
            </span>
              <span class="svc-card__label"
                >Technology &amp; Platform Development</span
              >
            </div>
            <div class="svc-card__body">
              <ul class="svc-list">
                <li>Custom tournament platforms and registration portals</li>
                <li>Score tracking dashboards and live updates</li>
                <li>
                  Integration with Discord, Twitch, and other gaming tools
                </li>
                <li>Mobile-first responsive design</li>
              </ul>
            </div>
          </article>
        </li>

        <li class="svc-card">
          <article class="svc-card__inner">
            <div class="svc-card__tab">
              <span class="svc-card__puzzle" aria-hidden="true"
                >
              <img src="{{ asset('./img/services-icon.png') }}" />
              </span>
              <span class="svc-card__label"
                >Technology &amp; Platform Development</span
              >
            </div>
            <div class="svc-card__body">
              <ul class="svc-list">
                <li>Custom tournament platforms and registration portals</li>
                <li>Score tracking dashboards and live updates</li>
                <li>
                  Integration with Discord, Twitch, and other gaming tools
                </li>
                <li>Mobile-first responsive design</li>
              </ul>
            </div>
          </article>
        </li>

        <li class="svc-card">
          <article class="svc-card__inner">
            <div class="svc-card__tab">
              <span class="svc-card__puzzle" aria-hidden="true"
                >
              <img src="{{ asset('./img/services-icon.png') }}" />
              </span>
              <span class="svc-card__label"
                >Technology &amp; Platform Development</span
              >
            </div>
            <div class="svc-card__body">
              <ul class="svc-list">
                <li>Custom tournament platforms and registration portals</li>
                <li>Score tracking dashboards and live updates</li>
                <li>
                  Integration with Discord, Twitch, and other gaming tools
                </li>
                <li>Mobile-first responsive design</li>
              </ul>
            </div>
          </article>
        </li>
      </ul>

      <!-- pagination / controls -->
      <div class="services__footer">
        <div class="pager" aria-label="pagination">
          <button
            class="dot"
            aria-label="slide 1 (current)"
            aria-current="true"
          ></button>
          <button class="dot" aria-label="slide 2"></button>
          <button class="dot" aria-label="slide 3"></button>
          <button class="dot" aria-label="slide 4"></button>
        </div>

        <div class="nav">
          <button class="nav__btn nav__btn--prev" aria-label="Previous">
            <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6" /></svg>
          </button>
          <button class="nav__btn nav__btn--next" aria-label="Next">
            <svg viewBox="0 0 24 24"><path d="M9 6l6 6-6 6" /></svg>
          </button>
        </div>
      </div>
    </section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush