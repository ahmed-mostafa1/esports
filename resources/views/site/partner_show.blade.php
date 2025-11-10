@extends('layouts.app')

@section('title', __('Our Partners'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/partners.css') }}" />
@endpush

@section('content')

<section class="sp">
  <div class="sp__inner">
    <!-- Badge -->
    <div class="sp__badge">Our Partners</div>

    <div class="sp__row">
      <!-- Left: Rounded image card with bevel + red caption -->
      <figure class="sp-card">
        <img src="img/partner-hero.jpg" alt="Dubai Police Esports Tournament">
        <span class="sp-card__edge" aria-hidden="true"></span>
        <figcaption class="sp-card__caption">Dubai Police Esports Tournament</figcaption>
      </figure>

      <!-- Right: Paragraph + bullet list -->
      <div class="sp__content">
        <p class="sp__lead">
          Organized by: Dubai Police in collaboration with Four04<br>
          The Dubai Police Esports Tournament is a groundbreaking initiative launched to promote digital
          engagement, community wellness, and youth empowerment through competitive gaming. As part of the Dubai
          Police’s commitment to innovation, sport, and positive spirit, this tournament serves as a platform for
          gamers across the UAE to showcase their skills, build teamwork, and connect with like-minded players in a
          safe and encouraging environment.
        </p>

        <p class="sp__kicker">Key Information:</p>
        <ul class="sp__list">
          <li>Organized by: Dubai Police, in partnership with f40four</li>
          <li>Tournament Name: Dubai Police Esports Challenge</li>
          <li>Edition: 4th Edition (if applicable)</li>
          <li>Start Date: [Please confirm the exact date you’d like me to insert here]</li>
          <li>Game Titles: e.g. FIFA, Valorant, Call of Duty, Fortnite</li>
          <li>Participants: Open to UAE residents — students, professionals, and esports enthusiasts</li>
          <li>Format: Online qualifiers leading to live finals at Dubai Police Officers Club or a specified venue</li>
          <li>Prizes: Trophies, gaming gear, and cash prizes for top winners</li>
          <li>Theme: #Be_Responsible — promoting discipline, teamwork, and a healthy approach to gaming</li>
        </ul>

        <p class="sp__kicker">Objectives:</p>
        <ul class="sp__list">
          <li>Support youth talent in digital sports</li>
          <li>Encourage responsible gaming habits</li>
          <li>Promote values of respect, collaboration, and strategic thinking</li>
          <li>Bridge the gap between traditional sports and the growing esports community</li>
        </ul>
      </div>
    </div>

    <!-- Years table-like list -->
    <div class="sp__years">
      <div class="sp-year">
        <div class="sp-year__y">2022</div>
        <div class="sp-year__d">FIFA, Valorant, Call of Duty, Fortnite – 3 days – 150$ K Prizes – 10,000 Players</div>
      </div>
      <div class="sp-year">
        <div class="sp-year__y">2023</div>
        <div class="sp-year__d">FIFA, Valorant, Call of Duty, Fortnite – 4 days – 150$ K Prizes – 10,000 Players</div>
      </div>
      <div class="sp-year">
        <div class="sp-year__y">2024</div>
        <div class="sp-year__d">FIFA, Valorant, Call of Duty, Fortnite – 5 days – 150$ K Prizes – 10,000 Players</div>
      </div>
      <div class="sp-year">
        <div class="sp-year__y">2025</div>
        <div class="sp-year__d">FIFA, Valorant, Call of Duty, Fortnite – 4 days – 150$ K Prizes – 10,000 Players</div>
      </div>
    </div>

    <!-- Bottom nav -->
    <div class="sp__nav">
      <button class="sp-nav sp-nav--prev" aria-label="Previous">‹</button>
      <button class="sp-nav sp-nav--next" aria-label="Next">›</button>
    </div>
  </div>
</section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
