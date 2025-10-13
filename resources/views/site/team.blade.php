@extends('layouts.app')

@section('title', 'Teams')

@push('styles')
<link rel="stylesheet" href="{{ asset('./css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('./css/reg-team.css') }}" />
@endpush

@section('content')

<section class="team" aria-labelledby="team-title">
    <h2 style="display: flex; justify-content: center">
        <button
            class="tab-btn active"
            style="
            font-size: 25px;
            padding: 10px 40px;
            margin-bottom: 20px;
            border-radius: 5px !important;
          ">
            Our Team
        </button>
    </h2>

    <!-- edge confetti -->
    <i class="tri tl" aria-hidden="true"></i>
    <i class="tri tr" aria-hidden="true"></i>
    <i class="tri ml" aria-hidden="true"></i>
    <i class="tri mr" aria-hidden="true"></i>

    <!-- Grid -->
    <ul class="team-grid">
        <!-- Card -->
        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image-3.png') }}" alt="Mickdad Abbas" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">Mickdad Abbas</h3>
                <div class="role">Founder</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image 4.png') }}" alt="Wysten Night" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">Wysten&nbsp;&nbsp;Night</h3>
                <div class="role">CEO</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image 5.png') }}" alt="David Lee" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">David Lee</h3>
                <div class="role">CTO</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image 6.png') }}" alt="Sarah Kim" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">Sarah Kim</h3>
                <div class="role">COO</div>
            </figcaption>
        </li>

        <!-- Row 2 (examples) -->
        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image-3.png') }}" alt="David Lee" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">David Lee</h3>
                <div class="role">CTO</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image 4.png') }}" alt="Wysten Night" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">Wysten Night</h3>
                <div class="role">CTO</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image 5.png') }}" alt="Pro Team" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">Pro Team</h3>
                <div class="role">CTO</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ asset('./img/image 6.png') }}" alt="Junior Squad" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">Junior Squad</h3>
                <div class="role">CTO</div>
            </figcaption>
        </li>
    </ul>
</section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush