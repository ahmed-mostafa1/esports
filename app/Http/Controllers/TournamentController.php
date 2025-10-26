<?php

namespace App\Http\Controllers;

use App\Models\TournamentCard;

class TournamentController extends Controller
{
    public function register(TournamentCard $tournament)
    {
        if ($tournament->status === 'finished') {
            return redirect()->route('winners.show', $tournament->slug);
        }

        return view('site.tournament-reg', compact('tournament'));
    }
}

