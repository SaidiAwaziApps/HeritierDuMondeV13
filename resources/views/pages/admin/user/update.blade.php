
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
                <form method="POST" action="{{ route('admin.user.update_handler',['id'=>$user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="profil_meta_bloc">
                        <div id="profil_bloc">
                            <div id="profil_bloc_img">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ Storage::url($user->photo) }}">
                                            <img src="{{ Storage::url($user->photo) }}" alt="Profil Image" id="user_profil_img" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
                                        </a>    
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
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                            <div id="nom_prenom_bloc">
                                <div class="form-group">
                                    <label for="nom">
                                        Nom:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="nom" id="nom" value="{{ $user->nom }}" class="form-control" placeholder="Entrer nom" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">
                                        Prenom:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="prenom" id="prenom" value="{{ $user->prenom }}" class="form-control" placeholder="Entrer prenom" maxlength="20" required>
                                </div>
                            </div>
                            <div id="email_bloc">
                                <div class="form-group">
                                    <label for="email">
                                        Email:<i id="required-sign">*</i>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="Adresse @ email" required>
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
                            <div id="username_bloc">
                                <div class="form-group">
                                    <label for="username">
                                        Username:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="form-control" placeholder="Nom utilisateur" maxlength="20" required>
                                </div>
                            </div>
                            <div id="password_bloc">
                                <a href="{{ route('admin.user.reset_password_page', ['id' => $user->id]) }}" title="Cliquer pour reinitializer le mot de passe">
                                    Reset password ?
                                </a>
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
            </div>   
        </div>
        <!-- Scripts internes -->
        <script type="text/javascript">
            let roles = <?php echo($user->roles); ?>     
        </script>
        <!-- Scripts externes -->
        <script src="{{ asset('script/pages/admin/user/update.js') }}"></script>
    </div>
    @endsection

