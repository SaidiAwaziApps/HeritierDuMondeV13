<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dons</title>
    <link rel="stylesheet" href="{{ asset('css/don/donors_talks.css') }}">

    <style>
        div.card-header h4 {
            /* text-align: center; */
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        div.card-header h4 i {
            opacity: 0.4;
        }



        table thead tr th ,
        table tbody tr td {
            font-family: italic;
            text-transform: capitalize;
        }

        table thead tr th:nth-child(7) {
            text-align: center;
        }

        table tbody tr td:nth-child(4) a ,
        table tbody tr td:nth-child(7) a {
            border: 1px solid #ccc;
        }

        table tbody tr td a:hover {
            border: 1px solid #ccc;
            opacity: 0.8; 
        }


        .donors-talks {
            margin-top: 10px;
        }

        .donors-talks-heading h4 {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.8;
        }

        @media all and (max-width: 800px) {
            .donors-talks-heading h4 {
                font-weight: normal; 
                padding: 6px;
                border-radius: 4px;
                background-color: #f8f8ff;
                /* color: white; */
                opacity: 0.9;
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
                <h4 class="card-title">
                   <i class="fa fa-list"></i> Liste Dons effectues
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
                                    Date
                                </th>
                                <th>
                                    Montant($)
                                </th>
                                <th>
                                    Donateur
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
                            @foreach($dons as $don)
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
                                    <a href="{{ route('donateur.details',['id'=>$don->donateur->id]) }}" title="Plus infos sur le donateur" class="btn btn-default btn-sm">
                                        {{ $don->donateur->nom }}
                                    </a>
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
        </div>

        <!-- Que disent nos donateurs -->
        @if($dons && $dons->count() > 0)  
            <div class="donors-talks">
                <div class="card">
                    <div class="card-body">
                        <div class="donors-talks-heading">
                            <h4 class="donors-talks-heading-title">
                                @if($dons->count() > 1)
                                    Que disent nos donateurs ?
                                @else
                                    Que dit le donateur ?
                                @endif
                            </h4>
                        </div>
                        <div class="donors-talks-heading">
                            @include('components.don.donors_talks')
                        </div>
                    </div>
                </div>
            </div> 
        @endif

    </div>
    @endsection

</body>
</html>