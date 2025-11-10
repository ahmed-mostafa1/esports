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

        $valueCards = $this->buildValueCards($team);

        return view('site.team_show', [
            'team' => $team,
            'valueCards' => $valueCards,
        ]);
    }

    private function buildValueCards(Team $team): array
    {
        $locale = app()->getLocale();
        $raw = trim($team->textFor($team->values, $locale));

        if ($raw === '') {
            return [];
        }

        $blocks = preg_split("/\n{2,}/", $raw) ?: [];
        $cards = [];

        foreach ($blocks as $block) {
            $block = trim($block);
            if ($block === '') {
                continue;
            }

            $title = null;
            $body = $block;

            if (str_contains($block, '::')) {
                [$title, $body] = array_map('trim', explode('::', $block, 2));
            } elseif (str_contains($block, '||')) {
                [$title, $body] = array_map('trim', explode('||', $block, 2));
            } elseif (str_contains($block, '|')) {
                [$title, $body] = array_map('trim', explode('|', $block, 2));
            }

            $cards[] = [
                'title' => $title,
                'body' => $body,
            ];
        }

        return $cards;
    }
}
