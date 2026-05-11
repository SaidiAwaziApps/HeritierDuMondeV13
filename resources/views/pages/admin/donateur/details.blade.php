
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
                                            <a href="{{ Storage::url($donateur->photo) }}" title="Profil {{ $donateur->nom }}">
                                                <img src="{{ Storage::url($donateur->photo) }}" alt="Profil {{ $donateur->nom }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
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
                                                    <a href="{{ route('admin.don.details',['id'=>$don->id]) }}" title="Details sur le don"  class="btn btn-default btn-sm">
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
