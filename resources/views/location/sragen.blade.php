<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textdark font-poppins my-14">
            Pemetaan Kelompok KKN Kabupaten Sragen
        </h2>

        <div class="border-2 container flex  mx-auto mb-6">
            <div id="map" style="width:100%" class="w-full z-10" ></div>
        </div>
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden min-h-[102vh] mt-16 flex justify-center items-center">
            <div id="table_data" ></div>
        </div>

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
                ['GENENG', -7.391884, 110.786813, 191],
                ['JERUK', -7.384459, 110.799560, 192],
                ['SUNGGINGAN',-7.375844, 110.808751, 193],
                ['GIRIMARGO',-7.372149, 110.822698,194],
                ['DOYONG',-7.362288, 110.838982,195],
                ['SOKO',-7.351308, 110.831412,196],
                ['BROJOL',-7.359577, 110.804133,197],
                ['BAGOR',-7.340743, 110.810016,198],
                ['GILIREJO',-7.289205, 110.798621,199],
                ['GILIREJO BARU',-7.276183, 110.802370,200],
                ['PENDEM',-7.336494, 110.842781,201],
                ['HADILUWIH',-7.355589, 110.860353,202],
                ['JATI',-7.351622, 110.880052,203],
                ['CEPOKO',-7.337377, 110.884679,204],
                ['MOJOPURO',-7.328913, 110.865887,205],
                ['NGANDUL',-7.325365, 110.857218,206],
                ['PAGAK',-7.320413, 110.893567,207],
                ['NGARGOSARI',-7.278713, 110.863468,208],
                ['NGARGOTIRTO',-7.301689, 110.855966,209],
                ['MONDOKAN',-7.320425, 110.931938,210],
                ['TEMPELREJO',-7.351635, 110.925863,211],
                ['TROMBOL',-7.359186, 110.942417,212],
                ['PARE',-7.320275, 110.912883,213],
                ['JEKANI',-7.331403, 110.935029,214],
                ['KEDAWUNG',-7.313608, 110.945263,215],
                ['JAMBANGAN',-7.292240, 110.948177,216]
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
                .bindPopup(`<div class="flex flex-col py-2">
                        <div class="flex justify-center">
                            <div class="font-semibold">KKN DESA ${desa[i][0]}</div>
                        </div>
                        <button class="bg-blue-500 rounded-md font-semibold text-white w-20 h-6 mt-4 mx-auto" onclick="showData(this)">
                            <input type="hidden" name="desa_id" value="${desa[i][3]}">
                            Detail
                        </button>
                    </div>`)
                .addTo(map);
            }

            const showData = (e) =>{

                const table_data = document.querySelector('.modal-container');
                table_data.classList.remove('hidden');

                const desa_id = e.children[0].value;

                $.ajax({
                    url: `{{ route('location.show') }}`,
                    type: 'POST',
                    data: {
                        'desa_id': desa_id,
                    },
                    success: function(data) {
                        table_data.innerHTML = data;
                    }

                });
            }

            const closeContainer = () =>{
                const table_data = document.querySelector('.modal-container');
                table_data.classList.add('hidden');
            }
        </script>
    </x-slot>
</x-app-layout>
