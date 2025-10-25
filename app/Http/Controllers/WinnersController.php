<?php

namespace App\Http\Controllers;

use App\Models\TournamentCard;

class WinnersController extends Controller
{
    public function show(TournamentCard $tournament)
    {
        if ($tournament->status !== 'finished') {
            abort(404);
        }

        $tournament->load('winner');

        return view('site.winner', [
            'tournament' => $tournament,
            'winner' => $tournament->winner,
        ]);
    }
}
