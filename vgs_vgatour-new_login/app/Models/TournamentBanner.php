<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentBanner extends Model
{
    use HasFactory;

    protected $table = 'vgatour_tournament_banner';

    protected $fillable = [
        'status'
    ];
}
