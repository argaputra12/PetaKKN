<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Grobogan
        </h2>

        <div id="map"></div>

    <script type="text/javascript" src="{{ asset('peta/Grobogan.js') }}"></script>

    <script type="text/javascript">
      var map = L.map("map").setView([-7.03, 111.1], 12);

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
      geojson = L.geoJson(Grobogan, {
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
                ['BANDUNGSARI',	-7.054344, 111.163627],
                ['BELOR',	-7.034585, 111.204282],
                ['KALANGDOSARI',	-7.085045, 111.204532],
                ['KALANGLUNDO',	-7.078167, 111.176732],
                ['NGARAPARAP',	-7.057070, 111.205855],
                ['NGARINGAN',	-7.047189, 111.129294],
                ['PENDEM',	-7.059896, 111.146260],
                ['SARIREJO',	-7.107651, 111.167853],
                ['SENDANGREJO',	-7.107289, 111.138106],
                ['SUMBERAGUNG',	-7.000493, 111.139693],
                ['TANJUNGHARJO',	-7.033228, 111.181157],
                ['TRUWOLU',	-7.086716, 111.144957],
                ['GODAN',	-7.023191, 111.023962],
                ['JONO',	-7.086805, 110.983198],
                ['KEMADUHBATUR',	-6.986381, 111.033776],
                ['MAYAHAN',	-7.078562, 110.964286],
                ['PLOSOREJO',	-7.059805, 110.982935],
                ['POJOK',	-7.063852, 111.009555],
                ['POULONGRAMBE',	-7.096967, 110.963627],
                ['SELO',	-7.094405, 111.004584],
                ['TARUB',	-7.072173, 111.016558],
                ['TAWANGHARJO',	-7.074173, 111.017152]

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
