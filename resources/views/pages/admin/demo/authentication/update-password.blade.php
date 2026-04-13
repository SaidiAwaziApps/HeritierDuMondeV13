<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à jour le mot de passe</title>
    <style>
        /* Style similaire à la page de login */
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Mettre à jour votre mot de passe</h2>
        <form action="/update-password" method="POST">
            <input type="password" name="old_password" placeholder="Ancien mot de passe" required>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="confirm_new_password" placeholder="Confirmer le nouveau mot de passe" required>
            <button type="submit">Mettre à jour le mot de passe</button>
        </form>
        <a href="login.html" class="link">Retour à la connexion</a>
    </div>
</body>
</html>
