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
        body {
            padding: 0px;
            margin: 0px;
        }

        div#navigation {
            padding: 10px 10px 10px 10px;
            height: 60px;
            width: 100%;
            position: fixed;
            /* background-color: cadetblue; */
            z-index: 999;
            top: 0px;
            left: 0px;
            background-color: #2e4053;
            /* box-shadow: 0px 0px 0px 0px #f8f8ff; */
        } 

        div#navigation #navbar {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
            width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }

        @media all and (max-width: 700px) { 
            div#navigation #navbar{
                padding-left: 6px;
            }
        }

        div#navbar #navbar_logo_collapse_button {
            display: flex;
            justify: space-between;
            flex-wrap: nowrap;        
        }

        div#navbar #navbar_logo_collapse_button > div {
            margin-left: 4px;
        }
        
        div#navbar_logo_collapse_button #navbar_logo {
            display: flex;
            justify-content: space-between;
            height: 40px; 
            line-height: 20px;
            border-radius: 14px;    
        }

        div#navbar_logo_collapse_button #navbar_logo img {
            width: auto;
        }

        div#navbar_logo_collapse_button #navbar_text {
            line-height: 40px;
        }

        div#navbar_logo_collapse_button #navbar_text span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
            color: white;
        }

        div#navbar_logo_collapse_button #navbar_logo img {
            border-radius: 5px;
        }


        div#navbar_logo_collapse_button #navbar_collapse {
            display: none;
        }

        div#navbar_logo_collapse_button #navbar_collapse button  {
            color: white;
            font-size: 22px;
            font-weight: bold;
            font-family: italic;
        }


        div#navbar #navbar_social_menu {
            margin-left: -40px;
        }

        @media all and (max-width: 700px) {
            div#navbar_logo_collapse_button #navbar_logo,
            div#navbar_logo_collapse_button #navbar_text {
                display: none;
            }

            div#navbar_logo_collapse_button #navbar_collapse {
                display: block;
            }   
        }



        div#navbar #navbar_social_menu ul li {
           float: left;
           margin-left: 20px; 
           list-style-type: none;
           line-height: 40px;
        }

        div#navbar_social_menu ul li a:hover {
           opacity: 0.4;    
        }



        div#navbar_user_menu ul > li {
            /* padding: 4px; */
            line-height: 34px;
            list-style-type: none;
        }

        div#navbar_user_menu ul > li a {
            text-decoration: none;
            color: white;
        }

        div#navbar_user_menu ul:nth-child(1) > li:nth-child(1) a span {
            font-size: 17px;
            font-family: italic;
        }

        /* div#navbar_user_menu ul  li > ul {
            margin-right: 120px;
        } */

        div#navbar_user_menu ul  li > ul  li:nth-child(1) {
            font-weight: bold; 
        }

        div#navbar_user_menu ul  li > ul  li:nth-child(2n+3) {
            margin-left: 6px;
            margin-right: 6px;
            font-weight: normal;
        }

        div#navbar_user_menu ul > li > ul li a {
           font-size: 14px;
           font-family: italic;
           color: black;  
           cursor: pointer;
        }

        div#navbar_user_menu ul > li > ul li:nth-child(1),
        div#navbar_user_menu ul > li > ul li:nth-child(7) {
            text-align: center;
            padding: 1px;
        }

        div#navbar_user_menu ul > li > ul li:nth-child(7) {
            padding-left: 2px;
            padding-right: 2px;
        }

        @media all and (max-width: 700px) {
            div#navbar_user_menu > ul:nth-child(1) > li:nth-child(1) > a:nth-child(1) span {
                display: none;
            }
        }



        /********** Sidebar ***********/
        div#sidebar {
            position: relative;
            top: 2px;
            left: 0px;
            width: 24%;
            height: 560px;
            padding: 0px 2px 10px 2px;
            transition: all 4s linear;
            background-color: white;
            overflow: auto;
            scrollbar-width: thin;
        }

        /* @media all and (min-width: 700px) {
            div#sidebar {
                padding-right: 10px;
                border-right: 2px solid #f8f8ff;
            }
        } */

        @media all and (max-width: 700px) {
            div#sidebar {
                position: fixed;
                top: 2px;
                left: 0px;
                width: 96%;
                height: 100vh;
                z-index: 1000;
                padding-top: 1px;
                border-radius: 6px;
                display: none;
            }    
        }


        div#sidebar_logo_dismiss {
            display: none;
        }

        div#sidebar_logo_title {
            text-align: center;
        }

        div#sidebar_logo_title img {
            width: 60px;
            height: 60px;
        }

        div#sidebar_logo_title span {
            font-size: 20px;
            font-family: italic;
        }

        div#sidebar_dismiss {
            padding: 0px 6px 0px 24px;
            margin-bottom: 0px;
        }

        @media all and (max-width: 700px) {
            div#sidebar_logo_dismiss {
                display: flex;
                justify-content: space-between;
                flex-wrap: nowrap;
                padding: 22px 8px 0px 8px;
            }
        }

        div#sidebar_dismiss button {
            float: right;
            margin-right: 2px;
        }

        div#sidebar_dismiss button span {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
        }



        div#sidebar_admin {
            margin-top: 0px;
            padding-top: 0px;
        }

        @media all and (max-width: 700px) {
            div#sidebar_admin {
                margin-top: 6px;
                padding-top: 10px;
                padding-left: 24px;
                padding-right: 24px;
                border-top: 1px solid cadetblue;
            }
        }

        div#sidebar_admin > div div#profil_img,
        div#sidebar_admin > div div#profil_nom,
        div#sidebar_admin > div div#profil_qualification {
            text-align: center;
        }

        div#sidebar_admin > div div#profil_img img {
            width: 111px;
            height: 111px;
        }

        @media all and (max-width: 700px) {
            div#sidebar_admin > div div#profil_img img {
                width: 120px;
                height: 120px;
            }
        }

        div#sidebar_admin > div div#profil_nom span {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
        }


        div#sidebar_admin > div div#profil_qualification {
            padding-top: 2px;
            border-top: 1px solid #f8f8ff;
        }

        div#sidebar_admin > div div#profil_qualification span {
           display: block;
           padding: 6px;
           text-align: center;
           font-size: 16px;
           /* //font-weight: bold; */
           font-family: italic;
           border-radius: 4px;
           background-color:  #2e4053;
           color: white;    
        }

        @media all and (max-width: 700px) {
            div#sidebar_admin > div div#profil_qualification {
                margin-top: 6px;
            }  
        }


        div#sidebar_menu {
            margin-top: 16px;
            padding-left: 24px;
            padding-right: 24px;
        }


        @media all and (max-width: 700px) {
            div#sidebar_menu {
                margin-top: 16px;
                padding-left: 44px;
                padding-right: 44px;
            }  
        } 

        div#sidebar_menu li {
            display: block;
            margin-top: 6px;
        }

        div#sidebar_menu li a {
            display: block;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
            color: black;
            padding: 4px 10px 6px 20px;
            border-bottom: 2px solid #F8F8FF;
            border-radius: 8px;
        }


        @media all and (max-width: 700px) {
            div#sidebar_menu li a {
                padding: 10px 10px 6px 20px;
            }
        }

        div#sidebar_menu li a:hover {
            background-color: cadetblue;
            color: white;
            border-radius: 2px;
        }

        div#sidebar_menu li a i {
            opacity: 0.5;
        }

        div#sidebar_menu li a span {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            color: black;
        }



        div#content_wrapper {
            position: absolute;
            left: 26%;
            width: 73%;
            top: 68px;
        }

        @media all and (max-width: 700px) {
            div#content_wrapper {
                position: relative;
                left: 0px;
                padding: 4px 14px 10px 14px;
                width: 100%;
            }
        }

    </style>
