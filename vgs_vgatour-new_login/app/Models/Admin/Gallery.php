<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "vgatour_galleries";

    protected $fillable = [
        "tournament_id",
        "name_image",
        "img_url",
        "img_convert",
        "img_resize",
    ];
}
