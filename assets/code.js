// let solution = (Math.round(Math.random()*101))
// console.log("jeu")
// let msg = prompt('Combien ?')
// let tour = 0;

// while (msg != solution) {
//     console.log(tour += 1)
//     if (msg < solution) {
//         msg = prompt ('La solution est plus élevée !');
//     } else {
//         (msg > solution)
//         msg = prompt ('La solution est plus petite !');
//     }
// }
// alert('Trouvé')

let polygons = [
    [
        [
            [48.857757564566924,2.339316137485028],
                [48.856806083163775,2.3410084512700275],
                [48.85500429223433,2.3431007664951173],
                [48.85424556800601,2.3448607983431384],
                [48.85346104822773,2.3470146522513193],
                [48.852722069967,2.348637735017842],
                [48.852246283670866,2.3498685086796596],
                [5.513516521235,3.512416589454425],
                [48.85158827389591,2.352683903431068],
                [48.85202863524094,2.352391594686386],
                [48.85372424333016,2.3520685166001587],
                [48.8546352926156,2.3512762060553634],
                [48.85546534530812,2.3495454305934325],
                [48.855769019683805,2.3483223492670007],
                [48.85667497062573,2.3452915691247744],
                [48.857282302859346,2.3412992470592533],

                [48.857757564566924,2.339316137485028]
        ]
    ],
        [
            [
                [48.85374747782521,2.3530207906753438],
                [48.85253332128681,2.3532408660072544],
                [48.85163103910017,2.353884163131301],
                [48.85105178764471,2.3558479122468126],
                [48.849893264629145,2.3592336865839],
                [48.84948109132219,2.360317134371768],
                [48.85032771390132,2.36001241468143],
                [48.85104064812796,2.3601478456549136],
                [48.85167559662685,2.35960612176098],
                [48.85373633890825,2.353410154724109],
                [48.85374747782521,2.3530207906753438]
            ]
        ]
]

let new_polygons = []
polygons.forEach((polygon, i) => { //polygon pour récupérer les multipolygons
    new_polygons[i] = [];
    console.log(i, polygon);
    polygon.forEach((shape, j) => { //shape pour récupérer un polygon
        new_polygons[i][j] = [];
        console.log(j, shape);
        shape.forEach((point) => { //point pour récupérer les lignes
            if (point[0] < 48.86 && point[0] > 48.84 && point[1] < 2.37 && point[1] > 2.33) {
            let lat = Number(point[0].toFixed(5))
            let lon = Number(point[1].toFixed(5))
            
            new_polygons[i][j].push([lon, lat]);
            console.log(point);

            }
        })
    })
})

let geojson = {
  "type": "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "properties": {},
      "geometry": {
        "coordinates": new_polygons,
        "type": "MultiPolygon"
      }
    }
  ]
};

console.log(JSON.stringify(geojson))