@extends('layouts.app')

@section('title', __('Teams'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/team_show.css') }}" />
@endpush

@section('content')

<section class="team" aria-labelledby="team-title">
    <div class="team-head">
        <h2 id="team-title" class="pill-red">
            {{ content('team.title', 'Our Team') }}
        </h2>
    </div>

   <aside class="profile-card">
      <div class="portrait-wrap">
        <img class="portrait" src="img/profile-mickdad.jpg" alt="Mickdad Abbas" />
        <div class="name-pill">Mickdad Abbas</div>
      </div>

      <div class="left-blurb">
        Focus on esports and community: <br/>
        Publicly, his contributions center entirely on tournament design,
        educational outreach, and positive gaming culture.
      </div>

      <div class="logo-card">
        <!-- Put your white rounded logo here -->
        <img src="img/four04-white-card.png" alt="Four04 logo card" />
      </div>
    </aside>

    <!-- RIGHT COLUMN -->
    <section class="content" aria-label="Story">
      <!-- Block 1 -->
      <div class="block">
        <div class="ribbon">
          <!-- gamepad icon -->
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 7h12a4 4 0 0 1 3.9 4.9l-1 3.9a3.5 3.5 0 0 1-6.8.1L14 15h-4l-.1 1.8a3.5 3.5 0 0 1-6.8-.1l-1-3.9A4 4 0 0 1 6 7zm3 3H7v2H5v2h2v2h2v-2h2v-2H9v-2zm6.75 1.5a1.25 1.25 0 1 0 0 2.5 1.25 1.25 0 0 0 0-2.5zm2.5 2a1.25 1.25 0 1 0 0-2.5 1.25 1.25 0 0 0 0 2.5z"/></svg>
          From Passion to Purpose: The Story of Mickdad Abbas
        </div>
        <div class="text-block">
          Born and raised with a deep love for gaming, Mickdad “Mickdad” Abbas transformed his
          childhood passion into a pioneering force in the UAE’s esports scene. Driven by the mantra,
          “If you love what you’re doing, you’ll never age in your life,” he co-founded Four04 Esports
          with a mission to nurture local talent and foster a responsible, vibrant gaming culture
          <span class="text-muted">dubaipolice.gov.ae</span>
        </div>
      </div>

      <!-- Block 2 -->
      <div class="block section-gap">
        <div class="ribbon">
          <!-- globe icon -->
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm7.7 9h-3.1a15.7 15.7 0 0 0-1.5-6 8 8 0 0 1 4.6 6zM12 4c.8 1.1 2.3 3.9 2.6 7H9.4c.3-3.1 1.8-5.9 2.6-7zM8.9 5a15.7 15.7 0 0 0-1.5 6H4.3a8 8 0 0 1 4.6-6zM4.3 13h3.1c.2 2.2.9 4.4 1.5 6a8 8 0 0 1-4.6-6zm5.1 0h5.2c-.3 3.1-1.8 5.9-2.6 7-.8-1.1-2.3-3.9-2.6-7zm5 6a15.7 15.7 0 0 0 1.5-6h3.1a8 8 0 0 1-4.6 6z"/></svg>
          Vision for the Future
        </div>
        <div class="text-block">
          Mickdad sees Four04 Esports not merely as an event organizer, but as a catalyst for responsible
          gaming and community cohesion. Through thoughtful tournament design, educational outreach,
          and collaboration with civic bodies like Dubai Police, he champions an ecosystem where talent
          thrives, safety is prioritized, and digital culture evolves positively.
        </div>
      </div>

      <!-- Block 3 -->
      <div class="block section-gap">
        <div class="ribbon">
          <!-- medallion/award icon -->
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a5 5 0 0 0-5 5c0 2.8 2.2 5 5 5s5-2.2 5-5-2.2-5-5-5zm-1.3 12.2-4.4 6.6 3.9-1 2.1 3.2 2.1-3.2 3.9 1-4.4-6.6a7 7 0 0 1-3.2 0z"/></svg>
          Making an Impact with Dubai Police
        </div>
        <div class="text-block">
          In a landmark partnership, Mickdad collaborated with Dubai Police to co-manage the Dubai
          Police Esports Tournament. As the official operator of the fourth edition (December 20–22, 2024),
          hosted at the Dubai Police Officers Club, he helped curate a premier event featuring six major
          game titles—including Valorant, CS2, Fortnite, EA FC25, Mobile Legends, and Tekken.
        </div>
      </div>
      </section>
</section>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
