@extends('layouts.admin')

@section('content')
<div id="globalContent">
    <form method="POST" action="{{ route('access_ressource.update_handler', ['user_id' => $user->id]) }}">
        @csrf
        @method('PUT')
        
        <div class="card">
            <div class="card-body">

                <!-- Title -->
                <div id="title_bloc">
                    <div class="card">
                        <div class="card-body text-center">
                            <span>
                               <i class="fa fa-shield"></i> Definir les privileges
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Profil + Access -->
                <div id="profil_access_bloc">

                    <!-- Profil Bloc -->
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
                                    <span>
                                        <i class="bi bi-person-fill"></i>User:
                                    </span>
                                    <span>{{ $user->nom }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Profil Bloc -->

                    <!-- Access Bloc -->
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
                                                @php $actions = ['register','delete','update']; @endphp
                                                @foreach($actions as $action)
                                                    <div id="access_item" class="me-3 mb-2">
                                                        <input type="checkbox" name="access_ressources[]" 
                                                               id="access_{{ $ressource->id }}_{{ $action }}" 
                                                               value="{{ json_encode(['ressource_id'=>$ressource->id,'action'=>$action]) }}"
                                                               @if(in_array($action, $user->access_ressources->toArray()[$ressource->id] ?? [])) checked @endif>
                                                        <label for="access_{{ $ressource->id }}_{{ $action }}">{{ ucfirst($action) }}</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div id="access_item">
                                                    <input type="checkbox" name="access_ressources[]" 
                                                           id="access_{{ $ressource->id }}_authorized" 
                                                           value="{{ json_encode(['ressource_id'=>$ressource->id,'action'=>'authorized']) }}"
                                                           @if(in_array('authorized', $user->access_ressources->toArray()[$ressource->id] ?? [])) checked @endif>
                                                    <label for="access_{{ $ressource->id }}_authorized">Authorized</label>
                                                </div>    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Check all -->
                            <div id="check_all_bloc">
                               <input type="checkbox" name="check_all" id="check_all"> 
                               <label for="check_all"><i>Tout authoriser</i></label>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Access Bloc -->

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

                <!-- Submit -->
                <div id="submit_bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm active">
                            <span><i class="bi bi-upload"></i> Valider</span>    
                        </button>
                    </div>
                </div>

            </div>
            <!-- fin card-body -->
        </div>
        <!-- fin card -->
    </form>
</div>

<script type="text/javascript">
    let access_ressources = @json($user->access_ressources);
</script>
<script src="{{ asset('script/access_ressource/update.js') }}"></script>
@endsection