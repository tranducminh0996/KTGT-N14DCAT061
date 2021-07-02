<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tournament;

class Video extends Model
{
    use HasFactory;

    protected $table = 'vgatour_videos';
    protected $fillable = ['name', 'description', 'publish_date', 'slug', 'featured', 'home', 'order', 'status', 'video_url', 'video_thumbnail_url', 'post_source', 'tournament_id'];

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'vgatour_video_tag');
    }

    public function category()
    {
        return $this->belongsTo(CategoryVideo::class, 'category_video_id');
    }
    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }
    public static function getList()
    {
        $video = Video::query()->get();
        return $video;
    }

    public static function getById($id)
    {
        $video = Video::query()->findOrFail($id);

        return $video;
    }

    public static function getByIdWithTag($id)
    {
        $video = Video::getById($id);
        $video['tag'] = $video->tag->toArray();
        if (empty($video['tag'])) {
            $video['tag'] = null;
        }
        return $video;
    }

    public static function updateVideo($id, array $params = [], $tagsRequest)
    {
        $video = Video::getById($id);
        $video->fill($params);
        $video->save();
        $video->tag()->detach();
        foreach ($tagsRequest as $tagRequestItem) {
            if (Tag::getByName($tagRequestItem) === null) {
                $newTag = Tag::store($tagRequestItem);
                $newTag->video()->sync($id);
            }
            if (Tag::getByName($tagRequestItem) !== null) {
                $tag = Tag::getByName($tagRequestItem);
                $tag->video()->attach($id);
            }
        }
        return back();
    }

    public static function storeVideo(array $params = [], $tagsRequest)
    {
        $video = new Video();
        $video->fill($params);
        $video->save();
        $id = Video::query()->latest('created_at')->first();
        $id = $id['id'];
        foreach ($tagsRequest as $tagRequestItem) {
            if (Tag::getByName($tagRequestItem) === null) {
                $newTag = Tag::store($tagRequestItem);
                $newTag->post()->sync($id);
            }
            if (Tag::getByName($tagRequestItem) !== null) {
                $tag = Tag::getByName($tagRequestItem);
                $tag->post()->attach($id);
            }
        }
        return back();
    }

    public static function getNameSlug($slug)
    {
        $video = Video::query()->where('slug', $slug)->first();
        return $video;
    }
}
