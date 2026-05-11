<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement</title>
    <style>
        

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
                <a href="{{ route('admin.evenement.register_page') }}" class="active" title="Ajouter un evenement">
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
                                    <a href="{{ route('admin.evenement.details',['id'=>$evenement->id]) }}" class="btn btn-default btn-sm" title="Plus de details">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','delete','allowed'))
                                <td>
                                    <form method="POST" action="{{ route('admin.evenement.delete_one',['id'=>$evenement->id]) }}">
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
                                    <a href="{{ route('admin.evenement.update_page',['id'=>$evenement->id]) }}" class="btn btn-primary btn-sm active" title="Appliquer des modifications">
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