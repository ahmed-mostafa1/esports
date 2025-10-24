@extends('layouts.app')

@section('title', 'Tournaments')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/tournaments.css') }}" />
@endpush

@section('content')

    <section class="our-tournaments" aria-labelledby="esports-title">
      <!-- top labels -->
      <div class="right-panel">
        <div class="form-header">
          <button
            class="tab-btn active"
            style="font-size: 20px; border-radius: 10px"
          >
            {{ content('tournaments.header.title', 'E-Sports') }}
          </button>
        </div>
      </div>
      <span class="ot-pill ot-pill--gray">{{ content('tournaments.our_tournament', 'Our Tournament') }}</span>

      <!-- grid -->
      <ul class="ot-grid">
        <!-- Tournament 1: League of Legends World Championship -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.tournament1.image', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament1.title', 'League of Legends Championship') }}" />
            </figure>

            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament1.title', 'LEAGUE OF LEGENDS WORLD CHAMPIONSHIP') }}</h3>

              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament1.date', '15/12/2024') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament1.time', '18:00') }}</span>
                </li>
              </ul>

              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament1.prize', '$5,000.00') }}</span>
              </div>

              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 2: FIFA Ultimate Team Challenge -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.tournament2.image', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament2.title', 'FIFA Ultimate Team Challenge') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament2.title', 'FIFA ULTIMATE TEAM CHALLENGE') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament2.date', '20/12/2024') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament2.time', '16:30') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament2.prize', '$3,500.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 3: Call of Duty Warzone Battle -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.image.img3', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament3.title', 'Call of Duty Warzone Battle') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament3.title', 'CALL OF DUTY WARZONE BATTLE') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament3.date', '25/12/2024') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament3.time', '14:00') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament3.prize', '$4,200.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 4: Counter-Strike Global Offensive -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.image.img4', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament4.title', 'Counter-Strike Global Offensive') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament4.title', 'COUNTER-STRIKE GLOBAL OFFENSIVE') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament4.date', '28/12/2024') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament4.time', '19:45') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament4.prize', '$6,750.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 5: Valorant Champions -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.image.img5', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament5.title', 'Valorant Champions') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament5.title', 'VALORANT CHAMPIONS SERIES') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament5.date', '02/01/2025') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament5.time', '17:15') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament5.prize', '$8,000.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 6: Apex Legends Arena -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.image.img6', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament6.title', 'Apex Legends Arena') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament6.title', 'APEX LEGENDS ARENA MASTERS') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament6.date', '05/01/2025') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament6.time', '15:30') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament6.prize', '$3,800.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 7: Rocket League Championship -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.image.img7', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament7.title', 'Rocket League Championship') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament7.title', 'ROCKET LEAGUE CHAMPIONSHIP SERIES') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament7.date', '08/01/2025') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament7.time', '13:45') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament7.prize', '$2,900.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>

        <!-- Tournament 8: Overwatch League Finals -->
        <li class="ot-card">
          <article class="ot-card__wrap">
            <figure class="ot-media">
              <img src="{{ content_media('tournaments.image.img4', 'img/tournaments-inner.png') }}" alt="{{ content('tournaments.tournament8.title', 'Overwatch League Finals') }}" />
            </figure>
            <div class="ot-body">
              <h3 class="ot-title">{{ content('tournaments.tournament8.title', 'OVERWATCH LEAGUE GRAND FINALS') }}</h3>
              <ul class="ot-meta">
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M7 2v3M17 2v3M3 9h18M5 6h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament8.date', '12/01/2025') }}</span>
                </li>
                <li class="meta">
                  <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 8v5l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
                    />
                  </svg>
                  <span>{{ content('tournaments.tournament8.time', '21:00') }}</span>
                </li>
              </ul>
              <div class="ot-prize">
                <svg class="ico" viewBox="0 0 24 24" aria-hidden="true">
                  <path
                    d="M8 21h8M12 17v4M5 3h14v2a4 4 0 0 1-4 4h-1a4 4 0 0 1-3 4v0H9v0a4 4 0 0 1-3-4H7A4 4 0 0 1 3 5V3h2z"
                  />
                </svg>
                <span class="amount">{{ content('tournaments.tournament8.prize', '$10,500.00') }}</span>
              </div>
              <a href="{{ route('tours-reg') }}" class="ot-btn">{{ content('tournaments.card.register', 'REGISTER') }}</a>
            </div>
          </article>
        </li>
      </ul>
    </section>


@endsection
@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
