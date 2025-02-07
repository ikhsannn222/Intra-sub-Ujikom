<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('tasks.index') }}" class="text-black-400 font-semibold">Task</a></li>
        </ul>
    </div>
    <h2 class="flex items-center space-x-4 my-6 text-2xl font-semibold text-gray-700 dark:text-black-200">
        <span>Task</span>
        @can('manageTasks-create')
            <a href="{{ route('tasks.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                + Add Data
            </a>
            <div class="relative w-1/2">
                <i class='bx bx-search absolute left-3 mt-2  transform  text-gray-400'></i>
                <input type="text"
                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-purple-500 text-sm w-full"
                    wire:model.live="search" placeholder="Search Task...">
            </div>
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

    <!-- Task Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    @if($tasks->isEmpty())
                    <tr>
                        <td colspan="5" class="border p-4 text-center text-gray-500">
                            Data tidak tersedia
                        </td>
                    </tr>
                @else
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-black-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-black-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Content</th>
                        <th class="px-4 py-3">Code</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Estimation</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                    @endif
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($tasks as $task)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">{{ $task->name }}</td>
                            <td class="px-4 py-3 text-sm">{!! $task->content !!}</td>
                            <td class="px-4 py-3 text-sm">{{ $task->code }}</td>
                            <td class="px-4 py-3 text-sm">{{ $task->order }}</td>
                            <td class="px-4 py-3 text-sm">{{ $task->estimation }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    @can('manageTasks-edit')
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="flex items-center justify-center w-10 h-10 text-blue-500 bg-blue-100 rounded-full hover:bg-blue-200"
                                            title="Edit">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232a1 1 0 00-1.415 0L7.5 11.5V14h2.5l6.318-6.318a1 1 0 000-1.415z" />
                                            </svg>
                                        </a>
                                    @endcan

                                    @can('manageTasks-view')
                                        <a href="{{ route('tasks.show', $task->id) }}"
                                            class="flex items-center justify-center w-10 h-10 text-green-500 bg-green-100 rounded-full hover:bg-green-200"
                                            title="Show">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6 3 2 12 2 12s4 9 10 9 10-9 10-9-4-9-10-9zm0 12a3 3 0 110-6 3 3 0 010 6z" />
                                            </svg>
                                        </a>
                                    @endcan

                                    @can('manageTasks-delete')
                                        <button onclick="my_modal_{{ $task->id }}.showModal()"
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
                                    <dialog id="my_modal_{{ $task->id }}"
                                        class="modal fixed inset-0 flex items-center justify-center">
                                        <div
                                            class="modal-box bg-white text-gray-800 dark:bg-gray-800 dark:text-white p-4 md:p-5">
                                            <svg class="mx-auto mb-4 text-gray-400 w-20 h-20 dark:text-gray-200"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="text-lg font-bold">Apakah anda mau menghapus task ini?</h3>
                                            <div class="modal-action">
                                                <button
                                                    class="btn bg-red-500 text-white hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 border-none"
                                                    wire:click="destroy({{ $task->id }})">
                                                    Delete
                                                </button>
                                                <button class="btn hover:bg-gray-900 dark:bg-gray-700 dark:text-white"
                                                    onclick="my_modal_{{ $task->id }}.close()">
                                                    cancel
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
        {{ $tasks->links('livewire::tailwind') }}
    </div>
</div>
