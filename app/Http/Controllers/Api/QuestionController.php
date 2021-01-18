<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddQuestionRequest;
use App\Http\Requests\Api\CheckCorrectnessAnswerRequest;
use App\Http\Requests\Api\IndexQuestionRequest;
use App\Http\Requests\Api\UpdateQuestionRequest;
use App\Models\Question;
use App\Traits\ApiRequestParametersTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    use ApiRequestParametersTrait;

    /**
     * @param IndexQuestionRequest $request
     * @return JsonResponse
     */
    public function index(IndexQuestionRequest $request): JsonResponse
    {
        $params = $this->getRequestParameters($request);
        extract($params);

        $query = Question::search($search, $searchable)->filter($filter)->orderBy($sort, $order);

        $questionsCount = $query->count('id');
        $questions = $query->offset($offset)->limit($limit)->get();

        return response()->json([
            'total' => $questionsCount,
            'rows' => $questions
        ], Response::HTTP_OK);
    }

    /**
     * @param AddQuestionRequest $request
     * @return JsonResponse
     */
    public function add(AddQuestionRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $question = new Question($request->validated());

            $question->save();

            DB::commit();

            return response()->json(
                [
                    'status' => 'success',
                    'results' => [
                        'url' => route('back.question')
                    ]
                ],
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'errors' => [
                        'main' => [
                            'Nie możemy dodać Twojego zgłoszenia, aby rozwiązać problem skontaktuj się z administratorem serwisu.'
                        ]
                    ],
                    'message' => 'Wewnętrzny błąd serwisu.'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @param UpdateQuestionRequest $request
     * @return JsonResponse
     */
    public function update(UpdateQuestionRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $question = Question::findOrFail($request->input('id'));

            $question->fill($request->validated());
            $question->save();

            DB::commit();

            return response()->json(
                [
                    'status' => 'success',
                    'results' => [
                        'url' => route('back.question')
                    ]
                ],
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'errors' => [
                        'main' => [
                            'Nie możemy zaktualizować rekordu, aby rozwiązać problem skontaktuj się z administratorem serwisu.'
                        ]
                    ],
                    'message' => 'Wewnętrzny błąd serwisu.'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @param Question $question
     * @return JsonResponse
     */
    public function delete(Question $question): JsonResponse
    {
        DB::beginTransaction();

        try {
            $question->delete();

            DB::commit();

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Rekord został pomyślnie usunięty.'
                ],
                Response::HTTP_OK
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'errors' => [
                        'main' => [
                            'Nie możemy usunąć rekordu, aby rozwiązać problem skontaktuj się z administratorem serwisu.'
                        ]
                    ],
                    'message' => 'Wewnętrzny błąd serwisu.'
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }

    /**
     * @return JsonResponse
     */
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
        ], Response::HTTP_OK);
    }

    /**
     * @param CheckCorrectnessAnswerRequest $request
     * @return JsonResponse
     */
    public function correctness(CheckCorrectnessAnswerRequest $request): JsonResponse
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
        ], Response::HTTP_OK);
    }
}
