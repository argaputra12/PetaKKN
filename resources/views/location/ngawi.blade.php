<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textdark my-14 font-poppins">
            Pemetaan Kelompok KKN Kabupaten Ngawi
        </h2>

        <div class="container flex  mx-auto mb-6 border-2">
            <div id="map" style="width:100%" class="w-full z-10" ></div>
        </div>
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden min-h-[102vh] mt-16 flex justify-center items-center">
            <div id="table_data" ></div>
        </div>

        <script type="text/javascript" src="{{ asset('peta/Ngawi.js') }}"></script>

        <script type="text/javascript">
            var map = L.map("map").setView([-7.53, 111.28], 12);

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
                  : "Hover over Kecamatan");
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
            geojson = L.geoJson(Ngawi, {
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
                ['GAYAM',	-7.551265, 111.267699,251],
                ['DADAPAN',	-7.537040, 111.290563,252],
                ['PATALAN',	-7.525527, 111.328529,253],
                ['KENDAL',	-7.564315, 111.302173,254],
                ['MAJASEM',	-7.562707, 111.326015,255],
                ['NGRAYUDAN',	-7.563956, 111.252802,256],
                ['KLETEKAN',	-7.534390, 111.235354,257],
                ['GIRIMULYO',	-7.569095, 111.240264,258],
                ['MACANAN',	-7.530007, 111.279967,259],
                ['JOGOROGO',	-7.520750, 111.273414,260]
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
