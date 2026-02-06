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

var marker = null;

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
        .then(data => {
            let lon = data.features[0].geometry.coordinates[0];
            let lat = data.features[0].geometry.coordinates[1];
            let nom = data.features[0].properties.label;
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lon]).addTo(map);
            marker.bindPopup(nom).openPopup();
            map.setView([lat, lon], 12);
        });
    },

    autocomplete() {
        let url = '/villes?recherche=' + this.recherche;
        fetch(url)
        .then(res => res.json())
        .then(donnees => {
            this.villes = donnees;
        });
    }
  },

}).mount('#entete');