
    @extends('layouts.auth')

    @section('content')
    <div id="form_bloc">
        <form method="post" action="{{ route('authentication.login_handler') }}">
            @csrf
            <div id="form_header">
                <img src="{{ asset('image/logo_site.png') }}" alt="Logo {{$identite->nom}}" class="rounded-circle" width="80" height="80">
                <span><i>{{ $identite->nom }}</i></span>
            </div>

            <div id="form_body">
                <h5><i class="fa fa-users"></i>Login</h5>

                <div id="input_bloc">
                    <div class="form-group">
                        <label for="username">
                            <i class="fa fa-user"></i> Username:<i id="required-sign">*</i>
                        </label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Nom utilisateur" maxlength="60" required>
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fa fa-lock"></i> Password:<i id="required-sign">*</i>
                        </label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" maxlength="20" minlength="4" required>
                    </div>
                </div>

                <div id="submit_bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm btn-block active">
                            <span>
                               <i class="fa fa-upload"></i> Se connecter 
                            </span>
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
                    <a href="{{ route('authentication.reset_email_page') }}">Forget password?</a>
                </div>
                
            </div>
        </form>
    </div>
    @endsection
