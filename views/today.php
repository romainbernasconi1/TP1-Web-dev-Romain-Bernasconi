<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $moisFr = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $moisEnCours = $moisFr[date('m') -1];
    
    $joursFr = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche']; 
    ?>
    <p>Nous sommes le <?= date('d') . ' ' . $moisEnCours . ' ' . date('Y') ?></p>

    <table>
        <tr>
            <?php foreach ($joursFr as $jour) { 
                if ($jour == $joursFr[date('N')-1]) {
                    echo '<td class=today>'. $jour .'</td>' ;
                } else {
                    echo '<td>'. $jour .'</td>' ;
             
                }
            }
            ?>
        <tr>
    <table>
</body>
</html>