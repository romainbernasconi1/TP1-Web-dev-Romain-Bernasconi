<?php
declare(strict_types=1);

session_start(); 

require_once 'flight/Flight.php';

// Connexion sql en local
$link = mysqli_connect('u2.ensg.eu', 'geo', '', 'geobase');

mysqli_set_charset($link, "utf8");
Flight::set('geobase', $link);
Flight::set('flight.views.path', __DIR__ . '/views');

// Routes :

// Page d'accueil
Flight::route('/', function() {
    Flight::render('accueil');
});

// POST / villes
Flight::route('/villes', function () {
    $link = Flight::get('geobase');

    $recherche = $_GET['recherche'];
    $villes = [];

    $sql = "SELECT nom, insee FROM communes WHERE nom LIKE '$recherche%' LIMIT 5";
    $requete = mysqli_query($link, $sql);
    foreach ($requete as $ville) {
        $villes[] = $ville;
    }
    Flight::json($villes);
});

// Lefleat
Flight::route('/leaflet', function() {
    Flight::render('leaflet');
});

// Today
Flight::route('/today', function () {
    $moisFr = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $moisEnCours = $moisFr[date('m') - 1];
    $dateJour = date('d') . ' ' . $moisEnCours . ' ' . date('Y');
    Flight::render('today', ['dateJour' => $dateJour]);
});

// Index2
Flight::route('/index2', function() {
    Flight::render('index2');
});

// Index3
Flight::route('/index3', function() {
    Flight::render('index3');
});

// Login get et post
Flight::route('GET /login', function() {
    $user = $_GET['login'] ?? null;
    Flight::render('login', ['user' => $user]);
});

Flight::route('POST /login', function() {
    $user = $_POST['login'] ?? null;
    if ($user) {
        $_SESSION['user'] = $user;
    }
    Flight::render('login', ['user' => $user]);
});

// Logout
Flight::route('/logout', function () {
    $_SESSION = [];
    session_destroy();
    Flight::redirect('/login');
});

// Départements
Flight::route('/departements', function() {
    $link = Flight::get('geobase');
    // Liste des régions
    $regions = [];
    $res_regions = mysqli_query($link, "SELECT insee, nom FROM regions ORDER BY nom");
    while ($row = mysqli_fetch_assoc($res_regions)) {
        $regions[] = $row;
    }
    $departements = [];
    // Si une région est sélectionné
    if (isset($_GET['regions']) && $_GET['regions'] != '') {
        $region_id = $_GET['regions'];
        $sql = "SELECT insee, nom 
                FROM departements 
                WHERE region_insee = '$region_id'
                ORDER BY nom";
        $res_dep = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($res_dep)) {
            $departements[] = $row;
        }
    }
    Flight::render('departements', [
        'regions' => $regions,
        'departements' => $departements
    ]);
});

// communes
Flight::route('/communes', function() {
    $link = Flight::get('geobase');
    $communes = [];
    $nom_dep = '';
    $region_id = '';
    // Vérifie si un département est select
    if (isset($_GET['id_dep']) && $_GET['id_dep'] != '') {
        $dep_id = $_GET['id_dep'];
        // Récupération du nom du departement et sa région
        $sql_dep = "SELECT nom, region_insee 
                    FROM departements 
                    WHERE insee = '$dep_id'";
        $res_dep = mysqli_query($link, $sql_dep);
        if ($row_dep = mysqli_fetch_assoc($res_dep)) {
            $nom_dep = $row_dep['nom'];
            $region_id = $row_dep['region_insee'];
        }
        // Récupération des communes du departement
        $sql_com = "SELECT insee, nom 
                    FROM communes 
                    WHERE departement_insee = '$dep_id'
                    ORDER BY nom";
        $res_com = mysqli_query($link, $sql_com);
        while ($row = mysqli_fetch_assoc($res_com)) {
            $communes[] = $row;
        }
    }
    Flight::render('communes', [
        'communes' => $communes,
        'nom_dep' => $nom_dep,
        'region_id' => $region_id
    ]);
});

Flight::start();

