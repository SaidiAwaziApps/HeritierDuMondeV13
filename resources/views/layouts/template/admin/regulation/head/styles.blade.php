@if(Route::currentRouteName() == 'regulation.register_page')
   <link href="{{ asset('dependance/select2/select2.min.css') }}" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('style/pages/admin/regulation/register.css') }}">
@endif

@if(Route::currentRouteName() == 'regulation.update_page')
   <!-- Select2 CSS -->
   <link href="{{ asset('dependance/select2/select2.min.css') }}" rel="stylesheet" />
   <link rel="stylesheet" href="{{ asset('style/pages/admin/regulation/update.css') }}">
@endif