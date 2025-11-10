<?php

namespace App\Http\Controllers;

use App\Models\Team;

class TeamPublicController extends Controller
{
    public function index()
    {
        $teams = Team::query()
            ->published()
            ->ordered()
            ->get();

        return view('site.team', compact('teams'));
    }

    public function show(Team $team)
    {
        abort_unless($team->is_published, 404);

        return view('site.team_show', compact('team'));
    }
}
