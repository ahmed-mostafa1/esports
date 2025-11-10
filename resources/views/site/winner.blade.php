@extends('layouts.app')

@section('title', $tournament->titleFor(app()->getLocale()) ?: 'Winners')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endpush

@section('content')
  <section class="winner-page" style="padding:40px 0; width:80%; margin:0 auto;">
    <div class="text-center mb-8">
      <button class="tab-btn active" style="font-size: 25px; padding: 10px 40px; border-radius: 5px !important;">
        {{ content('winners.header.main_title', 'E-Sports') }}
      </button>
    </div>

    <div class="container" style=" margin:auto;">
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

        <?php
          $gameWinners = ($gameWinners ?? collect())->filter();
          $hasGameWinners = $gameWinners->isNotEmpty();
          $hasLegacyWinner = ! $hasGameWinners && $winner;
        ?>

        <?php if ($hasGameWinners): ?>
          <section class="w-full space-y-4">
            @foreach($gameWinners as $game)
              <article class="bg-[#1f2937] border border-[#374151] rounded-2xl p-5 space-y-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                  <div>
                    <h2 class="text-xl font-bold text-white">{{ $game->titleFor(app()->getLocale()) ?: __('Game') }}</h2>
                    <p class="text-xs text-gray-400 uppercase tracking-wide">{{ __('Status:') }} {{ strtoupper($game->status) }}</p>
                  </div>
                  <div class="flex items-center gap-2 text-xs text-gray-400">
                    <span>{{ __('Single:') }} {{ $game->allow_single ? __('Yes') : __('No') }}</span>
                    <span>•</span>
                    <span>{{ __('Team:') }} {{ $game->allow_team ? __('Yes') : __('No') }}</span>
                  </div>
                </div>
                <div class="flex flex-wrap gap-2">
                  @foreach($game->winnerEntry->winners as $winnerName)
                    <span class="px-4 py-2 rounded-full bg-[#0f172a] border border-[#1f2937] text-sm font-medium text-white">
                      {{ $winnerName }}
                    </span>
                  @endforeach
                </div>
              </article>
            @endforeach
          </section>
        <?php endif; ?>

        <?php if ($hasLegacyWinner): ?>
          @php
            $snapshot = $winner->snapshot ?? [];
            $singleEntries = collect($snapshot['singles'] ?? []);
            if ($singleEntries->isEmpty() && !empty($snapshot['single'])) {
              $singleEntries = collect([$snapshot['single']]);
            }
            $teamEntries = collect($snapshot['teams'] ?? []);
            if ($teamEntries->isEmpty() && !empty($snapshot['team'])) {
              $teamEntries = collect([$snapshot['team']]);
            }
          @endphp

          @if($singleEntries->isNotEmpty())
            <section style="background:#1f2937; width:80%; padding:24px; border-radius:12px; text-align:center;">
              <h2 style="font-size:20px; font-weight:700; margin-bottom:12px;">
                {{ content('winners.single.label', 'Winner (Single)') }}
              </h2>
              <div style="display:grid; gap:16px;">
                @foreach($singleEntries as $single)
                  <div style="background:#111827; border:1px solid #1f2937; border-radius:12px; padding:18px;">
                    <p style="font-weight:600; font-size:18px;">{{ $single['player_name'] ?? '' }}</p>
                    @if(!empty($single['ingame_id']))
                      <p style="color:#9ca3af; margin-top:8px;">{{ $single['ingame_id'] }}</p>
                    @endif
                  </div>
                @endforeach
              </div>
            </section>
          @endif

          @if($teamEntries->isNotEmpty())
            <section style="background:#1f2937; width:80%; padding:24px; border-radius:12px; width:90%; margin:0 auto; text-align:center;">
              <h2 style="font-size:20px; font-weight:700; margin-bottom:12px;">
                {{ content('winners.team.label', 'Winner (Team)') }}
              </h2>
              <div style="display:grid; gap:20px;">
                @foreach($teamEntries as $team)
                  @php
                    $teamLogoUrl = $team['team_logo_url'] ?? null;
                    $teamLogoUrl = $teamLogoUrl ?: \App\Models\TeamRegistration::logoPathToUrl($team['team_logo_path'] ?? null);
                    $captainLogoUrl = $team['captain_logo_url'] ?? null;
                    $captainLogoUrl = $captainLogoUrl ?: \App\Models\TeamRegistration::logoPathToUrl($team['captain_logo_path'] ?? null);
                  @endphp
                  <article style="background:#111827; border:1px solid #1f2937; border-radius:14px; padding:20px; display:flex; flex-direction:column; gap:18px;">
                    <div style="display:flex; flex-wrap:wrap; gap:16px; align-items:center; justify-content:center;">
                      @if($teamLogoUrl)
                        <div style="width:88px; height:88px; border-radius:18px; overflow:hidden; background:#0f172a;">
                          <img src="{{ $teamLogoUrl }}" alt="{{ $team['team_name'] ?? '' }} logo" style="width:100%; height:100%; object-fit:cover;">
                        </div>
                      @endif
                      <div style="display:flex; flex-direction:column; gap:6px; min-width:200px;">
                        <p style="font-size:20px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em;">
                          {{ $team['team_name'] ?? '' }}
                        </p>
                      </div>
                    </div>
                    <div style="display:flex; gap:12px; flex-wrap:wrap; font-size:13px; color:#9ca3af; justify-content:center;">
                      @if(!empty($team['captain_name']))
                        <span style="display:inline-flex; align-items:center; gap:6px; background:#0f172a; border-radius:999px; padding:6px 14px;">
                          @if($captainLogoUrl)
                            <img src="{{ $captainLogoUrl }}" alt="{{ $team['captain_name'] }} logo" style="width:60px; height:60px; border-radius:50%; object-fit:cover;">
                          @endif
                          <span>{{ __('Captain:') }} {{ $team['captain_name'] }}</span>
                        </span>
                      @endif
                      @if(!empty($team['game_id']))
                        <span style="display:inline-flex; align-items:center; gap:6px; background:#0f172a; border-radius:999px; padding:6px 14px;">
                          <span>{{ __('Game ID:') }} {{ $team['game_id'] }}</span>
                        </span>
                      @endif
                    </div>

                    @if(!empty($team['members']))
                      <div>
                        <p style="font-size:14px; text-transform:uppercase; color:#6b7280; letter-spacing:0.08em; margin-bottom:10px;">
                          {{ __('Team Roster') }}
                        </p>
                        <ul style="list-style:none; padding:0; margin:0; display:grid; gap:8px; text-align:center; max-width:420px; margin-left:auto; margin-right:auto;">
                          @foreach($team['members'] as $member)
                            <li style="background:#0f172a; border:1px solid #1f2937; border-radius:10px; padding:12px 14px; font-size:14px; display:flex; flex-direction:column; justify-content:center; align-items:center; gap:6px;">
                              <span style="font-weight:600; text-transform:uppercase; letter-spacing:0.04em;">{{ $member['member_name'] ?? '' }}</span>
                              @if(!empty($member['member_ingame_id']))
                                <span style="color:#9ca3af; font-size:12px;">{{ $member['member_ingame_id'] }}</span>
                              @endif
                            </li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                  </article>
                @endforeach
              </div>
            </section>
          @endif
        <?php endif; ?>

        <?php if (! $hasGameWinners && ! $hasLegacyWinner): ?>
          <p class="text-gray-400" style="font-size:16px;">
            {{ content('winners.empty', 'Winner will be announced soon.') }}
          </p>
        <?php endif; ?>
      </article>
    </div>
  </section>
@endsection

@push('scripts')
@vite('../../../public/js/script.js')
@endpush
