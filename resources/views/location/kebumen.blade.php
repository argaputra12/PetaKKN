<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Kebumen
        </h2>

        <div id="map"></div>

    <script type="text/javascript" src="{{ asset('peta/Kebumen.js') }}"></script>

    <script type="text/javascript">
      var map = L.map("map").setView([-7.64, 109.65], 11);

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
      geojson = L.geoJson(Kebumen, {
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
                ['PATUKGAWEMULYO ',	-7.787356, 109.814133],
                ['PATUKREJOMULYO ',	-7.782762, 109.800509],
                ['TLOGOPRAGOTO ',	-7.816872, 109.787274],
                ['PONCOWARNO',	-7.662104, 109.745002],
                ['ROWO ',	-7.806448, 109.828932],
                ['KARANGGAYAM',	-7.555346, 109.658866],
                ['KEBAKALAN',	-7.566218, 109.655862],
                ['SEBARA',	-7.525471, 109.708320],
                ['KALIGENDING',	-7.594627, 109.690495],
                ['LOGEDE',	-7.684187, 109.624174],
                ['KEBULUSAN',	-7.670186, 109.630741],
                ['PENGARINGAN',	-7.599837, 109.641256],
                ['KEC KUTOWINANGUN 1',	-7.705289, 109.744305],
                ['KEC KUTOWINANGUN 2',	-7.708181, 109.753060],
                ['JATIMALANG',	-7.725889, 109.638427],
                ['JOGOMERTAN',	-7.748834, 109.609345],
                ['WONOSARI',	-7.524306, 109.734872],
                ['PUCANGAN',	-7.524756, 109.688464],
                ['TANGGULANGIN',	-7.781062, 109.637943],
                ['BANJARWINANGUN',	-7.703395, 109.612252],
                ['AMPELSARI ',	-7.756625, 109.597967],
                ['JOGOSIMO',	-7.776894, 109.614466],
                ['KRAKAL',	-7.612887, 109.703037],
                ['KALIPUTIH',	-7.618555, 109.751168],
                ['KEMANGGUAN ',	-7.632874, 109.665911],

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
