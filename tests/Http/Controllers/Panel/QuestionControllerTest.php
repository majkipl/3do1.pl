<?php

namespace Tests\Http\Controllers\Panel;

use App\Models\Application;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Panel\PanelBaseTestCase;

class QuestionControllerTest extends PanelBaseTestCase
{
    use RefreshDatabase;

    public $route = 'back.question';

    public $model = Question::class;
}
