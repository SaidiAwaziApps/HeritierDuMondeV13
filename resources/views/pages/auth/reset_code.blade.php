    
    @extends('layouts.auth')

    @section('content')
    <div id="form_bloc">
        <form method="post" action="{{ route('authentication.reset_code_handler') }}">
            @csrf
            <div id="form_header">
                <img src="{{ asset('image/logo_site.png') }}" alt="Logo {{$identite->nom}}" class="rounded-circle" width="80" height="80">
                <span><i>{{ $identite->nom }}</i></span>
            </div>

            <div id="form_body">
                <h5><i class="fa fa-users"></i>Authentication</h5>

                <input type="hidden" name="send_code" value="{{ $send_code }}">
                <input type="hidden" name="reset_email" value="{{ $reset_email }}">

                <div id="input_bloc">
                    <div class="form-group">
                        <label for="reset_code">
                            <i class="fa fa-wrench"></i> Code:<i id="required-sign">*</i>
                        </label>
                        <input type="number" name="reset_code" id="reset_code" class="form-control" placeholder="Code réinitialisation" maxlength="8" required>
                    </div>
                </div>

                <div id="submit_bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm btn-block active">
                            <span><i class="fa fa-sign-in-alt"></i> Soumettre</span>
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

