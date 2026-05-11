    @if(Route::currentRouteName() == 'admin.besoin.register_page' || Route::currentRouteName() == 'admin.besoin.update_page')
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">    
    @endif    

    @if(Route::currentRouteName() == 'admin.besoin.register_page')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/besoin/register.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.besoin.update_page')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/besoin/update.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.besoin.list')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/besoin/list.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.besoin.details')
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/items.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/feedback_toast.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/don/donors_talks.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/share/register.css') }}">

    <link rel="stylesheet" href="{{ asset('style/pages/admin/besoin/details.css') }}">
    @endif