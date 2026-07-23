
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   <i class="fas fa-hand-holding-heart"></i> Nos donateurs
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-striped" id="donateurs_list_table">
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
                                    <div class="d-grid">
                                        <a href="{{ Storage::url($donateur->photo) }}" class="btn btn-default btn-sm btn-block" title="Cliquer pour afficher profil">
                                            <img src="{{ Storage::url($donateur->photo) }}" alt="Profil {{ $donateur->nom }}" class="rounded-circle">       
                                        </a>
                                    </div> 
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
                                    <div class="d-grid">
                                        <a href="{{ route('admin.donateur.details',['id' => $donateur->id]) }}" class="btn btn-default btn-sm btn-block" title="Afficher infos detaillees de {{ $donateur->nom }}">
                                            <i class="fa fa-plus"></i> Plus
                                        </a>
                                    </div>
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

