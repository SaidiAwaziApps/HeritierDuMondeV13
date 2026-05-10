
    @if(Route::currentRouteName() == 'admin.article.register_page' || Route::currentRouteName() == 'admin.article.update_page')
        <script src="{{ asset('dependance/axios/axios.min.js') }}"></script>
        <script src="https://cdn.tiny.cloud/1/ee38iugviofz8h4oh6zztci4avjx4mkq8bq6k73l9mru5ej9/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    @endif