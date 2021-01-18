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
            'name' => $this->faker->text(128),
            'answer_1' => $this->faker->word,
            'answer_2' => $this->faker->word,
            'answer_3' => $this->faker->word,
            'correct' => $this->faker->numberBetween(1, 3),
        ];
    }
}
