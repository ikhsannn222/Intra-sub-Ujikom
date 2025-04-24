<div>
    <div x-data="{ open: false }">
        <!-- Breadcrumbs and Back Button -->
        <div class="breadcrumbs text-sm mt-4">
            <ul>
                <li><a href="{{ route('welcome') }}">Dashboard</a></li>
                <li><a href="{{ route('project.index') }}">Project</a></li>
                <li><span class="text-black-400 font-semibold">Detail data Project</span></li>
            </ul>
        </div>
        <a href="{{ route('project.index') }}" class="btn btn-md bg-white text-black mt-2">
            <i class="bx bx-arrow-back text-xl"></i>
        </a>

        <!-- Project Details Section -->
        <div class="mb-8 md:grid-cols-2 mt-4">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 flex flex-col">
                <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">Detail User</h4>
                <div class="flex justify-center mb-4">
                    @if ($project->cover_image)
                        <img src="{{ asset('storage/projects/' . $project->cover_image) }}" alt="cover"
                             class="rounded-lg cursor-pointer hover:shadow-lg transition-shadow max-h-80 w-auto" @click="open = true" />
                    @else
                        <p class="text-gray-700 dark:text-gray-400">Tidak ada Cover</p>
                    @endif
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-700 dark:divide-gray-600">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400"><strong>Name:</strong></td>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">
                                <strong>Description:</strong>
                            </td>
                            <td class="px-6 py-4 whitespace-normal text-black-600 dark:text-black-400">
                                {!! $project->description !!}
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400"><strong>Ticket Prefix</strong></td>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">{{ $project->ticket_prefix }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400"><strong>Owner:</strong></td>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">{{ $project->owner->name ?? 'Tidak ada owner' }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400"><strong>Status:</strong></td>
                            <td class="px-6 py-4 whitespace-nowrap text-black-600 dark:text-black-400">{{ $project->status->name ?? 'Tidak ada status' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for Enlarged Image Display -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-64 z-64">
            <div class="bg-white p-4 rounded-lg shadow-lg relative max-w-4xl mx-auto">
                <button @click="open = false" class="absolute top-5 right-5 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
                <div class="flex justify-center">
                    <img src="{{ asset('storage/projects/' . $project->cover_image) }}" alt="cover" class="rounded-lg max-w-full max-h-screen" />
                </div>
            </div>
        </div>

        <!-- Detail Attach User Section -->
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            @if (session()->has('message'))
                <div class="toast toast-top toast-end mt-12 transform translate-x-full transition-transform duration-500 ease-out" x-data="{ show: true }" x-show="show" x-init="show = true; setTimeout(() => show = false, 5000)">
                    <div class="flex flex-col gap-2 h-auto text-[10px] sm:text-xs z-50 mt-6">
                        <div class="success-alert cursor-default flex items-center justify-between h-12 sm:h-14 rounded-lg bg-gray-800 dark:bg-gray-900 px-[10px]">
                            <div class="flex gap-2">
                                <div class="text-green-500 bg-white/10 dark:bg-white/20 p-1 rounded-lg"><i class='bx bx-check-circle text-3xl'></i></div>
                                <div><p class="text-white mt-3">{{ session('message') }}</p></div>
                            </div>
                            <button @click="show = false" class="text-gray-400 hover:bg-white/5 p-1 rounded-md transition-colors ease-linear">
                                <i class='bx bx-x text-xl'></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <div>
                <h2 class="flex items-center space-x-4 my-6 text-2xl font-semibold text-gray-700 dark:text-black-200">
                    <span class="ml-4">Attach User</span>
                    @can('manageAttachUser-create')
                        <a href="{{ route('project.attachUser.Index', ['projectId' => $projectId]) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">+ Attach User</a>
                        <div class="relative w-1/2">
                            <i class='bx bx-search absolute left-3 mt-2  transform text-gray-400'></i>
                            <input type="text" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-purple-500 text-sm w-full" wire:model.live="search" placeholder="Cari Project...">
                        </div>
                    @endcan
                </h2>

                <div class="mt-8">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-black-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-black-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">No</th>
                                    <th class="px-4 py-3">Owner</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                @forelse ($attachUser as $attach)
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm">{{ $attach->user->name }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                @can('manageAttachUser-edit')
                                                    <a href="{{ route('project.attachUser.Edit', ['projectId' => $projectId, 'attachUserId' => $attach->id]) }}" class="flex items-center justify-center w-10 h-10 text-blue-500 bg-blue-100 rounded-full hover:bg-blue-200" title="Edit">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232a1 1 0 00-1.415 0L7.5 11.5V14h2.5l6.318-6.318a1 1 0 000-1.415z" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                @can('manageAttachUser-delete')
                                                    <button onclick="my_modal_{{ $attach->id }}.showModal()" class="flex items-center justify-center w-10 h-10 text-red-500 bg-red-100 rounded-full hover:bg-red-200" title="Delete">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                                    <dialog id="my_modal_{{ $attach->id }}" class="modal fixed inset-0 flex items-center justify-center">
                                        <div class="modal-box bg-white text-gray-800 dark:bg-gray-800 dark:text-white p-4 md:p-5">
                                            <svg class="mx-auto mb-4 text-black-400 w-20 h-20 dark:text-black-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="text-lg font-bold">Apakah anda mau menghapus Attach User ini?</h3>
                                            <div class="modal-action">
                                                <button class="btn bg-red-500 text-white hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 border-none" wire:click="destroy({{ $attach->id }})">Delete</button>
                                                <button class="btn hover:bg-gray-900 dark:bg-gray-700 dark:text-white" onclick="my_modal_{{ $attach->id }}.close()">Cancel</button>
                                            </div>
                                        </div>
                                    </dialog>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-sm text-gray-500">No users are bound for this project.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $attachUser->links('livewire::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
