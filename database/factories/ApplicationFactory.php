<?php

namespace Database\Factories;

use App\Models\Whence;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $maxDate = Carbon::now()->subYears(13)->subDay(); // Odejmuje 13 lat i 1 dzień

        $whencesCont = Whence::count();

        if( $whencesCont ) {
            $whence = Whence::inRandomOrder()->first();
        } else {
            $whence = Whence::factory()->create();
        }

        $mainPrize = $this->faker->boolean;
        $weekPrize = $this->faker->boolean;

        $obj = [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'birthday' => $this->faker->dateTimeBetween($maxDate)->format('d-m-Y'),
            'phone' => '+48' . $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'shop' => $this->faker->text(128),
            'whence_id' => $whence->id,
            'product_code' => $this->faker->numerify('########'),
            'img_receipt' => 'receipts/UReSLM067wKkT9TyB5vohgT6elOWh35ApP2ZA8c9.jpg',
            'legal_5' => $this->faker->numberBetween(0,1),
            'legal_6' => $this->faker->numberBetween(0,1),
            'token' => Str::random(32),
        ];

        if( $mainPrize ) {
            $obj['is_main_prize'] = $mainPrize;

            $obj['competition_title'] = $this->faker->text(128);
            $obj['competition_audio'] = 'receipts/UReSLM067wKkT9TyB5vohgT6elOWh35ApP2ZA8c9.jpg';
        }

        if( $weekPrize ) {
            $obj['is_week_prize'] = $weekPrize;

            $obj['timer'] = $this->faker->numberBetween(60000, 99999);
            $obj['response'] = $this->faker->text(128);
            $obj['correct'] = $this->faker->numberBetween(1, 17);
        }

        return $obj;
    }
}
