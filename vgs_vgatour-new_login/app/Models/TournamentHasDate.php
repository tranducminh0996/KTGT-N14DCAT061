<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentHasDate extends Model
{
    use HasFactory;

    protected $table = 'vgatour_tournament_date';

    protected $fillable = [
        'tournament_id',
        'date'
    ];
}
