<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function asset;

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

    protected $appends = [
        'team_logo_url',
        'captain_logo_url',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(TournamentCard::class, 'tournament_card_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(TeamMember::class)->orderBy('id');
    }

    public function getTeamLogoUrlAttribute(): ?string
    {
        return static::logoPathToUrl($this->team_logo_path);
    }

    public function getCaptainLogoUrlAttribute(): ?string
    {
        return static::logoPathToUrl($this->captain_logo_path);
    }

    public static function logoPathToUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['storage/', '/storage/'])) {
            return asset(ltrim($path, '/'));
        }

        return Storage::disk('public')->url($path);
    }
}
