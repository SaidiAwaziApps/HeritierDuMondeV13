<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>

    <!-- CSS -->
    <link href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}">

    <!-- JS -->
    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>
    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <style>
        body {
            background-color: rgb(243, 243, 251);
        }

        div#form_bloc {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 88vh;  
        }

        div#form_bloc form {
            width: 34%;
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        @media all and (max-width: 1000px) {
            div#form_bloc form {
                width: 64%;
            }
        }

        @media all and (max-width: 500px) {
            div#form_bloc form {
                width: 100%;
                padding: 10px;
            }
        }

        div#form_header {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 15px;
        }

        div#form_header span {
            display: block;
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            opacity: 0.6;
        }

        div#form_body h5 {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            font-family: italic;
            margin-bottom: 15px;
        }

        div#form_body h5 i {
            opacity: 0.6;
            margin-right: 6px;
        }

        label {
            font-size: 17px;
            font-weight: bold;
            font-family: italic;
        }

        label i[id="required-sign"] {
            color: red;
            margin-left: 2px;
        }

        input[id="username"],
        input[id="password"] {
            border-bottom: 2px solid #ccc;
        }

        div#submit_bloc {
            margin-top: 15px;
        }

        div#submit_bloc span {
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
        }

        div#error_bloc {
            margin-top: 10px;
        }

        .error_item span {
            display: block;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            font-family: italic;
            color: red;
            margin-bottom: 4px;
        }

        div#reset_bloc a {
            float: right;
            font-size: 16px;
            font-family: italic;
            text-decoration: none;
        }

        div#reset_bloc a:hover {
            text-decoration: underline;
        }

        div#sociaux_info {
            padding: 18px 0 6px 0;
            margin-top: 15px;
            border-radius: 6px;
            background-color: #ccc;
        }

        div#sociaux_info ul {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 0;
            margin: 0;
        }

        div#sociaux_info ul li {
            list-style: none;
            margin-left: 16px;
        }

        div#sociaux_info ul li:first-child {
            margin-left: 0;
        }

        div#sociaux_info ul li span {
            font-size: 19px;
            font-family: italic;
        }

        div#sociaux_info ul li a:hover {
            opacity: 0.4;
        }

        @media all and (max-width: 500px) {
            div#sociaux_info ul li span {
                display: none;
            }
            div#sociaux_info ul li {
                margin-left: 12px;
            }
        }
    </style>
</head>
<body>
    <div id="global_content">
        <div id="form_bloc">
            <form method="POST" action="{{ route('authentication.login_handler') }}">
                @csrf
                <div id="form_header">
                    <img src="{{ asset('image/logo_site.png') }}" alt="Logo {{ $identite->nom }}" class="rounded-circle" width="80" height="80">
                    <span><i>{{ $identite->nom }}</i></span>
                </div>
                <div id="form_body">
                    <h5><i class="fa fa-users"></i>Login</h5>
                    <div id="input_bloc">
                        <div class="form-group">
                            <label for="username"><i class="fa fa-user"></i> Username:<i id="required-sign">*</i></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Nom utilisateur" maxlength="60" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fa fa-lock"></i> Password:<i id="required-sign">*</i></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" maxlength="20" minlength="4" required>
                        </div>
                    </div>
                    <div id="submit_bloc">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm btn-block active">
                                <span><i class="fa fa-sign-in-alt"></i> Se connecter</span>
                            </button>
                        </div>
                    </div>
                    <div id="error_bloc">
                        @if($errors->any())
                        <div id="error_bloc_content">
                            @foreach($errors->all() as $error)
                            <div class="error_item">
                                <span>{{ $error }}</span>    
                            </div>
                            @endforeach
                        </div> 
                        @endif
                    </div>
                    <div id="reset_bloc">
                        <a href="#">Forget password?</a>
                    </div>
                </div>
            </form>
        </div>

        <div id="sociaux_info">
            <ul>
                <li><span>Contactez sur:</span></li>
                <li><a href="{{ $identite->sociaux->facebook }}" title="Facebook"><i class="bi bi-facebook" style="color: blue;"></i></a></li>
                <li><a href="{{ $identite->sociaux->twitter }}" title="Twitter"><i class="bi bi-twitter" style="color: #00acee;"></i></a></li>
                <li><a href="{{ $identite->sociaux->google }}" title="Google+"><i class="bi bi-google" style="color: #db4a39;"></i></a></li>
                <li><a href="{{ $identite->sociaux->instagram }}" title="Instagram"><i class="bi bi-instagram" style="color: #C32AA3;"></i></a></li>
            </ul>
        </div>
    </div>
</body>
</html>