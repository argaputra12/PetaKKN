<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Karanganyar
        </h2>

        <div id='map'></div>

    <script type="text/javascript" src="{{ asset('peta/Karanganyar.js') }}"></script>

    <script type="text/javascript">
      var map = L.map("map").setView([-7.6, 110.98], 11);

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
      geojson = L.geoJson(Karanganyar, {
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
                ['BLORONG',	-7.643493, 110.988292],
                ['GEMANTAR',	-7.675537, 111.033041],
                ['GENENGAN',	-7.665195, 111.008902],
                ['KEBAK',	-7.676536, 110.991277],
                ['NGUNUT',	-7.654201, 110.983058],
                ['SAMBIREJO',	-7.632762, 110.965684],
                ['SEDAYU',	-7.675775, 110.963375],
                ['SRINGIN',	-7.650196, 111.016718],
                ['SUKOSARI',	-7.638639, 110.951335],
                ['TUGU',	-7.656158, 110.961961],
                ['TUNGGULREJO',	-7.663385, 111.042384],
                ['BANDARDAWUNG',	-7.669367, 111.084698],
                ['BLUMBANG',	-7.661130, 111.155977],
                ['GONDOSULI',	-7.665483, 111.177692],
                ['KALISORO',	-7.670076, 111.143197],
                ['TAWANGMANGU',	-7.673044, 111.127624],
                ['PLUMBON',	-7.649902, 111.101457],
                ['KARANGLO',	-7.660939, 111.090002],
                ['SEPANJANG',	-7.680618, 111.108255],
                ['TENGKLIK ',	-7.651268, 111.128716],
                ['PANCOT',	-7.658133, 111.140465],
                ['WATUSAMBANG',	-7.654187, 111.102004],
                ['GAYAMDOMPO',	-7.617026, 111.006283],
                ['JANTIHARJO',	-7.619439, 110.972208],
                ['POPONGAN',	-7.608726, 110.986813],
                ['BOLONG',	-7.625952, 110.971864],
                ['LALUNG ',	-7.612064, 110.938514],
                ['DAYU ',	-7.476792, 110.843600],
                ['KARANGLO 2',	-7.659294, 111.078941],
                ['TAWANGMANGU 2',	-7.668584, 111.116909],
                ['POJOK',	-7.567470, 111.009132],
                ['DELINGAN',	-7.598213, 111.002942],
                ['GEDONG',	-7.578834, 110.981651],
                ['SEWUREJO',	-7.587222, 111.018373],
                ['KEMUNING',	-7.594811, 111.116039]

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
