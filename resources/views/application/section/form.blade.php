<section class="form-form" id="form">
    <div class="container">
        <form class="form" method="post" id="save" action="{{ route('front.application.save') }}">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="row">
                        @component( 'component.form.input.text', [
                            'name' => 'firstname',
                            'value' => '',
                            'placeholder' => 'Imię',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            'classWrapper' => 'col-12'
                            ])
                        @endcomponent

                        @component( 'component.form.input.text', [
                            'name' => 'lastname',
                            'value' => '',
                            'placeholder' => 'Nazwisko',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            'classWrapper' => 'col-12'
                            ])
                        @endcomponent

                        @component('component.form.input.text', [
                            'name' => 'birthday',
                            'value' => '',
                            'placeholder' => 'Data urodzenia [DD-MM-YYYY]',
                            'required' => true,
                            'max' => 10,
                            'error' => '',
                            'classWrapper' => 'col-12'
                        ])
                        @endcomponent

                        @component( 'component.form.input.text', [
                            'name' => 'phone',
                            'value' => '',
                            'placeholder' => 'Numer telefonu',
                            'required' => true,
                            'max' => 32,
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
                            'name' => 'shop',
                            'value' => '',
                            'placeholder' => 'Sklep',
                            'required' => true,
                            'max' => 128,
                            'error' => '',
                            'classWrapper' => 'col-12'
                            ])
                        @endcomponent

                        @component('component.form.select', [
                            'name' => 'whence',
                            'value' => '',
                            'placeholder' => 'Skąd wiesz o akcji?',
                            'required' => true,
                            'error' => '',
                            'items' => $whences,
                            'classWrapper' => 'col-12'])
                        @endcomponent

                        @component( 'component.form.input.text', [
                            'name' => 'product_code',
                            'value' => '',
                            'placeholder' => 'Wpisz kod kreskowy produktu/produktów',
                            'required' => true,
                            'max' => 16,
                            'error' => '',
                            'classWrapper' => 'col-12'
                            ])
                        @endcomponent
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6 d-flex align-items-center">

                            @component( 'component.form.input.file', [
                                        'name' => 'img_receipt',
                                        'required' => true,
                                        'error' => '',
                                        'class' => 'row mx-auto',
                                        'srcIcon' => asset('/images/svg/form/upload.svg')
                            ])
                                Wgraj zdjęcie paragonu
                            @endcomponent

                        </div>
                        <div class="col-md-6 animate-img">
                            <img class="form-img" src="{{ asset('images/form/image.png') }}" alt=""/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="superoption-1">
                        <input type="hidden" class="superoption-input input" name="main_prize" id="main_prize" value="" />
                        <div class="text-center">
                            <button class="button superoption-button mb-4" type="button" data-toggle="#superoption-box-1">Chcę wygrać nagrodę główną</button>
                        </div>
                        <div class="superoption-box superoption-box-1" id="superoption-box-1">
                            <div class="row justify-content-center">
                                <div class="col-11 col-lg-10">
                                    <p class="superoption-text">Uwolnij swoją kreatywność i wygraj atrakcyjne, piłkarskie nagrody! Spacer z psem, obiad u teściów, wywiadówka syna? Opowiedz nam o dowolnej, zabawnej sytuacji, przesyłając nagranie utrzymane w stylu komentarza sportowego!</p>
                                    <p class="superoption-text">Dla osoby, która wygra nasz konkurs, przygotowaliśmy zestaw kina domowego (telewizor i soundbar), roczny dostęp do ELEVEN SPORTS oraz spersonalizowane koszulki Reprezentacji Polski dla całej rodziny. Oczaruj jury z Mateuszem Mikulakiem z Footgol TV na czele!</p>
                                    <p class="superoption-text">To proste - użyj dyktafonu znajdującego się w każdym smartfonie i prześlij nam nagranie głosowe.</p>
                                    <img class="superoption-img" src="{{ asset('images/form/superoption-1.png') }}" alt="" />

                                    <div class="field">
                                    <label class="superoption-title">
                                        <span class="span">Praca konkursowa</span>
                                        <input type="text" class="input" name="competition_title" id="competition_title" placeholder="Tytuł" aria-label="Praca konkursowa" value="" />
                                        <div class="error-post error-competition_title"></div>
                                    </label>
                                    </div>
                                    <div class="file-input">
                                        <div class="field file-uploads field-uploads">
                                            <div class="thumbs text-center">
                                                <audio controls id="competition_audio_tag">Twoja przeglądarka nie wspiera elementu AUDIO.</audio>
                                            </div>
                                            <button type="button" class="info button-uploads">
                                                <img src="{{ asset('/images/svg/form/upload.svg') }}" alt="cloud"/>
                                                <span>Wgraj nagranie konkursowe<br />(format audio lub MP3,<br />max. 1 min., max. 1,5 MB)</span>
                                            </button>
                                            <div class="uploads uploads-d-none">
                                                <input type="file"
                                                       name="competition_audio"
                                                       id="competition_audio"
                                                       class="upload-audio upload-file file"/>
                                            </div>
                                            <div class="error-post error-competition_audio"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="superoption-2 mb-4">
                        <input type="hidden" class="superoption-input input" name="week_prize" id="week_prize" value="" />
                        <div class="text-center">
                            <button class="button superoption-button mb-4" type="button" data-toggle="#superoption-box-2">Walczę o nagrodę tygodnia</button>
                        </div>
                        <div class="superoption-box superoption-box-2" id="superoption-box-2">
                            <div class="superoption-start" id="superoption-start">
                                <div class="row justify-content-center">
                                    <div class="col-11 col-lg-10">
                                        <div class="text-center">
                                            <p class="superoption-text font-top large mb-0">Graj o nagrodę tygodnia!</p>
                                            <p class="superoption-text mb-0">Rozwiąż nasz quiz wiedzy o footballu i wygraj nasz przenośny pakiet kibica.</p>
                                            <p class="superoption-text bold">Sprawdź się!</p>
                                        </div>

                                        <img class="superoption-img" src="{{ asset('images/form/superoption-2.png') }}" alt="" />

                                        <div class="text-center">
                                            <button class="button play-button" type="button" data-open="#superoption-quiz" data-close="#superoption-start">Gram!</button>
                                        </div>

                                        <div class="text-center">
                                            <div class="error-post error-timer bold mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="superoption-quiz" id="superoption-quiz">
                                <div class="row justify-content-center">
                                    <div class="col-11 col-lg-10">
                                        <p class="superoption-text question"></p>
                                        <button class="button answer answer-1" type="button"></button>
                                        <button class="button answer answer-2" type="button"></button>
                                        <button class="button answer answer-3" type="button"></button>
                                        <div class="text-center">
                                            <button class="button return-button" type="button" data-open="#superoption-start" data-close="#superoption-quiz">Rezygnuję</button>
                                        </div>
                                        <div class="error-post error-timer bold mt-3"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="superoption-end" id="superoption-end">
                                <div class="row justify-content-center">
                                    <div class="col-11 col-lg-10">
                                        <div class="end-box">
                                            <p class="superoption-text quiz-error bold show-error">Błąd połączenia. Przepraszamy</p>
                                            <p class="superoption-text font-top large mb-0 show-success">Gratulacje!</p>
                                            <p class="superoption-text mb-4 show-success">Jesteś mistrzem wiedzy o Piłce Nożnej!</p>
                                            <p class="superoption-text show-success">Twój wynik to:</p>
                                            <p class="superoption-text superoption-text-score font-top large mb-4 show-success">
                                                <span class="correct">0</span> / <span class="total">17</span>
                                            </p>
                                            <button class="button end-button report-button show-success" type="button" data-show=".end-text" data-hide=".end-button">zgłoś swój wynik do konkursu</button>
                                            <p class="superoption-text end-text show-success">Jeśli jesteś niezadowolony z wyniku spróbuj jeszcze raz!</p>
                                            <button class="button end-button replay-button show-success" type="button" data-open="#superoption-quiz" data-close="#superoption-end">spróbuj jeszcze raz</button>

                                            <div class="error-post error-timer bold mt-3"></div>

                                            <input type="hidden" name="timer" id="timer" value="" class="input" />
                                            <input type="hidden" name="response" id="response" value="" class="input" />
                                            <input type="hidden" name="correct" id="correct" value="" class="input" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-xl-8">
                    <div class="row">
                        @component( 'component.form.input.checkbox', [  'name' => 'legal_1',
                                                                        'required' => true,
                                                                        'class' => '',
                                                                        'error' => '',
                                                                        'classWrapper' => 'col-12'
                        ])
                            Oświadczam, że zapoznałem/am się i akceptuję regulamin akcji 3:1 DLA CIEBIE!.
                        @endcomponent

                        @component( 'component.form.input.checkbox', [  'name' => 'legal_2',
                                                                        'required' => true,
                                                                        'class' => '',
                                                                        'error' => '',
                                                                        'classWrapper' => 'col-12'
                        ])
                            Oświadczam, że zapoznałem/am się i akceptuję Politykę Prywatności.
                        @endcomponent

                        @component( 'component.form.input.checkbox', [  'name' => 'legal_3',
                                                                        'required' => true,
                                                                        'class' => '',
                                                                        'error' => '',
                                                                        'classWrapper' => 'col-12'
                        ])
                            Wyrażam zgodę na przetwarzanie danych osobowych przez Highlite Bielecka Jellinek sp.j. z
                            siedzibą we Wrocławiu przy ul. Pomorskiej 55/2, 50-217 Wrocław oraz VARTA Consumer Batteries
                            Poland Sp. z o.o., Aleje Jerozolimskie 162A, 02-342 Warszawa/ Poland wyłącznie w celu
                            przeprowadzenia niniejszej akcji, jej promocji i realizacji oraz wydania nagród.
                            Administratorem danych osobowych VARTA Consumer Batteries Poland. Dane osobowe będą
                            przetwarzane zgodnie rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia
                            27.04.2016 r. („RODO”). Podanie danych jest dobrowolne, lecz niezbędne dla potrzeb
                            przeprowadzenia Konkursu i wydania nagród. Zgoda na przetwarzanie danych osobowych może być
                            w dowolnym momencie wycofana, bez wpływu na zgodność z prawem przetwarzania, które zostało
                            dokonane przed jej wycofaniem.
                        @endcomponent

                        @component( 'component.form.input.checkbox', [  'name' => 'legal_4',
                                                                        'required' => true,
                                                                        'class' => '',
                                                                        'error' => '',
                                                                        'classWrapper' => 'col-12'
                        ])
                            Potwierdzam, że zostałem/-am poinformowany/-a o dobrowolności wyrażenia zgody na
                            przetwarzanie danych osobowych w odniesieniu do każdego z celów ich przetwarzania, o prawie
                            do wycofania zgody w dowolnym momencie oraz o zgodności z prawem przetwarzania, którego
                            dokonano na podstawie zgody przed jej wycofaniem. Więcej informacji na temat przetwarzania
                            danych znajduje się w regulaminie promocji, regulaminie konkursu oraz w polityce
                            prywatności.
                        @endcomponent

                        @component( 'component.form.input.checkbox', [  'name' => 'legal_5',
                                                                        'required' => false,
                                                                        'class' => '',
                                                                        'error' => '',
                                                                        'classWrapper' => 'col-12'
                        ])
                            Oświadczam, że nie ukończyłam/em 18 lat, ale ukończyłem/am 13 lat, posiadam ograniczoną
                            zdolność do czynności prawnych i uczestniczę w konkursie „3:1 DLA CIEBIE!” po zapoznaniu się
                            z jego regulaminem i za zgodą mojego rodzica lub przedstawiciela ustawowego.
                        @endcomponent

                        @component( 'component.form.input.checkbox', [  'name' => 'legal_6',
                                                                        'required' => false,
                                                                        'class' => '',
                                                                        'error' => '',
                                                                        'classWrapper' => 'col-12'
                        ])
                            Oświadczam, że ukończyłam/em 18 lat i posiadam pełną zdolność do czynności prawnych,
                            uczestniczę w konkursie „3:1 DLA CIEBIE!” po zapoznaniu się z jego regulaminem.
                        @endcomponent
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="button mb-5 submit">Wyślij</button>
            </div>
        </form>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="rules">
                    <h5 class="rules-title">Skrócony regulamin:</h5>
                    <ol class="rules-list">
                        <li>W dniach 1.04. – 31.07.2021 kup dowolny produkt VARTA za min. 15 zł i zarejestruj swój zakup
                            w tym terminie na stronie akcji.
                        </li>
                        <li>Jeden paragon/faktura upoważnia do otrzymania jednej sztuki nagrody gwarantowanej. Podczas
                            trwania konkursu uczestnik/uczestniczka może wygrać jedną nagrodę główną i/lub jedną nagrodę
                            tygodnia.
                        </li>
                        {{--                        <li>Nagroda główna to zestaw kina domowego, roczny dostęp do ELEVEN SPORTS i spersonalizowane--}}
                        {{--                            koszulki Reprezentacji Polski dla całej rodziny.--}}
                        {{--                        </li>--}}
                        {{--                        <li>Nagroda tygodnia to przenośny pakiet kibica - Power Bank VARTA, słuchawki bezprzewodowe JBL,--}}
                        {{--                            lazy bag i dostęp do ELEVEN SPORTS na 30 dni.--}}
                        {{--                        </li>--}}
                        <li>Szczegóły i regulamin akcji dostępne są na stronie konkursowej.</li>
                    </ol>
                    <a class="rules-link" href="{{ asset('pdf/konkurs.pdf') }}" target="_blank"
                       rel="noopener noreferrer">Pełna treść regulaminu</a>
                </div>
            </div>
        </div>
    </div>
</section>
