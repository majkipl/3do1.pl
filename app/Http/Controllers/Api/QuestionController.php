<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckCorrectnessAnswerRequest;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function quiz(): JsonResponse
    {
        $query = Question::select('id', 'name', 'answer_1', 'answer_2', 'answer_3')
            ->inRandomOrder()
            ->limit(17);

        $total = $query->count('id');
        $rows = $query->get();

        return response()->json([
            'total' => $total,
            'rows' => $rows
        ]);
    }

    public function correctness(CheckCorrectnessAnswerRequest $request)
    {
        $questionQuery = DB::table('questions');

        $answersArray = $request->input('answers');

        $filteredArray = array_filter($answersArray, function ($value) {
            return $value !== null;
        });

        foreach ($filteredArray as $id => $correct) {
            $questionQuery->orWhere(function ($query) use ($id, $correct) {
                $query->where('id', $id)->where('correct', $correct);
            });
        }

        return response()->json([
            'success' => true,
            'total' => count($filteredArray),
            'correct' => $questionQuery->count('id')
        ]);
    }
}
