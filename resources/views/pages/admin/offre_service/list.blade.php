
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-tasks"></i> Offres Services
                </span>
                <!-- Autorisation acquise -->
                <a href="{{ route('admin.offre_service.register_page') }}" title="Ajouter un offre">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped" id="offre_services_list_table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Service
                                </th>
                                <th>
                                    Description
                                </th>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','delete','allowed'))
                                <th>
                                    <i class="fa fa-trash"></i>
                                </th>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','update','allowed'))
                                <th>
                                    <i class="fa fa-pencil-square"></i>
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 0; ?>
                            @foreach($offre_services as $index => $offre_service)
                            <?php $index++; ?>
                            <tr>
                                <td>
                                    {{ $index  }} 
                                </td>
                                <td>
                                    {{ $offre_service->intitule }} 
                                </td>
                                <td>
                                    {{ $offre_service->description }} 
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','delete','allowed'))
                                <td>
                                    <div class="d-grid">
                                        <form method="POST" action="{{ route('admin.offre_service.deleteOne',['id' => $offre_service->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer ?')" class="btn btn-danger btn-block btn-sm active" title="Supprimer l'offre">
                                                <i class="bi bi-trash"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','update','allowed'))
                                <td>
                                    <a href="{{ route('admin.offre_service.update_page',['id' => $offre_service->id]) }}" title="Modifier l'offre d'emploie" class="btn btn-primary btn-sm active">
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
        
        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/offre_service/list.js') }}"></script>

    </div>    
    @endsection
