<?php

namespace Database\Seeders;

use App\Models\Admin\Post;
use App\Models\Athletic;
use App\Models\TournamentHasAthletic;
use Database\Factories\AthleticFactory;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
//        \App\Models\Admin\Post::factory(100)->create();
//        \App\Models\Athletic::factory(1000)->create();
        TournamentHasAthletic::factory(1000)->create();
    }
}
