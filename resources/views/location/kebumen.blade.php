<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-5xl text-primary-textdark font-poppins my-14">
            Pemetaan Kelompok KKN Kabupaten Kebumen
        </h2>

        <div class="container flex  mx-auto mb-6 border-2">
            <div id="map" style="width:100%" class="w-full z-10" ></div>
        </div>
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden min-h-[102vh] mt-16 flex justify-center items-center">
            <div id="table_data" ></div>
        </div>

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
                ['PATUKGAWEMULYO ',	-7.787356, 109.814133,292],
                ['PATUKREJOMULYO ',	-7.782762, 109.800509,293],
                ['TLOGOPRAGOTO ',	-7.816872, 109.787274,294],
                ['PONCOWARNO',	-7.662104, 109.745002,295],
                ['ROWO ',	-7.806448, 109.828932,296],
                ['KARANGGAYAM',	-7.555346, 109.658866,297],
                ['KEBAKALAN',	-7.566218, 109.655862,298],
                ['SEBARA',	-7.525471, 109.708320,299],
                ['KALIGENDING',	-7.594627, 109.690495,300],
                ['LOGEDE',	-7.684187, 109.624174,301],
                ['KEBULUSAN',	-7.670186, 109.630741,302],
                ['PENGARINGAN',	-7.599837, 109.641256,303],
                ['MEKARSARI',	-7.705289, 109.744305,304],
                ['MRINEN',	-7.708181, 109.753060,305],
                ['JATIMALANG',	-7.725889, 109.638427,306],
                ['PESALAKAN',	-7.748834, 109.609345,307],
                ['WONOSARI',	-7.524306, 109.734872,308],
                ['PUCANGAN',	-7.524756, 109.688464,309],
                ['TANGGULANGIN',	-7.781062, 109.637943,310],
                ['BANJARWINANGUN',	-7.703395, 109.612252,311],
                ['AMPELSARI ',	-7.756625, 109.597967,312],
                ['JOGOSIMO',	-7.776894, 109.614466,313],
                ['KRAKAL',	-7.612887, 109.703037,314],
                ['KALIPUTIH',	-7.618555, 109.751168,315],
                ['KEMANGGUAN ',	-7.632874, 109.665911,316],

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
