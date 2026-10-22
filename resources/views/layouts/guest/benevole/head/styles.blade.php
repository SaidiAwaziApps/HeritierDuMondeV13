
@if(Route::currentRouteName() == 'guest.benevole.list') 
    <link rel="stylesheet" href="{{ asset('style/components/guest/benevole/volunter-item.css') }}">
    <link rel="stylesheet" href="{{ asset('style/pages/guest/benevole/list.css') }}">
@endif


@if(Route::currentRouteName() == 'guest.benevole.register') 
    <link href="{{ asset('dependance/select2/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style/pages/guest/benevole/register.css') }}">
@endif