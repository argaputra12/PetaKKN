<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Sukoharjo
        </h2>

        <div class="container flex  mx-auto mb-6">
            <div id="map" style="width:100%" class="w-full z-10" ></div>
        </div>
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden h-screen mt-16 flex justify-center items-center">
            <div id="table_data" ></div>
        </div>

        <script type="text/javascript" src="{{ asset('peta/Sukoharjo.js') }}"></script>

        <script type="text/javascript">
          var map = L.map("map").setView([-7.72, 110.83], 12);

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
            return d > 15
              ? "#ffffcc"
              : d > 10
              ? "#a1dab4"
              : d > 5
              ? "#41b6c4"
              : d > 0
              ? "#2c7fb8"
              : "#253494";
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
          geojson = L.geoJson(Sukoharjo, {
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
                ['Tegalsari', -7.772421, 110.736290, 78],
                ['Tawang', -7.755085, 110.747921, 79],
                ['Karanganyar', -7.795045, 110.769694, 80],
                ['Karangwuni',-7.802010, 110.748851,81],
                ['Watubonang', -7.750249, 110.767203, 82],
                ['Grogol', -7.786481, 110.722895, 83],
                ['Jatingarang', -7.805429, 110.770495, 84],
                ['Karakan', -7.787471, 110.746681, 85],
                ['Puron', -7.751139, 110.808234, 86],
                ['Malangan', -7.738826, 110.805508,87],
                ['Bulu',-7.759699, 110.834332,88],
                ['Kunden', -7.759060, 110.819253,89],
                ['Ngasinan', -7.744230, 110.833101,90],
                ['Lengking', -7.734421, 110.820228,91],
                ['Sanggang', -7.783151, 110.807451,92],
                ['Kamal', -7.772322, 110.819014,93],
                ['Gentan', -7.783943, 110.838216,94],
                ['Kedongsono', -7.798920, 110.850010,95],
                ['Ngreco', -7.764683, 110.765204,96],
                ['Kateguhan', -7.730387, 110.793861,97],
                ['Alasombo', -7.788293, 110.786944,98],
                ['Pojok', -7.718595, 110.799830,99],
                ['Majasto', -7.701204, 110.777921,100],
                ['Ponowaren', -7.718537, 110.778086,101],
                ['Tangkisan', -7.707128, 110.793211,102],
                ['Grajegan', -7.734785, 110.773827,103],
                ['Lorog', -7.743879, 110.790315,104],
                ['Pundungrejo', -7.762459, 110.796256,105],
                ['Weru', -7.779751, 110.756573,106],
                ['Mranggen', -7.633651, 110.889183,107]
            ];

            for (let i = 0; i < desa.length; i++) {
                marker = L.marker([desa[i][1], desa[i][2]])
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
