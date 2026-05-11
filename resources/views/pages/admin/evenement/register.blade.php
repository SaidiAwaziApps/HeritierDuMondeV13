
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                    <i class="fa fa-calendar" style="opacity: 0.6;"></i> Gestion Evenements
                </span>
                <a href="{{ route('admin.evenement.list') }}" title="List d'evenements">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.evenement.save') }}" enctype="multipart/form-data" id="register_evenement_form">
                    <div id="form_content">
                        @csrf          
                        <!-- Events -->
                        <div id="event_bloc">
                            <div id="titre_bloc">
                                <div class="form-group">
                                    <label for="titre">
                                        Titre:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="titre" id="titre" class="form-control" placeholder="Entrer un titre a l'evenement" maxlength="40" required>
                                </div>
                            </div>
                            <div id="type_model_bloc">
                                <div class="form-group">
                                    <label for="type">
                                        Type:<i id="required-sign">*</i>
                                    </label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="journalier">Journalier</option>
                                        <option value="periodique">Periodique</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="model">
                                        Model:<i id="required-sign">*</i>
                                    </label>
                                    <select name="model" id="model" class="form-control" required>
                                        <option value="">Specifier le model d'evenement</option>
                                        <option value="caricature">Caricature</option>
                                        <option value="culturelle">Culturelle</option>
                                        <option value="sportive">Sportive</option>
                                        <option value="mixed">Mixed</option>
                                        <option value="non defini">Non defini</option>
                                    </select>
                                </div>
                            </div>
                            <div id="date_du_jour_bloc">
                                <div class="form-group">
                                    <label for="date_du_jour">
                                        Date du jour:<i id="required-sign">*</i>
                                    </label>
                                    <input type="date" name="date_du_jour" id="date_du_jour" class="form-control">
                                </div>
                            </div>
                            <div id="periode_date_bloc">
                                <div class="form-group">
                                    <label for="periode_date_debut">
                                        Debut:<i id="required-sign">*</i>
                                    </label>
                                    <input type="date" name="periode_date_debut" id="periode_date_debut" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="periode_date_fin">
                                        Fin:<i id="required-sign">*</i>
                                    </label>
                                    <input type="date" name="periode_date_fin" id="periode_date_fin" class="form-control">
                                </div>
                            </div>
                            <div id="lieu_bloc">
                                <div class="form-group">
                                    <label for="lieu">
                                        Lieu(localisation):<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="lieu" id="lieu" class="form-control" placeholder="Entrer le lieu" maxlength="40" required>
                                </div>
                            </div>
                            <div id="contenu_bloc">
                                <div class="form-group">
                                    <label for="contenu">
                                        Content:<i id="required-sign">*</i>
                                    </label>
                                    <textarea name="contenu" id="contenu" class="form-control" placeholder="Specifier le contenu de l'evenement" cols="30" rows="3" required></textarea>
                                </div>
                            </div>                    
                        </div>
                        

                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block btn-sm active">
                                    <span>
                                        <i class="bi bi-upload"></i> Enregistrer
                                    </span>
                                </button>
                            </div> 
                        </div>
                         

                        <div class="imgs-bloc">
                            <div class="imgs-bloc-context">
                                @include('components.admin.image.global.context')
                            </div>
                            <div class="imgs-bloc-content">
                                @include('components.admin.image.global.content')
                            </div>
                        </div>


                        @if($errors->any())
                        <div class="validator-errors">
                            @foreach($errors->all() as $error)
                            <div class="error-item">
                                {{ $error }}
                            </div>
                            @endforeach 
                        </div>
                        @endif

                    </div>
                </form>
            </div>
        </div>

        <!-- Scripts externes -->
        <script src="{{ asset('script/components/admin/image/upload/register.js') }}"></script>
        <script src="{{ asset('script/components/admin/image/vignette/register.js') }}"></script> 
        <script src="{{ asset('script/pages/admin/evenement/register.js') }}"></script>
    </div>
    @endsection
    
