<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->words(3,true),
            'answer_1' => fake()->words(1,true),
            'answer_2' => fake()->words(1,true),
            'answer_3' => fake()->words(1,true),
            'correct' => fake()->numberBetween(1, 3),
        ];
    }
}
