@extends('layouts.app')

@section('title', 'Team Registeration')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/reg-team.css') }}" />
@endpush

@section('content')

<section class="reg-team" aria-labelledby="team-esports-title">

    <div class="right-panel">
      <div class="form-header" style=" margin: 50px;">
        <button
          class="tab-btn active"
          style="font-size: 20px; border-radius: 10px;"
        >
          {{ content('team_registration.header.title', 'E-Sports') }}
        </button>
      </div>
    </div>


  <div class="rt-wrap">
    <!-- LEFT: tabs + Phoenix -->
    <aside class="rt-left">
      <div class="tabs">
        <span class="tab tab--gray">{{ content('team_registration.tabs.tournament', 'Tournament Registrations') }}</span>
        <span class="tab tab--red">{{ content('team_registration.tabs.register', 'Register – now') }}</span>
        <span class="tab tab--gray tab--sm">{{ content('team_registration.tabs.team', 'Team') }}</span>
      </div>

      <figure class="phoenix">
        <img src="{{ content_media('team_registration.phoenix_image', 'img/Phoenix.png') }}" alt="Phoenix character card">
      </figure>
    </aside>

    <!-- RIGHT: avatar + form -->
    <div class="rt-right">
      

      @if(session('status') && ! session('registration_success'))
        <div class="alert success">
          {{ session('status') }}
        </div>
      @endif

      @include('components.registration-success-modal', ['redirectUrl' => route('home')])

      @if($errors->any())
        <div class="alert error">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="team-form" action="{{ route('register.team.store') }}" method="post" enctype="multipart/form-data" novalidate="">
        @csrf
        @php($stickyGameId = old('tournament_game_id', $selectedGameId ?? null))
        <input type="hidden" name="tournament_game_id" value="{{ $stickyGameId }}">

        <div class="field">
          <label for="tournamentCard">{{ content('team_registration.form.tournament', __('Choose Tournament')) }}</label>
          @php($selectedTournament = old('tournament_card_id', $selectedTournamentId ?? $tournaments->first()->id ?? null))
          <select id="tournamentCard" name="tournament_card_id" required>
            <option value="">{{ content('team_registration.form.tournament_placeholder', __('Select...')) }}</option>
            @foreach($tournaments as $tournament)
              @php($title = $tournament->title[app()->getLocale()] ?? $tournament->title['en'] ?? __('Tournament'))
              <option value="{{ $tournament->id }}" {{ (int) $selectedTournament === $tournament->id ? 'selected' : '' }}>
                {{ $title }}
              </option>
            @endforeach
          </select>
        </div>
<div>
  <!-- ! to keep space -->
</div>

        @if($tournaments->isEmpty())
          <div class="field" style="grid-column: span 2;">
            <div class="alert info">
              {{ __('No tournaments are open for team registrations right now.') }}
            </div>
          </div>
        @endif

        @if(($selectedGame ?? null) || $stickyGameId)
          @php($gameName = ($selectedGame ?? null)?->titleFor(app()->getLocale()) ?? '')
          <div class="field" style="grid-column: span 2;">
            <div class="alert info">
              {{ $gameName ?: __('You are registering for a selected game slot.') }}
            </div>
          </div>
        @endif

        <!-- Row 1 -->
        <div class="field">
          <label for="teamName">Team Name</label>
          <input id="teamName" name="teamName" type="text" placeholder="Enter  your team name" value="{{ old('teamName') }}">
        </div>
<div>
  <!-- ! to keep space -->
</div>

        <!-- Row 2 -->
        <div class="field">
         <label for="captainName">Captain's Name</label>
          <input id="captainName" name="captainName" type="text" placeholder="Enter  captain's name" value="{{ old('captainName') }}">
        </div>
          <div class="field" style="margin-left: 40px;">
          <label for="captainLogo">Captain's Logo</label>
          <label class="file-field">
            <input id="captainLogo" name="captainLogo" type="file" accept="image/*">
            <span class="file-placeholder">click to upload</span>
          </label>
        </div>
        <!-- Row 3 -->
        <div class="field">
          <label for="captainEmail">Captain's Email</label>
          <input id="captainEmail" name="captainEmail" type="email" placeholder="Enter  captain's email" value="{{ old('captainEmail') }}">
        </div>
          <div class="field" style="margin-left: 40px;">
          <label for="teamLogo">Team's Logo</label>
          <label class="file-field">
            <input id="teamLogo" name="teamLogo" type="file" accept="image/*">
            <span class="file-placeholder">click to upload</span>
          </label>
        </div>


        <div class="field">
          <label for="captainPhone">Captain's Phone</label>
          <input id="captainPhone" name="captainPhone" type="tel" placeholder="Enter  captain's phone" value="{{ old('captainPhone') }}">
        </div>
        <div class="field" style="margin-left: 40px;">
          <label for="gameId">Game  -ID</label>
          <input id="gameId" name="gameId" type="text" placeholder="Enter  Game ID" value="{{ old('gameId') }}">
        </div>

        <!-- Subheading -->
        <div class="full">
          <h3 class="subhead">Team Members</h3>
        </div>

        <!-- Members (2 columns) -->
        <div class="field">
          <label for="m1">Member 1</label>
          <input id="m1" name="m1" type="text" placeholder="Enter  member 1's name" value="{{ old('m1') }}">
        </div>
        <div class="field" style="margin-left: 40px;">
          <label for="m2">Member 2</label>
          <input id="m2" name="m2" type="text" placeholder="Enter  member 2's name" value="{{ old('m2') }}">
        </div>

        <div class="field">
          <label for="m3">Member 3</label>
          <input id="m3" name="m3" type="text" placeholder="Enter  member 3's name" value="{{ old('m3') }}">
        </div>
        <div class="field" style="margin-left: 40px;">
          <label for="m4">Member 4</label>
          <input id="m4" name="m4" type="text" placeholder="Enter  member 4's name" value="{{ old('m4') }}">
        </div>

        <!-- CTA -->
        <div class="full actions">
          <button class="btn-register" type="submit">Register Team</button>
        </div>
      </form>
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var tournamentSelect = document.getElementById('tournamentCard');
  var gameInput = document.querySelector('input[name="tournament_game_id"]');
  if (tournamentSelect && gameInput) {
    tournamentSelect.addEventListener('change', function () {
      gameInput.value = '';
    });
  }
});
</script>
@endpush
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
