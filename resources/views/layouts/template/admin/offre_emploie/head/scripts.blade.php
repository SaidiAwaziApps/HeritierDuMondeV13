@if(Route::currentRouteName() == 'admin.offre_emploie.register_page' || Route::currentRouteName() == 'admin.offre_emploie.update_page')
   <script src="{{ asset('dependance/js/sweetalert.min.js') }}"></script>
@endif