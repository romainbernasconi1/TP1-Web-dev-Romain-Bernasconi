<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <link rel="stylesheet" href="assets/leaflet.css"/>

    <title>Document</title>
</head>

<body>
<div id="entete">
    <form @submit.prevent="geocode">
        <input v-model="recherche" name="adresse">
        <input @input="autocomplete" type="submit" value="rechercher">   
    </form>

    <ul v-if="villes.length">
        <li v-for="ville in villes">
            {{ ville.nom }}
        </li>
    </ul>
</div>

<div id="map"></div>   

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="assets/leaflet.js"></script>

</body>

</html>