@extends('layouts.front')

@section('content')
    <section class="thankyou-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="heading">Dziękujemy!</h1>
                    <div class="content">
                        <div class="row justify-content-center">
                            <div class="col-11 col-lg-7 col-xl-9">
                                <p class="text">Na Twój adres e-mail wysłaliśmy prośbę o weryfikację adresu i
                                    potwierdzenie zgłoszenia.</p>
                                <p class="text">Sprawdź swoją skrzynkę i wróć do nas poprzez podany w wiadomości
                                    link.</p>
                                <p class="text">Chociaż tego nie lubimy, czasami wpadamy do SPAMu<br/>– sprawdź również
                                    tę zakładkę.</p>
                                <p class="text">Jeżeli mail weryfikacyjny do Ciebie nie dotarł,<br/>napisz do nas
                                    wiadomość.</p>
                            </div>
                        </div>
                        <img class="img" src="{{ asset('images/thankyou/image.png') }}" alt=""/>
                    </div>
                    <div class="text-center"><a class="button" href="/">wróć na stronę główną</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection
