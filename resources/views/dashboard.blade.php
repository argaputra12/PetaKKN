<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<<<<<<< Updated upstream
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
=======
                <div class=" bg-white border-b border-gray-200">

                    <div class="w-full">

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="p-4">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  " placeholder="Search for items">
                                </div>
                            </div>
                            <table class="w-full text-sm text-left text-primary-textdark ">
                                <thead class="text-base border">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            Kelompok
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Ketua
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Proker
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Dokumentasi
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lokasis as $index=>$lokasi)

                                    <tr class="bg-white border-b hover:bg-gray-50 dark:hover:bg-gray-600 hover:text-primary-textlight">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold">Kelompok {{ $lokasi->kelompok->identitas_kelompok }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium">
                                            {{ $lokasi->kelompok->nama_ketua }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $prokers[$index]->program_telah_jalan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $prokers[$index]->dokumen_penunjang }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="m-3 p-2 font-small bg-yellow-200 text-yellow-600 dark:yellow-blue-500 rounded-lg">Pending</span>
                                        </td>
                                        <td class="px-6 py-4 text-right inline-flex flex-col">
                                            <a href="#" class="m-3 p-2 font-bold bg-blue-200 text-blue-600 dark:text-blue-500  rounded-lg"><i class="fa-solid fa-eye"></i></a>
                                            <a href="#" class="m-3 p-2 font-small bg-yellow-200 text-yellow-600 dark:text-yellow-500 rounded-lg"><i class="fa-solid fa-pen-to-square"></i></a>
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
>>>>>>> Stashed changes
                </div>
            </div>
        </div>
    </div>
<<<<<<< Updated upstream
</x-app-layout>
=======
    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
</x-app-layout>
>>>>>>> Stashed changes
