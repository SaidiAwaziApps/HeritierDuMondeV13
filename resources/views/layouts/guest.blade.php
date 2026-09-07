<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $identite->nom }}</title>


    <!-- =========================================
         BOOTSTRAP
    ========================================== -->

    <link
        href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css') }}"
    >

    <!-- Font Awesome -->

    <link
        rel="stylesheet"
        href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}"
    >

    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>


    <style>

        /* =========================================
           1. VARIABLES
        ========================================== */

        :root {

            --green: #16805c;

            --white: #ffffff;

            --text: #222222;

            --border: #dddddd;

            --footer: #f5f5f5;

        }


        /* =========================================
           2. RESET
        ========================================== */

        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

        }


        /* =========================================
           3. BODY
        ========================================== */

        body {

            font-family: Arial, sans-serif;

            color: var(--text);

            background-color: var(--white);

            transition:
                background-color 0.3s ease,
                color 0.3s ease;

        }


        /* =========================================
           4. HEADER
        ========================================== */

        .header {

            width: 100%;

            background-color: var(--white);

            color: var(--text);

            border-bottom: 1px solid var(--border);

        }


        /* =========================================
           5. NAVBAR
        ========================================== */

        .navbar {

            min-height: 70px;

            padding-left: 20px;

            padding-right: 20px;

        }


        .navbar > .container-fluid {

            width: 100%;

            display: flex;

            align-items: center;

            position: relative;

        }


        /* =========================================
           6. LOGO
        ========================================== */

        .logo {

            display: inline-block;

            flex-shrink: 0;

            overflow: hidden;

            border-radius: 50%;

        }


        .logo img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            object-position: center;

            display: block;

            border-radius: 50%;

        }


        .navbar .logo {

            width: 120px;

            height: 60px;

        }


        /* =========================================
           7. MENU PRINCIPAL
        ========================================== */

        .navbar-collapse {

            flex-grow: 0;

        }


        .navbar-nav {

            gap: 15px;

        }


        /* =========================================
           8. MENU CENTRE - GRAND ECRAN
        ========================================== */

        @media (min-width: 992px) {

            .navbar-collapse {

                position: absolute;

                left: 50%;

                transform: translateX(-50%);

                width: max-content;

                display: flex !important;

                align-items: center;

            }


            .navbar-nav {

                margin: 0 !important;

                display: flex;

                align-items: center;

                justify-content: center;

            }


            .navbar-nav > .nav-item:not(:last-child)::after {

                content: "";

                position: absolute;

                top: 50%;

                right: -8px;

                transform: translateY(-50%);

                width: 1px;

                height: 20px;

                background-color: var(--border);

            }


            .navbar-nav > .nav-item {

                position: relative;

            }

        }


        /* =========================================
           9. LIENS DU MENU
        ========================================== */

        .navbar .nav-link {

            position: relative;

            color: var(--text);

            font-family: italic;

            font-size: 17px;

            padding: 10px 0 !important;

            text-decoration: none !important;

            transition: 0.3s;

            white-space: nowrap;

        }


        .navbar .nav-link > i:first-child {

            margin-right: 6px;

            font-size: 14px;

        }


        .navbar .nav-link:hover {

            color: var(--green);

            font-weight: bold;

        }


        /* =========================================
           10. SOULIGNEMENT MENU
        ========================================== */

        .navbar .nav-link::before {

            content: "";

            position: absolute;

            left: 0;

            bottom: 2px;

            width: 0;

            height: 2px;

            background-color: var(--green);

            transition: width 0.3s ease;

        }


        .navbar .nav-link:hover::before {

            width: 100%;

        }


        /* =========================================
           11. OFFRES & SERVICES
        ========================================== */

        .dropdown-toggle::after {

            display: none;

        }


        .navbar .nav-item.dropdown > .nav-link {

            color: var(--text);

            transition: 0.3s;

        }


        .navbar .nav-item.dropdown > .nav-link:hover {

            color: var(--green);

            font-weight: bold;

        }


        .navbar .nav-item.dropdown > .nav-link::before {

            content: "";

            position: absolute;

            left: 0;

            bottom: 2px;

            width: 0;

            height: 2px;

            background-color: var(--green);

            transition: width 0.3s ease;

        }


        .navbar .nav-item.dropdown > .nav-link:hover::before {

            width: 100%;

        }


        .dropdown-toggle i {

            margin-left: 5px;

            font-size: 12px;

            transition: 0.3s;

        }


        .dropdown-toggle.show i.bi-chevron-down {

            transform: rotate(180deg);

        }


        /* =========================================
           12. SOUS-MENU
        ========================================== */

        .dropdown-menu {

            min-width: 220px;

            padding: 8px;

            margin-top: 10px !important;

            background-color: var(--white);

            border: 1px solid var(--border);

            border-radius: 8px;

            box-shadow:
                0 5px 15px rgba(0, 0, 0, 0.10);

        }


        .dropdown-menu .dropdown-item {

            padding: 10px;

            color: var(--text);

            border-radius: 5px;

            font-size: 14px;

            text-decoration: none;

            transition:
                color 0.3s ease,
                background-color 0.3s ease;

        }


        .dropdown-menu .dropdown-item i {

            width: 20px;

            margin-right: 6px;

            font-size: 14px;

            text-align: center;

        }


        .dropdown-menu .dropdown-item:hover {

            color: white;

            background-color: var(--green);

        }


        .dropdown-menu .dropdown-item:focus {

            color: white;

            background-color: var(--green);

        }


        /* =========================================
           13. ACTIONS A DROITE
        ========================================== */

        .navbar-actions {

            display: flex;

            align-items: center;

            justify-content: flex-end;

            gap: 8px;

            margin-left: auto;

            flex-shrink: 0;

        }


        /* =========================================
           14. HAMBURGER
        ========================================== */

        .navbar-toggler {

            margin: 0;

            flex-shrink: 0;

        }


        /* =========================================
           15. DARK MODE
        ========================================== */

        #dark-mode {

            display: none;

        }


        .theme-container {

            display: flex;

            align-items: center;

            margin: 0;

            padding: 0;

        }


        .theme-button {

            width: 40px;

            height: 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid var(--border);

            border-radius: 50%;

            cursor: pointer;

            color: var(--text);

            font-size: 18px;

            transition: 0.3s;

        }


        .theme-button:hover {

            color: white;

            background-color: var(--green);

            border-color: var(--green);

            transform: rotate(10deg);

        }


        .theme-button .sun {

            display: block;

        }


        .theme-button .moon {

            display: none;

        }


        #dark-mode:checked ~ .theme-button .sun {

            display: none;

        }


        #dark-mode:checked ~ .theme-button .moon {

            display: block;

        }


        /* =========================================
           16. DARK MODE DU SITE
        ========================================== */

        body:has(#dark-mode:checked) {

            --white: #111827;

            --text: #f5f5f5;

            --border: #374151;

            --footer: #0f172a;

        }


        body:has(#dark-mode:checked) .header {

            background-color: var(--white);

            color: var(--text);

        }


        body:has(#dark-mode:checked) .content {

            background-color: var(--white);

            color: var(--text);

        }


        body:has(#dark-mode:checked) footer {

            background-color: var(--footer);

            color: var(--text);

        }


        /* =========================================
           17. CONTENU
        ========================================== */

        .content {

            min-height: 500px;

            padding: 100px 20px;

            text-align: center;

            background-color: var(--white);

            color: var(--text);

        }


        .content h1 {

            margin-bottom: 20px;

            font-size: 40px;

        }


        .content p {

            line-height: 1.6;

        }


        /* =========================================
           18. FOOTER
        ========================================== */

        footer {

            width: 100%;

            background-color: var(--footer);

            color: var(--text);

            border-top: 1px solid var(--border);

            transition: 0.3s;

            font-family: italic;

        }


        /* =========================================
           19. FOOTER CONTENT
        ========================================== */

        .footer-content {

            width: 100%;

            padding: 20px 20px 20px;

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 20px;

        }


        /* =========================================
           20. DESCRIPTION
        ========================================== */

        .platform-description {

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;

            width: 100%;

            margin-left: 0;

            font-family: italic;

        }


        .platform-description > .logo {

            display: block;

            width: 160px;

            height: 160px;

            margin-left: auto;

            margin-right: auto;

            margin-bottom: 20px;

        }


        .platform-description > .logo img {

            width: 100%;

            height: 100%;

            object-fit: contain;

            object-position: center;

            border-radius: 50%;

            display: block;

        }


        /* =========================================
           21. DESCRIPTION TEXTE
        ========================================== */

        .platform-description p {

            width: 100%;

            max-width: 400px;

            margin: 0;

            text-align: justify;

            line-height: 1.6;

            font-size: 14px;

            font-family: italic;

        }


        /* =========================================
           22. RESEAUX SOCIAUX
        ========================================== */

        .platform-socials {

            width: 100%;

            margin: 0;

            font-family: italic;

        }


        @media all and (min-width: 850px) {

            .platform-socials {

                padding-left: 10px;

            }

        }


        .platform-socials h6 {

            position: relative;

            display: inline-block;

            margin-bottom: 20px;

            padding-bottom: 8px;

            color: var(--green);

            font-size: 18px;

            font-weight: bold;

            font-family: italic;

        }


        .platform-socials h6::after {

            content: "";

            position: absolute;

            left: 0;

            bottom: 0;

            width: 45px;

            height: 3px;

            background-color: var(--green);

            border-radius: 3px;

        }


        .platform-socials ul {

            list-style: none;

            margin: 0;

            padding: 0;

        }


        .platform-socials li {

            margin-bottom: 0;

            padding: 7px 0;

            border-bottom: 1px solid rgba(128, 128, 128, 0.15);

        }


        .platform-socials li:last-child {

            border-bottom: none;

        }


        /*
         * Liens sociaux :
         * couleur légèrement différente du texte
         * pour les identifier comme des liens.
         */

        .platform-socials a {

            display: inline-flex;

            align-items: center;

            gap: 10px;

            width: fit-content;

            color: #3f5f55;

            font-size: 15px;

            font-family: italic;

            text-decoration: none;

            cursor: pointer;

            position: relative;

            transition:
                color 0.3s ease,
                transform 0.3s ease;

        }


        /* Petit soulignement discret */

        .platform-socials a::after {

            content: "";

            position: absolute;

            left: 30px;

            bottom: -2px;

            width: 0;

            height: 1px;

            background-color: var(--green);

            transition: width 0.3s ease;

        }


        .platform-socials a:hover {

            color: var(--green);

            transform: translateX(4px);

        }


        .platform-socials a:hover::after {

            width: calc(100% - 30px);

        }


        .platform-socials a i {

            width: 20px;

            text-align: center;

            font-size: 18px;

            transition: 0.3s;

        }


        /* Couleurs spécifiques des icônes */

        .platform-socials li:nth-child(1) a i {

            color: #1877f2;

        }


        .platform-socials li:nth-child(2) a i {

            color: #1da1f2;

        }


        .platform-socials li:nth-child(3) a i {

            color: #0a66c2;

        }


        .platform-socials li:nth-child(4) a i {

            color: #e4405f;

        }


        /* =========================================
           23. CONTACTS
        ========================================== */

        .platform-contacts {

            width: 100%;

            margin: 0;

            font-family: italic;

        }


        @media all and (min-width: 850px) {

            .platform-contacts {

                padding-left: 10px;

            }

        }


        .platform-contacts h6 {

            position: relative;

            display: inline-block;

            margin-bottom: 20px;

            padding-bottom: 8px;

            color: var(--green);

            font-size: 18px;

            font-weight: bold;

            font-family: italic;

        }


        .platform-contacts h6::after {

            content: "";

            position: absolute;

            left: 0;

            bottom: 0;

            width: 45px;

            height: 3px;

            background-color: var(--green);

            border-radius: 3px;

        }


        .platform-contacts ul {

            list-style: none;

            margin: 0;

            padding: 0;

        }


        .platform-contacts li {

            display: flex;

            align-items: flex-start;

            gap: 8px;

            margin-bottom: 0;

            padding: 7px 0;

            color: var(--text);

            font-size: 15px;

            font-family: italic;

            line-height: 1.5;

            border-bottom: 1px solid rgba(128, 128, 128, 0.15);

        }


        .platform-contacts li:last-child {

            border-bottom: none;

        }


        .platform-contacts li span {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            color: var(--text);

            font-size: 16px;

            font-weight: bold;

            font-family: italic;

            white-space: nowrap;

        }


        .platform-contacts li span i {

            font-size: 17px;

        }


        /* Couleurs spécifiques des contacts */

        .platform-contacts li:nth-child(1) span i {

            color: #ea4335;

        }


        .platform-contacts li:nth-child(2) span i {

            color: #25d366;

        }


        .platform-contacts li:nth-child(3) span i {

            color: #16805c;

        }


        /* =========================================
           24. COPYRIGHT
        ========================================== */

        .platform-copyright {

            grid-column: 1 / -1;

            width: 100%;

            padding-top: 20px;

            border-top: 1px solid var(--border);

            text-align: center;

            font-size: 13px;

            font-family: italic;

        }


        /* =========================================
           25. TABLETTE
        ========================================== */

        @media (max-width: 991px) {

            .navbar-nav {

                gap: 0;

                margin-top: 15px;

            }


            .navbar .nav-link {

                width: 100%;

                padding: 12px 5px !important;

            }


            .navbar-collapse {

                width: 100%;

                flex-basis: 100%;

                order: 3;

            }


            .navbar-nav .nav-item {

                border-bottom: 1px solid var(--border);

            }


            .navbar-nav .nav-item:last-child {

                border-bottom: none;

            }


            .navbar-nav > .nav-item > .nav-link:hover {

                color: white;

                background-color: var(--green);

                font-weight: bold;

            }


            .navbar-nav > .nav-item > .nav-link:hover::before {

                width: 0;

            }


            .dropdown-menu {

                margin-top: 0 !important;

                border: none;

                box-shadow: none;

                padding-left: 15px;

                background-color: transparent;

            }


            .dropdown-menu .dropdown-item {

                border-radius: 5px;

            }


            .dropdown-menu .dropdown-item:hover {

                color: white;

                background-color: var(--green);

            }


            .navbar-actions {

                margin-left: auto;

                margin-right: 0;

                gap: 8px;

                order: 2;

            }


            .theme-container {

                order: 1;

            }


            .navbar-toggler {

                order: 2;

            }


            .footer-content {

                grid-template-columns: 1fr 1fr;

                gap: 20px;

            }


            .platform-description {

                grid-column: 1 / -1;

                width: 100%;

                margin-left: 0;

                padding-left: 4px;

            }


            .platform-description p {

                max-width: 350px;

            }


            .platform-copyright {

                grid-column: 1 / -1;

            }

        }


        /* =========================================
           26. PETITS ECRANS
        ========================================== */

        @media (max-width: 575px) {

            .navbar {

                padding-left: 15px;

                padding-right: 15px;

            }


            .navbar > .container-fluid {

                width: 100%;

                display: flex;

                align-items: center;

                flex-wrap: wrap;

            }


            /* Logo */

            .navbar > .container-fluid > .logo {

                width: 120px;

                height: 50px;

            }


            .navbar > .container-fluid > .logo img {

                width: 100%;

                height: 100%;

                object-fit: contain;

                object-position: center;

            }


            /* Actions à droite */

            .navbar-actions {

                margin-left: auto;

                margin-right: 0;

                display: flex;

                align-items: center;

                justify-content: flex-end;

                gap: 8px;

                flex-shrink: 0;

            }


            /* Dark Mode */

            .theme-container {

                order: 1;

                margin: 0;

                padding: 0;

            }


            .theme-button {

                width: 36px;

                height: 36px;

                font-size: 16px;

            }


            /* Hamburger */

            .navbar-toggler {

                order: 2;

                margin: 0;

                padding: 6px 8px;

            }


            /* Menu ouvert */

            .navbar-collapse {

                width: 100%;

                flex-basis: 100%;

                order: 3;

                margin-top: 10px;

            }


            .navbar-nav {

                width: 100%;

                margin-top: 0;

                gap: 0;

            }


            /* Contenu */

            .content {

                padding: 70px 20px;

            }


            .content h1 {

                font-size: 30px;

            }


            /* Footer */

            .footer-content {

                grid-template-columns: 1fr;

                padding: 10px;

                gap: 20px;

            }


            /* Description */

            .platform-description {

                grid-column: 1;

                width: 100%;

                margin-left: 0;

                padding-left: 0;

                padding-bottom: 10px;

                border-bottom: 1px solid var(--border);

            }


            .platform-description > .logo {

                width: 160px;

                height: 160px;

                margin-bottom: 20px;

            }


            .platform-description p {

                max-width: none;

            }


            /* Réseaux sociaux */

            .platform-socials {

                grid-column: 1;

                width: 100%;

                margin: 0;

                padding-bottom: 10px;

                border-bottom: 1px solid var(--border);

            }


            /* Contacts */

            .platform-contacts {

                grid-column: 1;

                width: 100%;

                margin: 0;

            }


            .platform-contacts li {

                font-size: 14px;

            }


            .platform-contacts li span {

                font-size: 15px;

            }


            /* Copyright */

            .platform-copyright {

                grid-column: 1;

                width: 100%;

                margin: 0;

            }

        }

    </style>

