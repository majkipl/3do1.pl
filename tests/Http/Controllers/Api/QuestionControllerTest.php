<?php

namespace Tests\Http\Controllers\Api;

use App\Enums\UserRole;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function getUser()
    {
        return User::factory()->create([
            'role' => UserRole::ADMIN
        ]);
    }

    /** @test */
    public function it_response_http_forbidden_if_without_token_for_list_question()
    {
        $response = $this->getJson(route('api.question'));
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function it_response_http_forbidden_if_token_wrong_for_list_question()
    {
        $queryParams = [
            'searchable' => ['id', 'name'],
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . Str::random(32),
        ])->getJson(route('api.question') . '?' . http_build_query($queryParams));

        $response
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function it_can_list_question()
    {
        $question = Question::factory()->count(5)->create();

        $queryParams = [
            'searchable' => ['id', 'name'],
        ];

        $token = JWTAuth::fromUser($this->getUser());

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson(route('api.question') . '?' . http_build_query($queryParams));

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonCount($question->count(), 'rows');
    }
}
