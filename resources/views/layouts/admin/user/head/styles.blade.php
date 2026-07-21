@if(Route::currentRouteName() == 'admin.user.register_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/register.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.user.update_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/update.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.user.reset_password_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/reset_password.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.user.list')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/list.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.user.details')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/details.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.user.my_profil')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/my_profil.css') }}">
@endif