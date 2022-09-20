<table class="w-full text-sm text-left text-primary-textdark ">
    <thead class="text-base border-b">
        <tr>
            <th scope="col" class="px-6 py-3">
                Kelompok
            </th>
            <th scope="col" class="px-6 py-3">
                Desa
            </th>
            <th scope="col" class="px-6 py-3">
                Kecamatan
            </th>
            <th scope="col" class="px-6 py-3">
                Kota
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-center">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lokasis as $index=>$lokasi)

        <tr class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-600 hover:text-primary-textlight">
            <input type="hidden" name="lokasi_id[]" value="{{ $lokasi->id }}">
            <td class=" px-6 py-4">
                <div class="flex items-center text-sm">
                    <div>
                        <p class="font-semibold">Kelompok {{ $lokasi->kelompok->identitas_kelompok }}</p>
                    </div>
                </div>
            </td>
            <td scope="row" class="px-6 py-4">
                Desa {{ ucwords(strtolower($lokasi->desa->nama_desa)) }}
            </td>
            <td class="px-6 py-4">
                Kecamatan {{ ucwords(strtolower($lokasi->desa->nama_kecamatan))}}
            </td>
            <td class="px-6 py-4">
                {{ $lokasi->desa->kota->nama}}
            </td>

            <td class="px-6 py-4 text-center">
                @if ($lokasi->kelompok->status == 'pending')
                    <span class="m-3 p-2 font-small bg-yellow-200 text-yellow-600 dark:yellow-blue-500 rounded-lg">Pending</span>
                @elseif($lokasi->kelompok->status == 'approved')
                    <span class="m-3 p-2 font-small bg-green-200 text-green-600 dark:yellow-blue-500 rounded-lg">Approved</span>
                @elseif($lokasi->kelompok->status == 'rejected')
                    <span class="m-3 p-2 font-small bg-red-200 text-red-600 dark:yellow-blue-500 rounded-lg">Rejected</span>
                @endif
            </td>
            <td class="px-6 py-4 flex justify-center">
                <button type="button" onclick="showData(this)" class="mx-3 p-2 font-bold bg-blue-200 text-blue-600 dark:text-blue-500  rounded-lg w-9 h-9 text-center">
                    <input type="hidden" name="desa_id" value="{{ $lokasi->desa_id }}">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <button type="button" class="mx-3 p-2 font-small bg-green-200 text-green-600 dark:text-green-500 rounded-lg w-9 h-9 text-center" onclick="approvedKkn(this)">
                    <input type="hidden" name="kelompok_id" value="{{ $lokasi->kelompok_id }}">
                    <i class="fa-solid fa-check"></i>
                </button>
                <button type="button" class="mx-3 p-2 font-small bg-yellow-200 text-yellow-600 dark:text-yellow-500 rounded-lg w-9 h-9 text-center" onclick="pendingKkn(this)">
                    <input type="hidden" name="kelompok_id" value="{{ $lokasi->kelompok_id }}">
                    <i class="fa-solid fa-exclamation"></i>
                </button>
                <button type="button" class="mx-3 p-2 font-small bg-red-200 text-red-600 dark:text-red-500 rounded-lg w-9 h-9 text-center" onclick="rejectedKkn(this)">
                    <input type="hidden" name="kelompok_id" value="{{ $lokasi->kelompok_id }}">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="w-full h-[70px]">

</div>
