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

      <form class="team-form" action="#" method="post" novalidate>
        <!-- Team Name -->
        <div class="form-row">
          <div class="field full-width">
            <label for="teamName">{{ content('team_registration.form.team_name', 'Team Name') }}</label>
            <input id="teamName" name="teamName" type="text" placeholder="{{ content('team_registration.form.team_name_placeholder', 'Enter your team name') }}">
          </div>
        </div>

        <!-- Captain Info Row 1 -->
        <div class="form-row">
          <div class="field">
            <label for="captainName">{{ content('team_registration.form.captain_name', 'Captain\'s Name') }}</label>
            <input id="captainName" name="captainName" type="text" placeholder="{{ content('team_registration.form.captain_name_placeholder', 'Enter captain\'s name') }}">
          </div>
          <div class="field">
            <label for="captainLogo">{{ content('team_registration.form.captain_logo', 'Captain\'s Logo') }}</label>
            <label class="file-field">
              <input id="captainLogo" name="captainLogo" type="file" accept="image/*">
              <span class="file-placeholder">{{ content('team_registration.form.upload_placeholder', 'Click to upload') }}</span>
            </label>
          </div>
        </div>

        <!-- Captain Info Row 2 -->
        <div class="form-row">
          <div class="field">
            <label for="captainEmail">{{ content('team_registration.form.captain_email', 'Captain\'s Email') }}</label>
            <input id="captainEmail" name="captainEmail" type="email" placeholder="{{ content('team_registration.form.captain_email_placeholder', 'Enter captain\'s email') }}">
          </div>
          <div class="field">
            <label for="teamLogo">{{ content('team_registration.form.team_logo', 'Team Logo') }}</label>
            <label class="file-field">
              <input id="teamLogo" name="teamLogo" type="file" accept="image/*">
              <span class="file-placeholder">{{ content('team_registration.form.upload_placeholder', 'Click to upload') }}</span>
            </label>
          </div>
        </div>

        <!-- Captain Info Row 3 -->
        <div class="form-row">
          <div class="field">
            <label for="captainPhone">{{ content('team_registration.form.captain_phone', 'Captain\'s Phone') }}</label>
            <input id="captainPhone" name="captainPhone" type="tel" placeholder="{{ content('team_registration.form.captain_phone_placeholder', 'Enter captain\'s phone') }}">
          </div>
          <div class="field">
            <label for="gameId">{{ content('team_registration.form.game_id', 'Game ID') }}</label>
            <input id="gameId" name="gameId" type="text" placeholder="{{ content('team_registration.form.game_id_placeholder', 'Enter Game ID') }}">
          </div>
        </div>

        <!-- Team Members Section -->
        <div class="members-section">
          <h3 class="section-title">{{ content('team_registration.form.team_members', 'Team Members') }}</h3>
          
          <div class="form-row">
            <div class="field">
              <label for="m1">{{ content('team_registration.form.member1', 'Member 1') }}</label>
              <input id="m1" name="m1" type="text" placeholder="{{ content('team_registration.form.member1_placeholder', 'Enter member 1\'s name') }}">
            </div>
            <div class="field">
              <label for="m2">{{ content('team_registration.form.member2', 'Member 2') }}</label>
              <input id="m2" name="m2" type="text" placeholder="{{ content('team_registration.form.member2_placeholder', 'Enter member 2\'s name') }}">
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label for="m3">{{ content('team_registration.form.member3', 'Member 3') }}</label>
              <input id="m3" name="m3" type="text" placeholder="{{ content('team_registration.form.member3_placeholder', 'Enter member 3\'s name') }}">
            </div>
            <div class="field">
              <label for="m4">{{ content('team_registration.form.member4', 'Member 4') }}</label>
              <input id="m4" name="m4" type="text" placeholder="{{ content('team_registration.form.member4_placeholder', 'Enter member 4\'s name') }}">
            </div>
          </div>
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