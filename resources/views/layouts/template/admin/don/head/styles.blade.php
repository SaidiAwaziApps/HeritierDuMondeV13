
    @if(Route::currentRouteName() == 'admin.don.list')
        <link rel="stylesheet" href="{{ asset('style/components/admin/don/donors_talks.css') }}">
        <link rel="stylesheet" href="{{ asset('style/pages/admin/don/list.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.don.details')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/don/details.css') }}">
    @endif
