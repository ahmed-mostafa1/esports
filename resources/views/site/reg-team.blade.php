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
      <div class="avatar">
        <img src="{{ content_media('team_registration.avatar_image', 'img/reg-sinle.png') }}" alt="Team avatar / logo">
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

      <form class="team-form" action="{{ route('register.team.store') }}" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="text" name="website" value="" style="display:none;">

        <div class="form-row">
          <div class="field full-width">
            <label for="tournamentId">{{ content('team_registration.form.tournament', 'Choose Tournament') }}</label>
            @php($selectedTournament = old('tournament_card_id', $selectedTournamentId ?? null))
            <select id="tournamentId" name="tournament_card_id" required>
              <option value="">{{ content('team_registration.form.tournament_placeholder', 'Select...') }}</option>
              @foreach($tournaments as $tournament)
                @php($title = $tournament->title[app()->getLocale()] ?? $tournament->title['en'] ?? __('Tournament'))
                <option value="{{ $tournament->id }}" {{ (int) $selectedTournament === $tournament->id ? 'selected' : '' }}>
                  {{ $title }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- Team Name -->
        <div class="form-row">
          <div class="field full-width">
            <label for="teamName">{{ content('team_registration.form.team_name', 'Team Name') }}</label>
            <input id="teamName" name="team_name" type="text" placeholder="{{ content('team_registration.form.team_name_placeholder', 'Enter your team name') }}" value="{{ old('team_name') }}" required>
          </div>
        </div>

        <!-- Captain Info Row 1 -->
        <div class="form-row">
          <div class="field">
            <label for="captainName">{{ content('team_registration.form.captain_name', 'Captain\'s Name') }}</label>
            <input id="captainName" name="captain_name" type="text" placeholder="{{ content('team_registration.form.captain_name_placeholder', 'Enter captain\'s name') }}" value="{{ old('captain_name') }}" required>
          </div>
          <div class="field">
            <label for="captainLogo">{{ content('team_registration.form.captain_logo', 'Captain\'s Logo') }}</label>
            <label class="file-field">
              <input id="captainLogo" name="captain_logo" type="file" accept="image/*">
              <span class="file-placeholder">{{ content('team_registration.form.upload_placeholder', 'Click to upload') }}</span>
            </label>
          </div>
        </div>

        <!-- Captain Info Row 2 -->
        <div class="form-row">
          <div class="field">
            <label for="captainEmail">{{ content('team_registration.form.captain_email', 'Captain\'s Email') }}</label>
            <input id="captainEmail" name="captain_email" type="email" placeholder="{{ content('team_registration.form.captain_email_placeholder', 'Enter captain\'s email') }}" value="{{ old('captain_email') }}" required>
          </div>
          <div class="field">
            <label for="teamLogo">{{ content('team_registration.form.team_logo', 'Team Logo') }}</label>
            <label class="file-field">
              <input id="teamLogo" name="team_logo" type="file" accept="image/*">
              <span class="file-placeholder">{{ content('team_registration.form.upload_placeholder', 'Click to upload') }}</span>
            </label>
          </div>
        </div>

        <!-- Captain Info Row 3 -->
        <div class="form-row">
          <div class="field">
            <label for="captainPhone">{{ content('team_registration.form.captain_phone', 'Captain\'s Phone') }}</label>
            <input id="captainPhone" name="captain_phone" type="tel" placeholder="{{ content('team_registration.form.captain_phone_placeholder', 'Enter captain\'s phone') }}" value="{{ old('captain_phone') }}" required>
          </div>
          <div class="field">
            <label for="gameId">{{ content('team_registration.form.game_id', 'Game ID') }}</label>
            <input id="gameId" name="game_id" type="text" placeholder="{{ content('team_registration.form.game_id_placeholder', 'Enter Game ID') }}" value="{{ old('game_id') }}">
          </div>
        </div>

        <!-- Team Members Section -->
        <div class="members-section">
          <h3 class="section-title">{{ content('team_registration.form.team_members', 'Team Members') }}</h3>
          @php($memberOld = old('members', []))
          @foreach(range(0,3) as $index)
            <div class="form-row">
              <div class="field">
                <label for="member-name-{{ $index }}">{{ __('Member') }} {{ $index + 1 }}</label>
                <input
                  id="member-name-{{ $index }}"
                  name="members[{{ $index }}][name]"
                  type="text"
                  placeholder="{{ content('team_registration.form.member' . ($index + 1), 'Member ' . ($index + 1)) }}"
                  value="{{ $memberOld[$index]['name'] ?? '' }}"
                >
              </div>
              <div class="field">
                <label for="member-id-{{ $index }}">{{ __('In-Game ID') }}</label>
                <input
                  id="member-id-{{ $index }}"
                  name="members[{{ $index }}][ingame_id]"
                  type="text"
                  placeholder="{{ __('Enter in-game ID') }}"
                  value="{{ $memberOld[$index]['ingame_id'] ?? '' }}"
                >
              </div>
            </div>
          @endforeach
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
          <button class="btn-register" type="submit">{{ content('team_registration.form.register_button', 'Register Team') }}</button>
        </div>
      </form>
    </div>
  </div>
</section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
