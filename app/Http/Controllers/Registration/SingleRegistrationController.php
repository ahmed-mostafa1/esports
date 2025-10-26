<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingleRegistrationRequest;
use App\Models\SingleRegistration;
use App\Models\TournamentCard;
use Illuminate\Http\Request;

class SingleRegistrationController extends Controller
{
    public function create(Request $request)
    {
        $tournaments = TournamentCard::published()
            ->open()
            ->ordered()
            ->get(['id', 'title', 'slug']);

        $selectedTournamentId = $request->query('t');
        if ($selectedTournamentId !== null) {
            $selectedTournamentId = (int) $selectedTournamentId;
            if (! $tournaments->firstWhere('id', $selectedTournamentId)) {
                $selectedTournamentId = null;
            }
        }

        return view('site.reg-single', [
            'tournaments' => $tournaments,
            'selectedTournamentId' => $selectedTournamentId,
        ]);
    }

    public function store(SingleRegistrationRequest $request)
    {
        $data = $request->validated();
        $data['meta'] = [
            'locale' => app()->getLocale(),
            'ip' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 500),
        ];

        SingleRegistration::create($data);

        $message = __('Thank you! Your registration has been received.');

        return redirect()
            ->route('register.single')
            ->with([
                'status' => $message,
                'registration_success' => $message,
            ]);
    }
}
