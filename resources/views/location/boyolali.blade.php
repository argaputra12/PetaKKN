<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Boyolali
        </h2>

        <div id='map'></div>

        <div id="map"></div>

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
                ['GIRIROTO', -7.491981, 110.797119],
                ['GIRIROTO 2', -7.497699, 110.805940],
                ['KISMOYOSO', -7.506018, 110.789028],
                ['KISMOYOSO 2',-7.504636, 110.805486],
                ['PANDEYAN',-7.517458, 110.790869],
                ['PANDEYAN 2',-7.516278, 110.804450],
                ['DONOHUDAN',-7.514164, 110.781167],
                ['DONOHUDAN 2',-7.523816, 110.788789],
                ['SAWAHAN',-7.526224, 110.808043],
                ['GAGAKSIPAT',-7.520445, 110.767189],
                ['DIBAL',-7.506562, 110.774377],
                ['MANGGUNG',-7.492671, 110.780926],
                ['SINDON',-7.503940, 110.759534],
                ['NGESREP',-7.517476, 110.747417],
                ['NGARGOREJO',-7.514445, 110.725101],
                ['SOBOKERTO',-7.501683, 110.735858],
                ['JEMBUNGAN',-7.550744, 110.686235],
                ['JEMBUNGAN 2',-7.552479, 110.701024],
                ['KUWIRAN',-7.543106, 110.703794],
                ['SAMBON',-7.556110, 110.717142],
                ['DENGGUNGAN',-7.525653, 110.714680],
                ['NGARU-ARU',-7.541063, 110.680648],
                ['BENDAN',-7.545023, 110.672435],
                ['DUKUH',-7.557019, 110.679556],
                ['JIPANGAN',-7.558828, 110.691437],
                ['TANJUNGSARI',-7.515964, 110.683294],
                ['TRAYU',-7.518285, 110.692630],
                ['BATAN',-7.533221, 110.703546],
                ['BANGAK',-7.522801, 110.701927],
                ['KETAON',-7.530606, 110.676011],
                ['BANYUDONO',-7.530678, 110.688083],
                ['BANYUDONO 2',-7.533842, 110.695407],
                ['CANGKRINGAN',-7.542883, 110.690511],
                ['JIPANGAN 2',-7.562276, 110.686604],
                ['GAGAKSIPAT 2',-7.522865, 110.756915],
                ['DIBAL 2',-7.507257, 110.765482],
                ['MANGGUNG 2',-7.493883, 110.771278],
                ['SINDON 2',-7.515716, 110.758507],
                ['NGARGOREJO 2',-7.523525, 110.726878],
                ['SOBOKERTO 2',-7.515201, 110.738205],
                ['KUWIRAN 2',-7.537053, 110.692795],
                ['SAMBON 2',-7.562602, 110.717591],
                ['DENGGUNGAN 2',-7.522830, 110.706463],
                ['DUKUH',-7.556924, 110.679405],
                ['KARANGANYAR',-7.598256, 110.542133],
                ['PAGERJURANG',-7.578053, 110.564847],
                ['MUDAL',-7.502071, 110.616475],
                ['KRAGILAN',-7.528187, 110.626249],
                ['BUTUH',-7.553614, 110.632528]

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
