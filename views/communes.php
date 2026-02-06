<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communes du département</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
// Vérifie si un département a été sélectionné
if (isset($nom_dep) && $nom_dep !== '') {

    echo '<h1>Les communes du département : ' . $nom_dep . '</h1>';
// tableau html
    if (isset($communes) && count($communes) > 0) {
        echo '<table>';
        echo '<tr><th>INSEE</th><th>Nom</th></tr>';

        foreach ($communes as $com) {
            echo '<tr>';
            echo '<td>' . $com['insee'] . '</td>';
            echo '<td>' . $com['nom'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }

    echo '<p><a href="departements?regions=' . $region_id . '">← Retour à la région</a></p>';
}
?>

</body>
</html>
