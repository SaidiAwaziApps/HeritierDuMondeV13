@extends('layouts.admin')

@section('content')
<div id="globalContent">
    <form method="POST" action="{{ route('access_ressource.save') }}">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

        <div class="card">
            <div class="card-body">
                <div id="title_bloc">
                    <div class="card">
                        <div class="card-body text-center">
                            <span>
                                <i class="fa fa-shield"></i> Definir les access aux ressources
                            </span>
                        </div>
                    </div>
                </div>

                <div id="profil_access_bloc">
                    <!-- Profil bloc -->
                    <div id="profil_bloc">
                        <div id="profil_bloc_image">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ Storage::url($user->photo) }}" alt="Profil {{$user->nom}}" class="rounded-thumbnail" style="width: 100%;height: 160px;">
                                </div>
                            </div>
                        </div>

                        <div id="profil_bloc_description" style="margin-top: 4px;">
                            <div class="card">
                                <div class="card-body">
                                    <span><i class="bi bi-person-fill"></i>User:</span>
                                    <span>{{ $user->nom }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Profil bloc -->

                    <!-- Access bloc -->
                    <div id="access_bloc">
                        <div class="accordion" id="ressources">
                            @foreach($ressources as $ressource)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <a class="accordion-button collapsed" data-bs-toggle="collapse" href="#ressource_{{ $ressource->id }}">
                                            {{ $ressource->nom }}
                                        </a>
                                    </h2>
                                    <div id="ressource_{{ $ressource->id }}" class="accordion-collapse collapse" data-bs-parent="#ressources">
                                        <div class="accordion-body d-flex flex-wrap justify-content-center">
                                            @if(!in_array($ressource->nom, ['contact','benevole','don']))
                                                @php
                                                    $actions = ['register','delete','update'];
                                                @endphp
                                                @foreach($actions as $action)
                                                    <div id="access_item" class="me-3 mb-2">
                                                        <input type="checkbox" name="access_ressources[]" value="{{ json_encode(['ressource_id'=>$ressource->id,'action'=>$action]) }}" id="access_ressources_{{ $ressource->id }}_{{ $action }}">
                                                        <label for="access_ressources_{{ $ressource->id }}_{{ $action }}">{{ ucfirst($action) }}</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div id="access_item">
                                                    <input type="checkbox" name="access_ressources[]" value="{{ json_encode(['ressource_id'=>$ressource->id,'action'=>'authorized']) }}" id="access_ressources_{{ $ressource->id }}_authorized">
                                                    <label for="access_ressources_{{ $ressource->id }}_authorized">Authorized</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div id="check_all_bloc">
                                <input type="checkbox" name="check_all" id="check_all"> 
                                <label for="check_all"><i>Tout authoriser</i></label>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Access bloc -->
                </div>
                <!-- fin profil_access_bloc -->

                <!-- Errors -->
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="text-center mt-1">
                            <span style="color: red;font-size: 18px;font-weight: bold;font-family: italic;">
                                {{ $error }}
                            </span>
                        </div>
                    @endforeach
                @endif

                <!-- Submit bloc -->
                <div id="submit_bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm active">
                            <span>
                                <i class="bi bi-upload"></i> Valider
                            </span>    
                        </button>
                    </div>
                </div>
                <!-- fin submit bloc -->
            </div>
            <!-- fin card-body -->
        </div>
        <!-- fin card -->
    </form>
</div>

<script src="{{ asset('script/access_ressource/register.js') }}"></script>
@endsection