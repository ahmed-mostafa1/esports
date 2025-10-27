@extends('layouts.app')

@section('title', $tournament->titleFor(app()->getLocale()) ?: 'Winners')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endpush

@section('content')
  <section class="winner-page" style="padding:40px 0;">
    <div class="text-center mb-8">
      <button class="tab-btn active" style="font-size: 25px; padding: 10px 40px; border-radius: 5px !important;">
        {{ content('winners.header.main_title', 'E-Sports') }}
      </button>
    </div>

    <div class="container" style="max-width:960px; margin:0 auto;">
      <div style="display:flex;justify-content:flex-start;margin-bottom:24px;">
        <button class="secondary-btn" style="font-size: 22px; padding: 10px 30px; border-radius: 5px !important;">
          {{ content('winners.header.section_title', 'Winners') }}
        </button>
      </div>

      <article class="news-card" style="background:#111827; color:#fff; border-radius:16px; padding:32px; display:flex; flex-direction:column; gap:24px; align-items:center; text-align:center;">
        <header style="display:flex; flex-direction:column; gap:12px; align-items:center; width:100%;">
          <div style="display:flex; justify-content:center; align-items:center; flex-wrap:wrap; gap:12px;">
            <h1 class="news-title" style="font-size:28px; font-weight:700;">
              {{ $tournament->titleFor(app()->getLocale()) ?: '' }}
            </h1>
            <span style="background:#1f2937; padding:6px 14px; border-radius:999px; font-size:12px; text-transform:uppercase; letter-spacing:0.08em;">
              {{ strtoupper($tournament->status) }}
            </span>
          </div>
          <div style="display:flex; gap:16px; font-size:14px; color:#9ca3af; justify-content:center; flex-wrap:wrap;">
            <span>{{ $tournament->date?->format('F j, Y') ?? '--' }}</span>
            <span>{{ $tournament->time ?: '--' }}</span>
            <span>{{ $tournament->prize ?: '--' }}</span>
          </div>
        </header>

        @if($tournament->image_path)
          <div style="width:100%; max-height:320px; overflow:hidden; border-radius:12px;">
            <img src="{{ $tournament->imageUrl() }}" alt="{{ $tournament->titleFor(app()->getLocale()) }}" style="width:100%; height:auto; object-fit:cover;">
          </div>
        @endif

        @if($winner)
          @php
            $snapshot = $winner->snapshot ?? [];
          @endphp

          @if(!empty($snapshot['single']))
            <section style="background:#1f2937; padding:24px; border-radius:12px; text-align:center;">
              <h2 style="font-size:20px; font-weight:700; margin-bottom:12px;">
                {{ content('winners.single.label', 'Winner (Single)') }}
              </h2>
              <div style="font-size:16px; display:flex; flex-direction:column; align-items:center;">
                <p style="font-weight:600;">{{ $snapshot['single']['player_name'] ?? '' }}</p>
                @if(!empty($snapshot['single']['ingame_id']))
                  <p style="color:#9ca3af;">{{ $snapshot['single']['ingame_id'] }}</p>
                @endif
              </div>
            </section>
          @endif

          @if(!empty($snapshot['team']))
            @php
              $teamLogoUrl = $snapshot['team']['team_logo_url'] ?? null;
              $teamLogoUrl = $teamLogoUrl ?: \App\Models\TeamRegistration::logoPathToUrl($snapshot['team']['team_logo_path'] ?? null);
              $captainLogoUrl = $snapshot['team']['captain_logo_url'] ?? null;
              $captainLogoUrl = $captainLogoUrl ?: \App\Models\TeamRegistration::logoPathToUrl($snapshot['team']['captain_logo_path'] ?? null);
            @endphp
            <section style="background:#1f2937; padding:24px; border-radius:12px; width:90%; margin:0 auto; text-align:center;">
              <h2 style="font-size:20px; font-weight:700; margin-bottom:12px;">
                {{ content('winners.team.label', 'Winner (Team)') }}
              </h2>
              <div style="display:flex; flex-direction:column; gap:18px; align-items:center;">
                <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:center; justify-content:center;">
                  @if($teamLogoUrl)
                    <div style="width:88px; height:88px; border-radius:18px; overflow:hidden; background:#111827; flex-shrink:0;">
                      <img src="{{ $teamLogoUrl }}" alt="{{ $snapshot['team']['team_name'] ?? '' }} logo" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                  @endif
                  <div style="display:flex; flex-direction:column; gap:6px; min-width:200px;">
                    <p style="font-size:20px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;">
                      {{ $snapshot['team']['team_name'] ?? '' }}
                    </p>
                    </div>
                    <br>
                    <div style="display:flex; gap:12px; flex-wrap:wrap; font-size:13px; color:#9ca3af; justify-content:center;">
                      @if(!empty($snapshot['team']['captain_name']))
                        <span style="display:inline-flex; align-items:center; gap:6px; background:#111827; border-radius:999px; padding:6px 14px;">
                          @if($captainLogoUrl)
                            <img src="{{ $captainLogoUrl }}" alt="{{ $snapshot['team']['captain_name'] }} logo" style="width:60px; height:60px; border-radius:50%; object-fit:cover;">
                          @endif
                          <span>{{ __('Captain:') }} {{ $snapshot['team']['captain_name'] }}</span>
                        </span>
                      @endif
                      @if(!empty($snapshot['team']['game_id']))
                        <span style="display:inline-flex; align-items:center; gap:6px; background:#111827; border-radius:999px; padding:6px 14px;">
                          <span>{{ __('Game ID:') }} {{ $snapshot['team']['game_id'] }}</span>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                @if(!empty($snapshot['team']['members']))
                  <div>
                    <p style="font-size:14px; text-transform:uppercase; color:#6b7280; letter-spacing:0.08em; margin-bottom:10px;">
                      {{ __('Team Roster') }}
                    </p>
                    <ul style="list-style:none; padding:0; margin:0; display:grid; gap:8px; text-align:center; max-width:420px; margin-left:auto; margin-right:auto;">
                    @foreach($snapshot['team']['members'] as $member)
                      <li style="background:#111827; border:1px solid #1f2937; border-radius:10px; padding:12px 14px; font-size:14px; display:flex; flex-direction:column; justify-content:center; align-items:center; gap:6px;">
                        <span style="font-weight:600; text-transform:uppercase; letter-spacing:0.04em;">{{ $member['member_name'] ?? '' }}</span>
                        @if(!empty($member['member_ingame_id']))
                          <span style="color:#9ca3af; font-size:12px;">{{ $member['member_ingame_id'] }}</span>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                  </div>
                @endif
              </div>
            </section>
          @endif
        @else
          <p class="text-gray-400" style="font-size:16px;">
            {{ content('winners.empty', 'Winner will be announced soon.') }}
          </p>
        @endif
      </article>
    </div>
  </section>
@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
