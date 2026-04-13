<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroller avec scrollBy()</title>
    <style>
        .section {
            height: 500px;
            margin: 20px;
            padding: 20px;
            background-color: lightgrey;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <div class="section">Section 1</div>
    <div class="section">Section 2</div>
    <div class="section">Section 3</div>
    <div class="section">Section 4</div>

    <button onclick="scrollByAmount()">Scroller de 300px</button>

    <script>
        function scrollByAmount() {
            // Défile la page de 300 pixels vers le bas
            window.scrollBy({
                top: 300,           // Défilement vers le bas de 300px
                behavior: 'smooth'  // Animation fluide
            });
        }
    </script>
</body>
</html>
