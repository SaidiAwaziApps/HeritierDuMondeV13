<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Besoin</title>

    <link rel="stylesheet" href="{{ asset('css/image/global/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/upload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image/vignette/style.css') }}">

    <style>
        div.card-header span.card-title {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.7;
        }

        div.card-header span.card-title i {
            opacity: 0.4
        }

        div.card-header a {
            float: right;
        }

        div.form-group {
            margin-bottom: 6px;
        }

        label {
            font-size: 17px;
            font-weight: bold;
            font-family: italic;
        }

        i[id="required-sign"] {
            color: red;
        }

        input[type="text"],
        input[type="number"],
        textarea[id="contenu"] {
            border: 1px solid #ccc;
            border-bottom: 3px solid #ccc;
        }

        div#submit_bloc {
            margin-top: 6px;
        }

        button[type="submit"] span {
           font-size: 17px;
           font-weight: bold;
           font-family: italic;
        }


        div.validator-error {
            text-align: center;
        }

        div.validator-error span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            color: red; 
        }



        .imgs-bloc > .imgs-bloc-context {
            position: fixed;
            top: 54%;
            left: 50%;
            z-index: 1100;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
        }

        @media all and (max-width: 500px) {
            .imgs-bloc > .imgs-bloc-context {
                top: 40%;
                left: 46%;
            }
        }

        @media all and (max-width: 400px) {
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
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    Gestion besoin
                </span>
                <a href="{{ route('besoin.list') }}" title="Tous les besoins" class="btn btn-default btn-sm active">
                    <i class="fa fa-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('besoin.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="intitule">
                            Intitule:<i id="required-sign">*</i>
                        </label>
                        <input type="text" name="intitule" id="intitule" class="form-control" placeholder="Entrer l'intitule du besoin" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label for="montant">
                            Montant:<i id="required-sign">*</i>
                        </label>
                        <input type="number" name="montant" id="montant" class="form-control" placeholder="Entrer le montant en Dollard US" required>
                    </div>
                    <div class="form-group">
                        <label for="contenu">
                            Contenu:<i id="required-sign">*</i>
                        </label>
                        <textarea name="contenu" id="contenu" class="form-control" placeholder="Taper le contenu du besoin" cols="30" rows="4" required></textarea>
                    </div>


                    <div id="submit_bloc">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm active">
                                <span>
                                    <i class="fa fa-upload"></i> Enregistrer
                                </span>
                            </button>
                        </div>
                    </div>


                    <!-- Contenu imaga -->
                    <div class="imgs-bloc">
                        <div class="imgs-bloc-context">
                            @include('components.image.global.context')
                        </div>
                        <div class="imgs-bloc-content">
                            @include('components.image.global.content')
                        </div>
                    </div>

                    @if($errors->any()) 
                       @foreach($errors->all() as $error)
                       <div class="validator-error">
                            <span>
                               {{ $error }}
                            </span>
                       </div>
                       @endforeach
                    @endif

                </form>
            </div>
        </div>


        <!-- Scripts -->
        <script src="{{ asset('script/image/upload/register.js') }}"></script>
        <script src="{{ asset('script/image/vignette/register.js') }}"></script> 

    </div>
    @endsection

</body>
</html>