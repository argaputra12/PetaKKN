<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Boyolali
        </h2>

        <div class="container flex  mx-auto mb-6">
            <div id="map" style="width:100%" class="w-full z-10" ></div>
        </div>
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden h-screen mt-16 flex justify-center items-center">
            <div id="table_data" ></div>
        </div>

        <script type="text/javascript" src="{{ asset('peta/Boyolali.js') }}"></script>

        <script type="text/javascript">
          var map = L.map("map").setView([-7.55, 110.61], 11);

          L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
              '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          }).addTo(map);

          // control that shows state info on hover
          var info = L.control();

          info.onAdd = function (map) {
            this._div = L.DomUtil.create("div", "info");
            this.update();
            return this._div;
          };

          info.update = function (props) {
            this._div.innerHTML =
              "<h4>Pesebaran Tim KKN UNS 2022</h4>" +
              (props
                ? "<b>" +
                  props.KECAMATAN +
                  "</b><br />" +
                  props.Jumlah +
                  " Kelompok"
                : "Hover over daerah Kecamatan");
          };

          info.addTo(map);

          // get color depending on population density value
          function getColor(d) {
            return d > 20
              ? "#980043"
              : d > 15
              ? "#7a0177"
              : d > 10
              ? "#006837"
              : d > 5
              ? "#253494"
              : d > 0
              ? "#993404"
              : "#bd0026";
          }

          function style(feature) {
            return {
              weight: 0.5,
              opacity: 1,
              color: "white",
              dashArray: "3",
              fillOpacity: 0.7,
              fillColor: getColor(feature.properties.Jumlah),
            };
          }

          function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
              weight: 5,
              color: "#666",
              dashArray: "",
              fillOpacity: 0.7,
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
              click: zoomToFeature,
            });
          }

          /* global statesData */
          geojson = L.geoJson(Boyolali, {
            style: style,
            onEachFeature: onEachFeature,
          }).addTo(map);

          map.attributionControl.addAttribution("Universitas Sebelas Maret 2022");

          var legend = L.control({
            position: "bottomright",
          });

          legend.onAdd = function (map) {
            var div = L.DomUtil.create("div", "info legend");
            var grades = [0, 5, 10, 15, 20];
            var labels = [];
            var from, to;

            for (var i = 0; i < grades.length; i++) {
              from = grades[i];
              to = grades[i + 1];

              labels.push(
                '<i style="background:' +
                  getColor(from + 1) +
                  '"></i> ' +
                  from +
                  (to ? "&ndash;" + to : "+")
              );
            }

            div.innerHTML = labels.join("<br>");
            return div;
          };

          legend.addTo(map);

          // marker
          var desa = [
                ['GIRIROTO', -7.491981, 110.797119, 108],
                ['GIRIROTO 2', -7.497699, 110.805940, 109],
                ['KISMOYOSO', -7.506018, 110.789028,110],
                ['KISMOYOSO 2',-7.504636, 110.805486,111],
                ['PANDEYAN',-7.517458, 110.790869, 112],
                ['PANDEYAN 2',-7.516278, 110.804450,113],
                ['DONOHUDAN',-7.514164, 110.781167,114],
                ['DONOHUDAN 2',-7.523816, 110.788789,115],
                ['SAWAHAN',-7.526224, 110.808043,116],
                ['GAGAKSIPAT',-7.520445, 110.767189,117],
                ['DIBAL',-7.506562, 110.774377,118],
                ['MANGGUNG',-7.492671, 110.780926,119],
                ['SINDON',-7.503940, 110.759534,120],
                ['NGESREP',-7.517476, 110.747417,121],
                ['NGARGOREJO',-7.514445, 110.725101,122],
                ['SOBOKERTO',-7.501683, 110.735858,123],
                ['JEMBUNGAN',-7.550744, 110.686235,124],
                ['JEMBUNGAN 2',-7.552479, 110.701024,125],
                ['KUWIRAN',-7.543106, 110.703794,126],
                ['SAMBON',-7.556110, 110.717142,127],
                ['DENGGUNGAN',-7.525653, 110.714680,128],
                ['NGARU-ARU',-7.541063, 110.680648,129],
                ['BENDAN',-7.545023, 110.672435,130],
                ['DUKUH',-7.557019, 110.679556,131],
                ['JIPANGAN',-7.558828, 110.691437,132],
                ['TANJUNGSARI',-7.515964, 110.683294,133],
                ['TRAYU',-7.518285, 110.692630,134],
                ['BATAN',-7.533221, 110.703546,135],
                ['BANGAK',-7.522801, 110.701927,136],
                ['KETAON',-7.530606, 110.676011,137],
                ['BANYUDONO',-7.530678, 110.688083,138],
                ['BANYUDONO 2',-7.533842, 110.695407,139],
                ['CANGKRINGAN',-7.542883, 110.690511,140],
                ['JIPANGAN 2',-7.562276, 110.686604,141],
                ['GAGAKSIPAT 2',-7.522865, 110.756915,142],
                ['DIBAL 2',-7.507257, 110.765482,143],
                ['MANGGUNG 2',-7.493883, 110.771278,144],
                ['SINDON 2',-7.515716, 110.758507,145],
                ['NGARGOREJO 2',-7.523525, 110.726878,146],
                ['SOBOKERTO 2',-7.515201, 110.738205,147],
                ['KUWIRAN 2',-7.537053, 110.692795,148],
                ['SAMBON 2',-7.562602, 110.717591,149],
                ['DENGGUNGAN 2',-7.522830, 110.706463,150],
                ['DUKUH',-7.556924, 110.679405,151],
                ['KARANGANYAR',-7.598256, 110.542133,152],
                ['PAGERJURANG',-7.578053, 110.564847,153],
                ['MUDAL',-7.502071, 110.616475,154],
                ['KRAGILAN',-7.528187, 110.626249,155],
                ['BUTUH',-7.553614, 110.632528,156]

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
                console.log(marker);
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
