var map = L.map('map').setView([48.85, 2.35], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var popup = L.popup()
    .setLatLng([48.85, 2.35])
    .setContent("I am a standalone popup.")
    .openOn(map);

function onMapClick(e) {
    alert("You clicked the map at " + e.latlng);
}

map.on('click', onMapClick);

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("You clicked the map at " + e.latlng.toString())
        .openOn(map);
}

var markers = L.geoJSON().addTo(map);

let geomCommune = L.geoJSON().addTo(map);

Vue.createApp({
  data() {
    return {
        recherche: '',
        villes: [],
    };
  },

  computed: {
    urlrecherche() {
        return 'https://data.geopf.fr/geocodage/search?q=' + this.recherche
    },
  },

  methods: {

    geocode() {
        fetch(this.urlrecherche)
        .then(res => res.json())
        .then(donnees => {
        markers.clearLayers();
        markers.addData(donnees);

        let bounds = markers.getBounds();
        map.fitBounds(bounds);
        });
    },

    autocomplete() {
        let url = '/villes?recherche=' + this.recherche;
        console.log(url);
        fetch(url)
        .then(res => res.json())
        .then(donnees => {
            this.villes = donnees;
        });
    },

    recupGeometrie(ville) {
        this.ville = [];
        let url = '/ville?insee=' + ville;
        console.log(url);
        fetch(url)
        .then(res => res.json())
        .then(donnees => {
            console.log(donnees)
            this.villes = donnees;
            geomCommune.clearLayers();
            geomCommune.addData(donnees);

        let bounds = geomCommune.getBounds();
        map.fitBounds(bounds);
    });
  },
},

}).mount('#entete');