<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Besoin</title>

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

        table thead tr th {
            text-align: center;
        }

        table thead tr th,
        table tbody tr td {
            font-size: 18px;
            font-family: italic;
        }

        table tbody tr td button:hover,
        table tbody tr td a:hover  {
            opacity: 0.8;
        } 

        table tbody tr td:nth-child(5) a {
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
                    <i class="fa fa-blog"></i> Gestion besoins
                </span>
                <!-- Autorisation acquise -->
                @if(Auth::user()->hasAccessToRessource('blog','register','allowed'))
                <a href="{{ route('besoin.register') }}" title="Ajouter un besoin" class="btn btn-default btn-sm active">
                   <i class="fa fa-plus"></i>
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsvive">
                    <table class="table table condensed">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Intitule
                                </th>
                                <th>
                                    Montant ({{ $paymentSetting->currency }})
                                </th>
                                <th>
                                    Contenu
                                </th>
                                <th>
                                    <i class="fa fa-plus"></i>
                                </th>
                                <!-- Autorisation acquise -->
                                @if(session('user')->hasAccessToRessource('besoin','delete','allowed'))
                                <th>
                                    <i class="fa fa-trash"></i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(session('user')->hasAccessToRessource('besoin','update','allowed'))
                                <th>
                                    <i class="fa fa-edit"></i>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $index=0;
                            ?>
                            @foreach($besoins as $besoin)
                            <?php $index++; ?>
                            <tr>
                                <td>
                                    {{ $index }}
                                </td>
                                <td>
                                    {{ $besoin->intitule }}
                                </td>
                                <td>
                                    {{ $besoin->montant }}
                                </td>
                                <td>
                                    {{ $besoin->contenu }} 
                                </td>
                                <td>
                                    <a href="{{ route('besoin.details',['id'=>$besoin->id]) }}" title="Plus de details sur le besoin" class="btn btn-default btn-sm">
                                        <span>
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('besoin','delete','allowed'))
                                <td>
                                    <form action="{{ route('besoin.delete_one',['id'=>$besoin->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="confirm('Voulez vous vraiment supprimer ?')" class="btn btn-danger btn-sm active">
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('besoin','update','allowed'))
                                <td>
                                    <a href="{{ route('besoin.update_page',['id'=>$besoin->id]) }}" title="Modifier le besoin" class="btn btn-primary btn-sm active">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span>
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