<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donateur</title>

    <style>
        div.card-header h4 {
            /* text-align: center; */
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.7;
        }

        div.card-header h4 i {
            opacity: 0.4;
        }


        table thead tr th {
            /* text-align: center; */
            font-family: italic;
        }

        /* table thead tr th:nth-child(6) {
            text-align: center;
        } */
         

        table tbody tr td:nth-child(2) a div {
           width: 45px;
           height: 45px;
        }

        table tbody tr td:nth-child(2) a:hover,
        table tbody tr td:nth-child(6) a:hover  {
            opacity: 0.6;
        }

        table tbody tr td:nth-child(6) a {
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
                <h4 class="card-title">
                   <i class="fa fa-people-group"></i> Nos donateurs
                </h4>
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
                                    Profil
                                </th>
                                <th>
                                    Nom
                                </th>
                                <th>
                                    Prenom
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    <i class="fa fa-plus"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               $index=0;
                            ?>
                            @foreach($donateurs as $donateur)
                            <?php
                                $index++;
                            ?>
                            <tr>
                                <td>
                                    {{ $index }}
                                </td>
                                <td>
                                    <a href="{{ Storage::url($admin->photo) }}" title="Afficher profil {{ $donateur->nom }}">
                                        <div>
                                            <img src="{{ Storage::url($admin->photo) }}" alt="Profil {{ $donateur->nom }}" class="cover rounded-thumbnail" style="width: 100%;height: 100%;">
                                        </div>        
                                    </a>
                                </td>
                                <td>
                                    {{ $donateur->nom }}
                                </td>
                                <td>
                                    {{ $donateur->prenom }}
                                </td>
                                <td>
                                    {{ $donateur->email }}
                                </td>
                                <td>
                                    <a href="{{ route('donateur.details',['id'=>$donateur->id]) }}" title="Afficher infos detaillees de {{ $donateur->nom }}" class="btn btn-default btn-sm btn-block">
                                        <i class="fa fa-plus"></i> Plus
                                    </a>
                                </td>
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