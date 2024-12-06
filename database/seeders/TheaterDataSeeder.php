<?php

namespace Database\Seeders;

use App\Models\Repositories\MovieRepository;
use App\Models\Repositories\TheaterRepository;
use App\Models\Sale;
use App\Models\Screening;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with theater data.
     */
    public function run(): void
    {
        (new TheaterRepository)->createTheaters(30);
        (new MovieRepository)->createMovies(60);
        Screening::factory(600)->create();
        Sale::factory(4000)->create();
    }
}
