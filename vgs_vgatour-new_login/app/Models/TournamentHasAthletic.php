<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentHasAthletic extends Model
{
    use HasFactory;

    protected $table = 'vgatour_tournament_has_athletic';

    public function athleticScore()
    {
        return $this->hasMany(TournamentHasAthleticScore::class, 'tournament_athletic_id');
    }
}
