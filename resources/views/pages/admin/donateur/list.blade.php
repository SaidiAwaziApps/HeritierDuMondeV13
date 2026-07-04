
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
                    <table class="table table-condensed table-striped" id="donateurs_list_table">
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
                                    <a href="{{ Storage::url($donateur->photo) }}" title="Afficher profil {{ $donateur->nom }}">
                                        <div>
                                            <img src="{{ Storage::url($donateur->photo) }}" alt="Profil {{ $donateur->nom }}" class="cover rounded-thumbnail" style="width: 100%;height: 100%;">
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
                                    <a href="{{ route('admin.donateur.details',['id'=>$donateur->id]) }}" title="Afficher infos detaillees de {{ $donateur->nom }}" class="btn btn-default btn-sm btn-block">
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

        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/donateur/list.js') }}"></script> 

    </div>
    @endsection

