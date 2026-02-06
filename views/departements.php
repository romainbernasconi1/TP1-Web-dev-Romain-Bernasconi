<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Régions et départements de France</title>
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
        select, button {
            padding: 5px 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Les régions et départements de France</h1>
<form action="departements" method="get">
    <label for="regions">Sélectionnez une région :</label>
    <select name="regions" id="regions">
        <option value="">-- Choisir une région --</option>
        <?php foreach ($regions as $reg): ?>
            <option value="<?= $reg['insee'] ?>"
                <?= (isset($_GET['regions']) && $_GET['regions'] == $reg['insee']) ? 'selected' : '' ?>>
                <?= $reg['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Valider</button>
</form>

<?php
// Si une région est select
if (isset($_GET['regions']) && $_GET['regions'] != '') {
    // Récupération du nom de la région
    $nom_region = '';
    foreach ($regions as $reg) {
        if ($reg['insee'] == $_GET['regions']) {
            $nom_region = $reg['nom'];
            break;
        }
    }

    echo '<h2>Départements de la région : ' . $nom_region . '</h2>';

    echo '<table>';
    echo '<tr><th>INSEE</th><th>Nom</th></tr>';

    foreach ($departements as $dep) {
        echo '<tr>';
        echo '<td>' . $dep['insee'] . '</td>';
        echo '<td><a href="communes?id_dep=' . $dep['insee'] . '">' . $dep['nom'] . '</a></td>';
        echo '</tr>';
    }

    echo '</table>';
}
?>

</body>
</html>
