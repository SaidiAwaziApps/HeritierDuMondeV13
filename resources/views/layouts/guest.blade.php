<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <!-- Responsive -->
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

            background: var(--white);

            transition: 0.3s;

        }


        /* =========================================
           4. HEADER
        ========================================== */

        .header {

            background: var(--white);

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


        /* =========================================
           6. LOGO
        ========================================== */

        .logo {

            display: inline-block;

        }


        .logo img {

            width: 60px;

            height: 60px;

            object-fit: cover;

            border-radius: 50%;

        }


        /* =========================================
           7. MENU PRINCIPAL
        ========================================== */

        .navbar-nav {

            gap: 15px;

        }


        /* =========================================
           8. LIENS DU MENU
        ========================================== */

        .navbar .nav-link {

            position: relative;

            color: var(--text);

            font-size: 14px;

            padding: 10px 0 !important;

            text-decoration: none !important;

            transition: 0.3s;

        }


        .navbar .nav-link:hover {

            color: var(--green);

        }


        /* =========================================
           9. SOULIGNEMENT
        ========================================== */

        .navbar .nav-link::after {

            content: "";

            position: absolute;

            left: 0;

            bottom: 2px;

            width: 0;

            height: 2px;

            background: var(--green);

            transition: width 0.3s ease;

        }


        .navbar .nav-link:hover::after {

            width: 100%;

        }


        /* =========================================
           10. OFFRES & SERVICES
        ========================================== */

        .dropdown-toggle::after {

            display: none;

        }


        .dropdown-toggle i {

            margin-left: 5px;

            font-size: 12px;

            transition: 0.3s;

        }


        .dropdown-toggle.show i {

            transform: rotate(180deg);

        }


        /* =========================================
           11. SOUS-MENU
        ========================================== */

        .dropdown-menu {

            min-width: 220px;

            padding: 8px;

            margin-top: 10px !important;

            background: var(--white);

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

            transition: 0.3s;

        }


        .dropdown-menu .dropdown-item:hover {

            color: white;

            background: var(--green);

        }


        /* =========================================
           12. DARK MODE
        ========================================== */

        #dark-mode {

            display: none;

        }


        .theme-container {

            margin-left: 15px;

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

            font-size: 18px;

            transition: 0.3s;

        }


        .theme-button:hover {

            color: white;

            background: var(--green);

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
           13. DARK MODE DU SITE
        ========================================== */

        body:has(#dark-mode:checked) {

            --white: #111827;

            --text: #f5f5f5;

            --border: #374151;

            --footer: #0f172a;

        }


        /* =========================================
           14. CONTENU
        ========================================== */

        .content {

            min-height: 500px;

            padding: 100px 20px;

            text-align: center;

        }


        .content h1 {

            margin-bottom: 20px;

            font-size: 40px;

        }


        .content p {

            line-height: 1.6;

        }


        /* =========================================
           15. FOOTER
        ========================================== */

        footer {

            width: 100%;

            background: var(--footer);

            color: var(--text);

            border-top: 1px solid var(--border);

            transition: 0.3s;

        }


        .footer-content {

            width: 100%;

            padding: 50px 20px 20px;

            display: grid;

            grid-template-columns: 2fr 1fr 1fr;

            gap: 30px;

        }


        /* =========================================
           16. DESCRIPTION
        ========================================== */

        .platform-description {

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;

            padding: 0;

        }


        /* Logo */

        .platform-description img {

            width: 100px;

            height: 100px;

            object-fit: cover;

            border-radius: 50%;

            margin-bottom: 20px;

        }


        /* Texte */

        .platform-description p {

            width: 100%;

            max-width: 350px;

            margin: 0;

            text-align: justify;

            line-height: 1.6;

            font-size: 14px;

        }


        /* =========================================
           17. RESEAUX SOCIAUX
        ========================================== */

        .platform-socials h6 {

            margin-bottom: 15px;

            color: var(--green);

            font-size: 16px;

        }


        /* =========================================
           18. CONTACTS
        ========================================== */

        .platform-contacts h6 {

            margin-bottom: 15px;

            color: var(--green);

            font-size: 16px;

        }


        /* =========================================
           19. COPYRIGHT
        ========================================== */

        .platform-copyright {

            grid-column: 1 / -1;

            width: 100%;

            padding-top: 20px;

            border-top: 1px solid var(--border);

            text-align: center;

            font-size: 13px;

        }


        /* =========================================
           20. TABLETTE
        ========================================== */

        @media (max-width: 991px) {


            /* Menu */

            .navbar-nav {

                gap: 0;

                margin-top: 15px;

            }


            .navbar .nav-link {

                width: 100%;

                padding: 12px 5px !important;

            }


            /* Dropdown */

            .dropdown-menu {

                margin-top: 0 !important;

                border: none;

                box-shadow: none;

                padding-left: 15px;

                background: transparent;

            }


            /* Dark mode */

            .theme-container {

                margin-left: 0;

                margin-top: 10px;

                margin-bottom: 10px;

            }


            /* Footer */

            .footer-content {

                grid-template-columns: 1fr 1fr;

            }


            .platform-description {

                grid-column: 1 / -1;

            }


            .platform-copyright {

                grid-column: 1 / -1;

            }

        }


        /* =========================================
           21. TELEPHONE
        ========================================== */

        @media (max-width: 575px) {


            /* Navbar */

            .navbar {

                padding-left: 15px;

                padding-right: 15px;

            }


            /* Logo */

            .logo img {

                width: 50px;

                height: 50px;

            }


            /* Dark mode */

            .theme-button {

                width: 36px;

                height: 36px;

                font-size: 16px;

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

                padding: 40px 20px 20px;

                gap: 30px;

            }


            /* Description */

            .platform-description {

                grid-column: 1;

                width: 100%;

            }


            .platform-description p {

                max-width: none;

            }


            /* Réseaux sociaux */

            .platform-socials {

                grid-column: 1;

            }


            /* Contacts */

            .platform-contacts {

                grid-column: 1;

            }


            /* Copyright */

            .platform-copyright {

                grid-column: 1;

                width: 100%;

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


                <!-- =================================
                     LOGO
                ================================== -->

                <a href="/" class="logo">

                    <img
                        src="{{ Storage::url($identite->logo) }}"
                        alt="Logo {{ $identite->nom }}"
                    >

                </a>


                <!-- =================================
                     BOUTON MOBILE
                ================================== -->

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainMenu"
                    aria-controls="mainMenu"
                    aria-expanded="false"
                    aria-label="Afficher le menu"
                >

                    <span class="navbar-toggler-icon"></span>

                </button>


                <!-- =================================
                     MENU PRINCIPAL
                ================================== -->

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
                            >
                                Accueil
                            </a>

                        </li>


                        <!-- À propos -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                À propos
                            </a>

                        </li>


                        <!-- Bénévoles -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Bénévoles
                            </a>

                        </li>


                        <!-- Faire un don -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Faire un don
                            </a>

                        </li>


                        <!-- Besoin -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Besoin
                            </a>

                        </li>


                        <!-- Événement -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Événement
                            </a>

                        </li>


                        <!-- Blog -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Blog
                            </a>

                        </li>


                        <!-- Contact -->

                        <li class="nav-item">

                            <a
                                href="#"
                                class="nav-link"
                            >
                                Contact
                            </a>

                        </li>


                        <!-- =================================
                             OFFRES & SERVICES
                        ================================== -->

                        <li class="nav-item dropdown">

                            <a
                                href="#"
                                class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >

                                Offres & Services

                                <i class="bi bi-chevron-down"></i>

                            </a>


                            <!-- Sous-menu -->

                            <ul class="dropdown-menu">


                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                    >
                                        Services
                                    </a>

                                </li>

                                <li class="dropdown-divider"></li>

                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                    >
                                        Appels d'offres
                                    </a>

                                </li>
                                
                                <li class="dropdown-divider"></li>

                                <li>

                                    <a
                                        href="#"
                                        class="dropdown-item"
                                    >
                                        Offres d'emploi
                                    </a>

                                </li>


                            </ul>

                        </li>


                    </ul>


                    <!-- =================================
                         DARK MODE
                    ================================== -->

                    <div class="theme-container">

                        <input
                            type="checkbox"
                            id="dark-mode"
                        >


                        <label
                            for="dark-mode"
                            class="theme-button"
                            aria-label="Activer le mode sombre"
                        >

                            <span class="sun">
                                ☀
                            </span>

                            <span class="moon">
                                ☾
                            </span>

                        </label>

                    </div>


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


        <!-- Contenu Laravel -->

        <div class="content-wrapper">

            @yield('content')

        </div>

    </main>


    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer>

        <div class="footer-content">


            <!-- =================================
                 DESCRIPTION
            ================================== -->

            <div class="platform-description">


                <!-- Logo -->

                <a
                    href="/"
                    class="logo"
                >

                    <img
                        src="{{ Storage::url($identite->logo) }}"
                        alt="Logo {{ $identite->nom }}"
                    >

                </a>


                <!-- Description -->

                <p>

                    {{ $identite->description }}

                </p>


            </div>


            <!-- =================================
                 RESEAUX SOCIAUX
            ================================== -->

            <div class="platform-socials">

                <h6>
                    Réseaux sociaux
                </h6>

            </div>


            <!-- =================================
                 CONTACTS
            ================================== -->

            <div class="platform-contacts">

                <h6>
                    Contacts
                </h6>

            </div>


            <!-- =================================
                 COPYRIGHT
            ================================== -->

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
