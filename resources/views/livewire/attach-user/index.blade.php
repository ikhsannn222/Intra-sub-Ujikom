<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Attach User
        @can('manageAttachUser-create')
            <a href="{{ route('attach-user.create') }}"
                class="px-4 py-2 text-sm font-medium justify-end leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                + Add data
            </a>
        @endcan
    </h2>

   {{-- Message --}}
    @if (session()->has('message'))
        <div class="toast toast-top toast-end mt-12 transform translate-x-full transition-transform duration-500 ease-out"
            x-data="{ show: true }" x-show="show" x-init="show = true;
            setTimeout(() => show = false, 5000)">
            <div class="flex flex-col gap-2 w-60 h-60 sm:w-72 text-[10px] sm:text-xs z-50 mt-6">
                <div
                    class="success-alert cursor-default flex items-center justify-between w-full h-12 sm:h-14 rounded-lg bg-gray-800 dark:bg-gray-900 px-[10px]">
                    <div class="flex gap-2">
                        <div class="text-green-500 bg-white/10 dark:bg-white/20 p-1 rounded-lg">
                            <i class='bx bx-check-circle text-3xl'></i>
                        </div>
                        <div>
                            <p class="text-white mt-3">{{ session('message') }}</p>
                        </div>
                    </div>
                    <button @click="show = false"
                        class="text-gray-400 hover:bg-white/5 p-1 rounded-md transition-colors ease-linear">
                        <i class='bx bx-x text-xl'></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">User ID</th>
                        <th class="px-4 py-3">User Name</th>
                        <th class="px-4 py-3">Project ID</th>
                        <th class="px-4 py-3">Project Name</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($attachUser as $attach)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ $attach->users->id}}</td>
                             <td class="px-4 py-3 text-sm">{{ $attach->users->name}}</td>
                            <td class="px-4 py-3 text-sm">{{ $attach->projects->id }}</td>
                             <td class="px-4 py-3 text-sm">{{ $attach->projects->name }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    @can('manageattachUser-edit')
                                        <a href="{{ route('attach-user.edit', $attach->id) }}"
                                            class="flex items-center justify-center w-10 h-10 text-blue-500 bg-blue-100 rounded-full hover:bg-blue-200"
                                            title="Edit">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232a1 1 0 00-1.415 0L7.5 11.5V14h2.5l6.318-6.318a1 1 0 000-1.415z" />
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('manageattachUser-view')
                                        <a href="{{ route('attach-user.show', $attach->id) }}"
                                            class="flex items-center justify-center w-10 h-10 text-green-500 bg-green-100 rounded-full hover:bg-green-200"
                                            title="Show">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6 3 2 12 2 12s4 9 10 9 10-9 10-9-4-9-10-9zm0 12a3 3 0 110-6 3 3 0 010 6z" />
                                            </svg>
                                        </a>
                                    @endcan
                                    @can('manageattachUser-delete')
                                        <button onclick="my_modal_{{ $attach->id }}.showModal()"
                                            class="flex items-center justify-center w-10 h-10 text-red-500 bg-red-100 rounded-full hover:bg-red-200"
                                            title="Delete">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endcan

                                    <!-- Modal Konfirmasi -->
                                    <dialog id="my_modal_{{ $attach->id }}"
                                        class="modal fixed inset-0 flex items-center justify-center">
                                        <div
                                            class="modal-box bg-white text-gray-800 dark:bg-gray-800 dark:text-white p-4 md:p-5">
                                            <svg class="mx-auto mb-4 text-gray-400 w-20 h-20 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor 24 24" stroke="currentColor">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="text-lg font-bold">Apakah anda mau menghapus daftar ini</h3>
                                            <div class="modal-action">
                                                <button
                                                    class="btn bg-red-500 text-white hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 border-none"
                                                    wire:click="destroy({{ $attach->id }})">
                                                    Hapus
                                                </button>
                                                <button class="btn hover:bg-gray-900 dark:bg-gray-700 dark:text-white"
                                                    onclick="my_modal_{{ $attach->id }}.close()">
                                                    Batal
                                                </button>
                                            </div>
                                        </div>
                                    </dialog>




                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- paginate --}}
        <div class="mt-8 mb-6 p-1 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Showing {{ $attachUser->firstItem() }} to {{ $attachUser->lastItem() }} of {{ $attachUser->total() }} entries
            </div>
            <div class="flex items-center space-x-1">

                {{-- Tombol Previous --}}
                @if ($attachUser->onFirstPage())
                    <span class="bg-gray-300 text-gray-500 px-4 py-2 rounded cursor-not-allowed">Previous</span>
                @else
                    <button wire:click="previousPage" class="bg-transparent text-purple-600 border border-purple-300 px-4 py-2 rounded hover:bg-purple-100 transition duration-300 ease-in-out">
                        Previous
                    </button>
                @endif
                @php
                    $currentPage = $attachUser->currentPage();
                    $lastPage = $attachUser->lastPage();
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $currentPage + 2);
                @endphp
                @if ($startPage > 1)
                    <button wire:click="gotoPage(1)" class="bg-transparent text-purple-600 border border-purple-300 px-4 py-2 rounded hover:bg-purple-100 transition duration-300 ease-in-out">
                        1
                    </button>
                    @if ($startPage > 2)
                        <span class="px-2">...</span>
                    @endif
                @endif

                {{-- Halaman di sekitar halaman aktif --}}
                @for ($page = $startPage; $page <= $endPage; $page++)
                    @if ($page == $currentPage)
                        <span class="bg-purple-600 text-white px-4 py-2 rounded shadow-md cursor-default">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})"
                                class="bg-transparent text-purple-600 border border-purple-300 px-4 py-2 rounded hover:bg-purple-100 transition duration-300 ease-in-out">
                            {{ $page }}
                        </button>
                    @endif
                @endfor

                {{-- Tampilkan halaman terakhir jika jauh dari akhir --}}
                @if ($endPage < $lastPage)
                    @if ($endPage < $lastPage - 1)
                        <span class="px-2">...</span>
                    @endif
                    <button wire:click="gotoPage({{ $lastPage }})" class="bg-transparent text-purple-600 border border-purple-300 px-4 py-2 rounded hover:bg-purple-100 transition duration-300 ease-in-out">
                        {{ $lastPage }}
                    </button>
                @endif

                {{-- Tombol Next --}}
                @if ($attachUser->hasMorePages())
                    <button wire:click="nextPage" class="bg-transparent text-purple-600 border border-purple-300 px-4 py-2 rounded hover:bg-purple-100 transition duration-300 ease-in-out">
                        Next
                    </button>
                @else
                    <span class="bg-gray-300 text-gray-500 px-4 py-2 rounded cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
    </div>
</div>
