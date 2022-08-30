<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textlight my-14">
            Pemetaan Kelompok KKN Kabupaten Karanganyar
        </h2>

        <div class="container flex  mx-auto mb-6">
            <div id="map" style="width:100%" class="w-full z-10" ></div>
        </div>
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden h-screen mt-16 flex justify-center items-center">
            <div id="table_data" ></div>
        </div>

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
                ['BLORONG',	-7.643493, 110.988292, 157],
                ['GEMANTAR',	-7.675537, 111.033041,158],
                ['GENENGAN',	-7.665195, 111.008902,159],
                ['KEBAK',	-7.676536, 110.991277,160],
                ['NGUNUT',	-7.654201, 110.983058,161],
                ['SAMBIREJO',	-7.632762, 110.965684,162],
                ['SEDAYU',	-7.675775, 110.963375,163],
                ['SRINGIN',	-7.650196, 111.016718,164],
                ['SUKOSARI',	-7.638639, 110.951335,165],
                ['TUGU',	-7.656158, 110.961961,166],
                ['TUNGGULREJO',	-7.663385, 111.042384,167],
                ['BANDARDAWUNG',	-7.669367, 111.084698,168],
                ['BLUMBANG',	-7.661130, 111.155977,169],
                ['GONDOSULI',	-7.665483, 111.177692,170],
                ['KALISORO',	-7.670076, 111.143197,171],
                ['TAWANGMANGU',	-7.673044, 111.127624,172],
                ['PLUMBON',	-7.649902, 111.101457,173],
                ['KARANGLO',	-7.660939, 111.090002,174],
                ['SEPANJANG',	-7.680618, 111.108255,175],
                ['TENGKLIK ',	-7.651268, 111.128716,176],
                ['PANCOT',	-7.658133, 111.140465,177],
                ['WATUSAMBANG',	-7.654187, 111.102004,178],
                ['GAYAMDOMPO',	-7.617026, 111.006283,179],
                ['JANTIHARJO',	-7.619439, 110.972208,180],
                ['POPONGAN',	-7.608726, 110.986813,181],
                ['BOLONG',	-7.625952, 110.971864,182],
                ['LALUNG ',	-7.612064, 110.938514,183],
                ['DAYU ',	-7.476792, 110.843600,184],
                ['KARANGLO 2',	-7.659294, 111.078941,185],
                ['TAWANGMANGU 2',	-7.668584, 111.116909,186],
                ['POJOK',	-7.567470, 111.009132,187],
                ['DELINGAN',	-7.598213, 111.002942,188],
                ['GEDONG',	-7.578834, 110.981651,189],
                ['SEWUREJO',	-7.587222, 111.018373,190],
                ['KEMUNING',	-7.594811, 111.116039,261]

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
                console.log(marker);
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
