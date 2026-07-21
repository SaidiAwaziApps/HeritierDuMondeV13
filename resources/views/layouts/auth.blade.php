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

    <!-- Style layouts auth -->
    <link rel="stylesheet" href="{{ asset('style\layouts\auth.css') }}">

    <!-- Style template pour auth -->
    @include('layouts.auth.authentication.head.styles')

    <script src="{{ asset('dependance/font-awesome/font-awesome.js') }}"></script>
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('dependance/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
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