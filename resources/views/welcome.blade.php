<x-app-layout>



    {{-- Header --}}
    <x-slot name="header">
        {{-- Background --}}
        <div class=" absolute w-full left-0 bg-cover bg-center" style="background-image: url({{ asset('img/uns.png') }})">
            {{-- <img src="{{ asset('img/uns.png') }}" alt="uns-image" class="w-auto sm:w-full sm:bg-center sm:mx-auto left-0 z-0 opacity-60"> --}}
        </div>

        <div class="title pt-32">
            <h1 class="font-bold text-5xl w-1/3 leading-relaxed text-primary-textlight z-10 relative">
                Pemetaan Titik Lokasi KKN UNS 2022
            </h1>
        </div>

        <div class="subtitle pt-4">
            <h2 class="text-lg font-light w-[45%] leading-relaxed text-primary-textlight z-10 relative">
                KKN UNS dilaksanakan di berbagai lokasi, dengan menggunakan pemetaan titik lokasi, kita dapat mengetahui titik mana saja lokasi KKN UNS dilaksanakan.
            </h2>
        </div>

        {{-- <div class="pt-12 relative z-10">
            <button onclick="scrollToLokasi()" class="font-semibold text-primary-textlight bg-primary-red w-36 h-10 text-lg rounded-xl">
                Lokasi KKN
            </button>
        </div> --}}
        <form action="{{ route('location.index') }}" method="post" class="pt-12 relative z-10">
            @csrf
            <select name="id" id="" class="rounded-xl h-12 bg-opacity-50">
                <option value="" >Pilih Lokasi</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->nama }}</option>
                @endforeach
            </select>
            <button type="submit" class="font-semibold text-primary-textlight bg-primary-red w-40 h-12 ml-4 text-lg rounded-xl" >
                Pilih Lokasi KKN
            </button>
        </form>

    </x-slot>


    {{-- Jumbotron --}}



    <script>
        const scrollToLokasi = () => {
            const lokasi_kkn = document.getElementById('lokasi_kkn');
            lokasi_kkn.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    </script>
    {{-- <script>
        var map = L.map('map').setView([-7.57, 110.82], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // control that shows state info on hover
        var info = L.control();

        info.onAdd = function(map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };

        info.update = function(props) {
            this._div.innerHTML = '<h4>Pesebaran Tim KKN UNS 2022</h4>' + (props ?
                '<b>' + props.KECAMATAN + '</b><br />' + props.Jumlah + ' Kelompok' : 'Hover over Kecamatan');
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
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7,
                fillColor: getColor(feature.properties.Jumlah)
            };
        }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
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
                click: zoomToFeature
            });
        }

        /* global statesData */
        geojson = L.geoJson(statesData, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);

        map.attributionControl.addAttribution('Universitas Sebelas Maret 2022');


        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {

            var div = L.DomUtil.create('div', 'info legend');
            var grades = [0, 5, 10, 15, 20];
            var labels = [];
            var from, to;

            for (var i = 0; i < grades.length; i++) {
                from = grades[i];
                to = grades[i + 1];

                labels.push(
                    '<i style="background:' + getColor(from + 1) + '"></i> ' +
                    from + (to ? '&ndash;' + to : '+'));
            }

            div.innerHTML = labels.join('<br>');
            return div;
        };

        legend.addTo(map);
    </script> --}}


</x-app-layout>

