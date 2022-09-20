<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        {{-- Background --}}
        <div class="absolute w-full left-0 bg-cover bg-center min-h-full" style="background-image: url({{ asset('img/uns.png') }})">
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
</x-app-layout>

