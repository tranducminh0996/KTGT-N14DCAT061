<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(400),
            'content' => $this->faker->text(20000),
            'status' => $this->faker->numberBetween(0,10),
            'upload_by' => $this->faker->numberBetween(1,100),
            'post_source' => $this->faker->url,
            'featured' => $this->faker->numberBetween(1,11),
            'orders' => $this->faker->numberBetween(1,11),
            'order' => $this->faker->numberBetween(1,11),
            'home' => $this->faker->numberBetween(1, 11),
            'focus' => $this->faker->numberBetween(1, 11),
            'hot' => $this->faker->numberBetween(1, 11),
            'image' => $this->faker->imageUrl(1000,1000),
            'views' => $this->faker->numberBetween(1, 100000),
            'format_type' => $this->faker->text(30),
            'date_post' => $this->faker->dateTime,
        ];
    }
}
