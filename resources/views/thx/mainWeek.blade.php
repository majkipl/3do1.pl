@extends('layouts.front')

@section('content')
    <section class="thankyou-info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="heading">Dziękujemy Ci za udział w naszej akcji!</h1>
                    <div class="content">
                        <div class="row justify-content-center">
                            <div class="col-11 col-lg-7 col-xl-9">
                                <p class="text">Nasz Moderator już niedługo sprawdzi poprawność Twojego zgłoszenia.
                                    Jeżeli uzna, że Twoje zgłoszenie jest niekompletne – skontaktujemy się z Tobą.</p>
                                <p class="text">Trzymamy kciuki za Twoją wygraną!</p>
                                <p class="text">Pozdrawiamy <br/>Zespół VARTA</p>
                            </div>
                        </div>
                        <img class="img" src="{{ asset('images/thankyou/image.png') }}" alt="" />
                    </div>
                    <div class="text-center"><a class="button" href="/">wróć na stronę główną</a></div>
                </div>
            </div>
        </div>
    </section>
@endsection
