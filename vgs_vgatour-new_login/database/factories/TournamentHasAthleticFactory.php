<?php

namespace Database\Factories;

use App\Models\TournamentHasAthletic;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournamentHasAthleticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TournamentHasAthletic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'athletic_id' => $this->faker->numberBetween(1, 2000),
            'tournament_id' => $this->faker->numberBetween(1, 6),
            'total_bonus' => $this->faker->numberBetween(1, 2147483647),
            'ranking' => $this->faker->numberBetween(1, 1000),
            'sort' => $this->faker->numberBetween(1, 50),
            'is_cut' => 1,
        ];
    }
}
