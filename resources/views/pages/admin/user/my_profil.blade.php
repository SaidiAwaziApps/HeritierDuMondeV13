<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>

    <style>

        
        div#form_bloc {
            /* width: 34%; */
            display: flex;
            justify-content: center;
            align-items: center; 
            height: 88vh;  
        }

        div#form_bloc form {
            width: 60%;
        }

        @media all and (max-width: 1000px) {
            div#form_bloc {
                height: 100vh;  
            }
            div#form_bloc form {
                width: 64%;
            }
        }

        @media all and (max-width: 500px) {
            div#form_bloc {
                height: 100vh;  
            }
            div#form_bloc form {
                width: 100%;
                padding-left: 10px;
                padding-right: 10px;
            } 
        }


        div#form_bloc_content h4 {
            text-align: center;
            padding: 8px;
            border-radius: 4px;
            background-color: #f8f8ff;
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.8;
            border-bottom: 2px solid #ccc;
            margin-bottom: 10px;
        }

        div#form_bloc_content h4 i {
            opacity: 0.6;
        }


        div#form_header {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }

        div#form_header span {
            display: block;
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        div#form_body {
            margin-top: 6px;
        }



        div#profil_meta_bloc {
            display: flex;
            justify-content: space-between;
            flex: nowrap;
        }

        div#profil_meta_bloc > div#profil_bloc {
            width: 30%;
        }

        div#profil_meta_bloc > div#meta_bloc {
            width: 68%;
        }

        @media all and (min-width: 600px) {
            div#profil_bloc > div#profil_bloc_img .card .card-body {
                height: 196px; 
            }
        }

        @media all and (max-width: 600px) {
            div#profil_meta_bloc {
                display: block;
                margin-bottom: 10px;
            }
            div#profil_meta_bloc > div#profil_bloc {
                width: 100%;
                padding-left: 40px;
                padding-right: 40px;
            }
            div#profil_meta_bloc > div#meta_bloc {
                width: 100%;
                padding-top: 12px;
                margin-top: 12px;
                border-top: 2px solid #f8f8ff;
            }    

            div#profil_meta_bloc > div#meta_bloc > div {
                margin-bottom: 3px;
            }
        }

        div#profil_meta_bloc > div#meta_bloc > div {
            margin-bottom: 4px;
        }


        div#profil_bloc_img > .card > .card-body {
            height: 190px;
        }

        div#profil_bloc_input > label {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
            display: block;
            text-align: center;
            padding: 4px;
            margin-top: 6px;
            border-radius: 4px;
            background-color: cadetblue;
            color: white;
            cursor: pointer;
        }

        div#profil_bloc_input > input {
            display: none;
        }


        div#nom_prenom_bloc {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#nom_prenom_bloc > div {
            width: 49.5%;
        }

        @media all and (max-width: 600px) {
            div#nom_prenom_bloc {
                display: block;
            }
            div#nom_prenom_bloc > div {
                width: 100%;
                margin-bottom: 4px;
            }   
        }

        div#username_password_bloc {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap;
        }

        div#username_password_bloc > div {
            width: 49.5%;
        }

        @media all and (max-width: 600px) {
            div#username_password_bloc {
                display: block;
            }
            div#username_password_bloc > div {
                width: 100%;
            }
        }

        div#role_bloc {
            padding: 10px 10px 1px 10px;
        }

        div#role_bloc input {
            margin-left: 10px;
        }

        div#role_bloc span {
            font-size: 17px;
            font-family: italic;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
        }

        label i[id="required-sign"] {
            color: red;
        }

        div#submit_bloc {
            margin-top: 8px;
        }

        input[type="text"],input[type="email"],input[type="password"] {
            border-bottom: 1px solid #ccc;
        }

        div#submit_bloc .d-grid button span {
            font-size: 16px;
            font-weight: bold;
            font-family: italic;
        }
    </style>

</head>
<body>

    @extends('layouts.authentication')

    @section('content')
    <div id="form_bloc">
        <!-- form -->
        <form method="POST" action="{{ route('user.update',['id'=>session('user')->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="form_bloc_content">
                <div id="form_header">
                    <img src="{{ asset('image/logo_site.png') }}" alt="Logo {{$identite->nom}}" class="rounded-circle">
                    <span>
                        <i>{{ $identite->nom }}</i>
                    </span>
                </div>
                <div id="form_body">
                    <h4>
                        <i class="fa fa-user"></i> My Profil (Admin) 
                    </h4>
                    <div id="profil_meta_bloc">
                        <div id="profil_bloc">
                            <div id="profil_bloc_img">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ Storage::url(session('user')->photo) }}" alt="Profil Image" id="user_profil_img" class="rounded-thumbnail cover" style="width: 100%;height: 100%;">
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
                            <input type="hidden" name="id" id="id" value="">
                            <div id="nom_prenom_bloc">
                                <div class="form-group">
                                    <label for="nom">
                                        Nom:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="nom" id="nom" value="{{ session('user')->nom }}" class="form-control" placeholder="Entrer nom" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">
                                        Prenom:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="prenom" id="prenom" value="{{ session('user')->prenom }}" class="form-control" placeholder="Entrer prenom" maxlength="20" required>
                                </div>
                            </div>
                            <div id="email_bloc">
                                <div class="form-group">
                                    <label for="email">
                                        Email:<i id="required-sign">*</i>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ session('user')->email }}" class="form-control" placeholder="Adresse @ email">
                                </div>
                            </div>
                            <!-- <div id="role_bloc">
                                <label for="roles">
                                    Roles:<i id="required-sign">*</i>
                                </label>
                                <input type="checkbox" name="roles[]" id="roles" value="admin"> <span> Admin </span>
                                <input type="checkbox" name="roles[]" id="roles" value="blogeur"> <span> Blogeur </span>
                                <input type="checkbox" name="roles[]" id="roles" value="auteur"> <span> Auteur </span>
                            </div> -->
                            <div id="username_password_bloc">
                                <div class="form-group">
                                    <label for="username">
                                        Username:<i id="required-sign">*</i>
                                    </label>
                                    <input type="text" name="username" id="username" value="{{ session('user')->username }}" class="form-control" placeholder="Nom utilisateur" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        Password:<i id="required-sign">*</i>
                                    </label>
                                    <input type="password" name="password" id="password" value="{{ session('user')->password }}" class="form-control" placeholder="Mot de passe" maxlength="20" required>
                                </div>
                            </div>
                        </div>
                        <!-- fin meta_bloc --> 
                    </div>
                
                    <div id="submit_bloc">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-block btn-sm active">
                                <span>
                                    <i class="bi bi-upload"></i> Appliquer la mise a jour
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
            </div>        
        </form>  

        <script src="{{ asset('script/user/my_profil.js') }}"></script>

    </div>
    @endsection

</body>
</html>