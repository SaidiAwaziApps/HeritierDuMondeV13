
    @extends('layouts.auth')

    @section('content')
    <div id="form_bloc">
        <form method="post" action="{{ route('authentication.update_password_handler',['user_id' => Auth::user()->id]) }}">
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
                        <label for="old_password">
                            <i class="fa fa-lock"></i> Ancien mot de passe:<i id="required-sign">*</i>
                        </label>
                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Ancien mot de passe" minlength="4" maxlength="20" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">
                            <i class="fa fa-lock"></i> Nouveau mot de passe:<i id="required-sign">*</i>
                        </label>
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nouveau mot de passe" maxlength="20" minlength="4" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">
                            <i class="fa fa-lock"></i> Confirmer mot de passe:<i id="required-sign">*</i>
                        </label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirmer mot de passe" maxlength="20" minlength="4" required>
                    </div>
                </div>

                <div id="submit_bloc">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm btn-block active">
                            <span>
                                <i class="fa fa-upload"></i> Enregistrer
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
            </div>
        </form>
    </div>
    @endsection
