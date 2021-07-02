<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemTour extends Model
{
    use HasFactory;

    protected $table = 'vgatour_system_tournament';

    public function listTour()
    {
        return $this->hasMany(Tournament::class,'system_tour_id', 'id');
    }
    // public function listBanner()
    // {
    //     return $this->hasMany(TournamentBanner::class,'tour_id', 'id');
    // }
    
    

}
