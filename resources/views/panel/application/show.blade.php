@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Zgłoszenie</h1>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Zgłoszenie {{ $application->id }}</div>
                        <div class="panel-body">
                            <table class="item show data">
                                <tbody>
                                <tr>
                                    <td>Imię:</td>
                                    <td>{{ $application->firstname }}</td>
                                </tr>
                                <tr>
                                    <td>Nazwisko:</td>
                                    <td>{{ $application->lastname }}</td>
                                </tr>
                                <tr>
                                    <td>Data urodzin:</td>
                                    <td>{{ $application->birthday }}</td>
                                </tr>
                                <tr>
                                    <td>Adres e-mail:</td>
                                    <td>{{ $application->email }}</td>
                                </tr>
                                <tr>
                                    <td>Telefon:</td>
                                    <td>{{ $application->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Sklep:</td>
                                    <td>{{ $application->shop }}</td>
                                </tr>
                                <tr>
                                    <td>Kod kreskowy:</td>
                                    <td>{{ $application->product_code }}</td>
                                </tr>
                                <tr>
                                    <td>Zdjęcie dowodu sprzedaży:</td>
                                    <td><img src="{{ asset('storage/' . $application->img_receipt) }}"
                                             alt="Dowód zakupu dla zgłoszenia: {{ $application->id }}"/></td>
                                </tr>
                                <tr>
                                    <td>Gra o nagrodę główną?:</td>
                                    <td>{{ $application->is_main_prize ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Tytuł zgłoszenia:</td>
                                    <td>{{ $application->competition_title }}</td>
                                </tr>
                                <tr>
                                    <td>Plik audio:</td>
                                    <td>
                                        <audio controls="" id="competition_audio_tag">
                                            <source src="{{ asset('storage/' . $application->competition_audio) }}" type="audio/mpeg">
                                            Twoja przeglądarka nie wspiera elementu AUDIO.
                                        </audio>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gra o nagrodę tygodnia:</td>
                                    <td>{{ $application->is_week_prize ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Czas:</td>
                                    <td>{{ $application->timer }}</td>
                                </tr>
                                <tr>
                                    <td>Odpowiedzi:</td>
                                    <td>{{ $application->response }}</td>
                                </tr>
                                <tr>
                                    <td>Poprawne odpowiedzi:</td>
                                    <td>{{ $application->correct }}</td>
                                </tr>
                                <tr>
                                    <td>Legal 1:</td>
                                    <td>{{ $application->legal_1 ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Legal 2:</td>
                                    <td>{{ $application->legal_2 ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Legal 3:</td>
                                    <td>{{ $application->legal_3 ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Legal 4:</td>
                                    <td>{{ $application->legal_4 ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Legal 5:</td>
                                    <td>{{ $application->legal_5 ? 'TAK' : 'NIE' }}</td>
                                </tr>
                                <tr>
                                    <td>Legal 6:</td>
                                    <td>{{ $application->legal_6 ? 'TAK' : 'NIE' }}</td>
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
