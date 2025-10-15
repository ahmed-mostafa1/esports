@extends('layouts.app')

@section('title', 'Registeration')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/tours-reg.css') }}" />
@endpush

@section('content')

@php
    $toursRegCards = [
        [
            'key' => 'card1',
            'theme' => 'theme-dark',
            'label_classes' => 'vlabel',
            'name_class' => 'phoenix',
            'fallback_name' => 'PHOENIX',
            'fallback_country' => 'United Kingdom',
            'image' => 'img/Art(3).png',
            'abilities' => [
                ['key' => 'ability1', 'fallback' => 'img/vectors/Vector.png'],
                ['key' => 'ability2', 'fallback' => 'img/vectors/Vector3.png'],
                ['key' => 'ability3', 'fallback' => 'img/vectors/Vector(2).png'],
                ['key' => 'ability4', 'fallback' => 'img/vectors/Vector-1.png'],
            ],
        ],
        [
            'key' => 'card2',
            'theme' => 'theme-slate',
            'label_classes' => 'vlabel vlabel--light',
            'name_class' => '',
            'fallback_name' => 'JETT',
            'fallback_country' => 'South Korea',
            'image' => 'img/Art(2).png',
            'abilities' => [
                ['key' => 'ability1', 'fallback' => 'img/vectors/Vector(1).png'],
                ['key' => 'ability2', 'fallback' => 'img/vectors/Vector3.png'],
                ['key' => 'ability3', 'fallback' => 'img/vectors/Vector(3).png'],
                ['key' => 'ability4', 'fallback' => 'img/vectors/Vector-1.png'],
            ],
        ],
        [
            'key' => 'card3',
            'theme' => 'theme-coal',
            'label_classes' => 'vlabel',
            'name_class' => '',
            'fallback_name' => 'SOVA',
            'fallback_country' => 'Russia',
            'image' => 'img/Art(1).png',
            'abilities' => [
                ['key' => 'ability1', 'fallback' => 'img/vectors/Vector3.png'],
                ['key' => 'ability2', 'fallback' => 'img/vectors/Vector(2).png'],
                ['key' => 'ability3', 'fallback' => 'img/vectors/Vector.png'],
                ['key' => 'ability4', 'fallback' => 'img/vectors/Vector-1.png'],
            ],
        ],
        [
            'key' => 'card4',
            'theme' => 'theme-white',
            'label_classes' => 'vlabel vlabel--light',
            'name_class' => '',
            'fallback_name' => 'SAGE',
            'fallback_country' => 'China',
            'image' => 'img/Art.png',
            'abilities' => [
                ['key' => 'ability1', 'fallback' => 'img/vectors/Vector(2).png'],
                ['key' => 'ability2', 'fallback' => 'img/vectors/Vector3.png'],
                ['key' => 'ability3', 'fallback' => 'img/vectors/Vector.png'],
                ['key' => 'ability4', 'fallback' => 'img/vectors/Vector-1.png'],
            ],
        ],
    ];
@endphp

 <section class="tr-cards" aria-labelledby="tr-title">
      <!-- header pills -->
      <h2 style="display: flex; justify-content: center">
        <button
          class="tab-btn active"
          style="
            font-size: 25px;
            padding: 10px 40px;
            border-radius: 5px !important;
          "
        >
          {{ content('tours-reg.header.title', 'E-Sports') }}
        </button>
      </h2>

      <!-- Our News Section -->
      <section class="our-news-section">
        <h2 style="display: flex; justify-content: start">
          <button
            class="secondary-btn"
            style="
            font-size: 25px;
            padding: 10px 40px;
            border-radius: 5px !important;
          "
        >
            {{ content('tours-reg.section.title', 'Our News') }}
          </button>
        </h2>

        <!-- confetti shards -->
        <span class="tri t1" aria-hidden="true"></span>
        <span class="tri t2" aria-hidden="true"></span>
        <span class="tri t3" aria-hidden="true"></span>
        <span class="tri t4" aria-hidden="true"></span>

        <!-- cards grid -->
        <ul class="char-grid">
          @foreach($toursRegCards as $card)
            @php
                $cardKey = 'tours-reg.' . $card['key'];
                $cardName = content($cardKey . '.name', $card['fallback_name']);
                $cardCountry = content($cardKey . '.country', $card['fallback_country']);
            @endphp
            <li class="char-card {{ $card['theme'] }}">
              <div class="char-wrap">
                <figure class="art">
                  <img
                    src="{{ content_media($cardKey . '.image', $card['image']) }}"
                    alt="{{ $cardName }} artwork"
                  />
                </figure>

                <div class="{{ $card['label_classes'] }}">
                  <strong class="{{ $card['name_class'] }}">{{ $cardName }}</strong>
                  <em>{{ $cardCountry }}</em>
                </div>
                <i class="accent" aria-hidden="true"></i>

                <div class="abilities">
                  @foreach($card['abilities'] as $index => $ability)
                    <img
                      class="ab"
                      src="{{ content_media($cardKey . '.' . $ability['key'], $ability['fallback']) }}"
                      alt="{{ $cardName }} ability {{ $loop->iteration }}"
                    />
                  @endforeach
                  <span class="under" aria-hidden="true"></span>
                </div>
              </div>

              <div class="cta">
                <button class="btn-register" type="button">
                  {{ content('tours-reg.card.register_button', 'Register - now') }}
                </button>
                <div class="segmented">
                  @auth
                    <a href="{{ route('reg-single') }}" class="mini">
                      {{ content('tours-reg.links.single', 'Single') }}
                    </a>
                    <a href="{{ route('reg-team') }}" class="mini">
                      {{ content('tours-reg.links.team', 'Team') }}
                    </a>
                  @else
                    <a
                      href="{{ route('login') }}"
                      class="mini"
                      onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;"
                    >
                      {{ content('tours-reg.links.single', 'Single') }}
                    </a>
                    <a
                      href="{{ route('login') }}"
                      class="mini"
                      onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;"
                    >
                      {{ content('tours-reg.links.team', 'Team') }}
                    </a>
                  @endauth
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </section>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
