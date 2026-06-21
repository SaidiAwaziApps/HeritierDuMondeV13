@if(Route::currentRouteName() == 'admin.dashboard.admin')
    <script src="{{ asset('script/pages/admin/dashboard/admin/evenement/events_moment.js') }}"></script>
    <script src="{{ asset('script/pages/admin/dashboard/admin/evenement/events_modele.js') }}"></script>
    <script src="{{ asset('script/pages/admin/dashboard/admin/donation/donateurs.js') }}"></script>
    <script src="{{ asset('script/pages/admin/dashboard/admin/donation/dons.js') }}"></script>
    <script src="{{ asset('script/pages/admin/dashboard/admin/donation/besoins.js') }}"></script>
    <script src="{{ asset('script/pages/admin/dashboard/admin/offre_emploie/domaines.js') }}"></script>
    <script src="{{ asset('script/pages/admin/dashboard/admin/offre_emploie/organisations.js') }}"></script>
@endif