</head>


<body>


    <!-- =========================================
         HEADER
    ========================================== -->

    <header class="header">

        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid">


                <!-- Logo -->

                <a
                    href="{{ Storage::url($identite->logo) }}"
                    class="logo"
                    title="{{ $identite->nom }}"
                >

                    <img
                        src="{{ Storage::url($identite->logo) }}"
                        alt="Logo {{ $identite->nom }}"
                    >

                </a>


                <!-- Menu principal -->

                <div
                    class="collapse navbar-collapse"
                    id="mainMenu"
                >

                    <ul class="navbar-nav mx-auto">


                        <!-- Accueil -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="Accueil"
                            >

                                <i class="fa fa-home"></i>

                                Accueil

                            </a>

                        </li>


                        <!-- À propos -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="À propos"
                            >

                                <i class="fa fa-info-circle"></i>

                                À propos

                            </a>

                        </li>


                        <!-- Bénévoles -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="Bénévoles"
                            >

                                <i class="fa fa-users"></i>

                                Bénévoles

                            </a>

                        </li>


                        <!-- Besoin -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="Besoin"
                            >

                                <i class="fa fa-hand-paper-o"></i>

                                Besoin

                            </a>

                        </li>


                        <!-- Événement -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="Événement"
                            >

                                <i class="fa fa-calendar"></i>

                                Événement

                            </a>

                        </li>


                        <!-- Blog -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="Blog"
                            >

                                <i class="fa fa-pencil"></i>

                                Blog

                            </a>

                        </li>


                        <!-- Contact -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                                title="Contact"
                            >

                                <i class="fa fa-envelope"></i>

                                Contact

                            </a>

                        </li>


                        <!-- Offres & Services -->

                        <li class="nav-item dropdown">

                            <a
                                href="#"
                                class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                title="Offres & Services"
                            >

                                <i class="fa fa-briefcase"></i>

                                Offres & Services

                                <i class="bi bi-chevron-down"></i>

                            </a>


                            <!-- Sous-menu -->

                            <ul class="dropdown-menu">


                                <!-- Services -->

                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                        title="Services"
                                    >

                                        <i class="fa fa-cogs"></i>

                                        Services

                                    </a>

                                </li>


                                <li class="dropdown-divider"></li>


                                <!-- Faire un don -->

                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                        title="Faire un don"
                                    >

                                        <i class="fa fa-heart"></i>

                                        Faire un don

                                    </a>

                                </li>


                                <li class="dropdown-divider"></li>


                                <!-- Appels d'offres -->

                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                        title="Appels d'offres"
                                    >

                                        <i class="fa fa-bullhorn"></i>

                                        Appels d'offres

                                    </a>

                                </li>


                                <li class="dropdown-divider"></li>


                                <!-- Offres d'emploi -->

                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                        title="Offres d'emploi"
                                    >

                                        <i class="fa fa-briefcase"></i>

                                        Offres d'emploi

                                    </a>

                                </li>

                            </ul>

                        </li>

                    </ul>

                </div>


                <!-- Actions à droite -->

                <div class="navbar-actions">


                    <!-- Dark Mode -->

                    <div class="theme-container">

                        <input
                            type="checkbox"
                            id="dark-mode"
                        >

                        <label
                            for="dark-mode"
                            class="theme-button"
                            aria-label="Activer le mode sombre"
                            title="Activer / Désactiver le mode sombre"
                        >

                            <span class="sun">
                                ☀
                            </span>

                            <span class="moon">
                                ☾
                            </span>

                        </label>

                    </div>


                    <!-- Hamburger -->

                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#mainMenu"
                        aria-controls="mainMenu"
                        aria-expanded="false"
                        aria-label="Afficher le menu"
                        title="Afficher le menu"
                    >

                        <span class="navbar-toggler-icon"></span>

                    </button>

                </div>

            </div>

        </nav>

    </header>


    <!-- =========================================
         CONTENU
    ========================================== -->

    <main class="content">

        <h1>
            Plateforme Humanitaire
        </h1>

        <p>
            Ensemble pour une action humanitaire
            plus solidaire.
        </p>

        <div class="content-wrapper">

            @yield('content')

        </div>

    </main>


    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer>

        <div class="footer-content">


            <!-- Description -->

            <div class="platform-description">

                <a
                    href="{{ Storage::url($identite->logo) }}"
                    class="logo"
                    title="{{ $identite->nom }}"
                >

                    <img
                        src="{{ Storage::url($identite->logo) }}"
                        alt="Logo {{ $identite->nom }}"
                    >

                </a>

                <p>

                    {{ $identite->description }}

                </p>

            </div>


            <!-- Réseaux sociaux -->

            <div class="platform-socials">

                <h6>
                    Réseaux sociaux
                </h6>

                <ul>

                    <li>

                        <a
                            href="{{ $identite->sociaux->facebook }}"
                            title="Facebook"
                            target="_blank"
                            rel="noopener noreferrer"
                        >

                            <i class="fa fa-facebook"></i>

                            Facebook

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ $identite->sociaux->twitter }}"
                            title="Twitter"
                            target="_blank"
                            rel="noopener noreferrer"
                        >

                            <i class="fa fa-twitter"></i>

                            Twitter

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ $identite->sociaux->linkedIn }}"
                            title="LinkedIn"
                            target="_blank"
                            rel="noopener noreferrer"
                        >

                            <i class="fa fa-linkedin"></i>

                            LinkedIn

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ $identite->sociaux->instagram }}"
                            title="Instagram"
                            target="_blank"
                            rel="noopener noreferrer"
                        >

                            <i class="fa fa-instagram"></i>

                            Instagram

                        </a>

                    </li>

                </ul>

            </div>


            <!-- Contacts -->

            <div class="platform-contacts">

                <h6>
                    Contacts
                </h6>

                <ul>

                    <li>

                        <span>

                            <i class="fa fa-envelope"></i>

                            Email:

                        </span>

                        {{ $identite->email }}

                    </li>


                    <li>

                        <span>

                            <i class="fa fa-phone"></i>

                            Téléphone :

                        </span>

                        {{ $identite->tel }}

                    </li>


                    <li>

                        <span>

                            <i class="fa fa-home"></i>

                            Adresse :

                        </span>

                        {{ $identite->adresse }}

                    </li>

                </ul>

            </div>


            <!-- Copyright -->

            <div class="platform-copyright">

                © 2026 {{ $identite->nom }}.

                Tous droits réservés.

                <br>

                Designed by Saidi / Skynet-Burundi

            </div>


        </div>

    </footer>


    <!-- =========================================
         BOOTSTRAP JS
    ========================================== -->

    <script
        src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>


</body>

</html>
