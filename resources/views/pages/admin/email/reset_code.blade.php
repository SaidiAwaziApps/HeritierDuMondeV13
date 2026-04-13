<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de reinitialization</title>
    <style>
        div#email_message_bloc {
            padding: 10px;
            font-size: 20px;
            font-family: italic;
        }
    </style>
</head>
<body>
    <div id="global_content">
        <div id="email_message_bloc">
            Votre code de reinitialization est: <b>{{ $reset_code }}</b>
        </div>
    </div>
</body>
</html>