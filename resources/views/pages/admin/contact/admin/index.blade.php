<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Contact</title>

    <style>
        h4 {
            padding: 20px;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-family: italic;
            opacity: 0.8;
        }

        h4 i {
            font-size: 22px;
            opacity: 0.3;
        }
    </style>
</head>
<body>

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
       <!-- fin card -->
        <script type="text/javascript">
            window.APP_URL = '<?php echo($app_url);?>';
            window.STORAGE_PATH_URL = '<?php echo($storage_path_url);?>';
            window.user = <?php echo(session('user')??session('user')); ?>;
            window.messages = <?php echo($messages);?>;
        </script>
        <!-- Inclus script -->
        <script src="{{ mix('js/mains/contact/admin/index.js') }}"></script>
    </div>
    @endsection

</body>
</html>