<header class="header">
    <div class="navbar navbar-expand-xl fixed-top">
        <div class="container-fluid">
            <a href="/" aria-label="Varta">
                <img class="logo" src="{{ asset('images/svg/logo.svg') }}" alt="Logo"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <div class="toggler-icon"></div>
            </button>
            <nav id="navbar" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto mt-4 mt-xl-0">
                    <li><a class="nav-link" href="/#nagrody">Nagrody</a></li>
                    <li><a class="nav-link" href="/#wez-udzial">Weź udział</a></li>
                    <li><a class="nav-link" href="/#produkty">Produkty</a></li>
                    <li><a class="nav-link" href="/#partnerzy">Partnerzy</a></li>
                    <li><a class="nav-link" href="/#kontakt">Kontakt</a></li>
                </ul>
                <ul class="navbar-nav flex-row">
                    <li>
                        <a class="nav-link" href="https://www.facebook.com/Varta.AGPL" target="_blank"
                           rel="noopener noreferrer" aria-label="Facebook">
                            {!! file_get_contents(public_path('images/svg/icon/sm/facebook.svg')) !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="https://www.youtube.com/user/vartaconsumer" target="_blank"
                           rel="noopener noreferrer" aria-label="YouTube">
                            {!! file_get_contents(public_path('images/svg/icon/sm/youtube.svg')) !!}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link pr-xl-0 mr-xl-0" href="https://www.instagram.com/varta.agpl/" target="_blank"
                           rel="noopener noreferrer" aria-label="Instagram">
                            {!! file_get_contents(public_path('images/svg/icon/sm/instagram.svg')) !!}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
