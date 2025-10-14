@extends('layouts.app')

@section('title', 'Single Registeration')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/reg-single.css') }}" />
<link rel="stylesheet" href="{{ asset('css/auth-fixes.css') }}" />
@endpush

@section('content')

<section class="reg" aria-labelledby="reg-esports-title">

    <div class="right-panel">
      <div class="form-header" style=" margin: 50px;">
        <button
          class="tab-btn active"
          style="font-size: 20px; border-radius: 10px;"
        >
          E-Sports
        </button>
      </div>
    </div>

  <div class="reg__wrap">
    <!-- Left: tabs + Phoenix -->
    <aside class="reg__left">
      <div class="tabs">
        <span class="tab tab--gray">Tournament Registrations</span>
        <span class="tab tab--red">Register – now</span>
        <span class="tab tab--gray tab--sm">Single</span>
      </div>

      <figure class="phoenix">
        <img src="{{ asset('./img/Phoenix.png') }}" alt="Phoenix character card">
      </figure>
    </aside>

    <!-- Right: avatar + single-column form -->
    <div class="reg__right">
      <div class="avatar">
        <img src="{{ asset('./img/reg-sinle.png') }}" alt="Player avatar">
      </div>

      <form class="reg-form" action="#" method="post" novalidate>
        <div class="form-row">
          <div class="field">
            <label for="playerName">Player Name</label>
            <input id="playerName" name="playerName" type="text" placeholder="Enter your name">
          </div>

          <div class="field">
            <label for="ingameId">In-Game ID</label>
            <input id="ingameId" name="ingameId" type="text" placeholder="Enter your in-game ID">
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="Enter your email">
          </div>

          <div class="field">
            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" type="tel" placeholder="Enter your phone number">
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label for="age">Player Age</label>
            <input id="age" name="age" type="number" inputmode="numeric" placeholder="Enter your age" min="1">
          </div>
        </div>

        <div class="form-actions">
          <button class="btn-register" type="submit">Register</button>
        </div>
      </form>
    </div>
  </div>
</section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush