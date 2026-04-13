<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offre Emploie</title>
    <script src="{{ asset('dependance/js/sweetalert.min.js') }}"></script>
    <style>
        div.card .card-header span {
            font-size: 18px;
            /* font-weight: bold; */
            font-family: italic;
        }

        div.card .card-header a {
            font-weight: bold;
            font-family: italic;
            color: black;
            float: right;
            border: 1px solid #ccc;
            border-radius: 2px;
            padding: 2px 4px 2px 4px;
        } 

        div#document_bloc {
            position: fixed;
            top: 62%;
            left: 50%;
            z-index: 1001;
            opacity: 0.8;
        }

        @media all and (max-width: 700px) {
            div#document_bloc {
               top: 36%;
               left: 29%;
            } 
        }

        div#document_bloc > div > #image_bloc {
            width: 100%;
            height: 120px;
            text-align: center;
            display: none;
        }

        div#document_bloc > div > #input_bloc label {
            display: block;
            padding: 4px 14px 4px 14px;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
            /* font-weight: bold; */
            font-family: italic;
            color: white;
            background-color: cadetblue;
            cursor: pointer;
        }

        div#document_bloc > div > #input_bloc label:hover {
            opacity: 0.6;
        }

        div#submit_bloc {
            margin-top: 10px;
        }

        div#submit_bloc > .d-grid button span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
        }

        label i[id="required-sign"] {
            color: red;
        }

        input[type="text"],
        input[type="date"],
        textarea[id="object"],
        select[id="domaine"] {
            border-bottom: 2px solid #ccc;
        }


        div#validate_errors_bloc {
            margin-top: 6px;
            text-align: center;
        }

        div#validate_errors_bloc span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
            color: red;
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
                    Offre d'emploie               
                </span>
                <a href="{{ route('offre_emploie.list') }}" title="Afficher la liste">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('offre_emploie.update',['id'=>$offre_emploie->id]) }}" enctype="multipart/form-data">
                    <div id="form_content">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="date_emission">
                                Date:<i id="required-sign">*</i>
                            </label>
                            <input type="date" name="date_emission" id="date_emission" class="form-control" value="{{ $offre_emploie->date_emission }}" required>
                        </div>
                        <div class="form-group">
                            <label for="domaine">
                                Domaine<i id="required-sign">*</i>
                            </label>
                            <select name="domaine" id="domaine" class="form-control" required>
                                <option value="">Specifier un domaine d'employabilte</option>
                                <option value="medecine">Medecine</option>
                                <option value="agronomie">Agronomie</option>
                                <option value="economie">Economie</option>
                                <option value="informatique">Informatique</option>
                                <option value="ingenierie">Ingenierie</option>
                                <option value="esthetique">Esthetique</option>
                                <option value="marketing">Marketing</option>
                                <option value="media">Media</option>
                                <option value="securite">Securite</option>
                                <option value="non definie">Non definie</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="organisme">
                                Organisme:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="organisme" id="organisme" class="form-control" placeholder="Entrer le nom de l'organisme" value="{{ $offre_emploie->organisme }}" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu">
                                Lieu:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="lieu" id="lieu" class="form-control" placeholder="Entrer le lieu" value="{{ $offre_emploie->lieu }}" required>
                        </div>
                        <div class="form-group">
                            <label for="object">
                                Object:<i id="required-sign">*</i>
                            </label>
                            <textarea name="object" id="object" class="form-control" placeholder="Entrer l'object d'offre emploie" cols="30" rows="2" value="{{ $offre_emploie->object }}" required></textarea>
                        </div>
                        <!-- Document -->
                        <div id="document_bloc">
                            <div id="document_bloc_content">
                                <div id="image_bloc">
                                    <img src="{{ Storage::url($identite->logo) }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                </div>
                                <div id="file_bloc" id="display: block;">
                                    <span id="document_file_name"></span>
                                </div>
                                <div id="input_bloc">
                                    <label for="document">
                                        <i class="bi bi-download"></i> Inserer Document
                                    </label>
                                    <input type="file" name="document" id="document" style="display: none;">
                                </div>
                            </div>
                        </div>
                        <!-- fin document_bloc -->
                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block btn-sm active">
                                    <span>
                                        <i class="bi bi-upload"></i> Enregistrer
                                    </span>
                                </button>
                            </div>
                        </div> 

                        @if($errors->any())
                            <div id="validate_errors_bloc">
                                @foreach($errors->all() as $error)
                                <span>
                                    {{ $error }} 
                                </span>
                                @endforeach
                            </div>
                        @endif

                    </div>    
                </form>
            </div>
        </div>
    </div>



    <script src="{{ asset('script/offre_emploie/update.js') }}"></script>

    @endsection
</body>
</html>