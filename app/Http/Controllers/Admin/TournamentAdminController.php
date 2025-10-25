<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\TournamentCard;
use App\Models\SingleRegistration;
use App\Models\TeamRegistration;
use App\Models\Winner;

class TournamentAdminController extends Controller
{
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

    public function finish(TournamentCard $tournament, Request $request)
    {
        if ($tournament->status === 'finished') {
            return back()->withErrors(['status' => __('This tournament has already been marked as finished.')]);
        }

        $data = $request->validate([
            'kind' => ['required', Rule::in(['single', 'team', 'mixed'])],
            'single_registration_id' => ['nullable', 'integer', Rule::exists('single_registrations', 'id')->where('tournament_card_id', $tournament->id)],
            'team_registration_id' => ['nullable', 'integer', Rule::exists('team_registrations', 'id')->where('tournament_card_id', $tournament->id)],
        ]);

        $hasSingle = filled($data['single_registration_id'] ?? null);
        $hasTeam = filled($data['team_registration_id'] ?? null);

        if ($data['kind'] === 'single' && !$hasSingle) {
            return back()->withErrors(['single_registration_id' => __('Please select a single registration winner.')]);
        }

        if ($data['kind'] === 'team' && !$hasTeam) {
            return back()->withErrors(['team_registration_id' => __('Please select a team registration winner.')]);
        }

        if ($data['kind'] === 'mixed' && !($hasSingle || $hasTeam)) {
            return back()->withErrors(['single_registration_id' => __('Select at least one winner.')]);
        }

        DB::transaction(function () use ($data, $tournament, $hasSingle, $hasTeam) {
            $snapshot = [];
            $singleId = null;
            $teamId = null;

            if ($hasSingle) {
                /** @var SingleRegistration $single */
                $single = SingleRegistration::with('tournament')->find($data['single_registration_id']);
                $singleId = $single->id;
                $snapshot['single'] = [
                    'player_name' => $single->player_name,
                    'ingame_id' => $single->ingame_id,
                ];
            }

            if ($hasTeam) {
                /** @var TeamRegistration $team */
                $team = TeamRegistration::with('members')->find($data['team_registration_id']);
                $teamId = $team->id;
                $snapshot['team'] = [
                    'team_name' => $team->team_name,
                    'captain_name' => $team->captain_name,
                    'game_id' => $team->game_id,
                    'team_logo_path' => $team->team_logo_path,
                    'captain_logo_path' => $team->captain_logo_path,
                    'members' => $team->members->map(function ($member) {
                        return [
                            'member_name' => $member->member_name,
                            'member_ingame_id' => $member->member_ingame_id,
                        ];
                    })->values()->all(),
                ];
            }

            Winner::updateOrCreate(
                ['tournament_card_id' => $tournament->id],
                [
                    'kind' => $data['kind'],
                    'single_registration_id' => $singleId,
                    'team_registration_id' => $teamId,
                    'snapshot' => $snapshot,
                ]
            );

            $tournament->update(['status' => 'finished']);
        });

        return redirect()
            ->route('admin.tournaments.show', $tournament)
            ->with('ok', __('Tournament marked as finished.'));
    }
}
