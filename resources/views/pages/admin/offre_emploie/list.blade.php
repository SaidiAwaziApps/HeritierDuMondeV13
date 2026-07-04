
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-tasks"></i> Offres Emploies
                </span>
                <!-- Autorisation acquise -->
                @if(Auth::user()->hasAccessToRessource('offre_emploie','register','allowed'))
                <a href="{{ route('admin.offre_emploie.register_page') }}" title="Ajouter un offre">
                    <i class="fa fa-plus"></i>
                </a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped" id="offre_emploies_list_table">
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
                                    <a href="{{ Storage::url($offre_emploie->document) }}" class="btn btn-default btn-sm" title="Consulter document" style="border: 1px solid #ccc;">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </td>
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','delete','allowed'))
                                <td>
                                    <div class="d-grid">
                                        <form method="POST" action="{{ route('admin.offre_emploie.deleteOne',['id'=>$offre_emploie->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="confirm('Voulez-vous vraiment supprimer ?')" class="btn btn-danger btn-block btn-sm active" title="Supprimer l'offre">
                                                <i class="bi bi-trash"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                                <!-- Autorisation acquise -->
                                @if(Auth::user()->hasAccessToRessource('offre_emploie','update','allowed'))
                                <td>
                                    <a href="{{ route('admin.offre_emploie.update_page',['id'=>$offre_emploie->id]) }}" title="Modifier l'offre d'emploie" class="btn btn-primary btn-sm active">
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
        <script src="{{ asset('script/pages/admin/offre_emploie/list.js') }}"></script>

    </div>    
    @endsection
