<?php

namespace Tests\Http\Requests\Api;

use App\Http\Requests\Api\CheckCorrectnessAnswerRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\Feature\Api\Validation\ValidationTestCase;

class CheckCorrectnessAnswerRequestTest extends ValidationTestCase
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
            'answers' => $this->faker->text(128),
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

        $validator = Validator::make($data, (new CheckCorrectnessAnswerRequest())->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function validation_fails_if_answers_is_not_exists()
    {
        $data = $this->getData([], ['answers']);

        $this->expectValidationException($data, CheckCorrectnessAnswerRequest::class);
    }
}
