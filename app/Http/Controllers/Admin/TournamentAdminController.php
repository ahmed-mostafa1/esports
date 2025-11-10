<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use App\Models\TournamentCard;
use App\Models\SingleRegistration;
use App\Models\TeamRegistration;
use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TournamentAdminController extends Controller
{
    public function index()
    {
        $tournaments = TournamentCard::query()
            ->withCount(['singleRegistrations', 'teamRegistrations'])
            ->orderByRaw("FIELD(status, 'open','finished','closed') ASC")
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function bulkDestroy(Request $request)
    {
        $data = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:tournament_cards,id'],
        ]);

        $cards = TournamentCard::whereIn('id', $data['ids'])->get();

        foreach ($cards as $card) {
            $this->removeCardImage($card->image_path);
            $card->delete();
        }

        return redirect()
            ->route('admin.tournaments.index')
            ->with('ok', __('Selected tournaments deleted.'));
    }

    public function open()
    {
        $tournaments = TournamentCard::where('status', 'open')
            ->ordered()
            ->withCount(['singleRegistrations', 'teamRegistrations'])
            ->paginate(20);

        return view('admin.tournaments.open', compact('tournaments'));
    }

    public function show(TournamentCard $tournament)
    {
        $tournament->load([
            'singleRegistrations' => fn ($query) => $query->latest(),
            'teamRegistrations' => fn ($query) => $query->with('members')->latest(),
            'winner',
        ]);

        $singleRegistrations = $tournament->singleRegistrations;
        $teamRegistrations = $tournament->teamRegistrations;
        $winner = $tournament->winner;

        return view('admin.tournaments.show', compact('tournament', 'singleRegistrations', 'teamRegistrations', 'winner'));
    }

    public function export(TournamentCard $tournament)
    {
        $tournament->load([
            'singleRegistrations' => fn ($query) => $query->orderBy('player_name'),
            'teamRegistrations' => fn ($query) => $query->with('members')->orderBy('team_name'),
        ]);

        $tournamentTitle = $tournament->titleFor(app()->getLocale()) ?: $tournament->slug;

        $singleRows = $tournament->singleRegistrations->map(function (SingleRegistration $registration) use ($tournamentTitle) {
            return [
                'tournament' => $tournamentTitle,
                'team_name' => null,
                'player_name' => $registration->player_name,
                'role' => 'Single',
                'ingame_id' => $registration->ingame_id,
                'email' => $registration->email,
                'phone' => $registration->phone,
                'age' => $registration->age,
            ];
        });

        $teamRows = $tournament->teamRegistrations->flatMap(function (TeamRegistration $team) use ($tournamentTitle) {
            $rows = [[
                'tournament' => $tournamentTitle,
                'team_name' => $team->team_name,
                'player_name' => $team->captain_name,
                'role' => 'Captain',
                'ingame_id' => $team->game_id,
                'email' => $team->captain_email,
                'phone' => $team->captain_phone,
                'age' => null,
            ]];

            foreach ($team->members as $member) {
                $rows[] = [
                    'tournament' => $tournamentTitle,
                    'team_name' => $team->team_name,
                    'player_name' => $member->member_name,
                    'role' => 'Member',
                    'ingame_id' => $member->member_ingame_id,
                    'email' => null,
                    'phone' => null,
                    'age' => null,
                ];
            }

            return $rows;
        });

        $allRegistrations = $singleRows->concat($teamRows)->values();

        $content = view('admin.tournaments.export', [
            'tournament' => $tournament,
            'singleRegistrations' => $tournament->singleRegistrations,
            'teamRegistrations' => $tournament->teamRegistrations,
            'allRegistrations' => $allRegistrations,
        ])->render();

        $baseName = $tournament->titleFor(app()->getLocale()) ?: $tournament->slug;
        $filename = 'tournament-' . Str::slug($baseName ?: 'tournament') . '-registrations-' . now()->format('Ymd_His') . '.xls';

        return response($content, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function finish(TournamentCard $tournament, Request $request)
    {
        if ($tournament->status === 'finished') {
            return back()->withErrors(['status' => __('This tournament has already been marked as finished.')]);
        }

        $data = $request->validate([
            'kind' => ['required', Rule::in(['single', 'team', 'mixed'])],
            'single_registration_ids' => ['nullable', 'array'],
            'single_registration_ids.*' => ['integer', Rule::exists('single_registrations', 'id')->where('tournament_card_id', $tournament->id)],
            'team_registration_ids' => ['nullable', 'array'],
            'team_registration_ids.*' => ['integer', Rule::exists('team_registrations', 'id')->where('tournament_card_id', $tournament->id)],
        ]);

        $singleIds = collect($data['single_registration_ids'] ?? [])
            ->filter(fn ($value) => filled($value))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        $teamIds = collect($data['team_registration_ids'] ?? [])
            ->filter(fn ($value) => filled($value))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        $hasSingle = $singleIds->isNotEmpty();
        $hasTeam = $teamIds->isNotEmpty();

        if ($data['kind'] === 'single') {
            if (!$hasSingle) {
                return back()->withErrors(['single_registration_ids' => __('Please select at least one single registration winner.')])->withInput();
            }

            if ($hasTeam) {
                return back()->withErrors(['team_registration_ids' => __('Single winner mode does not accept team selections.')])->withInput();
            }
        }

        if ($data['kind'] === 'team') {
            if (!$hasTeam) {
                return back()->withErrors(['team_registration_ids' => __('Please select at least one team registration winner.')])->withInput();
            }

            if ($hasSingle) {
                return back()->withErrors(['single_registration_ids' => __('Team winner mode does not accept single selections.')])->withInput();
            }
        }

        if ($data['kind'] === 'mixed' && !($hasSingle || $hasTeam)) {
            return back()->withErrors(['single_registration_ids' => __('Select at least one winner.')])->withInput();
        }

        $finalKind = match (true) {
            $hasSingle && $hasTeam => 'mixed',
            $hasSingle => 'single',
            $hasTeam => 'team',
            default => $data['kind'],
        };

        DB::transaction(function () use ($tournament, $singleIds, $teamIds, $hasSingle, $hasTeam, $finalKind) {
            $snapshot = [];

            $singleSnapshots = collect();
            $teamSnapshots = collect();

            if ($hasSingle) {
                $singles = SingleRegistration::where('tournament_card_id', $tournament->id)
                    ->whereIn('id', $singleIds)
                    ->get()
                    ->keyBy('id');

                $singleSnapshots = $singleIds->map(function ($id) use ($singles) {
                    /** @var SingleRegistration $single */
                    $single = $singles->get($id);

                    if (!$single) {
                        return null;
                    }

                    return [
                        'id' => $single->id,
                        'player_name' => $single->player_name,
                        'ingame_id' => $single->ingame_id,
                        'email' => $single->email,
                        'phone' => $single->phone,
                    ];
                })->filter()->values();

                if ($singleSnapshots->isNotEmpty()) {
                    $snapshot['single'] = $singleSnapshots->first();
                    $snapshot['singles'] = $singleSnapshots->all();
                }
            }

            if ($hasTeam) {
                $teams = TeamRegistration::with('members')
                    ->where('tournament_card_id', $tournament->id)
                    ->whereIn('id', $teamIds)
                    ->get()
                    ->keyBy('id');

                $teamSnapshots = $teamIds->map(function ($id) use ($teams) {
                    /** @var TeamRegistration $team */
                    $team = $teams->get($id);

                    if (!$team) {
                        return null;
                    }

                    return [
                        'id' => $team->id,
                        'team_name' => $team->team_name,
                        'captain_name' => $team->captain_name,
                        'game_id' => $team->game_id,
                        'team_logo_path' => $team->team_logo_path,
                        'team_logo_url' => $team->team_logo_url,
                        'captain_logo_path' => $team->captain_logo_path,
                        'captain_logo_url' => $team->captain_logo_url,
                        'members' => $team->members->map(function ($member) {
                            return [
                                'member_name' => $member->member_name,
                                'member_ingame_id' => $member->member_ingame_id,
                            ];
                        })->values()->all(),
                    ];
                })->filter()->values();

                if ($teamSnapshots->isNotEmpty()) {
                    $snapshot['team'] = $teamSnapshots->first();
                    $snapshot['teams'] = $teamSnapshots->all();
                }
            }

            Winner::updateOrCreate(
                ['tournament_card_id' => $tournament->id],
                [
                    'kind' => $finalKind,
                    'single_registration_id' => $singleIds->first(),
                    'team_registration_id' => $teamIds->first(),
                    'snapshot' => $snapshot,
                ]
            );

            $tournament->update(['status' => 'finished']);
        });

        return redirect()
            ->route('admin.tournaments.show', $tournament)
            ->with('ok', __('Tournament marked as finished.'));
    }

    private function removeCardImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);
        if (File::isFile($fullPath)) {
            File::delete($fullPath);
        }
    }
}
