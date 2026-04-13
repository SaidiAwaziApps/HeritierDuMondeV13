<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>

    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('dependance/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/dataTable/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dependance/bootstrap-icons-1.11.3/font/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('dependance/font-awesome/font-awesome.min.css') }}">

    <!-- Style template pour auth -->
    @include('components.auth.template.head.styles')

    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <style>
        
        body {
            background-color:rgb(243, 243, 251);
        }

        
        div#sociaux_info {
            padding: 18px 0px 6px 0px;
            margin-top: 10px;
            border-radius: 6px;
            background-color: #ccc;
        }

        div#sociaux_info > div {
           display: flex;
           justify-content: center;
           align-items: center;
        }

        div#sociaux_info > div ul li {
            float: left;
            margin-left: 16px;
            list-style-type: none;
        }

        div#sociaux_info > div ul li span {
            font-size: 19px;
            font-family: italic;
        }

        @media all and (max-width: 500px) {
            div#sociaux_info > div ul li {
                margin-left: 20px;
            }
            div#sociaux_info > div ul li span {
              display: none;
            } 
        }

        div#sociaux_info > div ul li a:hover {
            opacity: 0.4;
        }


    </style>

</head>
<body>
    <div id="global_content">
        <div id="section">
            @yield('content')
        </div>
        <div id="sociaux_info">
            <div id="sociaux_info_content">
                <ul>
                    <li>
                        <span>Contactez sur:</span>
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->facebook }}" title="Facebook">
                            <i class="bi bi-facebook" style="color: blue;"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->twitter }}" title="Twitter">
                            <i class="bi bi-twitter" style="color: #00acee;"></i>
                        </a> 
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->google }}" title="Google+">
                            <i class="bi bi-google" style="color: #db4a39;"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $identite->sociaux->instagram }}" title="Instagram">
                            <i class="bi bi-instagram" style="color: #C32AA3;"></i> 
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- fin social_bloc -->
    </div>
</body>
</html>