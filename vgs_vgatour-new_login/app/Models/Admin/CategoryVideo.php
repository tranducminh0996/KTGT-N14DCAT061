<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVideo extends Model
{
    use HasFactory;

    protected $table = 'vgatour_category_video';
    protected $fillable = ['name', 'thumbnail', 'parent_id', 'description', 'status', 'upload_by', 'icon', 'order', 'is_default'];

    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
