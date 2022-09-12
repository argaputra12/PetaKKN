<x-app-layout>
    <x-slot name="header">
        <div class="modal-container absolute bg-black bg-opacity-50 inset-0 z-[999] hidden transition duration-150 ease-in-out flex justify-center items-center min-h-[113vh]">
            <div id="table_data" ></div>
        </div>
    </x-slot>

    <div class="py-12 bg-secondary-textgray mt-[-16px] inset-0 min-h-screen">
        <div class="mx-auto max-w-[80%]">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" bg-white border-b border-gray-200">

                <div class="w-full">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="p-4">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  " placeholder="Search for items" onkeyup="searchData(this.value)">
                        </div>
                            </div>
                            <div id="table-container">
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
                                                <button onclick="showData(this)" class="mx-3 p-2 font-bold bg-blue-200 text-blue-600 dark:text-blue-500  rounded-lg w-9 h-9 text-center">
                                                    <input type="hidden" name="desa_id" value="{{ $lokasi->desa_id }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button class="mx-3 p-2 font-small bg-green-200 text-green-600 dark:text-green-500 rounded-lg w-9 h-9 text-center" onclick="approvedKkn(this)">
                                                    <input type="hidden" name="kelompok_id" value="{{ $lokasi->kelompok_id }}">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                                <button  class="mx-3 p-2 font-small bg-yellow-200 text-yellow-600 dark:text-yellow-500 rounded-lg w-9 h-9 text-center" onclick="pendingKkn(this)">
                                                    <input type="hidden" name="kelompok_id" value="{{ $lokasi->kelompok_id }}">
                                                    <i class="fa-solid fa-exclamation"></i>
                                                </button>
                                                <button  class="mx-3 p-2 font-small bg-red-200 text-red-600 dark:text-red-500 rounded-lg w-9 h-9 text-center" onclick="rejectedKkn(this)">
                                                    <input type="hidden" name="kelompok_id" value="{{ $lokasi->kelompok_id }}">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="w-full p-4">
                                    {{ $lokasis->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
    <script>
        const searchData = (value) => {
            const table_container = document.querySelector('#table-container');
            $.ajax({
                url: '{{ route('admin.search') }}',
                type: 'get',
                data: { search: value },
                success: function(response)
                {

                    table_container.innerHTML = '';
                    table_container.innerHTML = response;
                    console.log(response);

                }
            });
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

        const approvedKkn = (e) =>{
            const kelompok_id = e.children[0].value;
            const row = e.parentElement.parentElement;
            const status_column = row.children[4];
            $.ajax({
                url: `{{ route('admin.approved') }}`,
                type: 'POST',
                data: {
                    'kelompok_id': kelompok_id,
                },
                success: function(data) {
                    alert(data.success);
                    // reload page
                    status_column.innerHTML = `<span class="m-3 p-2 font-small bg-green-200 text-green-600 dark:yellow-blue-500 rounded-lg">Approved</span>`;
                }

            });
        }

        const rejectedKkn = (e) =>{
            const kelompok_id = e.children[0].value;
            const row = e.parentElement.parentElement;
            const status_column = row.children[4];

            $.ajax({
                url: `{{ route('admin.rejected') }}`,
                type: 'POST',
                data: {
                    'kelompok_id': kelompok_id,
                },
                success: function(data) {
                    alert(data.success);
                    // reload page
                    status_column.innerHTML = `<span class="m-3 p-2 font-small bg-red-200 text-red-600 dark:yellow-blue-500 rounded-lg">Rejected</span>`;
                }

            });
        }

        const pendingKkn = (e) =>{
            const kelompok_id = e.children[0].value;
            const row = e.parentElement.parentElement;
            const status_column = row.children[4];

            $.ajax({
                url: `{{ route('admin.pending') }}`,
                type: 'POST',
                data: {
                    'kelompok_id': kelompok_id,
                },
                success: function(data) {
                    alert(data.success);
                    // reload page
                    status_column.innerHTML = `<span class="m-3 p-2 font-small bg-yellow-200 text-yellow-600 dark:yellow-blue-500 rounded-lg">Pending</span>`;
                }

            });
        }
    </script>
</x-app-layout>