</head>
<body>
    <div id="navigation">
        <div id="navbar">
            <div id="navbar_logo_collapse_button">
                <div id="navbar_logo">
                    <img src="{{ Storage::url($identite->logo) }}" alt="" id="logo_img" style="width: 100%;height: 100%;" class="cover">
                </div>
                <div id="navbar_text">
                    <span> {{ $identite->nom }}</span>
                </div>
                <div id="navbar_collapse">
                    <button type="button" class="btn btn-default btn-sm" id="collapse_button">
                        <span class="bi bi-list"></span>
                    </button>
                </div>    
            </div> 
            <!-- fin navbar_logo_collapse_button -->
            <div id="navbar_social_menu">
                <ul>
                    <li>
                        <a href="{{ $identite->sociaux->facebook }}">
                            <i class="bi bi-facebook" style="color: blue;"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->twitter }}">
                            <i class="bi bi-twitter" style="color: #00acee;"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->google }}">
                            <i class="bi bi-google" style="color: #db4a39;"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->instagram }}">
                            <i class="bi bi-instagram" style="color: #C32AA3;"></i>
                        </a>
                    </li>
                </ul>
            </div> 
            <!-- fin navbar_social_menu -->
            <div id="navbar_user_menu">
                <ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ Storage::url($admin->photo) }}" alt="profil" class="rounded-circle" id="user_profil" style="width: 40px;height: 40px;">
                            <span> {{ $admin->nom }} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-item">
                                <img src="{{ Storage::url($admin->photo) }}" alt="profil" class="rounded-circle" id="user_profil" style="width: 24px;height: 24px;"> Options <i class="bi bi-chevron-down"></i>
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
            <!-- fin navbar_user_menu --> 
        </div>
        <!-- fin navbar -->
        <div id="sidebar">
            <div id="sidebar_logo_dismiss">
                <div id="sidebar_logo_title">
                    <img src="{{ Storage::url($identite->logo) }}" alt="" id="logo_img" class="cover">
                    <span>
                        <i>Heritier du Monde</i>
                    </span>
                </div>
                <div id="sidebar_dismiss">
                    <button type="button" class="btn btn-default btn-sm active" id="dismiss_button">
                        <span class="bi bi-x-lg"></span>
                    </button>
                </div>
            </div>
            <div id="sidebar_admin">
                <div id="sidebar_admin_content">
                    <div class="card">
                        <div class="card-body">
                            <div id="profil_img">
                               <img src="{{ Storage::url($admin->photo) }}" alt="" class="rounded-circle" id="admin_profil_img">
                            </div>
                            <div id="profil_nom">
                               <span>{{ $admin->nom }}</span>
                            </div>
                        </div>
                    </div>               
                    <div id="profil_qualification">
                        <span> 
                            <i class="bi bi-person-fill-gear"></i> Admin 
                        </span>
                    </div>
                </div>
            </div>
            <!-- fin sidebar_admin_profil -->
            <div id="sidebar_menu">
                <!-- Only Admin Access -->
                @if(session('user')->hasRole('admin')) 
                <li>
                    <a href="{{ route('dashboard.admin') }}">
                       <i class="fa fa-signal"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('identite.update',['id'=>$identite->id]) }}">
                       <i class="fa fa-globe"></i> Identite
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.list') }}">
                       <i class="fa fa-users"></i> Utilisateurs
                    </a>
                </li>
                @endif

                <!-- User Access -->
                <li>
                    @if(session('user')->hasAccessToRessource('blog','register','allowed')==true || session('user')->hasAccessToRessource('blog','update','allowed')==true || session('user')->hasAccessToRessource('blog','delete','allowed')==true)
                    <a href="{{ route('article.list') }}">
                       <i class="fa fa-blog"></i> Blog
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-blog"></i> Blog
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('benevole','register','allowed')==true || session('user')->hasAccessToRessource('benevole','update','allowed')==true || session('user')->hasAccessToRessource('benevole','delete','allowed')==true)
                    <a href="{{ route('benevole.list') }}">
                       <i class="fa fa-user"></i> Benevole
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-user"></i> Benevole
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('besoin','register','allowed')==true || session('user')->hasAccessToRessource('besoin','update','allowed')==true || session('user')->hasAccessToRessource('besoin','delete','allowed')==true)
                    <a href="{{ route('besoin.list') }}">
                       <i class="fa fa-blog"></i> Besoins
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-blog"></i> Besoins
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('contact','register','allowed')==true || session('user')->hasAccessToRessource('contact','update','allowed')==true || session('user')->hasAccessToRessource('contact','delete','allowed')==true)
                    <a href="#">
                       <i class="fa fa-envelope"></i> Contact
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-envelope"></i> Contact
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('donateur','register','allowed')==true || session('user')->hasAccessToRessource('donateur','update','allowed')==true || session('user')->hasAccessToRessource('donateur','delete','allowed')==true)
                    <a href="{{ route('donateur.list') }}">
                       <i class="fa fa-support"></i> Donateurs
                    </a>
                    @else 
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-support"></i> Donateurs
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('offre_emploie','register','allowed')==true || session('user')->hasAccessToRessource('offre_emploie','update','allowed')==true || session('user')->hasAccessToRessource('offre_emploie','delete','allowed')==true)
                    <a href="{{ route('offre_emploie.list') }}">
                       <i class="fa fa-tasks"></i> Offres Travails
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-tasks"></i> Offres Travails
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('don','register','allowed')==true || session('user')->hasAccessToRessource('don','update','allowed')==true || session('user')->hasAccessToRessource('don','delete','allowed')==true)
                    <a href="{{ route('don.list') }}">
                       <i class="fa fa-support"></i> Dons
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-support"></i> Dons
                    </a>
                    @endif
                </li>
                <li>
                    @if(session('user')->hasAccessToRessource('evenement','register','allowed')==true || session('user')->hasAccessToRessource('evenement','update','allowed')==true || session('user')->hasAccessToRessource('evenement','delete','allowed')==true)
                    <a href="{{ route('evenement.list') }}">
                       <i class="fa fa-calendar"></i> Evenement
                    </a>
                    @else
                    <a href="#" title="Access non autorise" disabled>
                       <i class="fa fa-calendar"></i> Evenement
                    </a>
                    @endif
                </li>
            </div> 
        </div> 
        <!-- fin sidebar -->
    </div>

    <div id="content_wrapper" class="content-wrapper">
        @yield('content') 
    </div>

    <script src="{{ asset('js/app.js') }}"> </script>

    <!-- Script admin.js -->
    <script src="{{ asset('script/layout/admin.js') }}"> </script>

    
</body>
</html>