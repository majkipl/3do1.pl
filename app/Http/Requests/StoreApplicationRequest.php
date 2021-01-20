<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
    public function rules()
    {
        $rules =  [
            'firstname' => 'bail|required|string|min:3|max:128',
            'lastname' => 'bail|required|string|min:3|max:128',
            'birthday' => 'bail|required|date_format:d-m-Y|before_or_equal:' . now()->subYears(13)->format('Y-m-d'),
            'phone' => [
                'bail',
                'required',
                'regex:/^\+48(\s)?([1-9]\d{8}|[1-9]\d{2}\s\d{3}\s\d{3}|[1-9]\d{1}\s\d{3}\s\d{2}\s\d{2}|[1-9]\d{1}\s\d{2}\s\d{3}\s\d{2}|[1-9]\d{1}\s\d{2}\s\d{2}\s\d{3}|[1-9]\d{1}\s\d{4}\s\d{2}|[1-9]\d{2}\s\d{2}\s\d{2}\s\d{2}|[1-9]\d{2}\s\d{3}\s\d{2}|[1-9]\d{2}\s\d{4})$/'
            ],
            'email' => 'bail|required|email:rfc,dns|unique:applications,email',
            'shop' => 'bail|required|string|min:3|max:128',
            'whence' => 'bail|required|numeric|exists:whences,id',
            'product_code' => [
                'bail',
                'required',
                'regex:/^([0-9]{8}|[0-9]{13}|[0-9]{14})$/'
            ],
            'img_receipt' => 'bail|required|file|mimes:jpeg,jpg,png|max:4096',
            'legal_1' => 'bail|required',
            'legal_2' => 'bail|required',
            'legal_3' => 'bail|required',
            'legal_4' => 'bail|required',
            'legal_5' => 'bail|nullable',
            'legal_6' => 'bail|nullable',
        ];

        $rules['main_prize'] = 'bail';
        if ($this->input('main_prize') !== null) {
            $rules['competition_title'] = 'bail|required|string|min:3|max:128';
            $rules['competition_audio'] = 'bail|required|file|mimes:mp3|max:2048';
        }

        $rules['week_prize'] = 'bail';
        if ($this->input('week_prize') !== null) {
            $rules['timer'] = 'bail|required';
            $rules['response'] = 'bail|required|regex:/^[1-3]?(,[1-3]*)*[1-3]?$/';
            $rules['correct'] = 'bail|required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'required' => 'Pole jest wymagane.',
            'string' => 'Wprowadź wartość tekstową.',
            'min' => 'Pole wymaga minimum :min znaków.',
            'max' => 'Pole wymaga maksymalnie :max znaków.',
            'date_format' => 'Niewłaściwy format daty. Oczekiwany format: DD-MM-YYYY.',
            'before_or_equal' => 'Musisz mieć co najmniej 13 lat, aby się zarejestrować.',
            'regex' => 'Błędny format wprowadzonych danych.',
            'email' => 'Błędny format wprowadzonych danych.',
            'unique' => 'Adres e-mail jest już zajęty.',
            'exists' => 'Wybierz prawidłową wartość.',
            'file' => 'Pole wymaga pliku.',
            'mimes' => 'Dopuszczalne typy plików :values.',
            'img_receipt.max' => 'Plik nie może być większy niż 4MB.',
            'competition_audio.max' => 'Plik nie może być większy niż 2MB.',
            'timer.required' => 'Musisz rozwiązać Quiz',
            'response.required' => 'Musisz rozwiązać Quiz',
            'correct.required' => 'Musisz rozwiązać Quiz',
        ];
    }
}
