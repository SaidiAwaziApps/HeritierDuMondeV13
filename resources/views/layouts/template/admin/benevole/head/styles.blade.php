
@if(Route::currentRouteName() == 'admin.benevole.list')
    <link rel="stylesheet" href="{{ asset('style/pages/admin/benevole/list.css') }}">
@endif

@if(Route::currentRouteName() == 'admin.benevole.details')
    <link rel="stylesheet" href="{{ asset('style/pages/admin/benevole/details.css') }}">
@endif