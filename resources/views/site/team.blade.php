@extends('layouts.app')

@section('title', __('Teams'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/team.css') }}" />
@endpush

@section('content')

<section class="team" aria-labelledby="team-title">
    <div class="team-head">
        <h2 id="team-title" class="pill-red">
            {{ content('team.title', 'Our Team') }}
        </h2>
    </div>

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
                <img src="{{ content_media('team.member1.image', 'img/image-3.png') }}" alt="{{ content('team.member1.name', 'Mickdad Abbas') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member1.name', 'Mickdad Abbas') }}</h3>
                <div class="role">{{ content('team.member1.role', 'Founder') }}</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member2.image', 'img/image 4.png') }}" alt="{{ content('team.member2.name', 'Wysten Night') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member2.name', 'Wysten Night') }}</h3>
                <div class="role">{{ content('team.member2.role', 'CEO') }}</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member3.image', 'img/image 5.png') }}" alt="{{ content('team.member3.name', 'David Lee') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member3.name', 'David Lee') }}</h3>
                <div class="role">{{ content('team.member3.role', 'CTO') }}</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member4.image', 'img/image 6.png') }}" alt="{{ content('team.member4.name', 'Sarah Kim') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member4.name', 'Sarah Kim') }}</h3>
                <div class="role">{{ content('team.member4.role', 'COO') }}</div>
            </figcaption>
        </li>

        <!-- Row 2 -->
        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member3.image', 'img/image-3.png') }}" alt="{{ content('team.member3.name', 'David Lee') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member3.name', 'David Lee') }}</h3>
                <div class="role">{{ content('team.member3.role', 'CTO') }}</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member2.image', 'img/image 4.png') }}" alt="{{ content('team.member2.name', 'Wysten Night') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member2.name', 'Wysten Night') }}</h3>
                <div class="role">{{ content('team.member2.role', 'CEO') }}</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member5.image', 'img/image 5.png') }}" alt="{{ content('team.member5.name', 'Pro Team') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member5.name', 'Pro Team') }}</h3>
                <div class="role">{{ content('team.member5.role', 'Lead Developer') }}</div>
            </figcaption>
        </li>

        <li class="member">
            <figure class="avatar">
                <img src="{{ content_media('team.member6.image', 'img/image 6.png') }}" alt="{{ content('team.member6.name', 'Junior Squad') }}" />
            </figure>
            <figcaption class="meta">
                <h3 class="name">{{ content('team.member6.name', 'Junior Squad') }}</h3>
                <div class="role">{{ content('team.member6.role', 'Junior Developer') }}</div>
            </figcaption>
        </li>
    </ul>
</section>


@endsection
@push('scripts')
@vite('../../../public/js/script.js')
@endpush
