<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bouton Sélection Personnalisée</title>
    <style>
        #optionsList {
            display: none;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        #optionsList li {
            background-color: lightgrey;
            margin: 5px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <button onclick="toggleOptions()">Sélectionner une option</button>

    <ul id="optionsList">
        <li onclick="selectOption('Option 1')">Option 1</li>
        <li onclick="selectOption('Option 2')">Option 2</li>
        <li onclick="selectOption('Option 3')">Option 3</li>
    </ul>

    <script>
        function toggleOptions() {
            const optionsList = document.getElementById('optionsList');
            optionsList.style.display = optionsList.style.display === 'none' ? 'block' : 'none';
        }

        function selectOption(option) {
            alert('Vous avez sélectionné: ' + option);
            document.getElementById('optionsList').style.display = 'none'; // Ferme la liste après sélection
        }
    </script>

</body>
</html>
