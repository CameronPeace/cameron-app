<?php

namespace Database\Factories;

use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $screenings = Screening::pluck('id')->toArray();
        // senior, children, adult rates
        $amountOptions = [7.00, 10.00, 11.90];
        $screeningId = fake()->randomElement($screenings);
        $screenEnd = Screening::where('id', $screeningId)->value('screen_end');

        return [
            'amount' => fake()->randomElement($amountOptions),
            'screening_id' => $screeningId,
            'sale_date' => fake()->dateTimeBetween(Carbon::parse($screenEnd)->subDays(6), $screenEnd),
        ];
    }
}
