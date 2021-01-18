<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|min:3|max:128',
            'answer_1' => 'bail|required|string|min:3|max:128',
            'answer_2' => 'bail|required|string|min:3|max:128',
            'answer_3' => 'bail|required|string|min:3|max:128',
            'correct' => 'bail|required|numeric|between:1,3',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'required' => 'Pole jest wymagane.',
            'string' => 'Wprowadź wartość tekstową.',
            'min' => 'Pole wymaga minimum :min znaki.',
            'max' => 'Pole wymaga maksymalnie :max znaków.',
            'numeric' => 'Pole wymaga wartości liczbowej',
            'between' => 'Pole wymaga wartości 1, 2, lub 3.'
        ];
    }
}
