<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bouton de Sélection avec Case à Cocher</title>
</head>
<body>
    <button onclick="toggleSelect()">Activer/Désactiver Sélection</button>
    
    <select id="selectOption" disabled>
        <option value="option1">Option 1</option>
        <option value="option2">Option 2</option>
        <option value="option3">Option 3</option>
    </select>

    <script>
        function toggleSelect() {
            var select = document.getElementById('selectOption');
            select.disabled = !select.disabled; // Alterne l'état disabled
        }
    </script>
</body>
</html>