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

      <article class="news-card" style="background:#111827; color:#fff; border-radius:16px; padding:32px; display:flex; flex-direction:column; gap:24px;">
        <header style="display:flex; flex-direction:column; gap:12px;">
          <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
            <h1 class="news-title" style="font-size:28px; font-weight:700;">
              {{ $tournament->titleFor(app()->getLocale()) ?: '' }}
            </h1>
            <span style="background:#1f2937; padding:6px 14px; border-radius:999px; font-size:12px; text-transform:uppercase; letter-spacing:0.08em;">
              {{ strtoupper($tournament->status) }}
            </span>
          </div>
          <div style="display:flex; gap:16px; font-size:14px; color:#9ca3af;">
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
          @php($snapshot = $winner->snapshot ?? [])

          @if(!empty($snapshot['single']))
            <section style="background:#1f2937; padding:24px; border-radius:12px;">
              <h2 style="font-size:20px; font-weight:700; margin-bottom:12px;">
                {{ content('winners.single.label', 'Winner (Single)') }}
              </h2>
              <div style="font-size:16px;">
                <p style="font-weight:600;">{{ $snapshot['single']['player_name'] ?? '' }}</p>
                @if(!empty($snapshot['single']['ingame_id']))
                  <p style="color:#9ca3af;">{{ $snapshot['single']['ingame_id'] }}</p>
                @endif
              </div>
            </section>
          @endif

          @if(!empty($snapshot['team']))
            <section style="background:#1f2937; padding:24px; border-radius:12px;">
              <h2 style="font-size:20px; font-weight:700; margin-bottom:12px;">
                {{ content('winners.team.label', 'Winner (Team)') }}
              </h2>
              <div style="display:flex; flex-direction:column; gap:12px;">
                <div>
                  <p style="font-size:18px; font-weight:600;">{{ $snapshot['team']['team_name'] ?? '' }}</p>
                  @if(!empty($snapshot['team']['captain_name']))
                    <p style="color:#9ca3af; font-size:14px;">{{ __('Captain:') }} {{ $snapshot['team']['captain_name'] }}</p>
                  @endif
                  @if(!empty($snapshot['team']['game_id']))
                    <p style="color:#9ca3af; font-size:14px;">{{ __('Game ID:') }} {{ $snapshot['team']['game_id'] }}</p>
                  @endif
                </div>

                @if(!empty($snapshot['team']['members']))
                  <ul style="list-style:none; padding:0; margin:0; display:grid; gap:8px;">
                    @foreach($snapshot['team']['members'] as $member)
                      <li style="background:#111827; border:1px solid #1f2937; border-radius:8px; padding:10px 12px; font-size:14px;">
                        <strong>{{ $member['member_name'] ?? '' }}</strong>
                        @if(!empty($member['member_ingame_id']))
                          <span style="color:#9ca3af;">({{ $member['member_ingame_id'] }})</span>
                        @endif
                      </li>
                    @endforeach
                  </ul>
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
