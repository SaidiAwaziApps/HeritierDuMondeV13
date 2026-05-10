@if(Route::currentRouteName() == 'regulation.register_page' || Route::currentRouteName() == 'regulation.update_page')
    <!-- jQuery (obligatoire pour Select2) -->
    <script src="{{ asset('dependance/jquery/jquery.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('dependance/select2/select2.min.js') }}"></script>
@endif