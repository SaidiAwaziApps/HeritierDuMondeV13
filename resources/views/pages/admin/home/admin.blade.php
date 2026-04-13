<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}">
    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dependance/highcharts/highcharts.js') }}"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #1e293b;
            color: white;
            padding: 2px 20px;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .logo span {
            font-size: 18px;
            /* font-weight: bold; */
            font-family: italic;
        }

        @media all and (max-width: 500px) {
            .navbar .logo span {
                display: none;
            } 
        }



        .navbar .social-icons i {
            margin: 0 10px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .navbar .social-icons i:hover {
            color: #0ea5e9;
        }



        .navbar .user-info {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
            padding-top: 10px;
        }

        .navbar .user-info img {
            height: 35px;
            width: 35px;
            border-radius: 50%;
            margin-right: 10px;
        } 

        .navbar .user-info span {
            font-size: 18px;
            font-family: italic;
        }
        
        
        .navbar .user-info ul > li {
            /* padding: 4px; */
            line-height: 34px;
            list-style-type: none;
        }

        .navbar .user-info ul > li a {
            text-decoration: none;
            color: white;
        }

        .navbar .user-info ul:nth-child(1) > li:nth-child(1) a span {
            font-size: 17px;
            font-family: italic;
        }

        /* div#navbar_user_menu ul  li > ul {
            margin-right: 120px;
        } */

        .navbar .user-info ul  li > ul  li:nth-child(1) {
            font-weight: bold; 
        }

        .navbar .user-info ul  li > ul  li:nth-child(2n+3) {
            margin-left: 6px;
            margin-right: 6px;
            font-weight: normal;
        }

        .navbar .user-info ul > li > ul li a {
           font-size: 14px;
           font-family: italic;
           color: black;  
           cursor: pointer;
        }

        .navbar .user-info ul > li > ul li:nth-child(1),
        .navbar .user-info ul > li > ul li:nth-child(7) {
            text-align: center;
            padding: 1px;
        }

        .navbar .user-info ul > li > ul li:nth-child(7) {
            padding-left: 2px;
            padding-right: 2px;
        }

        @media all and (max-width: 700px) {
            .navbar .user-info > ul:nth-child(1) > li:nth-child(1) > a:nth-child(1) span {
                display: none;
            }
        }



        section.content {
            margin-top: 10px;
        }


        div.global-content {
            width: 80%;
            margin: 0 auto;
        }

        .content .img-site {
            width: 100%;
        }

        div.img-site-title {
            padding-bottom: 1px;
            margin-bottom: 6px;
            border-bottom: 1px solid #ccc;
        }

        .content .img-site h2 {
            text-align: center;
            /* font-size: 20px; */
            font-weight: bold;
            font-family: italic;
            padding: 6px;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

        .carousel-item {
            height: 320px;
        }

        .carousel-item img {
            border-radius: 4px;
        }



        div.options {
            margin-top: 10px;
        }

        .options-text {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .options-text i {
            margin-left: 0px;
            margin-right: 0px;
        }

        .options-text::before,
        .options-text::after {
            content: "";
            flex: 1;
            border-top: 2px solid #ccc;
            margin: 0 2px;
            
        }

        .options-text span {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.7;
        }

        .options .options-content {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .options-content a[class="content-item"] {
            width: 24%;
            margin-right: 1px; 
            text-decoration: none;
            margin-bottom: 6px;
        }


        @media all and (max-width: 500px) {
            .options .options-content {
                display: block;
            }
            .options-content a[class="content-item"] {
                width: 100%;
                height: 40px;
            } 
            .options-content a[class="content-item"] .card {
               margin-bottom: -16px;
            }
        }

        .options-content a[class="content-item"]:hover {
            opacity: 0.6;
        }

        

        .options-content a[class="content-item"] .card .card-body {
            text-align: center;
        }

        .options-content a[class="content-item"] .card .card-body span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }

        .options-content a[class="content-item"] .card .card-body span i {
            opacity: 0.8;
        }


    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="{{ Storage::url($identite->logo) }}" alt="Logo de l'organisation">
            <span>{{ $identite->nom }}</span>
        </div>

        <div class="social-icons">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-linkedin-in"></i>
        </div>

        <div class="user-info">
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ Storage::url(session('user')->photo) }}" alt="profil" class="rounded-circle" id="user_profil" style="width: 40px;height: 40px;">
                        <span> {{ session('user')->nom }} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item">
                            <img src="{{ Storage::url(session('user')->photo) }}" alt="profil" class="rounded-circle" id="user_profil" style="width: 24px;height: 24px;"> Options <i class="bi bi-chevron-down"></i>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="#">
                                <span>
                                    <i class="bi bi-person-fill-gear"></i> My Profil
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="#">
                                <span>
                                    <i class="bi bi-lock-fill"></i> Password
                                </span>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <div class="d-grid">
                                <a href="#" class="btn btn-default active btn-sm">
                                    <span>
                                        <i class="bi bi-box-arrow-right" style="font-weight: bold;"></i> Logout
                                    </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <section class="content">
        <div class="global-content">
            <div class="img-site">
                <div class="img-site-title">
                    <h2>
                        <i class="fa fa-globe" style="opacity: 0.6;"></i> Images du sites
                    </h2>
                </div>
                <div class="carousel slide" id="carousel" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ Storage::url(session('user')->photo) }}" alt="" class="rounded-thumbnail d-block w-100 cover">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ Storage::url(session('user')->photo) }}" alt="" class="rounded-thumbnail d-block w-100 cover">
                        </div>
                    </div>

                    <button type="button" class="carousel-control-prev"  data-bs-target="#carousel" data-bs-slide="prev">
                        <i class="carousel-control-prev-icon"></i>
                    </button>

                    <button type="button" class="carousel-control-next" data-bs-target="#carousel" data-bs-slide="next">
                        <i class="carousel-control-next-icon"></i>
                    </button>
                </div>
            </div>

            <div class="options">
                <div class="options-text">
                    <span>
                        <i class="fa fa-list"></i> Options menus
                    </span>    
                </div>
                <div class="options-content">
                    <a class="content-item" href="{{ route('dashboard.admin') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-signal">

                                    </i><br>
                                    Dashboard
                                </span>
                            </div>
                        </div>
                    </a>  
                    <a class="content-item" href="{{ route('identite.update',['id'=>1]) }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-globe">

                                    </i><br>
                                    Identite
                                </span>
                            </div>
                        </div>
                    </a>  
                    <a class="content-item" href="{{ route('user.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-users">

                                    </i><br>
                                    Utilisateurs
                                </span>
                            </div>
                        </div>
                    </a>  
                    <a class="content-item" href="{{ route('article.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-blog">

                                    </i><br>
                                    Blog
                                </span>
                            </div>
                        </div>
                    </a> 
                    <a class="content-item" href="{{ route('benevole.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-users">

                                    </i><br>
                                    Benevoles
                                </span>
                            </div>
                        </div>
                    </a> 
                    <a class="content-item" href="{{ route('besoin.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-blog">

                                    </i><br>
                                    Besoins
                                </span>
                            </div>
                        </div>
                    </a>  
                    <a class="content-item" href="#" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-envelope">

                                    </i><br>
                                    Contact
                                </span>
                            </div>
                        </div>
                    </a> 
                    <a class="content-item" href="{{ route('donateur.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-support">

                                    </i><br>
                                    Donateurs
                                </span>
                            </div>
                        </div>
                    </a> 
                    <a class="content-item" href="{{ route('offre_emploie.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-tasks">

                                    </i><br>
                                    Offres emploies
                                </span>
                            </div>
                        </div>
                    </a> 
                    <a class="content-item" href="{{ route('don.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-support">

                                    </i><br>
                                    Dons
                                </span>
                            </div>
                        </div>
                    </a>    
                    <a class="content-item" href="{{ route('evenement.list') }}" title="Cliquer pour acceder au menu">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    <i class="fa fa-calendar">

                                    </i><br>
                                    Evenements
                                </span>
                            </div>
                        </div>
                    </a> 
                </div>
            </div>
        </div>
    </section>

    <!-- Script admin.js -->
    <script src="{{ asset('script/layout/admin.js') }}"> </script>
</body>
</html>