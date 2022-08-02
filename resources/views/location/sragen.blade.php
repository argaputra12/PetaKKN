<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Sragen
        </h2>

        <div id='map'></div>

        <script type="text/javascript" src="{{ asset('peta/Sragen.js') }}"></script>

        <script type="text/javascript">
            var map = L.map('map').setView([-7.307265, 110.842774], 12);

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
                    '<b>' + props.KECAMATAN + '</b><br />' + props.Jumlah + ' Kelompok' : 'Hover over daerah Kecamatan');
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
            geojson = L.geoJson(Sragen, {
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
                ['GENENG', -7.391884, 110.786813],
                ['JERUK', -7.384459, 110.799560],
                ['SUNGGINGAN',-7.375844, 110.808751],
                ['GIRIMARGO',-7.372149, 110.822698],
                ['DOYONG',-7.362288, 110.838982],
                ['SOKO',-7.351308, 110.831412],
                ['BROJOL',-7.359577, 110.804133],
                ['BAGOR',-7.340743, 110.810016],
                ['GILIREJO',-7.289205, 110.798621],
                ['GILIREJO BARU',-7.276183, 110.802370],
                ['PENDEM',-7.336494, 110.842781],
                ['HADILUWIH',-7.355589, 110.860353],
                ['JATI',-7.351622, 110.880052],
                ['CEPOKO',-7.337377, 110.884679],
                ['MOJOPURO',-7.328913, 110.865887],
                ['NGANDUL',-7.325365, 110.857218],
                ['PAGAK',-7.320413, 110.893567],
                ['NGARGOSARI',-7.278713, 110.863468],
                ['NGARGOTIRTO',-7.301689, 110.855966],
                ['MONDOKAN',-7.320425, 110.931938],
                ['TEMPELREJO',-7.351635, 110.925863],
                ['TROMBOL',-7.359186, 110.942417],
                ['PARE',-7.320275, 110.912883],
                ['JEKANI',-7.331403, 110.935029],
                ['KEDAWUNG',-7.313608, 110.945263],
                ['JAMBANGAN',-7.292240, 110.948177]
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
