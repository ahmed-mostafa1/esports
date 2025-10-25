<?php

namespace App\Http\Controllers\Registration;

use App\Http\Controllers\Controller;
use App\Http\Requests\SingleRegistrationRequest;
use App\Models\SingleRegistration;
use App\Models\TournamentCard;

class SingleRegistrationController extends Controller
{
    public function create()
    {
        $tournaments = TournamentCard::published()
            ->open()
            ->ordered()
            ->get(['id', 'title', 'slug']);

        return view('site.reg-single', compact('tournaments'));
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

        return redirect()
            ->route('register.single')
            ->with('status', __('Thank you! Your registration has been received.'));
    }
}
