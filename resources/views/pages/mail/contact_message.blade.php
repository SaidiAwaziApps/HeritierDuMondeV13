<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reception</title>
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
            {{ $message->texte }}
        </div>
    </div>
</body>
</html>