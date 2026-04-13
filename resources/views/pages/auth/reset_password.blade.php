
    @extends('layouts.auth')

    @section('content')
    <div id="form_bloc">
        <form method="post" action="{{ route('authentication.reset_password_handler',['reset_email'=>$reset_email]) }}">
            @csrf
            @method('PUT')

            <div id="form_header">
                <img src="{{ asset('image/logo_site.png') }}" alt="Logo {{$identite->nom}}" class="rounded-circle" width="80" height="80">
                <span><i>{{ $identite->nom }}</i></span>
            </div>

            <div id="form_body">
                <h5><i class="fa fa-users"></i> Authentication</h5>

                <div id="input_bloc">
                    <div class="form-group">
                        <label for="new_password">
                            <i class="fa fa-key"></i> Nouveau mot de passe:<i id="required-sign">*</i>
                        </label>
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nouveau mot de passe" maxlength="20" minlength="4" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">
                            <i class="fa fa-key"></i> Confirmer mot de passe:<i id="required-sign">*</i>
                        </label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirmer mot de passe" maxlength="20" minlength="4" required>
                    </div>
                </div>

                <div id="submit_bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm btn-block active">
                            <span><i class="fa fa-upload"></i> Réinitialiser</span>
                        </button>
                    </div>
                </div>

                <!-- VALIDATION DU FORMUALAIRE -->
                <div id="errors_bloc">
                    @if($errors->any())
                        <div id="errors_bloc_content">
                            @foreach($errors->all() as $error)
                            <div class="error-item">
                                <span>{{ $error }}</span>    
                            </div>
                            @endforeach
                        </div> 
                    @endif
                </div>

                <!-- LIEN MOT DE PASSE OUBLIE (RESET BLOC) -->
                <div id="reset_bloc">
                    <a href="{{ route('authentication.login_page') }}">Revenir à la connexion ?</a>
                </div>

            </div>
        </form>
    </div>
    @endsection
