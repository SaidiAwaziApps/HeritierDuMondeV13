<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement</title>
    <link rel="stylesheet" href="{{ asset('css/image/global/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/upload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/vignette/style.css') }}">

    <style>
        div.card .card-header span.card-title {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        div.card .card-header span.card-title i {
            opacity: 0.4;
        }


        div.card .card-header a {
            float: right;
            font-size: 21px;
            color: black;
            border: 1px solid #ccc;
            padding-left: 6px;
            padding-right: 6px;
            border-radius: 4px;
        }


        div.modal-footer button {
            border: 1px solid #ccc;
        }

        div.modal-footer button span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }



        div#form_content > div > div {
            margin-bottom: 3px;
        }

        div#type_model_bloc {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#type_model_bloc > div {
            width: 49.8%;
        }

        div#periode_date_bloc {
            display: none;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#periode_date_bloc > div {
            width: 49.7%;
        }

        @media all and (max-width: 700px) {
            div#periode_date_bloc > div {
                width: 49.2%;
            }  
        }


        div#submit_bloc {
            margin-top: 4px;
        }

        div#submit_bloc > div button span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
        }

        label {
            font-weight: bold;
            font-family: italic;
        }

        label i[id="required-sign"] {
            color: red;
        }

        input[type="text"],input[type="date"],select[name="type"],select[name="model"],textarea[name="contenu"] {
            border: 1px solid #ccc;
            border-bottom: 3px solid #ccc;
        }
        


        
        .imgs-bloc > .imgs-bloc-context {
            position: fixed;
            top: 72%;
            left: 50%;
            z-index: 1100;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
        }

        @media all and (max-width: 500px) {
            .imgs-bloc > .imgs-bloc-context {
                top: 71%;
                left: 46%;
            }
        }

        @media all and (max-width: 400px) {
            .imgs-bloc > .imgs-bloc-context {
                top: 56%;
                left: 46%;
            }
        }

        @media all and (max-width: 450px) {
            .imgs-bloc > .imgs-bloc-context {
                top: 53%;
                left: 46%;
            }
        }
    </style>

</head>
<body>

    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-calendar" style="opacity: 0.6;"></i> Gestion Evenements
                </span>
                <a href="{{ route('evenement.list') }}" title="List d'evenements">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('evenement.save') }}" enctype="multipart/form-data" id="register_evenement_form">
                    <div id="form_content">
                        @csrf          
                        <!-- Events -->
                        <div id="event_bloc">
                            <div id="titre_bloc">
                                <div class="form-group">
                                    <label for="titre">
                                        Titre:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="titre" id="titre" class="form-control" placeholder="Entrer un titre a l'evenement" maxlength="40" required>
                                </div>
                            </div>
                            <div id="type_model_bloc">
                                <div class="form-group">
                                    <label for="type">
                                        Type:<i id="required-sign">*</i>
                                    </label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="journalier">Journalier</option>
                                        <option value="periodique">Periodique</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="model">
                                        Model:<i id="required-sign">*</i>
                                    </label>
                                    <select name="model" id="model" class="form-control" required>
                                        <option value="">Specifier le model d'evenement</option>
                                        <option value="caricature">Caricature</option>
                                        <option value="culturelle">Culturelle</option>
                                        <option value="sportive">Sportive</option>
                                        <option value="mixed">Mixed</option>
                                        <option value="non defini">Non defini</option>
                                    </select>
                                </div>
                            </div>
                            <div id="date_du_jour_bloc">
                                <div class="form-group">
                                    <label for="date_du_jour">
                                        Date du jour:<i id="required-sign">*</i>
                                    </label>
                                    <input type="date" name="date_du_jour" id="date_du_jour" class="form-control">
                                </div>
                            </div>
                            <div id="periode_date_bloc">
                                <div class="form-group">
                                    <label for="periode_date_debut">
                                        Debut:<i id="required-sign">*</i>
                                    </label>
                                    <input type="date" name="periode_date_debut" id="periode_date_debut" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="periode_date_fin">
                                        Fin:<i id="required-sign">*</i>
                                    </label>
                                    <input type="date" name="periode_date_fin" id="periode_date_fin" class="form-control">
                                </div>
                            </div>
                            <div id="lieu_bloc">
                                <div class="form-group">
                                    <label for="lieu">
                                        Lieu(localisation):<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="lieu" id="lieu" class="form-control" placeholder="Entrer le lieu" maxlength="40" required>
                                </div>
                            </div>
                            <div id="contenu_bloc">
                                <div class="form-group">
                                    <label for="contenu">
                                        Content:<i id="required-sign">*</i>
                                    </label>
                                    <textarea name="contenu" id="contenu" class="form-control" placeholder="Specifier le contenu de l'evenement" cols="30" rows="3" required></textarea>
                                </div>
                            </div>                    
                        </div>
                        

                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block btn-sm active">
                                    <span>
                                        <i class="bi bi-upload"></i> Enregistrer
                                    </span>
                                </button>
                            </div> 
                        </div>
                         

                        <div class="imgs-bloc">
                            <div class="imgs-bloc-context">
                                @include('components.image.global.context')
                            </div>
                            <div class="imgs-bloc-content">
                                @include('components.image.global.content')
                            </div>
                        </div>


                        @if($errors->any())
                        <div class="validator-errors">
                            @foreach($errors->all() as $error)
                            <div class="error-item">
                                {{ $error }}
                            </div>
                            @endforeach 
                        </div>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- script -->
    <script src="{{ asset('script/image/upload/register.js') }}"></script>
    <script src="{{ asset('script/image/vignette/register.js') }}"></script>
    <script src="{{ asset('script/evenement/register.js') }}"></script>
    @endsection
    
</body>
</html>