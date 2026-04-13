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


        div#donateur_info {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#donateur_info > div#profil_bloc {
            width: 30%;
        }

        div#donateur_info > div#meta_bloc {
            width: 69%;
        }

        @media all and (max-width: 500px) {

            div#donateur_info {
                display: block;
            }

            div#donateur_info > div {
                margin-bottom: 6px;
            }

            div#donateur_info > div#profil_bloc {
                width: 100%;
            }

            div#donateur_info > div#meta_bloc {
                width: 100%;
            }
        }

        div#donateur_info > div#profil_bloc > div.card .card-body {
            height: 206px;
        }

        div#donateur_info > div#meta_bloc ul li span {
            font-size: 18px;
            font-family: italic;
        }

        div#donateur_info > div#meta_bloc ul li span:nth-child(1) {
            font-weight: bold;
            margin-right: 2px;
        }


        div#donateur_info > div#meta_bloc ul li:nth-child(5) {
            text-align: center;
            background-color: #f8f8ff;
        }

        div#donateur_info > div#meta_bloc ul li:nth-child(5) a {
            text-decoration: none;
            margin-right:8px;
        }

        div#donateur_info > div#meta_bloc ul li:nth-child(5) a:hover {
            opacity: 0.4;
        }


        div#don_info {
            margin-top: 20px;
        }

        div#don_info h5 {
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            padding-bottom: 6px;
            border-bottom: 2px solid black;
            text-align: center;
            opacity: 0.6;
        }

        div#don_info > div table thead tr th,
        div#don_info > div table tbody tr td  {
            font-size: 17px;
            font-family: italic;
            text-transform: capitalize;
        }

        div#don_info > div table tbody tr td a {
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
                   <i class="fa fa-plus"></i> Details sur le donateur
                </h4>
            </div>
            <div class="card-body">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Infos content -->
                        <div id="info_content">
                            <div id="donateur_info">
                                <div id="profil_bloc">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ Storage::url($admin->photo) }}" title="Profil {{ $donateur->nom }}">
                                                <img src="{{ Storage::url($admin->photo) }}" alt="Profil {{ $donateur->nom }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                                <div id="meta_bloc">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span>Nom:</span>
                                            <span>{{ $donateur->nom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Prenom:</span>
                                            <span>{{ $donateur->prenom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Email:</span>
                                            <span>{{ $donateur->email }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Zip Code:</span>
                                            <span>{{ $donateur->zip_code }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- fin donateur_info -->

                            <div id="don_info">
                                <div id="title_content">
                                   <h5>
                                       Dons realises
                                   </h5>
                                </div>
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
                                                    Somme($)
                                                </th>
                                                <th>
                                                    mode payment
                                                </th>
                                                <th>
                                                    Recu
                                                </th>
                                                <th>
                                                    <i class="fa fa-plus"></i>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $index=0; ?>
                                            @foreach($donateur->dons as $don)
                                            <?php $index++;?>
                                            <tr>
                                                <td>
                                                    {{ $index }}
                                                </td>
                                                <td>
                                                    {{ $don->created_at->format('d-m-y') }}
                                                </td>
                                                <td>
                                                    {{ $don->montant }}
                                                </td>
                                                <td>
                                                    {{ $don->mode_paiement }}
                                                </td>
                                                <td>
                                                    {{ isset($don->reception) ? 'Oui' : 'Non' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('don.details',['id'=>$don->id]) }}" title="Details sur le don"  class="btn btn-default btn-sm">
                                                        <i class="fa fa-plus"></i> Plus
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- fin don_info -->

                        </div>
                        <!-- Fin info content --> 
                    </div>
                </div>
                <!-- Fin card --> 
            </div>
        </div>
    </div>
    @endsection

</body>
</html>