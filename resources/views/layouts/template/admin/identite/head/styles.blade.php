@if(Route::currentRouteName() == 'admin.identite.register_page')
   <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
   <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
   <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">
   <link rel="stylesheet" href="{{ asset('style/pages/admin/identite/register.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.identite.update_page')
   <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
   <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
   <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">
   <link rel="stylesheet" href="{{ asset('style/pages/admin/identite/update.css') }}">
@endif