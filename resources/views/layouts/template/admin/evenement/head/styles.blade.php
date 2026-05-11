    
    @if(Route::currentRouteName() == 'admin.evenement.register_page' || Route::currentRouteName() == 'admin.evenement.update_page')
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.evenement.register_page')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/evenement/register.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.evenement.update_page')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/evenement/update.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.evenement.list')
        <link rel="stylesheet" href="{{ asset('style/pages/admin/evenement/list.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.evenement.details')
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/items.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/feedback_toast.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/don/donors_talks.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/share/register.css') }}">
         
        <link rel="stylesheet" href="{{ asset('style/pages/admin/evenement/details.css') }}">
    @endif


    

