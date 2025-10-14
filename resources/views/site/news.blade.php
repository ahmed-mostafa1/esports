@extends('layouts.app')

@section('title', 'News')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endpush

@section('content')


    <h2 style="display: flex;
  justify-content: center;">
<button class="tab-btn active" style="font-size: 25px; padding: 10px 40px; border-radius: 5px !important;">E-Sports</button>
</h2>

    <!-- Our News Section -->
  <section class="our-news-section">
        <h2 style="display: flex;
  justify-content: start;">
<button class="secondary-btn" style="font-size: 25px; padding: 10px 40px; border-radius: 5px !important;">Our News</button>
</h2>

    <div class="news-container">
      <!-- News Card 1 -->
      <div class="news-card">
        <div class="news-content">
          <p class="news-date">July 10, 2024</p>
          <h3 class="news-title">Movie Night Under the Stars</h3>
          <p class="news-desc">
            Join us for a movie night under the stars at the Community Center.
            We'll be screening a family-friendly film, so bring your blankets and snacks.
          </p>
        </div>
        <img src="{{ asset('./img/our-news-page4.png') }}" alt="Movie Night" />
      </div>

      <!-- News Card 2 -->
      <div class="news-card">
        <div class="news-content">
          <p class="news-date">August 5, 2024</p>
          <h3 class="news-title">Back to School Supply Drive</h3>
          <p class="news-desc">
            Help us support local students by donating school supplies at our annual drive.
            Drop off your donations at the Community Center.
          </p>
        </div>
        <img src="{{ asset('./img/our-news-page.png') }}" alt="School Supply" />
      </div>

      <!-- News Card 3 -->
      <div class="news-card">
        <div class="news-content">
          <p class="news-date">June 22, 2024</p>
          <h3 class="news-title">Summer Picnic</h3>
          <p class="news-desc">
            Enjoy a fun-filled summer picnic with your neighbors at Lakeside Park.
            Bring your favorite dish to share and enjoy games, music, and good company.
          </p>
        </div>
        <img src="{{ asset('./img/our-news-page2.png') }}" alt="Picnic" />
      </div>

      <!-- News Card 4 -->
      <div class="news-card">
        <div class="news-content">
          <p class="news-date">May 15, 2024</p>
          <h3 class="news-title">Community Cleanup</h3>
          <p class="news-desc">
            Join us for a community cleanup event at Central Park. We’ll be picking up litter,
            planting flowers, and making our park beautiful for everyone.
          </p>
        </div>
        <img src="{{ asset('./img/our-news-page3.png') }}" alt="Cleanup" />
      </div>

    </div>

    <!-- Pagination -->
    <div class="pagination">
      <div class="dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
      <div class="arrows">
        <button class="arrow">&lt;</button>
        <button class="arrow">&gt;</button>
      </div>
    </div>
  </section>

@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush