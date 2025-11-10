@extends('layouts.app')

@php($locale = app()->getLocale())
@php($name = $team->textFor($team->name, $locale))
@php($role = $team->textFor($team->role, $locale))
@php($description = trim($team->textFor($team->description, $locale)))
@php($valuesText = trim($team->textFor($team->values, $locale)))
@php($valuesLines = $valuesText !== '' ? array_values(array_filter(array_map('trim', preg_split("/\\r\\n|\\r|\\n/", $valuesText)))) : [])

@section('title', $name ?: __('Team Member'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/team.css') }}" />
@endpush

@section('content')
<section class="team team-show" aria-labelledby="team-member-title">
    <div class="team-head">
        <h2 id="team-member-title" class="pill-red">
            {{ $name }}
        </h2>
    </div>

    <div class="team-show-card">
        @if($team->imageUrl())
            <figure class="team-show-media">
                <img src="{{ $team->imageUrl() }}" alt="{{ $name }}">
            </figure>
        @endif
        <div class="team-show-content">
            @if($role)
                <p class="team-show-role">{{ $role }}</p>
            @endif

            @if($description !== '')
                <div class="team-show-section">
                    <h3>{{ __('Description') }}</h3>
                    <p class="team-show-text">{!! nl2br(e($description)) !!}</p>
                </div>
            @endif

            @if(!empty($valuesLines))
                <div class="team-show-section">
                    <h3>{{ __('Values') }}</h3>
                    <ul class="team-show-list">
                        @foreach($valuesLines as $line)
                            <li>{{ $line }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif($valuesText !== '')
                <div class="team-show-section">
                    <h3>{{ __('Values') }}</h3>
                    <p class="team-show-text">{!! nl2br(e($valuesText)) !!}</p>
                </div>
            @endif

            <a href="{{ route('team') }}" class="read-more-link back-link">
                {{ __('Back to Team') }}
            </a>
        </div>
    </div>
</section>
@endsection
