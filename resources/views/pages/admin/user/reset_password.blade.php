   @extends('layouts.admin')

   @section('content')
        @php $headTitle = 'Utilisateurs'; @endphp
   <div id="globalContent">
        <div class="card">
            <div class="card-body">
                <!-- form -->
                <form method="POST" action="{{ route('admin.user.reset_password_handler', ['id' => $user->id]) }}" id="reset_password_form">                    
                    @csrf
                    @method('PUT')
                    <div id="reset_password_form_content">
                        <h4>
                            <span>Reset Password</span>
                        </h4>

                        <div id="inputs_bloc">
                            <div class="form-group">
                                <label for="new_password">
                                    New Password:<i id="required-sign">*</i>
                                </label>
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Nouveau mot de passe" maxlength="20" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">
                                    Confirm Password:<i id="required-sign">*</i>
                                </label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirmer le nouveau mot de passe" maxlength="20" minlength="8" required>
                            </div>
                        </div>
                        
                        <div id="submit_bloc">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-block btn-sm active">
                                    <span>
                                        <i class="bi bi-upload"></i> Reinitialiser
                                    </span>
                                </button>
                            </div>
                        </div>

                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="text-red-500" style="text-align: center;color:red;font-family: italic;">
                                   {{ $error }}
                                </div>
                            @endforeach
                        @endif 
                    </div>

                    

                </form>
                <!-- formulaire -->
            </div>   
        </div>
    </div>
    @endsection    

