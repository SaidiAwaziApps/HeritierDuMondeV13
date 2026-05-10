    
    @if(Route::currentRouteName() == 'admin.article.register_page' || Route::currentRouteName() == 'admin.article.update_page')
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">

        <link rel="stylesheet" href="{{ asset('style/components/admin/categorie/all.css') }}">         
    @endif

    @if(Route::currentRouteName() == 'admin.article.register_page')
        <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/register.css') }}">
    @endif


    @if(Route::currentRouteName() == 'admin.article.update_page')
        <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/update.css') }}">
    @endif

    @if(Route::currentRouteName() == 'admin.article.list')
        <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
        <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/list.css') }}">
    @endif


    @if(Route::currentRouteName() == 'admin.article.details')
        <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
    
        <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/items.css') }}">

        <link rel="stylesheet" href="{{ asset('style/components/admin/share/register.css') }}">
   
        <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/details.css') }}">
    @endif