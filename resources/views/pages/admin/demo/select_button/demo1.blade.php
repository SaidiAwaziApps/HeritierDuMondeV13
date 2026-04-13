<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bouton Sélecteur</title>
</head>
<body>
    <!-- Bouton pour ouvrir un menu déroulant -->
    <button onclick="document.getElementById('selectOption').style.display = 'block';">
        Sélectionner une option
    </button>

    <!-- Menu déroulant caché au départ -->
    <select id="selectOption" style="display:none;" onchange="alert('Vous avez sélectionné : ' + this.value)">
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>
</body>
</html>
