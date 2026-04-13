@if(Route::currentRouteName() == 'user.register_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/register.css') }}">
@endif

@if(Route::currentRouteName() == 'user.update_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/update.css') }}">
@endif

@if(Route::currentRouteName() == 'user.list')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/list.css') }}">
@endif

@if(Route::currentRouteName() == 'user.details')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/details.css') }}">
@endif

@if(Route::currentRouteName() == 'user.my_profil')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/user/my_profil.css') }}">
@endif