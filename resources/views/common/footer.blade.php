<footer class="footer">
    <div class="container">
        <div>
            <a class="link mb-lg-5" href="{{ asset('pdf/promocja.pdf') }}" target="_blank" rel="noopener noreferrer">REGULAMIN
                PROMOCJI</a> <span class="link"> I </span> <a class="link mb-lg-5" href="{{ asset('pdf/konkurs.pdf') }}"
                                                              target="_blank" rel="noopener noreferrer">REGULAMIN
                KONKURSU</a>
        </div>
        <div class="row">
            <div class="col-lg-5 col-xl-6">
                <ul class="info">
                    <li><a class="text" href="/polityka-prywatnosci/" rel="noopener noreferrer">Polityka prywatności</a>
                    </li>
                    <li><a class="text" href="/polityka-cookies/" rel="noopener noreferrer">Polityka cookies</a></li>
                    <li><a class="text" href="/zasady-uzytkownika/" rel="noopener noreferrer">Zasady użytkowania</a>
                    </li>
                    <li><a class="text mb-3" href="/imprint/" rel="noopener noreferrer">Imprint</a></li>
                    <li><a class="link" href="https://www.varta-consumer.pl/" target="_blank" rel="noopener noreferrer">www.varta-consumer.pl</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-5 col-lg-3">
                <p class="lead">Napisz do nas</p>
                <div class="row">
                    <a class="link icon" href="/#kontakt" aria-label="Kontakt">
                        {!! file_get_contents(public_path('images/svg/icon/xl/contact.svg')) !!}
                    </a>
                </div>
            </div>
            <div class="col-sm-7 col-lg-4 col-xl-3">
                <p class="lead">Znajdź nas na</p>
                <div class="row">
                    <a class="link icon" href="https://www.facebook.com/Varta.AGPL" target="_blank"
                       rel="noopener noreferrer" aria-label="Facebook">
                        {!! file_get_contents(public_path('images/svg/icon/xl/facebook.svg')) !!}
                    </a>
                    <a class="link icon" href="https://www.youtube.com/user/vartaconsumer" target="_blank"
                       rel="noopener noreferrer" aria-label="YouTube">
                        {!! file_get_contents(public_path('images/svg/icon/xl/youtube.svg')) !!}
                    </a>
                    <a class="link icon" href="https://www.instagram.com/varta.agpl/" target="_blank"
                       rel="noopener noreferrer" aria-label="Instagram">
                        {!! file_get_contents(public_path('images/svg/icon/xl/instagram.svg')) !!}
                    </a></div>
            </div>
        </div>
    </div>
</footer>
