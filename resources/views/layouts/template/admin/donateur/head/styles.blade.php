
    @if(Route::currentRouteName() == 'admin.donateur.list')
        <link rel="stylesheet" href="{{ asset('style/components/admin/don/donors_talks.css') }}">
        <link rel="stylesheet" href="{{ asset('style/pages/admin/donateur/list.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.donateur.details')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/donateur/details.css') }}">
    @endif
