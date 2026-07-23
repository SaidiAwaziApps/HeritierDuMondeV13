
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
                    <table class="table table-bordered table condensed table-striped" id="evenements_list_table">
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
                            
                            @foreach($evenements as $index => $evenement)
                            <tr>
                                <td> 
                                    {{ $index+1 }} 
                                </td>
                                <td> 
                                    @if($evenement->type == 'journalier')
                                    {{ $evenement->date_du_jour }}
                                    @else
                                    {{ $evenement->periode_date_debut }} au {{ $evenement->periode_date_fin }}
                                    @endif
                                </td>
                                <td>
                                    {{ $evenement->titre }}
                                </td>
                                <td>
                                    <div class="d-grid">
                                        <a href="{{ route('admin.evenement.details',['id'=>$evenement->id]) }}" class="btn btn-default btn-sm btn-block" title="Cliquer pour de details sur l'evenement">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','delete','allowed'))
                                <td>
                                    <form method="POST" action="{{ route('admin.evenement.delete_one',['id'=>$evenement->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-grid">
                                            <button type="submit" onclick="return confirm('Voulez vous supprimer ?')" class="btn btn-danger btn-sm btn-block" title="Cliquer pour supprimer">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('evenement','update','allowed'))
                                <td>
                                    <div class="d-grid">
                                        <a href="{{ route('admin.evenement.update_page',['id'=>$evenement->id]) }}" class="btn btn-primary btn-sm btn-block active" title="Cliquer pour modifications">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/evenement/list.js') }}"></script>

    </div>
    @endsection
    