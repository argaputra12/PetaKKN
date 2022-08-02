<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Sukoharjo
        </h2>

        <div id="map"></div>

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
                ['Tegalsari', -7.772421, 110.736290],
                ['Tawang', -7.755085, 110.747921],
                ['Karanganyar', -7.795045, 110.769694],
                ['Karangwuni',-7.802010, 110.748851],
                ['Watubonang', -7.750249, 110.767203],
                ['Grogol', -7.786481, 110.722895],
                ['Jatingarang', -7.805429, 110.770495],
                ['Karakan', -7.787471, 110.746681],
                ['Puron', -7.751139, 110.808234],
                ['Malangan', -7.738826, 110.805508],
                ['Bulu',-7.759699, 110.834332],
                ['Kunden', -7.759060, 110.819253],
                ['Ngasinan', -7.744230, 110.833101],
                ['Lengking', -7.734421, 110.820228],
                ['Sanggang', -7.783151, 110.807451],
                ['Kamal', -7.772322, 110.819014],
                ['Gentan', -7.783943, 110.838216],
                ['Kedongsono', -7.798920, 110.850010],
                ['Ngreco', -7.764683, 110.765204],
                ['Kateguhan', -7.730387, 110.793861],
                ['Alasombo', -7.788293, 110.786944],
                ['Pojok', -7.718595, 110.799830],
                ['Majasto', -7.701204, 110.777921],
                ['Ponowaren', -7.718537, 110.778086],
                ['Tangkisan', -7.707128, 110.793211],
                ['Grajegan', -7.734785, 110.773827],
                ['Lorog', -7.743879, 110.790315],
                ['Pundungrejo', -7.762459, 110.796256],
                ['Weru', -7.779751, 110.756573],
                ['Mranggen', -7.633651, 110.889183]
            ];

            for (let i = 0; i < desa.length; i++) {
                marker = L.marker([desa[i][1], desa[i][2]])
                .bindPopup(`<b>${desa[i][0]}</b>`)
                .addTo(map);
                console.log(marker);
            }
        </script>
    </x-slot>


</x-app-layout>
