@if(Route::currentRouteName() == 'authentication.login_page')
    <link rel="stylesheet" href="{{ asset('style/pages/auth/login.css') }}">
@endif

@if(Route::currentRouteName() == 'authentication.reset_email_page')
    <link rel="stylesheet" href="{{ asset('style/pages/auth/reset_email.css') }}">
@endif

@if(Route::currentRouteName() == 'authentication.reset_code_page')
    <link rel="stylesheet" href="{{ asset('style/pages/auth/reset_code.css') }}">
@endif

@if(Route::currentRouteName() == 'authentication.reset_password_page')
    <link rel="stylesheet" href="{{ asset('style/pages/auth/reset_password.css') }}">
@endif

@if(Route::currentRouteName() == 'authentication.update_password_page')
    <link rel="stylesheet" href="{{ asset('style/pages/auth/update_password.css') }}">
@endif


