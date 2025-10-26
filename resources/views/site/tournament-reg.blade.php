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

      <ul class="char-grid">
        <li class="char-card theme-dark">
          <div class="char-wrap">
            <figure class="art">
              <img
                src="{{ $tournament->imageUrl() ?? content_media('tournaments.card.image','img/tournaments-inner.png') }}"
                alt="{{ $tournament->titleFor(app()->getLocale()) ?: 'Tournament' }}" />
            </figure>

            <div class="vlabel">
              <strong class="phoenix">{{ $tournament->titleFor(app()->getLocale()) }}</strong>
              <em>{{ optional($tournament->date)->format('d/m/Y') ?? '--' }} • {{ $tournament->time ?: '--' }}</em>
            </div>
            <i class="accent" aria-hidden="true"></i>

            <div class="abilities">
              <span class="under" aria-hidden="true"></span>
            </div>
          </div>

          <div class="cta">
            @if($tournament->status === 'open')
              <button class="btn-register" type="button">
                {{ content('tours-reg.card.register_button', 'Register - now') }}
              </button>
              <div class="segmented">
                @auth
                  <a href="{{ route('register.single') }}?t={{ $tournament->id }}" class="mini">
                    {{ content('tours-reg.links.single', 'Single') }}
                  </a>
                  <a href="{{ route('register.team') }}?t={{ $tournament->id }}" class="mini">
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
        </li>
      </ul>
    </section>
  </section>
@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
