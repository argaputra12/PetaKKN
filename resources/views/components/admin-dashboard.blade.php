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
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Aksi
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lokasis as $index=>$lokasi)

        <tr class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-600 hover:text-primary-textlight">
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
                {{ $lokasi->desa->kota->nama }}
            </td>

            <td class="px-6 py-4">
                Pending
            </td>
            <td class="px-6 py-4">
                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
