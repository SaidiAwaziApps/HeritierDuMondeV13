<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benevole</title>

    <style>
        h4.card-title {
            /* text-align: center; */
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        h4.card-title i {
            opacity: 0.4;
        }


        div#benevole_info {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#benevole_info > div#profil_bloc {
            width: 30%;
        }

        div#benevole_info > div#meta_bloc {
            width: 69%;
        }

        @media all and (max-width: 500px) {

            div#benevole_info {
                display: block;
            }

            div#benevole_info > div {
                margin-bottom: 6px;
            }

            div#benevole_info > div#profil_bloc {
                width: 100%;
            }

            div#benevole_info > div#meta_bloc {
                width: 100%;
            }
        }

        div#benevole_info > div#profil_bloc > div.card .card-body {
            height: 220px;
        }

        div#benevole_info > div#meta_bloc ul li span {
            font-size: 18px;
            font-family: italic;
        }

        div#benevole_info > div#meta_bloc ul li span:nth-child(1) {
            font-weight: bold;
            margin-right: 2px;
        }

/* 
        div#benevole_info > div#meta_bloc ul li:nth-child(5) {
            text-align: center;
            background-color: #f8f8ff;
        } */

        div#benevole_info > div#meta_bloc ul li:nth-child(5) span:nth-child(3n+1) {
            font-weight: bold; 
        }

        div#benevole_info > div#meta_bloc ul li:nth-child(5) a {
            text-decoration: none;
            margin-right:8px;
        }

        div#benevole_info > div#meta_bloc ul li:nth-child(5) a:hover {
            opacity: 0.4;
        }


        div#don_info {
            margin-top: 20px;
        }

        div#don_info h5 {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            padding-bottom: 6px;
            border-bottom: 2px solid black;
            text-align: center;
            opacity: 0.6;
        }

        div#sociaux_info {
            padding: 18px 0px 6px 0px;
            margin-top: 10px;
            border-radius: 6px;
            background-color: #f8f8ff;
        }

        div#sociaux_info > div {
           display: flex;
           justify-content: center;
           align-items: center;
        }

        div#sociaux_info > div ul li {
            float: left;
            margin-left: 16px;
            list-style-type: none;
        }

        div#sociaux_info > div ul li span {
            font-size: 19px;
            font-family: italic;
        }

        @media all and (max-width: 500px) {
            div#sociaux_info > div ul li {
                margin-left: 20px;
            }
            div#sociaux_info > div ul li span {
              display: none;
            } 
        }

        div#sociaux_info > div ul li a:hover {
            opacity: 0.4;
        }

    </style>
</head>
<body>
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fa fa-plus"></i> Details benevole
                </h4>
            </div>
            <div class="card-body">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Infos content -->
                        <div id="info_content">
                            <div id="benevole_info">
                                <div id="profil_bloc">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ Storage::url($admin->photo) }}" title="Profil {{ $benevole->nom }}">
                                                <img src="{{ Storage::url($admin->photo) }}" alt="Profil {{ $benevole->photo }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                                <div id="meta_bloc">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span>Nom:</span>
                                            <span>{{ $benevole->nom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Postnom:</span>
                                            <span>{{ $benevole->postnom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Prenom:</span>
                                            <span>{{ $benevole->prenom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Email:</span>
                                            <span>{{ $benevole->email }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Pays:</span>
                                            <span>{{ $benevole->pays }}</span> <b>\</b> 
                                            <span>Ville:</span>
                                            <span>{{ $benevole->ville }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- fin benevole_info -->

                            <div id="sociaux_info">
                                <div id="sociaux_info_content">
                                    <ul>
                                        <li>
                                            <span>Contactez sur:</span>
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->facebook }}" title="Facebook">
                                               <i class="bi bi-facebook" style="color: blue;"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->twitter }}" title="Twitter">
                                               <i class="bi bi-twitter" style="color: #00acee;"></i>
                                            </a> 
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->google }}" title="Google+">
                                               <i class="bi bi-google" style="color: #db4a39;"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->instagram }}" title="Instagram">
                                               <i class="bi bi-instagram" style="color: #C32AA3;"></i> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- Fin info content --> 
                    </div>
                </div>
                <!-- Fin card --> 
            </div>
        </div>
    </div>
    @endsection

</body>
</html>