<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroller avec scrollIntoView()</title>
    <style>
        .section {
            height: 500px;
            margin: 20px;
            padding: 20px;
            background-color: lightgrey;
            border-radius: 8px;
        }
        #target {
            background-color: lightcoral;
        }
    </style>
</head>
<body>

    <div class="section">Section 1</div>
    <div class="section" id="target">Section Cible (faite défiler ici)</div>
    <div class="section">Section 3</div>

    <button onclick="scrollToTarget()">Scroller vers la section cible</button>

    <script>
        function scrollToTarget() {
            // Récupère l'élément avec l'ID 'target' et fait défiler la page pour le rendre visible
            document.getElementById('target').scrollIntoView({
                behavior: 'smooth',  // Animation fluide
                block: 'start'       // Positionner l'élément en haut de la fenêtre
            });
        }
    </script>
</body>
</html>
