@extends('layouts.app')

@section('title', $tournament->titleFor(app()->getLocale()) ?: 'Tournament')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/tours-reg.css') }}" />
@endpush

@section('content')
  <section class="tr-cards" aria-labelledby="tr-title">
    <!-- header pills -->
    <h2 style="display:flex;justify-content:center">
      <button class="tab-btn active" style="font-size:25px;padding:10px 40px;border-radius:5px!important;">
        {{ content('tours-reg.header.title', 'E-Sports') }}
      </button>
    </h2>

    <section class="our-news-section">
      <h2 style="display:flex;justify-content:start">
        <button class="secondary-btn" style="font-size:25px;padding:10px 40px;border-radius:5px!important;">
          {{ content('tours-reg.section.title', 'Our News') }}
        </button>
      </h2>

      {{-- 2-column detail layout --}}
      <div class="tr-two-col">
        {{-- LEFT: image --}}
        <figure class="tr-media">
          <img
            src="{{ $tournament->imageUrl() ?? content_media('tournaments.card.image','img/tournaments-inner.png') }}"
            alt="{{ $tournament->titleFor(app()->getLocale()) ?: 'Tournament' }}"
            loading="eager" fetchpriority="high"
          />
        </figure>

        {{-- RIGHT: text + CTAs --}}
        <aside class="tr-aside">
          <header class="tr-aside__head">
            <h1 class="tr-title">{{ $tournament->titleFor(app()->getLocale()) }}</h1>
            <ul class="tr-meta">
              <li><span class="meta-k">{{ __('Date') }}</span> <span class="meta-v">{{ optional($tournament->date)->format('d/m/Y') ?? '--' }}</span></li>
              <li><span class="meta-k">{{ __('Time') }}</span> <span class="meta-v">{{ $tournament->time ?: '--' }}</span></li>
              @if(!empty($tournament->prize))
              <li><span class="meta-k">{{ __('Prize') }}</span> <span class="meta-v">{{ $tournament->prize }}</span></li>
              @endif
            </ul>
          </header>

          <div class="tr-cta">
            @if($tournament->status === 'open')
              <button class="btn-register" type="button" aria-label="Register now">
                {{ content('tours-reg.card.register_button', 'Register - now') }}
              </button>
              <div class="segmented">
                @auth
                  <a href="{{ route('register.single') }}?t={{ $tournament->id }}" class="mini" aria-label="Register as single">
                    {{ content('tours-reg.links.single', 'Single') }}
                  </a>
                  <a href="{{ route('register.team') }}?t={{ $tournament->id }}" class="mini" aria-label="Register as team">
                    {{ content('tours-reg.links.team', 'Team') }}
                  </a>
                @else
                  <a href="{{ route('login') }}" class="mini"
                     onclick="sessionStorage.setItem('loginMessage','You must login to register');return true;">
                    {{ content('tours-reg.links.single', 'Single') }}
                  </a>
                  <a href="{{ route('login') }}" class="mini"
                     onclick="sessionStorage.setItem('loginMessage','You must login to register');return true;">
                    {{ content('tours-reg.links.team', 'Team') }}
                  </a>
                @endauth
              </div>
            @elseif($tournament->status === 'finished')
              <a class="mini" href="{{ route('winners.show', $tournament->slug) }}">
                {{ content('tournaments.card.winner', 'Winner') }}
              </a>
            @else
              <span class="mini" style="pointer-events:none;opacity:.6">
                {{ content('tournaments.card.closed', 'Closed') }}
              </span>
            @endif
          </div>

          {{-- Optional: a short blurb (CMS-driven) --}}
          <p class="tr-note">
            {{ content('tournaments.register.note', 'Make sure you meet the requirements before registering.') }}
          </p>
        </aside>
      </div>
    </section>
  </section>
@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
