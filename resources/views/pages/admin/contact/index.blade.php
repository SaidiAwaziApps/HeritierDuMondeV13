
    @extends('layouts.admin')

    @section('content')
    <div id="global_content">
        <!-- card -->
        <div class="card">
            <div class="card-body" style="padding-bottom: 42px;">
                <h4>
                   <i class="fa fa-users"></i> Contact(messagerie)
                </h4>
                <div id="contact_hub">

                </div>
            </div>
        </div>

        <!-- Script interne -->
        <script type="text/javascript">
            window.APP_URL = @json(env('APP_URL'));
            window.STORAGE_PATH_URL = @json(env('STORAGE_PATH_URL'));
            window.user = @json(optional(Auth::user()));
            window.messages = @json($messages);
        </script>

        <!-- Script interne -->
        @vite('resources/js/mains/admin/contact/index.js')
    </div>
    @endsection

