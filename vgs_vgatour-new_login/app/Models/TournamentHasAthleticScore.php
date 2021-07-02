<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentHasAthleticScore extends Model
{
    use HasFactory;

    protected $table = 'vgatour_tournament_has_athletic_score';

    public function scoreHole()
    {
        return $this->hasMany(AthleticScoreHole::class, 'athletic_score_id');
    }
}
