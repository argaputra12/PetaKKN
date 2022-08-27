{{-- <div class="table border-primary-textlight border-2 rounded-md text-primary-textdark w-full">
    <div class="flex px-2 border-b-2">
        <div class="w-1/2 mb-2 font-semibold border-r-2 pl-2">Identitas Kelompok</div>
        <div class="pl-2">{{ $data->kelompok->identitas_kelompok }}</div>
    </div>
    <div class="flex p-2">
        <div class="w-1/2 mb-2 font-semibold">Nama ketua</div>
        <div>{{ $data->kelompok->nama_ketua }}</div>
    </div>
    <div class="flex p-2">
        <div class="w-1/2 mb-2 font-semibold">Sosial media</div>
        <div><a href="{{ $data->kelompok->link_sosmed }}" class="hover:text-primary-blue">Klik disini</a></div>
    </div>
    <div class="flex p-2">
        <div class="w-1/2 mb-3 font-semibold">Dokumen penunjang</div>
        <div><a href="{{ $proker->dokumen_penunjang }}" class="hover:text-primary-blue">Klik disini</a></div>
    </div>
    <div class="flex p-2 justify-start">
        <div class="w-1/2 mb-3 font-semibold">Program telah berjalan</div>
        <div class="">{{ $proker->program_telah_jalan }}</div>
    </div>

</div> --}}
<table class="table-fixed text-left border-collapse ">
    <tr>
        <th class="w-1/2 pl-2 py-2 border-b-[2px] border-slate-200">Identitas kelompok</th>
        <td class="p-2 border-b-[2px] pr-2 border-slate-200">{{ $data->kelompok->identitas_kelompok }}</td>
    </tr>
    <tr>
        <th class="w-1/2 pl-2 py-2 border-b-[2px] border-slate-200">Nama ketua</th>
        <td class="p-2 border-b-[2px] pr-2 border-slate-200">{{ $data->kelompok->nama_ketua }}</td>
    </tr>
    <tr>
        <th class="w-1/2 pl-2 py-2 border-b-[2px] border-slate-200">Sosial media</th>
        <td class="p-2 border-b-[2px] pr-2 border-slate-200"><a href="{{ $data->kelompok->link_sosmed }}" class="hover:text-primary-blue">Klik disini</a></td>
    </tr>
    <tr>
        <th class="w-1/2 pl-2 py-2 border-b-[2px] border-slate-200">Dokumen penunjang</th>
        <td class="p-2 border-b-[2px] pr-2 border-slate-200"><a href="{{ $proker->dokumen_penunjang }}" class="hover:text-primary-blue">Klik disini</a></td>
    </tr>
    <tr>
        <th class="w-1/2 pl-2 py-2 align-baseline">Program telah berjalan</th>
        <td class="p-2  ">{{ $proker->program_telah_jalan }}</td>
    </tr>
</table>
