<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AthleticTimeline extends Model
{
    use HasFactory;

    protected $table = 'vgatour_athletic_timeline';

    protected $fillable = [
        "athletic_id",
        "stt_view",
        "time_event",
        "title",
        "content",
    ];
}
