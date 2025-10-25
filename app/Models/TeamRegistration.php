<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamRegistration extends Model
{
    protected $fillable = [
        'tournament_card_id',
        'team_name',
        'captain_name',
        'captain_email',
        'captain_phone',
        'team_logo_path',
        'captain_logo_path',
        'game_id',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(TournamentCard::class, 'tournament_card_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class)->orderBy('id');
    }
}
