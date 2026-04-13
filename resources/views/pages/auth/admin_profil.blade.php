@extends('layouts.authentication')

@section('content')
<div id="form_bloc">
    <form method="POST" action="{{ route('user.update', ['id'=>session('user')->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div id="form_bloc_content">
            <h4>
                <i class="fa fa-user"></i> My Profil (Admin) 
            </h4>

            <div id="profil_meta_bloc">
                <!-- Profil Bloc -->
                <div id="profil_bloc">
                    <div id="profil_bloc_img">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ Storage::url(Auth::user()->photo) }}" alt="Profil Image" id="user_profil_img" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                            </div>
                        </div>
                    </div>
                    <div id="profil_bloc_input">
                        <label for="photo"><i class="bi bi-image"></i> Inserer photo</label>
                        <input type="file" accept="image/*" name="photo" id="photo" class="form-control">
                    </div>
                </div>

                <!-- Meta Bloc -->
                <div id="meta_bloc">
                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">

                    <div id="nom_prenom_bloc">
                        <div class="form-group">
                            <label for="nom">Nom:<i id="required-sign">*</i></label>
                            <input type="text" name="nom" id="nom" value="{{ Auth::user()->nom }}" class="form-control" placeholder="Entrer nom" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prenom:<i id="required-sign">*</i></label>
                            <input type="text" name="prenom" id="prenom" value="{{ Auth::user()->prenom }}" class="form-control" placeholder="Entrer prenom" maxlength="20" required>
                        </div>
                    </div>

                    <div id="email_bloc">
                        <div class="form-group">
                            <label for="email">Email:<i id="required-sign">*</i></label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Adresse @ email" required>
                        </div>
                    </div>

                    <div id="role_bloc">
                        <label>Roles:<i id="required-sign">*</i></label>
                        @php $roles = ['admin', 'blogeur', 'auteur']; @endphp
                        @foreach($roles as $role)
                            <input type="checkbox" name="roles[]" id="role_{{ $role }}" value="{{ $role }}"
                                @if(in_array($role, Auth::user()->roles ?? [])) checked @endif>
                            <label for="role_{{ $role }}">{{ ucfirst($role) }}</label>
                        @endforeach
                    </div>

                    <div id="username_password_bloc">
                        <div class="form-group">
                            <label for="username">Username:<i id="required-sign">*</i></label>
                            <input type="text" name="username" id="username" value="{{ session('user')->username }}" class="form-control" placeholder="Nom utilisateur" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:<i id="required-sign">*</i></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" maxlength="20">
                        </div>
                    </div>
                </div>
                <!-- fin meta_bloc --> 
            </div>
            
            <div id="submit_bloc">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block btn-sm active">
                        <span><i class="bi bi-upload"></i> Enregistrer</span>
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
</div>
@endsection