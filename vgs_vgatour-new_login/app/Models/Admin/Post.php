<?php

namespace App\Models\Admin;

use App\Models\Admin\Traits\BaseModel;
use App\Models\Tournament;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, BaseModel, Sluggable;

    protected $table = 'vgatour_posts';
    // protected $fillable = ['name', 'description', 'content', 'status', 'upload_by', 'slug', 'post_source','tournament_id', 'thumbnail', 'orders', 'order', 'home', 'focus', 'hot', 'image', 'views', 'format_type', 'date_post', 'category_id'];

    protected $fillable = ['name', 'description', 'content', 'status', 'upload_by', 'slug', 'post_source', 'tournament_id', 'thumbnail', 'orders', 'order', 'home', 'focus', 'hot', 'image', 'views', 'format_type', 'date_post', 'category_id'];

    public function tag()

    {
        return $this->belongsToMany(Tag::class, 'vgatour_post_tag');
    }

    public function category()
    {
        return $this->belongsTo(CategoryPost::class, 'category_id');
    }
    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public static function getByIdWithTag($id)
    {
        $post = Post::query()->findOrFail($id);
        $post['tag'] = $post->tag->toArray();
        if (empty($post['tag'])) {
            $post['tag'] = null;
        }
        return $post;
    }

    public static function storePost(array $params = [], $tagsRequest)
    {
        $post = new Post();
        $post->fill($params);
        $post->save();
        $id = Post::query()->latest('created_at')->first();
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
        return $post;
    }

    public static function updatedPost($id, array $params = [], $tagsRequest)
    {
        $post = Post::getById($id);
        $post->fill($params);
        $post->save();
        $postTag = $post->tag;
        foreach ($postTag as $postTagItem) {
            for ($i = 0; $i < count($tagsRequest); $i++) {
                if ($postTagItem['name'] !== $tagsRequest[$i]) {
                    $post->tag()->detach($postTagItem['id']);
                }
            }
        }
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

    public static function destroyPost($id)
    {
        $post = Post::getById($id);
        $post->tag()->detach($id);
        $post->delete();

        return back();
    }

    public static function destroyTag($id)
    {
        $post = Post::getById($id);
    }

    public static function getNameSlug($slug)
    {
       
        $post = Post::query()->where('slug', $slug)
            ->select('vgatour_posts.*')
            ->first();

        return $post;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
