   @extends('layouts.admin')

   @section('content')
        @php $headTitle = 'Utilisateurs'; @endphp
   <div id="globalContent">
        <div class="card">
            <div class="card-header">
                <span class="card-title">
                   <i class="fa fa-users"></i> Gestion utilisateurs
                </span>   
                <a href="{{ route('admin.user.list') }}" class="btn btn-default btn-sm active">
                    <span>
                        <i class="fa fa-list"></i>
                    </span>
                </a>
            </div>
            <div class="card-body">
                <!-- form -->
                <form method="POST" action="{{ route('admin.user.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="profil_meta_bloc">
                        <div id="profil_bloc">
                            <div id="profil_bloc_img">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset('image/user_icone.png') }}" alt="Profil Image" id="user_profil_img" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div id="profil_bloc_input">
                                <label for="photo">
                                    <i class="bi bi-image"></i> Inserer photo
                                </label>
                                <input type="file" accept="image/*" name="photo" id="photo" class="form-control">
                            </div>
                        </div>
                        <!-- fin profil_bloc -->
                        <div id="meta_bloc">
                            <div id="nom_prenom_bloc">
                                <div class="form-group">
                                    <label for="nom">
                                        Nom:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrer nom" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">
                                        Prenom:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Entrer prenom" maxlength="20" required>
                                </div>
                            </div>
                            <div id="email_bloc">
                                <div class="form-group">
                                    <label for="email">
                                        Email:<i id="required-sign">*</i>
                                    </label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Adresse @ email" required>
                                </div>
                            </div>
                            <div id="role_bloc">
                                <label for="roles">
                                    Roles:<i id="required-sign">*</i>
                                </label>
                                <input type="checkbox" name="roles[]" id="roles" value="admin"> <span> Admin </span>
                                <input type="checkbox" name="roles[]" id="roles" value="blogeur"> <span> Blogeur </span>
                                <input type="checkbox" name="roles[]" id="roles" value="auteur"> <span> Auteur </span>
                            </div>
                            <div id="username_password_bloc">
                                <div class="form-group">
                                    <label for="username">
                                        Username:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Nom utilisateur" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Password:<i id="required-sign">*</i>
                                    </label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <!-- fin meta_bloc --> 
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

                    @if($errors->any())
                        @foreach($errors->all() as $error)
                        <div class="text-red-500" style="text-align: center;color:red;font-family: italic;">
                            {{ $error }}
                        </div>
                        @endforeach
                    @endif

                </form>
                <!-- formulaire -->
            </div>   
        </div>
        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/user/register.js') }}"></script>
    </div>
    @endsection    

