
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fa fa-plus"></i> Details sur le benevole
                </h5>
            </div>
            <div class="card-body">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Infos content -->
                        <div id="info_content">
                            <div id="benevole_info">
                                <div id="profil_bloc">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ Storage::url($admin->photo) }}" title="Profil {{ $benevole->nom }}">
                                                <img src="{{ Storage::url($admin->photo) }}" alt="Profil {{ $benevole->photo }}" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                                <div id="meta_bloc">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span>Nom:</span>
                                            <span>{{ $benevole->nom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Postnom:</span>
                                            <span>{{ $benevole->postnom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Prenom:</span>
                                            <span>{{ $benevole->prenom }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Email:</span>
                                            <span>{{ $benevole->email }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Pays:</span>
                                            <span>{{ $benevole->pays }}</span> <b>\</b> 
                                            <span>Ville:</span>
                                            <span>{{ $benevole->ville }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- fin benevole_info -->

                            <div id="sociaux_info">
                                <div id="sociaux_info_content">
                                    <ul>
                                        <li>
                                            <span>Contactez sur:</span>
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->facebook }}" title="Facebook">
                                               <i class="bi bi-facebook" style="color: blue;"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->twitter }}" title="Twitter">
                                               <i class="bi bi-twitter" style="color: #00acee;"></i>
                                            </a> 
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->google }}" title="Google+">
                                               <i class="bi bi-google" style="color: #db4a39;"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ $benevole->sociaux->instagram }}" title="Instagram">
                                               <i class="bi bi-instagram" style="color: #C32AA3;"></i> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!-- Fin info content --> 
                    </div>
                </div>
                <!-- Fin card --> 
            </div>
        </div>
    </div>
    @endsection

