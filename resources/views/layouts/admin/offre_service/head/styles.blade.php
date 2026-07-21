
@if(Route::currentRouteName() == 'admin.offre_service.register_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/offre_service/register.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.offre_service.update_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/offre_service/update.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.offre_service.list')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/offre_service/list.css') }}">
@endif