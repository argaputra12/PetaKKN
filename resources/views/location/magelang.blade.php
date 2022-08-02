<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Magelang
        </h2>

        <div id="map"></div>

    <script type="text/javascript" src="{{ asset('peta/Magelang.js') }}"></script>

    <script type="text/javascript">
      var map = L.map("map").setView([-7.57, 110.2], 12);

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
      geojson = L.geoJson(Magelang, {
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
                ['PUCUNGREJO', -7.584792, 110.277866],
                ['GUNUNGPRING', -7.593592, 110.284924],
                ['BOJONG',	-7.557689, 110.271681],
                ['PAREMONO',	-7.568912, 110.245342],
                ['BLONDO',	-7.548232, 110.236309],
                ['BOROBUDUR', 	-7.607824, 110.199869],
                ['BOROBUDUR 2',	-7.607314, 110.206049],
                ['NGARGOGONDO',	-7.627944, 110.217195],
                ['WRINGINPUTIH',	-7.591521, 110.195171],
                ['GIRITENGAH',	-7.634504, 110.190950],
                ['NGADIHARJO', 	-7.617154, 110.170869],
                ['NGARGORETNO',	-7.636984, 110.150526],
                ['KALIREJO',	-7.618106, 110.133343],
                ['MENOREH',	-7.590567, 110.133674],
                ['KEBONREJO',	-7.566337, 110.140917],
                ['NGADIREJO',	-7.589039, 110.152606],
                ['PASURUHAN',	-7.570040, 110.212056],
                ['DONOROJO',	-7.561471, 110.212870],
                ['KALINEGORO',	-7.557416, 110.194188],
                ['BANJARNEGORO',	-7.519465, 110.189752],
                ['RINGINANOM',	-7.580402, 110.182898],
                ['PROGOWATI', 	-7.610013, 110.232081],
                ['KEJI', 	-7.591628, 110.266013],
                ['SOKORINI',	-7.621017, 110.249182],
                ['ADIKARTO',	-7.606514, 110.246733],
                ['TAMANAGUNG',	-7.578853, 110.274724],
                ['SIRAHAN',	-7.617833, 110.270000],
                ['GULON',	-7.598198, 110.301017],
                ['JUMOYO',	-7.608854, 110.306783],
                ['SALAM',	-7.639874, 110.300806],


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
