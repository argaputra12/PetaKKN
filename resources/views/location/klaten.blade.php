<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kota Klaten
        </h2>

        <div id="map"></div>

    <script type="text/javascript" src="{{ asset('peta/Klaten.js') }}"></script>

    <script type="text/javascript">
      var map = L.map("map").setView([-7.63, 110.69], 12);

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
      geojson = L.geoJson(Klaten, {
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
                ['BEKU',-7.653045, 110.638562],
                ['BRANGKAL ',	-7.646680, 110.647529],
                ['JURANGJERO',	-7.639179, 110.633640],
                ['GLEDEG',	-7.632015, 110.635493],
                ['JEBLOG',	-7.616936, 110.634461],
                ['NGABEYAN',	-7.635188, 110.647867],
                ['SOROPATEN',	-7.634449, 110.617890],
                ['PONDOK',	-7.624740, 110.635597],
                ['PADAS',	-7.640875, 110.609758],
                ['TROSO',	-7.664532, 110.645280],
                ['KARANGANOM',	-7.646648, 110.621273],
                ['GEMPOL',	-7.623894, 110.623087],
                ['PONGGOK',	-7.609881, 110.640981],
                ['NGANJAT 1',	-7.616842, 110.643541],
                ['GLAGAHWANGI',	-7.649142, 110.663073],
                ['KARANGLO',	-7.612341, 110.654627],
                ['JIMUS',	-7.617950, 110.653587],
                ['TURUS',	-7.616471, 110.663038],
                ['POLANHARJO',	-7.613900, 110.656739],
                ['KAPUNGAN',	-7.640738, 110.666172],
                ['JANTI',	-7.596277, 110.655983],
                ['WANGEN',	-7.602599, 110.657251],
                ['JELOBO',	-7.636104, 110.747513],
                ['BOTO',	-7.615529, 110.717129],
                ['BULAN',	-7.629644, 110.720946],
                ['TELOYO',	-7.624723, 110.761864],
                ['SEKARAN',	-7.611012, 110.723841],
                ['GUNTING',	-7.645983, 110.770640],
                ['LUMBUNG KEREP',	-7.628821, 110.735811],
                ['NGREDEN',	-7.638885, 110.732406]
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
