<?php

namespace Database\Factories;

use App\Models\Athletic;
use Illuminate\Database\Eloquent\Factories\Factory;

class AthleticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Athletic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vga_id' => $this->faker->numberBetween(1, 100000),
            'code_athletic' => 'PRO' . $this->faker->numberBetween(1, 1000000),
            'avatar' => $this->faker->imageUrl('100', 100),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birthday' => $this->faker->date(),
            'country' => $this->faker->numberBetween(1, 1000),
            'date_vgatour' => $this->faker->date('Y-m-d', 'now'),
            'turn_pro' => $this->faker->date('Y-m-d', 'now'),
            'height' => $this->faker->numberBetween(1, 1000),
            'weight' => $this->faker->numberBetween(1, 1000),
            'total_money' => $this->faker->numberBetween(1, 1000000000),
            'status' => 1,
        ];
    }
}
