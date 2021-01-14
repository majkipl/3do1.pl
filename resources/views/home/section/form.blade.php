<section class="home-form" id="kontakt">
    <div class="container" id="formContact">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <h2 class="heading">kontakt</h2>
                <p class="lead">Masz pytania w związku z naszą promocją?<br/>Skorzystaj z formularza i wyślij nam
                    wiadomość.</p>
                <div class="form mt-5">
                    <form class="form" method="post" action="{{ route('front.contact.send') }}">
                        @csrf
                        <div class="row">
                            @component( 'component.form.input.text', [
                                'name' => 'name',
                                'value' => '',
                                'placeholder' => 'Imię',
                                'required' => true,
                                'max' => 128,
                                'error' => '',
                                'classWrapper' => 'col-12'
                            ])
                            @endcomponent

                            @component( 'component.form.input.email', [
                                'name' => 'email',
                                'value' => '',
                                'placeholder' => 'Adres e-mail',
                                'required' => true,
                                'max' => 255,
                                'error' => '',
                                'classWrapper' => 'col-12'
                            ])
                            @endcomponent

                            @component( 'component.form.input.text', [
                                'name' => 'subject',
                                'value' => '',
                                'placeholder' => 'Temat',
                                'required' => true,
                                'max' => 128,
                                'error' => '',
                                'classWrapper' => 'col-12'
                            ])
                            @endcomponent

                            @component( 'component.form.textarea', [
                                'name' => 'message',
                                'value' => '',
                                'placeholder' => 'Wiadomość',
                                'required' => true,
                                'max' => 4096,
                                'error' => '',
                                'classWrapper' => 'col-12'
                            ])
                            @endcomponent

                            @component( 'component.form.input.checkbox', [
                                'name' => 'legal_7',
                                'required' => true,
                                'class' => '',
                                'error' => '',
                                'classWrapper' => 'col-12 mb-4'
                            ])
                                Wyrażam zgodę na przetwarzanie moich danych osobowych zawartych w wypełnionym przeze
                                mnie formularzu kontaktowym w celu uzyskania informacji zwrotnej. Dane będą przetwarzane
                                zgodnie z rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia
                                27.04.2016 r. („RODO”)
                            @endcomponent
                        </div>
                        <div class="text-center">
                            <a class="button send" href="#">Wyślij</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="appla"></div>--}}
</section>
