@extends('admin.layout')

@section('title', 'Tournament Overview')

@section('content')
<div class="px-6 py-4 space-y-6">
  <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
    <div>
      <h1 class="text-2xl font-semibold text-white">{{ $tournament->titleFor(app()->getLocale()) ?: 'Tournament' }}</h1>
      <div class="flex items-center gap-3 text-sm text-gray-400 mt-1">
        <span class="inline-flex items-center gap-2 px-2 py-1 bg-neutral-800 text-gray-200 rounded">
          <span class="w-2 h-2 rounded-full {{ $tournament->status === 'finished' ? 'bg-emerald-400' : 'bg-yellow-400' }}"></span>
          {{ ucfirst($tournament->status) }}
        </span>
        <span>{{ $tournament->date?->format('d/m/Y') ?? '--' }}</span>
        <span>{{ $tournament->time ?: '--' }}</span>
      </div>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('admin.tournaments.open') }}" class="px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-gray-200 rounded transition">
        Back to Open List
      </a>
      <a href="{{ route('admin.tournament-cards.edit', $tournament) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
        Edit Card
      </a>
    </div>
  </div>

  @if(session('ok'))
    <div class="px-4 py-3 bg-green-900/30 border border-green-700 text-green-200 rounded">
      {{ session('ok') }}
    </div>
  @endif

  @if($errors->any())
    <div class="px-4 py-3 bg-red-900/30 border border-red-700 text-red-200 rounded">
      <ul class="list-disc list-inside space-y-1 text-sm">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="col-span-1 bg-neutral-900 border border-neutral-800 rounded p-5 space-y-4">
      <div>
        <h2 class="text-lg font-semibold text-white mb-2">Tournament Details</h2>
        <dl class="space-y-2 text-sm text-gray-300">
          <div class="flex justify-between">
            <dt class="text-gray-400">Prize</dt>
            <dd>{{ $tournament->prize ?: '--' }}</dd>
          </div>
          <div class="flex justify-between">
            <dt class="text-gray-400">Singles</dt>
            <dd>{{ $singleRegistrations->count() }}</dd>
          </div>
          <div class="flex justify-between">
            <dt class="text-gray-400">Teams</dt>
            <dd>{{ $teamRegistrations->count() }}</dd>
          </div>
        </dl>
      </div>

      <div>
        <h2 class="text-lg font-semibold text-white mb-2">Winner Snapshot</h2>
        @if($winner)
          @php($snap = $winner->snapshot ?? [])
          <div class="space-y-3 text-sm text-gray-300">
            <div>
              <span class="text-gray-400 uppercase text-xs">Kind</span>
              <div class="font-semibold text-white">{{ ucfirst($winner->kind) }}</div>
            </div>
            @if(!empty($snap['single']))
              <div class="bg-neutral-800 rounded p-3">
                <div class="text-xs text-gray-400 uppercase mb-1">Single Winner</div>
                <div class="font-semibold">{{ $snap['single']['player_name'] ?? '' }}</div>
                @if(!empty($snap['single']['ingame_id']))
                  <div class="text-gray-400 text-xs">{{ $snap['single']['ingame_id'] }}</div>
                @endif
              </div>
            @endif
            @if(!empty($snap['team']))
              <div class="bg-neutral-800 rounded p-3 space-y-2">
                <div class="text-xs text-gray-400 uppercase mb-1">Team Winner</div>
                <div class="font-semibold">{{ $snap['team']['team_name'] ?? '' }}</div>
                @if(!empty($snap['team']['captain_name']))
                  <div class="text-gray-400 text-xs">Captain: {{ $snap['team']['captain_name'] }}</div>
                @endif
                @if(!empty($snap['team']['members']))
                  <ul class="text-xs text-gray-300 space-y-1">
                    @foreach($snap['team']['members'] as $member)
                      <li>{{ $member['member_name'] ?? '' }} <span class="text-gray-500">{{ $member['member_ingame_id'] ?? '' }}</span></li>
                    @endforeach
                  </ul>
                @endif
              </div>
            @endif
          </div>
        @else
          <p class="text-gray-400 text-sm">No winner selected yet.</p>
        @endif
      </div>
    </div>

    <div class="col-span-1 lg:col-span-2 space-y-6">
      @if($tournament->status !== 'finished')
        <div class="bg-neutral-900 border border-neutral-800 rounded p-5">
          <h2 class="text-lg font-semibold text-white mb-4">Mark Tournament as Finished</h2>
          @php($selectedKind = old('kind', 'single'))
          <form action="{{ route('admin.tournaments.finish', $tournament) }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div class="col-span-1 md:col-span-1">
                <label class="block text-sm text-gray-300 mb-1">Winner Type</label>
                <select name="kind" class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2">
                  @foreach(['single' => 'Single', 'team' => 'Team', 'mixed' => 'Mixed'] as $value => $label)
                    <option value="{{ $value }}" {{ $selectedKind === $value ? 'selected' : '' }}>{{ $label }}</option>
                  @endforeach
                </select>
              </div>
              <div>
                <label class="block text-sm text-gray-300 mb-1">Single Registration</label>
                <select name="single_registration_id" class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2">
                  <option value="">-- Select --</option>
                  @foreach($singleRegistrations as $registration)
                    <option value="{{ $registration->id }}" {{ old('single_registration_id') == $registration->id ? 'selected' : '' }}>
                      {{ $registration->player_name }} ({{ $registration->ingame_id }})
                    </option>
                  @endforeach
                </select>
              </div>
              <div>
                <label class="block text-sm text-gray-300 mb-1">Team Registration</label>
                <select name="team_registration_id" class="w-full bg-neutral-800 text-gray-200 rounded px-3 py-2">
                  <option value="">-- Select --</option>
                  @foreach($teamRegistrations as $registration)
                    <option value="{{ $registration->id }}" {{ old('team_registration_id') == $registration->id ? 'selected' : '' }}>
                      {{ $registration->team_name }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <p class="text-xs text-gray-500">Choose at least one winner entry. Mixed allows selecting both a single player and a team.</p>
            <div class="flex justify-end">
              <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded transition">
                Finish Tournament
              </button>
            </div>
          </form>
        </div>
      @endif

      <div class="bg-neutral-900 border border-neutral-800 rounded p-5">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-white">Single Registrations</h2>
          <span class="text-xs text-gray-400">{{ $singleRegistrations->count() }} entries</span>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-neutral-800 text-sm">
            <thead class="bg-neutral-900 text-gray-300 uppercase tracking-wide text-xs">
              <tr>
                <th class="px-3 py-2 text-left">Player</th>
                <th class="px-3 py-2 text-left">In-Game ID</th>
                <th class="px-3 py-2 text-left">Email</th>
                <th class="px-3 py-2 text-left">Phone</th>
                <th class="px-3 py-2 text-left">Age</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800">
              @forelse($singleRegistrations as $registration)
                <tr class="bg-neutral-900/40">
                  <td class="px-3 py-2 text-gray-200">{{ $registration->player_name }}</td>
                  <td class="px-3 py-2 text-gray-300">{{ $registration->ingame_id }}</td>
                  <td class="px-3 py-2 text-gray-400">{{ $registration->email ?: '—' }}</td>
                  <td class="px-3 py-2 text-gray-400">{{ $registration->phone ?: '—' }}</td>
                  <td class="px-3 py-2 text-gray-400">{{ $registration->age ?: '—' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-3 py-6 text-center text-gray-400">No single registrations yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="bg-neutral-900 border border-neutral-800 rounded p-5">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold text-white">Team Registrations</h2>
          <span class="text-xs text-gray-400">{{ $teamRegistrations->count() }} entries</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @forelse($teamRegistrations as $team)
            <article class="bg-neutral-900/40 border border-neutral-800 rounded p-4 space-y-2">
              <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">{{ $team->team_name }}</h3>
                <span class="text-xs text-gray-400">{{ $team->game_id ?: 'N/A' }}</span>
              </div>
              <div class="text-sm text-gray-300">
                <div>Captain: {{ $team->captain_name }}</div>
                <div class="text-gray-400 text-xs">Email: {{ $team->captain_email ?: '—' }}</div>
                <div class="text-gray-400 text-xs">Phone: {{ $team->captain_phone ?: '—' }}</div>
              </div>
              @if($team->members->isNotEmpty())
                <div class="pt-2 text-sm text-gray-300">
                  <div class="text-xs uppercase text-gray-500 mb-1">Members</div>
                  <ul class="space-y-1 text-xs text-gray-300">
                    @foreach($team->members as $member)
                      <li>{{ $member->member_name }} <span class="text-gray-500">{{ $member->member_ingame_id }}</span></li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </article>
          @empty
            <p class="col-span-full text-center text-gray-400 py-6">No team registrations yet.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
