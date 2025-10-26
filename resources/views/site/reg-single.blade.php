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

      @if(session('status'))
        <div class="alert success">
          {{ session('status') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert error">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="reg-form" action="{{ route('register.single.store') }}" method="post" novalidate>
        @csrf
        <input type="text" name="website" value="" style="display:none;">

        <div class="form-row">
          <div class="field">
            <label for="tournamentId">{{ content('single_registration.form.tournament', 'Choose Tournament') }}</label>
            @php($selectedTournament = old('tournament_card_id', $selectedTournamentId ?? null))
            <select id="tournamentId" name="tournament_card_id" required>
              <option value="">{{ content('single_registration.form.tournament_placeholder', 'Select...') }}</option>
              @foreach($tournaments as $tournament)
                @php($title = $tournament->title[app()->getLocale()] ?? $tournament->title['en'] ?? __('Tournament'))
                <option value="{{ $tournament->id }}" {{ (int) $selectedTournament === $tournament->id ? 'selected' : '' }}>
                  {{ $title }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label for="playerName">Player Name</label>
            <input id="playerName" name="player_name" type="text" placeholder="Enter your name" value="{{ old('player_name') }}" required>
          </div>

          <div class="field">
            <label for="ingameId">In-Game ID</label>
            <input id="ingameId" name="ingame_id" type="text" placeholder="Enter your in-game ID" value="{{ old('ingame_id') }}" required>
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="Enter your email" value="{{ old('email') }}">
          </div>

          <div class="field">
            <label for="phone">Phone Number</label>
            <input id="phone" name="phone" type="tel" placeholder="Enter your phone number" value="{{ old('phone') }}">
          </div>
        </div>

        <div class="form-row">
          <div class="field">
            <label for="age">Player Age</label>
            <input id="age" name="age" type="number" inputmode="numeric" placeholder="Enter your age" min="1" value="{{ old('age') }}">
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
