 
@if(Route::currentRouteName() == 'admin.article.register_page')
    <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">

    <link rel="stylesheet" href="{{ asset('style/components/admin/categorie/all.css') }}">

    <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/register.css') }}">

    <script src="https://cdn.tiny.cloud/1/ee38iugviofz8h4oh6zztci4avjx4mkq8bq6k73l9mru5ej9/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

@endif


@if(Route::currentRouteName() == 'admin.article.update_page')
    <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">

    <link rel="stylesheet" href="{{ asset('style/components/admin/categorie/all.css') }}">

    <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/update.css') }}">
@endif


@if(Route::currentRouteName() == 'admin.article.list')
    <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/upload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/vignette/style.css') }}">

    <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/list.css') }}">
@endif


@if(Route::currentRouteName() == 'admin.article.details')
    <link rel="stylesheet" href="{{ asset('style/components/admin/blog/article/components/menu.css') }}">
    
    <link rel="stylesheet" href="{{ asset('style/components/admin/image/global/admin_template_items.css') }}">

    <link rel="stylesheet" href="{{ asset('style/components/admin/share/register.css') }}">
   
    <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/details.css') }}">

    <link rel="stylesheet" href="{{ asset('style/pages/admin/blog/article/defailt.css') }}">
@endif