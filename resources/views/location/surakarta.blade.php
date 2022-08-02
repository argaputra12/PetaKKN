<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kota Surakarta
        </h2>

        <div id='map'></div>

    <script type="text/javascript" src="{{ asset('peta/Surakarta.js') }}"></script>

    <script type="text/javascript">

var map = L.map('map').setView([-7.57, 110.82], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// control that shows state info on hover
var info = L.control();

info.onAdd = function(map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info.update = function(props) {
    this._div.innerHTML = '<h4>Pesebaran Tim KKN UNS 2022</h4>' + (props ?
                '<b>' + props.KECAMATAN + '</b><br />' + props.Jumlah + ' Kelompok' : 'Hover over Kecamatan');
            };

            info.addTo(map);


            // get color depending on population density value
            function getColor(d) {
                return d > 15 ? '#ffffcc' :
                d > 10 ? '#a1dab4' :
                d > 5 ? '#41b6c4' :
                d > 0 ? '#2c7fb8' : '#253494';
            }

            function style(feature) {
                return {
                    weight: 0.5,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7,
                    fillColor: getColor(feature.properties.Jumlah)
                };
            }

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({
                    weight: 5,
                    color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }

        var geojson;

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        /* global statesData */
        geojson = L.geoJson(statesData, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);

        map.attributionControl.addAttribution('Universitas Sebelas Maret 2022');


        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'info legend');
            var grades = [0, 5, 10, 15, 20];
            var labels = [];
            var from, to;

            for (var i = 0; i < grades.length; i++) {
                from = grades[i];
                to = grades[i + 1];

                labels.push(
                    '<i style="background:' + getColor(from + 1) + '"></i> ' +
                    from + (to ? '&ndash;' + to : '+'));
                }

                div.innerHTML = labels.join('<br>');
                return div;
            };

            legend.addTo(map);

            // marker
            var desa = [
                ['PASAR KLIWON', -7.581113, 110.830505],
                ['KAUMAN', -7.572757, 110.825884],
                ['SEWU', -7.572871, 110.843645],
                ['PUCANGSAWIT', -7.567869, 110.853693],
                ['MOJOSONGO', -7.544419, 110.844643],
                ['JAGALAN', -7.566730, 110.843249],
                ['KEPATIHAN WETAN',	-7.565246, 110.832167],
                ['GILINGAN', -7.554372, 110.826787],
                ['PUNGGAWAN', -7.560864, 110.817334],
                ['KESTALAN', -7.558898, 110.823015],
                ['MOJO',	-7.589308, 110.835705],
                ['PAJANG',	-7.567942, 110.786661],
                ['TIPES',	-7.577963, 110.811556],
                ['SEMANGGI',	-7.586578, 110.835410],
                ['BANYUANYAR',	-7.539024, 110.805365],
                ['NUSUKAN',	-7.549406, 110.824706],
                ['DANUSUMAN',	-7.586928, 110.821658],
                ['KADIPIRO',	-7.534867, 110.821935],
                ['GANDEKAN',	-7.571709, 110.838501],
                ['JOGLO',	-7.545279, 110.827029],
                ['KRATONAN',	-7.578730, 110.817927],
                ['KARANGASEM',	-7.550126, 110.777397],
                ['KAMPUNGBARU',	-7.568756, 110.828299],
                ['BANJARSARI',	-7.545078, 110.817790],
                ['SUMBER',	-7.547456, 110.803626],
                ['PURWODININGRAT',	-7.564627, 110.837242],
                ['LAWEYAN',	-7.570186, 110.794542],
                ['SERENGAN',	-7.584310, 110.816484],
                ['SONDAKAN',	-7.565379, 110.792977],
                ['TEGALHARJO',	-7.559268, 110.834851],
                ['PASAR KLIWON 2',	-7.590319, 110.830539],
                ['KAUMAN 2',	-7.574918, 110.824590],
                ['SEWU 2',	-7.574452, 110.841301],
                ['PUCANGSAWIT 2',	-7.570657, 110.848064],
                ['MOJOSONGO 2',	-7.552493, 110.838206],
                ['JAGALAN 2',	-7.569623, 110.845524],
                ['KEPATIHAN WETAN  2',	-7.563098, 110.834055],
                ['GILINGAN 2',	-7.553439, 110.816908],
                ['PUNGGAWAN 2',	-7.563114, 110.815217],
                ['KESTALAN 2',	-7.557364, 110.821194],
                ['PANULARAN',	-7.573227, 110.806404],
                ['JOYOTAKAN',	-7.592674, 110.820733],
                ['KEDUNGLUMBU',	-7.574112, 110.831719],
                ['SETABELAN',	-7.561605, 110.826441],
                ['MANAHAN',	-7.554849, 110.808091],
                ['SANGKRAH',	-7.576824, 110.839009],
                ['SRIWEDARI',	-7.568745, 110.813593],
                ['PURWOSARI', -7.564716, 110.802262]

            ];

            var redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
                });


            for (let i = 0; i < desa.length; i++) {
                marker = L.marker([desa[i][1], desa[i][2]], {icon: redIcon})
                .bindPopup(`<b>${desa[i][0]}</b>`)
                .addTo(map);
                console.log(marker);
            }
            </script>
    </x-slot>


</x-app-layout>
