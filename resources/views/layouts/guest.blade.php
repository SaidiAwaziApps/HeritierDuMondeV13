 @php
    function isVideo($path) {
        $extension_array = ['mp4','MP4','mpeg','MPEG','mpeg-2','MPEG-2','avi','AVI','mov','MOV','wmv','WMV','avi','AVI','avchd','AVCHD','flv','FLV','f4v','F4V','swf','SWF','mkv','MKV','webm','WEBM'];
        if(in_array(pathinfo($path,PATHINFO_EXTENSION),$extension_array)) {
            return true;
        } else {
            return false;
        }
    } 
@endphp
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

    <script
        src="{{ asset('dependance/font-awesome/font-awesome.js') }}"
    ></script>


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


        html,
        body {

            width: 100%;

            margin: 0;

            padding: 0;

        }


        html {

            scroll-behavior: smooth;

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

            margin: 0;

            padding: 0;

            background-color: var(--white);

            color: var(--text);

            border-bottom: 1px solid var(--border);

            position: relative;

            z-index: 1000;

        }


        /* =========================================
           5. NAVBAR
        ========================================== */

        .navbar {

            min-height: 70px;

            margin: 0;

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

            position: relative;

            z-index: 1100;

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

                z-index: 1100;

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


        .navbar .nav-item.dropdown {

            position: relative;

            z-index: 1200;

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

            position: absolute !important;

            z-index: 9999 !important;

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

            position: relative;

            z-index: 1100;

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
           17. CAROUSEL
        ========================================== */

        #layouts-carousel {

            position: relative;

            width: 100%;

            height: 500px;

            margin: 0;

            padding: 0;

            overflow: hidden;

            background-color: #000;

            z-index: 1;

        }


        #layouts-carousel .carousel-inner {

            width: 100%;

            height: 100%;

            margin: 0;

            padding: 0;

        }


        #layouts-carousel .carousel-item {

            width: 100%;

            height: 500px;

            margin: 0;

            padding: 0;

        }


        #layouts-carousel .carousel-item img {

            display: block;

            width: 100%;

            height: 100%;

            margin: 0;

            padding: 0;

            object-fit: cover;

            object-position: center;

        }


        /* =========================================
           INDICATEURS
        ========================================== */

        #layouts-carousel .carousel-indicators {

            position: absolute;

            left: 0;

            right: 0;

            bottom: 18px;

            z-index: 10;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            margin: 0;

            padding: 0;

        }


        #layouts-carousel .carousel-indicators button {

            width: 9px;

            height: 9px;

            margin: 0;

            padding: 0;

            border: 0;

            border-radius: 50%;

            background-color: rgba(255, 255, 255, 0.85);

            opacity: 1;

            transition:
                width 0.3s ease,
                background-color 0.3s ease,
                transform 0.3s ease;

        }


        #layouts-carousel .carousel-indicators button.active {

            width: 22px;

            height: 9px;

            border-radius: 10px;

            background-color: var(--green);

            transform: none;

        }


        /* =========================================
           CONTROLES CAROUSEL
        ========================================== */

        #layouts-carousel .carousel-control-prev,
        #layouts-carousel .carousel-control-next {

            width: 46px;

            height: 46px;

            top: 50%;

            bottom: auto;

            transform: translateY(-50%);

            border-radius: 50%;

            background-color: rgba(22, 128, 92, 0.65);

            opacity: 1;

            display: flex;

            align-items: center;

            justify-content: center;

            transition:
                background-color 0.3s ease,
                transform 0.3s ease,
                opacity 0.3s ease;

            z-index: 10;

        }


        #layouts-carousel .carousel-control-prev {

            left: 20px;

        }


        #layouts-carousel .carousel-control-next {

            right: 20px;

        }


        #layouts-carousel .carousel-control-prev:hover,
        #layouts-carousel .carousel-control-next:hover {

            background-color: rgba(22, 128, 92, 0.90);

            opacity: 1;

        }


        #layouts-carousel .carousel-control-prev:hover {

            transform: translateY(-50%) scale(1.08);

        }


        #layouts-carousel .carousel-control-next:hover {

            transform: translateY(-50%) scale(1.08);

        }


        #layouts-carousel .carousel-control-prev-icon,
        #layouts-carousel .carousel-control-next-icon {

            width: 18px;

            height: 18px;

            background-size: 100% 100%;

        }


        /* =========================================
           18. CONTENU
        ========================================== */

        .content {

            width: 100%;

            min-height: 500px;

            margin: 0;

            padding: 0;

            text-align: center;

            background-color: var(--white);

            color: var(--text);

        }


        .content-wrapper {

            width: 100%;

            margin: 0;

            padding-top: 20px;

            padding-bottom: 20px;

            padding-left: 0;

            padding-right: 0;

        }


        /* =========================================
           19. FOOTER
        ========================================== */

        footer {

            width: 100%;

            margin: 0;

            padding: 0;

            background-color: var(--footer);

            color: var(--text);

            border-top: 1px solid var(--border);

            transition: 0.3s;

            font-family: italic;

        }


        /* =========================================
           20. FOOTER CONTENT
        ========================================== */

        .footer-content {

            width: 100%;

            padding: 20px;

            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 20px;

        }


        /* =========================================
           21. DESCRIPTION
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
           22. DESCRIPTION TEXTE
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
           23. RESEAUX SOCIAUX
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
           24. CONTACTS
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
           25. COPYRIGHT
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
           26. BOUTON DE DEFILEMENT
        ========================================== */

        #scroll-button {

            position: fixed;

            right: 25px;

            bottom: 25px;

            width: 48px;

            height: 48px;

            display: flex;

            align-items: center;

            justify-content: center;

            border: 1px solid rgba(255, 255, 255, 0.25);

            border-radius: 50%;

            background-color: rgba(22, 128, 92, 0.75);

            color: var(--white);

            font-size: 20px;

            cursor: pointer;

            opacity: 0;

            visibility: hidden;

            transform: translateY(15px);

            transition:
                opacity 0.3s ease,
                visibility 0.3s ease,
                transform 0.3s ease,
                background-color 0.3s ease,
                box-shadow 0.3s ease;

            z-index: 10000;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.18);

        }


        #scroll-button.show {

            opacity: 1;

            visibility: visible;

            transform: translateY(0);

        }


        #scroll-button:hover {

            background-color: rgba(22, 128, 92, 0.95);

            box-shadow:
                0 6px 18px rgba(0, 0, 0, 0.25);

            transform: translateY(-3px);

        }


        #scroll-button:active {

            transform: translateY(0) scale(0.94);

        }


        #scroll-button i {

            line-height: 1;

            transition: transform 0.3s ease;

        }


        /* =========================================
           27. TABLETTE
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

                position: static !important;

                z-index: 9999 !important;

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


            /* Carousel tablette */

            #layouts-carousel {

                height: 400px;

            }


            #layouts-carousel .carousel-item {

                height: 400px;

            }

        }


        /* =========================================
           28. PETITS ECRANS
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


            /* Carousel mobile */

            #layouts-carousel {

                width: 100%;

                height: 250px;

                margin: 0;

                padding: 0;

            }


            #layouts-carousel .carousel-item {

                height: 250px;

            }


            #layouts-carousel .carousel-indicators {

                bottom: 12px;

                gap: 6px;

            }


            #layouts-carousel .carousel-indicators button {

                width: 7px;

                height: 7px;

            }


            #layouts-carousel .carousel-indicators button.active {

                width: 18px;

                height: 7px;

            }


            /* Boutons carousel mobile */

            #layouts-carousel .carousel-control-prev,
            #layouts-carousel .carousel-control-next {

                width: 38px;

                height: 38px;

            }


            #layouts-carousel .carousel-control-prev {

                left: 10px;

            }


            #layouts-carousel .carousel-control-next {

                right: 10px;

            }


            #layouts-carousel .carousel-control-prev-icon,
            #layouts-carousel .carousel-control-next-icon {

                width: 15px;

                height: 15px;

            }


            /* Contenu */

            .content {

                width: 100%;

                min-height: 400px;

                padding: 0;

                margin: 0;

            }


            .content-wrapper {

                width: 100%;

                padding-top: 20px;

                padding-bottom: 20px;

                padding-left: 0;

                padding-right: 0;

                margin: 0;

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


            /* Bouton de défilement mobile */

            #scroll-button {

                width: 42px;

                height: 42px;

                right: 15px;

                bottom: 15px;

                font-size: 18px;

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


        <!-- =========================================
             CAROUSEL
        ========================================== -->

        <div
            id="layouts-carousel"
            class="carousel slide"
            data-bs-ride="carousel"
            data-bs-interval="7000"
        >


            <!-- Indicateurs -->

            <div class="carousel-indicators">

                @foreach($identite->images as $index => $image)
                <button
                    type="button"
                    data-bs-target="#layouts-carousel"
                    data-bs-slide-to="{{ $index + 1 }}"
                    class="@if($index == 0) active @endif"
                    aria-current="{{ $index == 0 ? true : false }}"
                    aria-label="Slide {{ $index + 1 }}"
                ></button>
                @endforeach
            </div>


            <!-- Images -->

            <div class="carousel-inner">

                <!-- Slide (carousel-item) -->
                @foreach($identite->images as $index => $image) 
                <div class="carousel-item 
                        @if($index == 0) 
                            active 
                        @endif"
                >
                    @if(strtolower($image['img_source']) != 'upload')
                        {!! $image['iframe'] !!}
                    @elseif(isVideo($image['path']))
                        <video autoplay muted loop playsinline width="100%" height="100%">
                            <source src="{{ Storage::url($image['path']) }}">
                        </video>
                    @else
                        <img width="100%" height="100%"
                            src="{{ Storage::url($image['path']) }}"
                            alt="{{ $image['titre'] }}"
                        > 
                    @endif

                </div>
                @endforeach

            </div>


            <!-- Contrôle précédent -->

            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#layouts-carousel"
                data-bs-slide="prev"
                aria-label="Image précédente"
            >

                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>

                <span class="visually-hidden">
                    Précédent
                </span>

            </button>


            <!-- Contrôle suivant -->

            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#layouts-carousel"
                data-bs-slide="next"
                aria-label="Image suivante"
            >

                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>

                <span class="visually-hidden">
                    Suivant
                </span>

            </button>

        </div>


        <!-- =========================================
             CONTENT WRAPPER
        ========================================== -->

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
         BOUTON DE DEFILEMENT
    ========================================== -->

    <button
        id="scroll-button"
        type="button"
        aria-label="Descendre vers le bas"
        title="Descendre vers le bas"
    >

        <i
            id="scroll-button-icon"
            class="bi bi-arrow-down"
            aria-hidden="true"
        ></i>

    </button>


    <!-- =========================================
         BOOTSTRAP JS
    ========================================== -->

    <script
        src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"
    ></script>


    <!-- =========================================
         SCROLL BUTTON JS
    ========================================== -->

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const scrollButton =
                document.getElementById('scroll-button');

            const scrollButtonIcon =
                document.getElementById('scroll-button-icon');


            const scrollThreshold = 40;


            function updateScrollButton() {

                const scrollTop =
                    window.pageYOffset ||
                    document.documentElement.scrollTop;


                const documentHeight =
                    document.documentElement.scrollHeight;


                const windowHeight =
                    window.innerHeight;


                const maxScroll =
                    documentHeight - windowHeight;


                /*
                 * Le bouton apparaît uniquement
                 * lorsqu'on a dépassé 40px.
                 */

                if (scrollTop > scrollThreshold) {

                    scrollButton.classList.add('show');

                } else {

                    scrollButton.classList.remove('show');

                }


                /*
                 * Si on est proche du bas,
                 * le bouton permet de remonter.
                 */

                if (scrollTop >= maxScroll - 40) {

                    scrollButtonIcon.className =
                        'bi bi-arrow-up';

                    scrollButton.setAttribute(
                        'aria-label',
                        'Remonter vers le haut'
                    );

                    scrollButton.setAttribute(
                        'title',
                        'Remonter vers le haut'
                    );

                } else {

                    /*
                     * Sinon, il permet de descendre.
                     */

                    scrollButtonIcon.className =
                        'bi bi-arrow-down';

                    scrollButton.setAttribute(
                        'aria-label',
                        'Descendre vers le bas'
                    );

                    scrollButton.setAttribute(
                        'title',
                        'Descendre vers le bas'
                    );

                }

            }


            scrollButton.addEventListener(
                'click',
                function () {

                    const scrollTop =
                        window.pageYOffset ||
                        document.documentElement.scrollTop;


                    const documentHeight =
                        document.documentElement.scrollHeight;


                    const windowHeight =
                        window.innerHeight;


                    const maxScroll =
                        documentHeight - windowHeight;


                    /*
                     * Si on est en bas :
                     * retour vers le haut.
                     */

                    if (scrollTop >= maxScroll - 40) {

                        window.scrollTo({

                            top: 0,

                            behavior: 'smooth'

                        });

                    } else {

                        /*
                         * Sinon :
                         * descendre d'une hauteur d'écran.
                         */

                        window.scrollBy({

                            top: window.innerHeight * 0.8,

                            behavior: 'smooth'

                        });

                    }

                }
            );


            window.addEventListener(
                'scroll',
                updateScrollButton,
                { passive: true }
            );


            window.addEventListener(
                'resize',
                updateScrollButton
            );


            updateScrollButton();

        });

    </script>


</body>

</html>
