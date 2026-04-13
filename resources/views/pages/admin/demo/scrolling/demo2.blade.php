<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroller avec scrollTo()</title>
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

    <button onclick="scrollToPosition()">Scroller vers une position spécifique</button>

    <script>
        function scrollToPosition() {
            // Défile la page à 1000 pixels du haut de la fenêtre
            window.scrollTo({
                top: 1000,
                behavior: 'smooth'  // Animation fluide
            });
        }
    </script>
</body>
</html>
