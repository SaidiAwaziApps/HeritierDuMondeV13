<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identite</title>

    <style>

        div#globalContent .card-body {
            padding-bottom: 100px;
        }

        div.card-header h4 {
            font-family: italic;
        }

        div.accordion-item:hover {
            opacity: 1;
            border: 1.6px solid #ccc; 
        }

        div.accordion-item .accordion-header {
            font-weight: bold;
            font-family: italic;
        }

        div.accordion-item .accordion-body p {
            font-size: 18px;
            font-family: italic;
            text-align: justify;
        }

        div#ask_button_actions {
            position: fixed;
            top: 50%;
            left: 50%;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
            z-index: 1000;
            background-color: #f8f8ff;
            padding: 10px 8px 10px 8px;
            border-radius: 8px;
            opacity: 0.8;
        }

        div#ask_button_actions > div {
            margin-right: 4px;
            display: none;
            transition: 2s;
        }

        div#ask_button_actions > div:nth-child(1) {
            display: block;
        }

        div#ask_button_actions > div:nth-child(1) a {
            border: 1px solid #ccc;
        }



    </style>

</head>
<body>

    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Questionnement 
                </h4>
            </div>
            <div class="card-body">
                <div id="form_content">
                    <!-- Item existant -->
                    <div id="existed_items">
                        <div class="container mt-1">
                            <div class="accordion" id="accordion">
                                @foreach($identite->questionnements as $questionnement)
                                    @if($questionnement->status==true)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading_accordion_item_{{ $questionnement->id }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordion_item_{{$questionnement->id}}" aria-expanded="false" aria-controls="heading_accordion_item_{{ $questionnement->id }}">
                                                    {{ $questionnement->question }}
                                            </button>
                                        </h2>
                                        <div id="accordion_item_{{$questionnement->id}}" class="accordion-collapse collapse"
                                             aria-labelledby="heading_accordion_item_{{ $questionnement->id }}" data-bs-parent="#accordion">
                                            <div class="accordion-body">
                                                <p>
                                                    {{ $questionnement->reponse }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- fin existed_items -->
                    <div id="ask_button_actions">
                        <div id="add_bloc">
                            <a href="{{ route('questionnement.register') }}" class="btn btn-default btn-sm" title="Ajouter(+) un questionnement">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div id="delete_bloc">
                            <form action="#" method="post" id="delete_ask_form">
                                @csrf
                                @method('DELETE')
                                <button onclick="confirm('Voulez-vous vraiment supprimer ?')" type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>    
                        </div>
                        <div id="update_bloc">
                            <a href="#" class="btn btn-primary btn-sm active" id="delete_ask_link">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    <!-- fin button_actions -->
                </div>
            </div>
        </div>

        <script type="text/javascript">
            let questionnements=<?php echo($identite->questionnements);?>
        </script>

        <!-- Inclus script -->
        <script src="{{ asset('script/questionnement/list.js') }}"></script>

    </div>
    @endsection

</body>
</html>