<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement</title>
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



        div.card-header a {
            font-size: 20px;
            font-weight: bold;
            color: black;
            float: right;
            padding-left: 4px;
            padding-right: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        

        table thead tr th {
            /* text-align: center; */
            font-size: 18px;
            font-family: italic;
        }

        table thead tr th:nth-child(n+4) {
            text-align: center;
        }

        table tbody tr td {
            font-size: 17px;
            font-family: italic;
        }

        table tbody tr td:nth-child(4) a {
            border: 1px solid #ccc;
        }

         table tbody tr td:nth-child(n+4) a:hover {
            opacity: 0.6;
         }

        table tbody tr td:nth-child(4) a:hover {
            border: 1px solid #ccc;
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
                   <i class="fa fa-calendar"></i> Gestion Evenements
                </span>
                <!-- Autorisation acquise -->
                @if(Auth::user()->hasAccessToRessource('evenement','register','allowed'))
                <a href="{{ route('evenement.register') }}" class="active" title="Ajouter un evenement">
                    <i class="bi bi-plus"></i>
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table condensed table-striped">
                        <thead>
                            <tr>
                                <th> # </th>
                                <!-- <th> Type </th> -->
                                <th> Date/Periode </th>
                                <th> Titre </th>
                                <th>
                                    <i  class="fa fa-plus"> </i>
                                </th>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','delete','allowed'))
                                <th>
                                    <i  class="fa fa-trash"> </i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','update','allowed'))
                                <th>
                                    <i  class="fa fa-edit"> </i>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index=0; ?>
                            @foreach($evenements as $evenement)
                            <?php $index++ ?>
                            <tr>
                                <td> 
                                    {{ $index }} 
                                </td>
                                <!-- <td>
                                    {{ $evenement->type }}
                                </td> -->
                                <td> 
                                    @if($evenement->type=='journalier')
                                    {{ $evenement->date_du_jour }}
                                    @else
                                    {{ $evenement->periode_date_debut }} au {{ $evenement->periode_date_fin }}
                                    @endif
                                </td>
                                <td>
                                    {{ $evenement->titre }}
                                </td>
                                <td>
                                    <a href="{{ route('evenement.details',['id'=>$evenement->id]) }}" class="btn btn-default btn-sm" title="Plus de details">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','delete','allowed'))
                                <td>
                                    <form method="POST" action="{{ route('evenement.delete_one',['id'=>$evenement->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm active" title="Supprimer l'evenement">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','update','allowed'))
                                <td>
                                    <a href="{{ route('evenement.update_page',['id'=>$evenement->id]) }}" class="btn btn-primary btn-sm active" title="Appliquer des modifications">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
    
</body>
</html>