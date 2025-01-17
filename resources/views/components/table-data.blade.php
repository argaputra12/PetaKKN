<div class="w-1/4 min-h-[50%] mx-auto rounded-lg mt-36 bg-white shadow-xl p-2" >
    <div class="absolute right-[720px] flex justify-end p-2">
        <button onclick="closeContainer()">
            <i class="fa-solid fa-xmark fa-xl" style="color: red"></i>
        </button>
    </div>
    <div class="my-3 pl-4">
        <div><span class="text-primary-textgray">KKN Reguler / </span><span class="text-primary-textdark">{{ $data->kelompok->identitas_kelompok }}</span></div>
    </div>
    <div class="font-semibold text-xl pl-4 mb-6 text-primary-textdark">Detail Informasi KKN</div>
    <div class="flex justify-start pl-4">
        <div class="text-primary-textgray w-32 mb-3">Ketua</div>
        <div class="text-primary-textdark">{{ $data->kelompok->nama_ketua }}</div>
    </div>
    <div class="flex justify-start pl-4">
        <div class="text-primary-textgray w-32 mb-3">Sosial media</div>
        @if ($data->kelompok->link_sosmed)
            <div><a href="{{ $data->kelompok->link_sosmed }}" target="_blank" class="hover:text-primary-blue">Klik disini</a></div>
        @endif
    </div>
    <div class="flex justify-start pl-4">
        <div class="text-primary-textgray w-32 mb-3">Status</div>
        @if ($data->kelompok->status == 'pending')
            <div class="text-yellow-500">{{ ucwords($data->kelompok->status ) }}</div>
        @elseif ($data->kelompok->status == 'approved')
            <div class="text-green-500">{{ ucwords($data->kelompok->status ) }}</div>
        @else
            <div class="text-red-500">{{ ucwords($data->kelompok->status ) }}</div>
        @endif
    </div>
    <div class="flex justify-start pl-4">
        <div class="text-primary-textgray w-32 mb-6">Dokumentasi</div>
        @if ($data->kelompok->dokumen_penunjang)
            <div><a href="{{ $data->kelompok->dokumen_penunjang }}" target="_blank" class="hover:text-primary-blue">Klik disini</a></div>
        @endif
    </div>
    <div class="mx-4 border-b border-primary-textgray mb-6 border-opacity-30"></div>
    <div class="flex flex-col justify-start pl-4 mb-4">
        <div class="text-primary-textdark font-semibold mb-3">Program telah berjalan</div>
        <div class="text-primary-textdark">• {!! str_replace(", ", "<br/> • ", $data->kelompok->program_telah_jalan)  !!}</div>
    </div>
</div>
