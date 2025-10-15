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

      @php
          $serviceCards = [
              [
                  'icon_key' => 'services.card1.icon',
                  'title_key' => 'services.card1.title',
                  'fallback_title' => 'Technology & Platform Development',
                  'items' => [
                      'services.card1.item1' => 'Custom tournament platforms and registration portals',
                      'services.card1.item2' => 'Score tracking dashboards and live updates',
                      'services.card1.item3' => 'Integration with Discord, Twitch, and other gaming tools',
                      'services.card1.item4' => 'Mobile-first responsive design',
                  ],
              ],
              [
                  'icon_key' => 'services.card2.icon',
                  'title_key' => 'services.card2.title',
                  'fallback_title' => 'Event Management & Production',
                  'items' => [
                      'services.card2.item1' => 'Tournament planning and execution',
                      'services.card2.item2' => 'Live streaming and broadcast services',
                      'services.card2.item3' => 'Professional commentary and analysis',
                      'services.card2.item4' => 'Venue coordination and logistics',
                  ],
              ],
              [
                  'icon_key' => 'services.card3.icon',
                  'title_key' => 'services.card3.title',
                  'fallback_title' => 'Community Building & Engagement',
                  'items' => [
                      'services.card3.item1' => 'Discord server setup and management',
                      'services.card3.item2' => 'Social media strategy and content creation',
                      'services.card3.item3' => 'Player networking and team formation',
                      'services.card3.item4' => 'Regular community events and activities',
                  ],
              ],
              [
                  'icon_key' => 'services.card4.icon',
                  'title_key' => 'services.card4.title',
                  'fallback_title' => 'Training & Coaching Services',
                  'items' => [
                      'services.card4.item1' => 'One-on-one coaching sessions',
                      'services.card4.item2' => 'Team strategy development',
                      'services.card4.item3' => 'Performance analysis and improvement',
                      'services.card4.item4' => 'Mental health and wellness support',
                  ],
              ],
              [
                  'icon_key' => 'services.card5.icon',
                  'title_key' => 'services.card5.title',
                  'fallback_title' => 'Broadcasting & Media Production',
                  'items' => [
                      'services.card5.item1' => 'Multi-platform streaming setup',
                      'services.card5.item2' => 'Professional video production',
                      'services.card5.item3' => 'Graphics and overlay design',
                      'services.card5.item4' => 'Post-event highlight reels',
                  ],
              ],
              [
                  'icon_key' => 'services.card6.icon',
                  'title_key' => 'services.card6.title',
                  'fallback_title' => 'Sponsorship & Partnership',
                  'items' => [
                      'services.card6.item1' => 'Brand partnership development',
                      'services.card6.item2' => 'Sponsorship activation strategies',
                      'services.card6.item3' => 'Marketing campaign execution',
                      'services.card6.item4' => 'ROI tracking and reporting',
                  ],
              ],
          ];
      @endphp

      <!-- grid -->
      <ul class="services__grid">
        @foreach($serviceCards as $card)
          <li class="svc-card">
            <article class="svc-card__inner">
              <div class="svc-card__tab">
                <span class="svc-card__puzzle" aria-hidden="true">
                  <img
                    src="{{ content_media($card['icon_key'], 'img/services-icon.png') }}"
                    alt="{{ content($card['title_key'], $card['fallback_title']) }}"
                  />
                </span>
                <span class="svc-card__label">
                  {{ content($card['title_key'], $card['fallback_title']) }}
                </span>
              </div>

              <div class="svc-card__body">
                <ul class="svc-list">
                  @foreach($card['items'] as $itemKey => $fallback)
                    <li>{{ content($itemKey, $fallback) }}</li>
                  @endforeach
                </ul>
              </div>
            </article>
          </li>
        @endforeach
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
