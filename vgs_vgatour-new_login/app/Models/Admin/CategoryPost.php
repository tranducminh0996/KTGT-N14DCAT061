<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'vgatour_category_post';
    protected $fillable = ['name', 'thumbnail', 'parent_id', 'description', 'status', 'upload_by', 'icon', 'order', 'is_default'];

    public function video()
    {
        return $this->hasMany(Video::class);
    }
}
