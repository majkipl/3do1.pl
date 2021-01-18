<?php

namespace Tests\Http\Requests\Api;

use App\Http\Requests\Api\AddQuestionRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\Feature\Api\Validation\ValidationTestCase;
use Illuminate\Support\Facades\Validator;

class AddQuestionRequestTest extends ValidationTestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * @param array $arr
     * @param array $without
     * @return array
     */
    public function getData(array $arr = [], array $without = []): array
    {
        $data = [
            'name' => $this->faker->text(128),
            'answer_1' => $this->faker->text(128),
            'answer_2' => $this->faker->text(128),
            'answer_3' => $this->faker->text(128),
            'correct' => $this->faker->numberBetween(1, 3),
        ];

        foreach ($without as $item) {
            if (array_key_exists($item, $data)) {
                unset($data[$item]);
            }
        }

        return array_merge($data, $arr);
    }

    /** @test */
    public function validation_pass_for_valid_data()
    {
        $data = $this->getData();

        $validator = Validator::make($data, (new AddQuestionRequest())->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function validation_fails_if_name_is_missing()
    {
        $data = $this->getData([], ['name']);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_name_is_not_string()
    {
        $data = $this->getData([
            'name' => $this->faker->numberBetween(1, 128)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_name_is_less_that_min_length()
    {
        $data = $this->getData([
            'name' => Str::random(2)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_name_is_exceeds_max_length()
    {
        $data = $this->getData([
            'name' => Str::random(129)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_1_is_missing()
    {
        $data = $this->getData([], ['answer_1']);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_1_is_not_string()
    {
        $data = $this->getData([
            'answer_1' => $this->faker->numberBetween(1, 128)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_1_is_less_that_min_length()
    {
        $data = $this->getData([
            'answer_1' => Str::random(2)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_1_is_exceeds_max_length()
    {
        $data = $this->getData([
            'answer_1' => Str::random(129)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_2_is_missing()
    {
        $data = $this->getData([], ['answer_2']);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_2_is_not_string()
    {
        $data = $this->getData([
            'answer_2' => $this->faker->numberBetween(1, 128)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_2_is_less_that_min_length()
    {
        $data = $this->getData([
            'answer_2' => Str::random(2)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_2_is_exceeds_max_length()
    {
        $data = $this->getData([
            'answer_2' => Str::random(129)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_3_is_missing()
    {
        $data = $this->getData([], ['answer_3']);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_3_is_not_string()
    {
        $data = $this->getData([
            'answer_3' => $this->faker->numberBetween(1, 128)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_3_is_less_that_min_length()
    {
        $data = $this->getData([
            'answer_3' => Str::random(2)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_answer_3_is_exceeds_max_length()
    {
        $data = $this->getData([
            'answer_3' => Str::random(129)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_correct_is_missing()
    {
        $data = $this->getData([], ['correct']);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_correct_is_not_numeric()
    {
        $data = $this->getData([
            'correct' => $this->faker->text(5)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_correct_is_not_between()
    {
        $data = $this->getData([
            'correct' => $this->faker->numberBetween(4, 9)
        ]);

        $this->expectValidationException($data, AddQuestionRequest::class);
    }

}
