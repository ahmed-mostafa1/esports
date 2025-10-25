<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SingleRegistration extends Model
{
    protected $fillable = [
        'tournament_card_id',
        'player_name',
        'ingame_id',
        'email',
        'phone',
        'age',
        'meta',
    ];

    protected $casts = [
        'age' => 'integer',
        'meta' => 'array',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(TournamentCard::class, 'tournament_card_id');
    }
}
