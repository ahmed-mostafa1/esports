@extends('layouts.app')

@section('title', 'Registeration')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/tours-reg.css') }}" />
@endpush

@section('content')

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
          E-Sports
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
            Our News
          </button>
        </h2>

        <!-- confetti shards -->
        <span class="tri t1" aria-hidden="true"></span>
        <span class="tri t2" aria-hidden="true"></span>
        <span class="tri t3" aria-hidden="true"></span>
        <span class="tri t4" aria-hidden="true"></span>

        <!-- cards grid -->
        <ul class="char-grid">
          <!-- Phoenix -->
          <li class="char-card theme-dark">
            <div class="char-wrap">
              <figure class="art">
                <img src="{{ asset('./img/Art(3).png') }}" alt="Phoenix artwork" />
              </figure>

              <div class="vlabel">
                <strong class="phoenix">PHOENIX</strong>
                <em>United Kingdom</em>
              </div>
              <i class="accent" aria-hidden="true"></i>

              <div class="abilities">
                <img class="ab" src="{{ asset('./img/vectors/Vector.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector3.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector(2).png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector-1.png') }}" alt="" />
                <span class="under" aria-hidden="true"></span>
              </div>
            </div>

            <div class="cta">
              <button class="btn-register" type="button">Register - now</button>
              <div class="segmented">
                @auth
                  <a href="{{ route('reg-single') }}" class="mini">Single</a>
                  <a href="{{ route('reg-team') }}" class="mini">Team</a>
                @else
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Single</a>
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Team</a>
                @endauth
              </div>
            </div>
          </li>

          <!-- Jett -->
          <li class="char-card theme-slate">
            <div class="char-wrap">
              <figure class="art">
                <img src="{{ asset('./img/Art(2).png') }}" alt="Jett artwork" />
              </figure>

              <div class="vlabel vlabel--light">
                <strong>JETT</strong>
                <em>South Korea</em>
              </div>
              <i class="accent" aria-hidden="true"></i>

              <div class="abilities">
                <img class="ab" src="{{ asset('./img/vectors/Vector(1).png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector3.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector(3).png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector-1.png') }}" alt="" />
                <span class="under" aria-hidden="true"></span>
              </div>
            </div>

            <div class="cta">
              <button class="btn-register" type="button">Register - now</button>
              <div class="segmented">
                @auth
                  <a href="{{ route('reg-single') }}" class="mini">Single</a>
                  <a href="{{ route('reg-team') }}" class="mini">Team</a>
                @else
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Single</a>
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Team</a>
                @endauth
              </div>
            </div>
          </li>

          <!-- Sova -->
          <li class="char-card theme-coal">
            <div class="char-wrap">
              <figure class="art">
                <img src="{{ asset('./img/Art(1).png') }}" alt="Sova artwork" />
              </figure>

              <div class="vlabel">
                <strong>SOVA</strong>
                <em>Russia</em>
              </div>
              <i class="accent" aria-hidden="true"></i>

              <div class="abilities">
                <img class="ab" src="{{ asset('./img/vectors/Vector3.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector(2).png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector-1.png') }}" alt="" />
                <span class="under" aria-hidden="true"></span>
              </div>
            </div>

            <div class="cta">
              <button class="btn-register" type="button">Register - now</button>
              <div class="segmented">
                @auth
                  <a href="{{ route('reg-single') }}" class="mini">Single</a>
                  <a href="{{ route('reg-team') }}" class="mini">Team</a>
                @else
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Single</a>
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Team</a>
                @endauth
              </div>
            </div>
          </li>

          <!-- Sage -->
          <li class="char-card theme-white">
            <div class="char-wrap">
              <figure class="art">
                <img src="{{ asset('./img/Art.png') }}" alt="Sage artwork" />
              </figure>

              <div class="vlabel vlabel--light">
                <strong>SAGE</strong>
                <em>China</em>
              </div>
              <i class="accent" aria-hidden="true"></i>

              <div class="abilities">
                <img class="ab" src="{{ asset('./img/vectors/Vector(2).png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector3.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector.png') }}" alt="" />
                <img class="ab" src="{{ asset('./img/vectors/Vector-1.png') }}" alt="" />
                <span class="under" aria-hidden="true"></span>
              </div>
            </div>

            <div class="cta">
              <button class="btn-register" type="button">Register - now</button>
              <div class="segmented">
                @auth
                  <a href="{{ route('reg-single') }}" class="mini">Single</a>
                  <a href="{{ route('reg-team') }}" class="mini">Team</a>
                @else
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Single</a>
                  <a href="{{ route('login') }}" class="mini" onclick="sessionStorage.setItem('loginMessage', 'You must login to register'); return true;">Team</a>
                @endauth
              </div>
            </div>
          </li>
        </ul>
      </section>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
