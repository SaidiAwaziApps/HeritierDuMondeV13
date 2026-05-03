@if(Route::currentRouteName() == 'questionnement.list')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/questionnement/list.css') }}">
@endif

@if(Route::currentRouteName() == 'questionnement.register_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/questionnement/register.css') }}">
@endif

@if(Route::currentRouteName() == 'questionnement.update_page')
   <link rel="stylesheet" href="{{ asset('style/pages/admin/questionnement/update.css') }}">
@endif