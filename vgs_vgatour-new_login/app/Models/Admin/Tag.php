<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'vgatour_tags';
    protected $fillable = ['name', 'description', 'status'];

    public function post()
    {
        return $this->belongsToMany(Post::class, 'vgatour_post_tag');
    }

    public function video(){
        return $this->belongsToMany(Video::class, 'vgatour_video_tag');
    }

    public static function getByName($name)
    {
        $tagName = Tag::query()->where('name', $name)->first();
        return $tagName;
    }

    public static function getById($id)
    {
        $tag = Tag::query()->findOrFail($id);
        return $tag;
    }

    public static function store($tagName)
    {
        $tag = new Tag();
        $tag->name = $tagName;
        $tag->save();
        return $tag;
    }

    public static function destroyTag($id)
    {

        $tag = Tag::getById($id);
        $tag->delete()->sync($id);

        return back();
    }
}
