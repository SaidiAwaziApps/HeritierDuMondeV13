
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
                                        <a href="{{ route('admin.besoin.details',['id'=>$don->id]) }}" title="Plus infos" class="btn btn-default btn sm details-link">
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
                                        <a href="{{ route('admin.donateur.details',['id'=>$don->donateur->id]) }}" class="btn btn-default btn-sm details-link" title="Plus infos sur le donateur">
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
            let don = @json($don);
        </script>

        <script src="{{ asset('script/pages/admin/don/details.js') }}"></script>

    </div>
    @endsection

