<div class="table border-primary-textlight border-2 rounded-md text-primary-textlight p-4 w-[980px] mx-auto">
    <div class="flex">
        <div class="w-48 mb-2 font-semibold">Identitas Kelompok</div>
        <div>{{ $data->kelompok->identitas_kelompok }}</div>
    </div>
    <div class="flex">
        <div class="w-48 mb-2 font-semibold">Nama ketua</div>
        <div>{{ $data->kelompok->nama_ketua }}</div>
    </div>
    <div class="flex">
        <div class="w-48 mb-2 font-semibold">Sosial media</div>
        <div><a href="{{ $data->kelompok->link_sosmed }}" class="hover:text-primary-blue">Klik disini</a></div>
    </div>
    <div class="flex">
        <div class="w-48 mb-3 font-semibold">Dokumen penunjang</div>
        <div><a href="{{ $proker->dokumen_penunjang }}" class="hover:text-primary-blue">Klik disini</a></div>
    </div>
    <div class="flex flex-col">
        <div class="mb-1 font-semibold">Program yang telah berjalan</div>
        <div>{{ $proker->program_telah_jalan }}</div>
    </div>

</div>
