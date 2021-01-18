<?php

namespace Tests\Http\Requests\Api;

use App\Http\Requests\Api\IndexApplicationRequest;
use App\Http\Requests\Api\IndexQuestionRequest;
use Tests\Feature\Api\Validation\ValidationTestCase;

class IndexQuestionRequestTest extends ValidationTestCase
{

    /** @test */
    public function validation_pass_for_valid_data()
    {
        $data = [
            'searchable' => ['id','name','answer_1','answer_2','answer_3','correct'],
            'offset' => 0,
            'limit' => 10,
            'sort' => 'id',
            'order' => 'asc',
            'search' => 'example search'
        ];

        $this->runValidationTest($data, IndexQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_searchable_is_not_exists()
    {
        $data = [
            'searchable' => ['slug'],
            'offset' => 0,
            'limit' => 10,
            'sort' => 'id',
            'order' => 'asc',
            'search' => 'example search'
        ];

        $this->expectValidationException($data, IndexQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_searchable_is_not_array()
    {
        $data = [
            'searchable' => 'id,name,answer_1,answer_2,answer_3,correct', // Should be an array
            'offset' => 0,
            'limit' => 10,
            'sort' => 'id',
            'order' => 'asc',
            'search' => 'example search'
        ];

        $this->expectValidationException($data, IndexQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_offset_is_not_an_integer()
    {
        $data = [
            'searchable' => ['id', 'name'],
            'offset' => 'abc', // Should be an integer
            'limit' => 10,
            'sort' => 'id',
            'order' => 'asc',
            'search' => 'example search'
        ];

        $this->expectValidationException($data, IndexQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_limit_is_not_an_integer()
    {
        $data = [
            'searchable' => ['id', 'name'],
            'offset' => 0,
            'limit' => 'abc', // Should be an integer
            'sort' => 'id',
            'order' => 'asc',
            'search' => 'example search'
        ];

        $this->expectValidationException($data, IndexQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_sort_is_invalid()
    {
        $data = [
            'searchable' => ['id', 'name'],
            'offset' => 0,
            'limit' => 10,
            'sort' => 'invalid_column', // Should be 'id', 'name', or 'slug'
            'order' => 'asc',
            'search' => 'example search'
        ];

        $this->expectValidationException($data, IndexQuestionRequest::class);
    }

    /** @test */
    public function validation_fails_if_order_is_invalid()
    {
        $data = [
            'searchable' => ['id', 'name'],
            'offset' => 0,
            'limit' => 10,
            'sort' => 'id',
            'order' => 'invalid_order', // Should be 'asc' or 'desc'
            'search' => 'example search'
        ];

        $this->expectValidationException($data, IndexQuestionRequest::class);
    }
}
