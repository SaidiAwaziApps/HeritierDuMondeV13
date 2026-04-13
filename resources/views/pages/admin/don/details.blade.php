<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don</title>

    <style>
        div.card-header h4 {
            text-align: center;
            font-family: italic;
            opacity: 0.8;
        }

        div#info_content > div  {
           margin-bottom: 4px;
        }

        div#info_content > div > .card .card-body {
            text-align: center;
        }

        
        div#info_content > div > .card .card-body  span {
            font-size: 18px;
            font-family: italic;
        }

        div#info_content > div > .card .card-body  span:nth-child(1) {
            font-weight: bold;
        }

        div#info_content > div > .card .card-body  span a.details-link {
            border: 1px solid #ccc;
        } 

        div#info_content > div > .card .card-body span a:hover {
            opacity: 0.4;
        }

        div#info_content > div:nth-child(4) > .card .card-body span {
            text-transform: capitalize;
        }


        div#montant_besoin_bloc {
            display: flex;
            justify-content: space-between;
        }

        div#montant_besoin_bloc > div.card:nth-child(1) {
            width: 30.7%;
        }

        div#montant_besoin_bloc > div.card:nth-child(2) {
            width: 69%;
        }

        @media all and (max-width: 500px) {
            div#montant_besoin_bloc {
                display: block;
            }
            div#montant_besoin_bloc > div {
                margin-bottom: 6px;
            }
            div#montant_besoin_bloc > div.card:nth-child(1) {
                width: 100%;
            }
            div#montant_besoin_bloc > div.card:nth-child(2) {
                width: 100%;
            } 
        }

        div#recu_bloc .card .card-body span:nth-child(n+2) {
           padding: 4px 6px 4px 6px;
           margin-left: 4px;
           border-radius: 4px;
           background-color: #fff;
           opacity: 0.9;
           /* color: white;  */
        }

        div#reception_bloc .card .card-body a.btn {
            border: 1px solid #ccc;
        }

        div#reception_bloc .card .card-body a.btn:hover {
            opacity: 0.4;
        }

        div#reception_bloc .card .card-body form {
            display: none;
        }


        div#reception_bloc .card .card-body form #validate_errors {
            margin-bottom: 6px;
        }

        div#reception_bloc .card .card-body form #validate_errors > div {
            text-align: center;
        }

        div#reception_bloc .card .card-body form #validate_errors > div span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            color: red;
        }


        div#reception_bloc .card .card-body form div textarea[name="texte"] {
            border-bottom: 2px solid #ccc;
        }


        div#submit_bloc {
            margin-top: 7px;
        }

        div#submit_bloc button {
            border-radius: 8px;
        }

        div#submit_bloc button span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
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
                    <i class="fa fa-plus"></i> Infos Detailler sur le don
                </h4>
            </div>
            <div class="card-body">
                <!-- info_content -->
                <div id="info_content">
                    <div id="date_bloc">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    Date:
                                </span>
                                <span>
                                    {{ $don->created_at->format('d-m-y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="montant_besoin_bloc">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    Somme:
                                </span> <br>
                                <span>
                                    {{ $don->montant }} {{ $paymentSetting->currency }}
                                </span>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    Raison:
                                </span> <br>
                                <span>
                                    @if(isset($don->besoinDons))
                                        {{ $don->besoinDons[0]->besoin->intitule }}  
                                        <a href="{{ route('besoin.details',['id'=>$don->id]) }}" title="Plus infos" class="btn btn-default btn sm details-link">
                                           <i class="fa fa-plus"></i> 
                                        </a>
                                    @else 
                                        ----
                                    @endif 
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="donateur_bloc">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid">
                                    <span>
                                        Donateur:
                                    </span>
                                    <span>
                                        {{ $don->donateur->nom.' '.$don->donateur->prenom }}
                                        <a href="{{ route('donateur.details',['id'=>$don->donateur->id]) }}" class="btn btn-default btn-sm details-link" title="Plus infos sur le donateur">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div id="mode_paiement_bloc">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                    Mode paiement:
                                </span>
                                <span>
                                    {{ $don->mode_paiement }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="recu_bloc">
                        <div class="card">
                            <div class="card-body">
                                <span>
                                   Somme(don) Recu:
                                </span>
                                <span id="positif_response">
                                    <i>Oui</i>
                                </span>
                                <span id="negatif_response">
                                    <i>Non</i>
                                </span>
                            </div>
                        </div>
                    </div>

                    @if(!isset($don->reception) && session('user')->hasAccessToRessource('don','recept','allowed')==true)
                    <div id="reception_bloc">
                        <div class="card">
                            <div class="card-body">
                                <a class="btn btn-default btn-sm" title="Cliquer ici" id="reception_button">
                                    <span>
                                        Accuser la reception <i class="fa fa-angle-down"></i>
                                    </span>
                                </a>
                                <form action="{{ route('reception.save') }}" method="POST" id="reception_form">
                                    @if($errors->any())
                                    <div id="validate_errors">
                                        @foreach($errors->all() as $error)
                                        <div id="error_item">
                                            <span>
                                                {{ $error }}
                                            </span>    
                                        </div>
                                        @endforeach
                                    </div> 
                                    @endif

                                    <div class="form-goup">
                                        @csrf
                                        <input type="hidden" name="don_id" id="don_id" value="{{ $don->id }}">
                                        <textarea name="texte" id="texte" cols="30" rows="4" id="texte" class="form-control" placeholder="Ecrire un texte accusant la reception" required></textarea>
                                    </div>
                                    <div id="submit_bloc" class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-sm btn-block active">
                                            <span>
                                               <i class="fa fa-upload"></i> Soumettre la reception
                                            </span>   
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                <!-- fin info_content --> 
            </div>
        </div>

        <script type="text/javascript">
            let don=<?php echo($don);?>
        </script>

        <script src="{{ asset('script/don/details.js') }}"></script>

    </div>
    @endsection

</body>
</html>