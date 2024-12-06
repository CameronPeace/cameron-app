<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Screening;
use App\Models\Theater;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screening>
 */
class ScreeningFactory extends Factory
{

    protected $model = Screening::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movies = Movie::pluck('id')->toArray();
        $theaters = Theater::pluck('id')->toArray();
        $showing = fake()->numberBetween(0, 1);
        
        return [
            'is_showing' => $showing,
            'theater_id' => fake()->randomElement($theaters),
            'movie_id' => fake()->randomElement($movies),
            'screen_end' => $showing ? fake()->dateTimeBetween('now', '+90 days') : fake()->dateTimeBetween('-90 days', 'now'),
        ];
    }
}
