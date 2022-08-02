<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Cilacap
        </h2>

        <div id="map"></div>

    <script type="text/javascript" src="{{ asset('peta/Cilacap.js') }}"></script>

    <script type="text/javascript">
      var map = L.map("map").setView([-7.68, 109.1], 12);

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
      geojson = L.geoJson(Cilacap, {
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
                ['KUTAWARU 1','bersama', 'mabar',-7.707998, 108.978316],
                ['KUTAWARU 2','Tidur', 'istirahat',-7.705545, 108.973830],
                ['KUTAWARU 3','Tidur', 'istirahat',-7.706465, 108.979244],
                ['ADIRAJA 1','Tidur', 'istirahat',-7.651430, 109.181241],
                ['ADIRAJA 2','Tidur', 'istirahat',-7.657555, 109.177465],
                ['KARANGTALUN',	'Tidur', 'istirahat',-7.677599, 109.018900]
            ];

            for (let i = 0; i < desa.length; i++) {
                marker = L.marker([desa[i][3], desa[i][4]])
                .bindPopup(`<div class="flex flex-col items-center">
                    <div class="item">
                        Desa: ${desa[i][0]}
                    </div>
                    <div class="item">
                        Tema: ${desa[i][1]}
                    </div>
                    <div class="item">
                        Judul: ${desa[i][2]}
                    </div>
                    <div class="item">
                        ${desa[i][0]}
                    </div>
                </div>`)
                .addTo(map);
                console.log(marker);
            }
    </script>
    </x-slot>


</x-app-layout>

{{-- <div class="flex flex-col items-center">
    <div class="item">
        ${desa[i][0]}
    </div>
    <div class="item">
        ${desa[i][0]}
    </div>
    <div class="item">
        ${desa[i][0]}
    </div>
    <div class="item">
        ${desa[i][0]}
    </div>
</div> --}}
