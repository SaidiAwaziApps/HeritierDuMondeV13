    
    @extends('layouts.admin')

    @section('content')
    <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title"> 
                    <i class="fa fa-globe" style="color: cadetblue;"></i> Identite du site web 
                </span>
            </div> 
            <div class="card-body">
                <div id="section">
                    <div class="d-flex-center">
                        <div id="content">
                            <form method="POST" action="{{ route('identite.update_handler',['id' => $identite->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div id="form_content_bloc">
                                    <div id="first_content_bloc">
                                        <div id="logo_bloc">
                                            <div id="logo_bloc_image">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <img src="{{ Storage::url($identite->logo) }}" alt="" class="rounded-thumbnail" id="input_logo_img" style="width: 100%;height: 100%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="logo_bloc_input">
                                                <label for="logo">
                                                    <i class="bi bi-image"></i> Inserer logo
                                                </label>
                                                <input type="file"  accept="image/*" name="logo" id="logo">
                                            </div>
                                        </div>
                                        <!-- Fin logo_bloc  -->
                                        <div id="input_bloc">
                                            <div id="nom_bloc">
                                                <div class="form-group">
                                                    <label for="nom">
                                                        Nom:<i id="required-sign">*</i>
                                                    </label>
                                                    <input type="text" name="nom" id="nom" class="form-control input-sm" placeholder="Entrer le nom du site" maxlength="30" value="{{ $identite->nom }}" required>
                                                </div>
                                            </div>
                                            <div id="slogant_bloc">
                                                <div class="form-group">
                                                    <label for="slogant">
                                                        Slogant:<i id="not-required-sign">*</i>
                                                    </label>
                                                    <input type="text" name="slogant" id="slogant" class="form-control input-sm" placeholder="Entrer le slogant du site" maxlength="30" value="{{ $identite->slogant }}">
                                                </div>
                                            </div>
                                            <div id="tel_email_bloc">
                                                <div class="form-group">
                                                    <label for="tel">
                                                        Tel:<i id="required-sign">*</i>
                                                    </label>
                                                    <input type="tel" name="tel" id="tel" class="form-control" placeholder="Numero telephone" maxlength="20" value="{{ $identite->tel }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel">
                                                        Email:<i id="required-sign">*</i>
                                                    </label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="Adresse @ email" maxlength="60" value="{{ $identite->email }}" required>
                                                </div>
                                            </div>
                                            <div id="adresse_bloc">
                                                <div class="form-group">
                                                    <label for="adresse">
                                                        Adresse:<i id="required-sign">*</i>
                                                    </label>
                                                    <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Entrer le siege (adresse)" maxlength="100" value="{{ $identite->adresse }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fin input_bloc -->  
                                    </div>
                                    <!-- fin first_content_bloc -->   
                                    <div id="second_content_bloc">
                                        <h6>
                                            Inserer liens sociaux: <i class="bi bi-facebook" style="color: blue;"></i> <i class="bi bi-twitter" style="color: #00acee;"></i> <i class="bi bi-google" style="color: #db4a39;"></i> <i class="bi bi-instagram" style="color: #C32AA3;"></i> 
                                        </h6>
                                        <div id="social_bloc">
                                            <div id="facebook_bloc">
                                                <label for="facebook">
                                                    <i class="bi bi-facebook" style="color: blue;"></i> Facebook:
                                                </label>
                                                <input type="url" name="facebook" id="facebook" class="form-control" placeholder="Lien facebook" value="{{ $identite->sociaux->facebook }}">
                                            </div>
                                            <div id="twitter_bloc">
                                                <label for="twitter">
                                                    <i class="bi bi-twitter" style="color: #00acee;"></i> Twitter:
                                                </label>
                                                <input type="url" name="twitter" id="twitter" class="form-control" placeholder="Lien Twitter"  value="{{ $identite->sociaux->twitter }}">
                                            </div>
                                            <div id="google_bloc">
                                                <label for="google">
                                                    <i class="bi bi-google" style="color: #db4a39;"></i> Google+:
                                                </label>
                                                <input type="url" name="google" id="google" class="form-control" placeholder="Lien google+"  value="{{ $identite->sociaux->google }}">
                                            </div>
                                            <div id="instagram_bloc">
                                                <label for="instagram">
                                                    <i class="bi bi-instagram" style="color: #C32AA3;"></i> Instagram:
                                                </label>
                                                <input type="url" name="instagram" id="instagram" class="form-control" placeholder="Lien Instagram"  value="{{ $identite->sociaux->instagram }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="firth_content_bloc">
                                        <div id="description_bloc">
                                            <div class="form-group">
                                                <label for="description">
                                                    Description:<i id="required-sign">*</i>
                                                </label>
                                                <textarea name="description" id="description" class="form-control" cols="30" rows="2" placeholder="Entrer votre texte descriptif ..." value="{{ $identite->description }}"></textarea>
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
                                    
                                    <!-- BLOC IMAGES (INCLUS IMAGES && VIGNETTES) -->
                                    <div class="imgs-bloc">
                                        <div class="imgs-bloc-context">
                                            @include('components.admin.image.global.context')
                                        </div>
                                        <div class="imgs-bloc-content">
                                            @include('components.admin.image.global.content')
                                        </div>
                                    </div>

                                    <!-- ERREURS VALIDATION FORMULAIRE -->
                                    @if($errors->any())
                                        @foreach($errors->all() as $error)
                                        <div style="text-align: center;margin-top: 1px;">
                                            <span style="color: red;font-size: 18px;font-weight: bold;font-family: italic;">
                                                {{ $error }}
                                            </span>   
                                        </div>
                                        @endforeach
                                    @endif

                                </div>
                            </form> 
                        </div> 
                    </div>
                </div>
                <!-- Fin section -->
            </div>
            <!-- Fin card-body -->
        </div>
        <!-- fin card -->  
        
        <script type="text/javascript">
            window.STORAGE_PATH_URL = '<?php echo(env('STORAGE_PATH_URL'));?>';
            let identite = <?php echo($identite); ?>;
            let images = identite.images;
            let vignettes = identite.vignettes;
        </script>

        <!-- Scripts pour image -->
        <script src="{{ asset('script/components/admin/image/upload/update.js') }}"></script>
        <script src="{{ asset('script/components/admin/image/vignette/update.js') }}"></script>

        <!--  Script pour update -->
        <script src="{{ asset('script/pages/admin/identite/update.js') }}"></script>  
    </div>
    @endsection

 