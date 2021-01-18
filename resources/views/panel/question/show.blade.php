@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pytanie</h1>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Pytanie {{ $question->id }}</div>
                        <div class="panel-body">
                            <table class="item show data">
                                <tbody>
                                <tr>
                                    <td>Treść pytania:</td>
                                    <td>{{ $question->name }}</td>
                                </tr>
                                <tr>
                                    <td>Odpowiedź 1:</td>
                                    <td>{{ $question->answer_1 }}</td>
                                </tr>
                                <tr>
                                    <td>Odpowiedź 2:</td>
                                    <td>{{ $question->answer_2 }}</td>
                                </tr>
                                <tr>
                                    <td>Odpowiedź 3:</td>
                                    <td>{{ $question->answer_3 }}</td>
                                </tr>
                                <tr>
                                    <td>Poprawna odpowiedź:</td>
                                    <td>{{ $question->correct }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div><!--/.row-->
        </div><!--/.main-->
    </div>
@endsection
