@extends('layouts.app')

@section('title', 'Team Registeration')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('./css/gallery.css') }}" />
@endpush

@section('content')

<section class="reg-team" aria-labelledby="team-esports-title">

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


  <div class="rt-wrap">
    <!-- LEFT: tabs + Phoenix -->
    <aside class="rt-left">
      <div class="tabs">
        <span class="tab tab--gray">Tournament Registrations</span>
        <span class="tab tab--red">Register – now</span>
        <span class="tab tab--gray tab--sm">Team</span>
      </div>

      <figure class="phoenix">
        <img src="{{ asset('./img/Phoenix.png') }}" alt="Phoenix character card">
    </aside>

    <!-- RIGHT: avatar + form -->
    <div class="rt-right">
      <div class="avatar">
        <img src="{{ asset('./img/reg-sinle.png') }}" alt="Team avatar / logo">
      </div>

      <form class="team-form" action="#" method="post" novalidate>
        <!-- Row 1 -->
        <div class="field">
          <label for="teamName">Team Name</label>
          <input id="teamName" name="teamName" type="text" placeholder="Enter  your team name">
        </div>
<div>
  <!-- ! to keep space -->
</div>

        <!-- Row 2 -->
        <div class="field">
         <label for="captainName">Captain's Name</label>
          <input id="captainName" name="captainName" type="text" placeholder="Enter  captain's name">
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
          <input id="captainEmail" name="captainEmail" type="email" placeholder="Enter  captain's email">
        </div>
          <div class="field" style="margin-left: 40px;">
          <label for="teamLogo">Captain's Logo</label>
          <label class="file-field">
            <input id="teamLogo" name="teamLogo" type="file" accept="image/*">
            <span class="file-placeholder">click to upload</span>
          </label>
        </div>


        <div class="field">
          <label for="captainPhone">Captain's Phone</label>
          <input id="captainPhone" name="captainPhone" type="tel" placeholder="Enter  captain's phone">
        </div>
        <div class="field" style="margin-left: 40px;">
          <label for="gameId">Game  -ID</label>
          <input id="gameId" name="gameId" type="text" placeholder="Enter  Game ID">
        </div>

        <!-- Subheading -->
        <div class="full">
          <h3 class="subhead">Team Members</h3>
        </div>

        <!-- Members (2 columns) -->
        <div class="field">
          <label for="m1">Member 1</label>
          <input id="m1" name="m1" type="text" placeholder="Enter  member 1's name">
        </div>
        <div class="field" style="margin-left: 40px;">
          <label for="m2">Member 2</label>
          <input id="m2" name="m2" type="text" placeholder="Enter  member 2's name">
        </div>

        <div class="field">
          <label for="m3">Member 3</label>
          <input id="m3" name="m3" type="text" placeholder="Enter  member 3's name">
        </div>
        <div class="field" style="margin-left: 40px;">
          <label for="m4">Member 4</label>
          <input id="m4" name="m4" type="text" placeholder="Enter  member 4's name">
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
@vite('../../../public/js/script.js')
@endpush