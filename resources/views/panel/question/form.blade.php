@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pytanie</h1>
                </div>
            </div><!--/.row-->
            <form class="form row save" id="saveForm" method="{{ isset($question) ? 'put' : 'post' }}"
                  action="{{ route(isset($question) ? 'api.question.update' : 'api.question.add') }}">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-6 col-sm-offset-3">
                        @component('component.form.input.text', [
                            'name' => 'name',
                            'value' => isset($question) ? $question->name : '',
                            'placeholder' => 'Treść pytania',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            ])
                        @endcomponent
                    </div>
                    <div class="col-12 col-sm-6 col-sm-offset-3">
                        @component('component.form.input.text', [
                            'name' => 'answer_1',
                            'value' => isset($question) ? $question->answer_1 : '',
                            'placeholder' => 'Odpowiedź 1',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            ])
                        @endcomponent
                    </div>
                    <div class="col-12 col-sm-6 col-sm-offset-3">
                        @component('component.form.input.text', [
                            'name' => 'answer_2',
                            'value' => isset($question) ? $question->answer_2 : '',
                            'placeholder' => 'Odpowiedź 2',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            ])
                        @endcomponent
                    </div>
                    <div class="col-12 col-sm-6 col-sm-offset-3">
                        @component('component.form.input.text', [
                            'name' => 'answer_3',
                            'value' => isset($question) ? $question->answer_3 : '',
                            'placeholder' => 'Odpowiedź 3',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            ])
                        @endcomponent
                    </div>
                    <div class="col-12 col-sm-6 col-sm-offset-3">
                        @component('component.form.input.text', [
                            'name' => 'correct',
                            'value' => isset($question) ? $question->correct : '',
                            'placeholder' => 'Poprawna odpowiedź',
                            'required' => true,
                            'max' => 1,
                            'error' => '',
                            ])
                        @endcomponent
                    </div>

                    <div class="col-12 col-sm-10 col-sm-offset-1 text-center">
                        <button class="button button-red mx-auto submit" type="submit">ZAPISZ</button>
                        @if(isset($question) && $question->id)
                            @component('component.form.input.hidden', [
                                'name' => 'id',
                                'value' => $question->id,
                                'error' => '',
                                ])
                            @endcomponent
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
