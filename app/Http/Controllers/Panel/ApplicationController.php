<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Question;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('panel/application/index');
    }

    public function show(Application $application)
    {
        $answersArray = explode(',', $application->response);
        $answers = array_filter($answersArray);

        $questions = Question::whereIn('id', array_keys($answers))->get();

        return view('panel/application/show', [
            'application' => $application,
            'answers' => $answers,
            'questions' => $questions
        ]);
    }
}
