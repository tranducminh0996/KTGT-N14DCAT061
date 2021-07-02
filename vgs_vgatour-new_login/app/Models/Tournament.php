<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'vgatour_tournament';
    // public $timestamps = true;

    protected $fillable = [
        'name',
        'facility_id',
        'number_athletic',
        'describe',
        'time',
        'system_tour_id',
        'link_livescore',
        'timer'
    ];

    public function athletics()
    {
        return $this->belongsToMany(Athletic::class, 'vgatour_tournament_has_athletic');
    }

    public static function getList()
    {
        $tour = Tournament::query()->orderBy('time', 'desc')->get();
        return $tour;
    }

    public static function getById($id)
    {
        $tournament = Tournament::findOrFail($id);
        return $tournament;
    }

    public function listDate()
    {
        return $this->hasMany(TournamentHasDate::class, 'tournament_id', 'id');
    }
    public function listBanner()
    {
        return $this->hasMany(TournamentBanner::class,'tour_id', 'id');
    }

}
