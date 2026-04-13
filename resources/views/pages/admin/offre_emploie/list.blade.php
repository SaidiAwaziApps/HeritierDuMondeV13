<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offre Emploie</title>
    
    <style>
        div.card .card-header span {
            font-size: 18px;
            /* font-weight: bold; */
            font-family: italic;
        }

        div.card .card-header span i {
            opacity: 0.7;
        }

        div.card .card-header a {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            color: black;
            float: right;
            border: 1px solid #ccc;
            border-radius: 2px;
            padding: 2px 4px 2px 4px;
        } 

        table thead tr th,table tbody tr td {
            font-size: 17px;
            font-family: italic;
        }

        table thead tr th:nth-child(n+6) {
            text-align: center;
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
                    <i class="fa fa-tasks"></i> Offres Emploies
                </span>
                <!-- Autorisation acquise -->
                @if(session('user')->hasAccessToRessource('offre_emploie','register','allowed'))
                <a href="{{ route('offre_emploie.register') }}">
                    <i class="fa fa-plus"></i>
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Organisme
                                </th>
                                <th>
                                    Lieu
                                </th>
                                <th>
                                    Object
                                </th>
                                <!-- <th>
                                    Document
                                </th> -->
                                <th>
                                    <i class="bi bi-download"></i>
                                </th>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','delete','allowed'))
                                <th>
                                    <i class="bi bi-trash"></i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','update','allowed'))
                                <th>
                                    <i class="bi bi-pencil-square"></i>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index=0; ?>
                            @foreach($offre_emploies as $offre_emploie)
                            <?php $index++; ?>
                            <tr>
                                <td>
                                    {{ $index  }} 
                                </td>
                                <td>
                                    {{ $offre_emploie->date_emission }} 
                                </td>
                                <td>
                                    {{ $offre_emploie->organisme }} 
                                </td>
                                <td>
                                    {{ $offre_emploie->lieu }} 
                                </td>
                                <td>
                                    {{ $offre_emploie->object }} 
                                </td>
                                <td>
                                    <a href="{{ Storage::url($offre_emploie->document) }}" class="btn btn-default btn-sm" style="border: 1px solid #ccc;">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','delete','allowed'))
                                <td>
                                    <div class="d-grid">
                                        <form method="POST" action="{{ route('offre_emploie.deleteOne',['id'=>$offre_emploie->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="confirm('Voulez-vous vraiment supprimer ?')" class="btn btn-danger btn-block btn-sm active">
                                                <i class="bi bi-trash"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','update','allowed'))
                                <td>
                                    <a href="{{ route('offre_emploie.update_page',['id'=>$offre_emploie->id]) }}" title="Modifier l'offre d'emploie" class="btn btn-primary btn-sm active">
                                        <i class="bi bi-pencil-square"></i>
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
    <script src="{{ asset('dependance/js/dataTable.min.js') }}"></script>

    <script type="text/javascript">
        document.querySelector('table').DataTable();
    </script>
    @endsection
</body>
</html>