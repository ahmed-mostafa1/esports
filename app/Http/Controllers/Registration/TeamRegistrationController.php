<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRegistrationRequest;
use App\Models\TeamRegistration;
use App\Models\TournamentCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeamRegistrationController extends Controller
{
    public function create()
    {
        $tournaments = TournamentCard::published()
            ->open()
            ->ordered()
            ->get(['id', 'title', 'slug']);

        return view('site.reg-team', compact('tournaments'));
    }

    public function store(TeamRegistrationRequest $request)
    {
        $data = $request->validated();
        $members = $data['members'];
        unset($data['members']);
        unset($data['team_logo'], $data['captain_logo']);

        DB::transaction(function () use ($request, &$data, $members) {
            if ($request->hasFile('team_logo')) {
                $data['team_logo_path'] = $this->storeLogo($request->file('team_logo'));
            }

            if ($request->hasFile('captain_logo')) {
                $data['captain_logo_path'] = $this->storeLogo($request->file('captain_logo'));
            }

            $data['meta'] = [
                'locale' => app()->getLocale(),
                'ip' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
            ];

            $team = TeamRegistration::create($data);

            foreach ($members as $member) {
                $team->members()->create($member);
            }
        });

        return redirect()
            ->route('register.team')
            ->with('status', __('Thank you! Your team registration has been received.'));
    }

    private function storeLogo($file): string
    {
        $path = $file->store('content-images/teams', 'public');

        return 'storage/' . ltrim($path, '/');
    }
}
