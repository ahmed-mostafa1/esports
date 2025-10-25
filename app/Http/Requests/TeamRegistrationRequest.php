<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tournament_card_id' => [
                'required',
                'integer',
                \Illuminate\Validation\Rule::exists('tournament_cards', 'id')->where('status', 'open'),
            ],
            'team_name' => ['required', 'string', 'max:255'],
            'captain_name' => ['required', 'string', 'max:255'],
            'captain_email' => ['required', 'email', 'max:255'],
            'captain_phone' => ['required', 'string', 'max:50'],
            'team_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'captain_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'game_id' => ['nullable', 'string', 'max:255'],
            'members' => ['array'],
            'members.*.name' => ['nullable', 'string', 'max:255'],
            'members.*.ingame_id' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'string', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'members.required' => __('At least one team member is required.'),
            'website.max' => 'Invalid submission.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $members = [];
        $rawMembers = $this->input('members', []);

        foreach ($rawMembers as $index => $member) {
            $name = trim((string) ($member['name'] ?? ''));
            $ingame = trim((string) ($member['ingame_id'] ?? ''));

            $members[$index] = [
                'name' => $name,
                'ingame_id' => $ingame,
            ];
        }

        $this->merge([
            'team_name' => trim((string) $this->input('team_name')),
            'captain_name' => trim((string) $this->input('captain_name')),
            'game_id' => trim((string) $this->input('game_id')),
            'captain_phone' => trim((string) $this->input('captain_phone')),
            'website' => trim((string) $this->input('website')),
            'members' => $members,
        ]);
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $members = collect($this->input('members', []))
                ->filter(fn ($member) => filled($member['name'] ?? null));

            if ($members->isEmpty()) {
                $validator->errors()->add('members', __('At least one team member is required.'));
            }
        });
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $data['members'] = collect($data['members'] ?? [])
            ->filter(fn ($member) => filled($member['name'] ?? null))
            ->map(fn ($member) => [
                'member_name' => $member['name'],
                'member_ingame_id' => $member['ingame_id'] ?? null,
            ])
            ->values()
            ->all();

        unset($data['website']);

        return $data;
    }
}
