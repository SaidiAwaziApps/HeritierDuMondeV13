
@if(Route::currentRouteName() == 'admin.offre_emploie.register_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/offre_emploie/register.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.offre_emploie.update_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/offre_emploie/update.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.offre_emploie.list')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/offre_emploie/list.css') }}">
@endif