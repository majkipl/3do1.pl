<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        return view('panel/question/index');
    }

    public function create()
    {
        return view('panel/question/form');
    }

    public function show(Question $question)
    {
        return view('panel/question/show', [
            'question' => $question
        ]);
    }

    public function edit(Question $question)
    {
        return view('panel/question/form', [
            'question' => $question
        ]);
    }
}
