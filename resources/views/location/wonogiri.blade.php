<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Wonogiri
        </h2>

        <div id="map"></div>

        <script type="text/javascript" src="{{ asset('peta/Wonogiri.js') }}"></script>

        <script type="text/javascript">
          var map = L.map("map").setView([-8.013050, 111.054627], 11);

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
                return d > 15 ? '#ffffcc' :
                d > 10 ? '#a1dab4' :
                d > 5 ? '#41b6c4' :
                d > 0 ? '#2c7fb8' : '#253494';
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
          geojson = L.geoJson(Wonogiri, {
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
                ['JATISARI 1',	-7.842368, 111.117395],
                ['NGELO 1',	-7.906354, 111.116526],
                ['NGELO 2',	-7.916633, 111.122335],
                ['JEBLOGAN 1',	-8.069697, 111.025930],
                ['JEBLOGAN 2',	-8.054121, 111.047812],
                ['KARANGTENGAH 1',	-8.021984, 111.100755],
                ['KARANGTENGAH 2',	-8.048099, 111.098801],
                ['NGAMBARSARI 1',	-8.029283, 111.032554],
                ['NGAMBARSARI 2',	-8.015585, 111.070143],
                ['PURWOHARJO 1',	-8.049215, 111.117254],
                ['PURWOHARJO 2',	-8.018278, 111.123603],
                ['TEMBORO 1',	-7.981453, 111.048171],
                ['TEMBORO 2',	-7.997942, 111.057271],
                ['KETOS 1',	-8.152489, 110.848298],
                ['KETOS 2',	-8.168204, 110.844382],
                ['JOHUNUT 1',	-8.139432, 110.845906],
                ['JOHUNUT 2',	-8.135022, 110.862835],
                ['GUDANGHARJO 1',	-8.180232, 110.868146],
                ['GUDANGHARJO 2',	-8.196955, 110.867146],
                ['GUNTURHARJO 1',	-8.179429, 110.889895],
                ['GUNTURHARJO 2',	-8.202027, 110.890240],
                ['SAMBIHARJO 1',	-8.156839, 110.865659],
                ['SAMBIHARJO 2',	-8.166975, 110.879734],

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
