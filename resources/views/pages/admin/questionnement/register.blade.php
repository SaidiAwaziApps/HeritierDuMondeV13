<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnement</title>

    <style>
        div.card .card-header span {
            font-size: 20px;
            font-family: italic;
        }

        div.card .card-header a {
            float: right;
            border: 1px solid #ccc;
        }

        div.card .card-header a:hover {
            opacity: 0.6;
        }

        div#form_title h4 {
            text-align: center;
            font-family: italic;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8ff;
        }

        /* div#form_content {
            margin-top: 1px;
        } */

        div#form_content > div {
            margin-bottom: 6px;
        }

        div#form_content > div#submit_bloc {
            margin-top: 6px;
        }

        div#submit_bloc > div button span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }

        label i[id="required-sign"] {
            color: red;
        }

        input[id="question"],textarea[id="reponse"] {
            border-bottom: 2px solid #ccc;
        }




        div#errors_bloc {
            margin-top: 10px;
        }

        div#error_item {
            text-align: center;
        }

        div#error_item span {
            font-size: 18px;
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
                    Questionnement
                </span>
                <a href="{{ route('questionnement.list') }}" class="btn btn-default btn-sm" title="Ajouter un questionnement">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('questionnement.save') }}">
                    <div id="form_title">
                        <h4>
                            Nouvelle questionnement
                        </h4>
                    </div>
                    <div id="form_content">
                        @csrf
                        <div class="form-group">
                            <label for="question">
                                Question:<i id="required-sign">*</i>
                            </label>
                            <input type="text" name="question" id="question" class="form-control" placeholder="Entrer la question" mexlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="reponse">
                                Reponse:<i id="required-sign">*</i>
                            </label>
                            <textarea name="reponse" id="reponse" cols="30" rows="6" class="form-control" placeholder="Entrer reponse a la question" required></textarea>
                        </div>
                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-sm btn-block active">
                                    <span>
                                        <i class="fa fa-upload"></i> Enregistrer
                                    </span>
                                </button>
                            </div>
                        </div>

                        @if($errors->any())
                        <div id="errors_bloc">
                            @foreach($errors->all() as $error)
                            <div id="error_item">
                                <span>
                                    {{ $error }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

</body>
</html>