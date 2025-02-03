<div>
    <div class="flex justify-between items-center mb-4 mt-4">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Kanban Board - {{ $project->name ?? '' }}
        </h2>
        <a href="{{ route('board.index') }}" class="text-blue-600 text-sm">
            << Back to board</a>
    </div>



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

@if (auth()->user()->can('manageTasks-create'))
    <div class="flex items-center space-x-4 mb-4">
        <button wire:click="openCreateTaskModal" class="bg-blue-500 text-white p-2 rounded">+ Create Task</button>
    </div>
@endif


<div x-data="{ open: false }" class="relative w-full">
    <!-- Filters Button -->
    <button @click="open = !open"
        class="text-gray-600 text-sm bg-gray-100 p-2 px-4 rounded-md mb-3 w-full flex items-center justify-between border border-gray-300">
        <span class="flex items-center space-x-1 text-sm text-gray-400">
            <i class="bx bx-filter text-xl"></i> <!-- Ikon user -->
            <span>Filter</span> <!-- Teks nama user -->
        </span>
        <svg class="w-4 h-4 transform transition-transform" :class="{ 'rotate-180': open }"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown Menu for Filters -->
    <div x-show="open" x-transition.origin.top.duration.300ms
        class="mt-2 bg-white border border-gray-300 rounded-md shadow-lg w-full p-4" wire:ignore>
        <div class="flex flex-wrap gap-4">
            <!-- Owners / Responsibles Filter -->
            <div class="w-1/4">
                <label class="block text-gray-600 text-sm mb-1">Owners / Responsibles</label>
                <select class="bg-gray-100 p-2 rounded w-full border border-gray-300"
                    wire:model.live="selectedResponsible">
                    <option value="">Select an option</option>
                    @foreach ($responsibles as $responsible)
                        <option value="{{ $responsible->id }}">{{ $responsible->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Ticket Types Filter -->
            <div class="w-1/4">
                <label class="block text-gray-600 text-sm mb-1">Task types</label>
                <select class="bg-gray-100 p-2 rounded w-full border border-gray-300"
                    wire:model.live="selectedType">
                    <option value="">Select an option</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Task Priorities Filter -->
            <div class="w-1/4">
                <label class="block text-gray-600 text-sm mb-1">Task priorities</label>
                <select class="bg-gray-100 p-2 rounded w-full border border-gray-300"
                    wire:model.live="selectedPriority">
                    <option value="">Select an option</option>
                    @foreach ($priorities as $priority)
                        <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Filter and Reset Buttons -->
        <div class="flex justify-end space-x-2 mt-4">
            <button @click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded">Reset filters</button>
        </div>
    </div>
</div>

<div class="flex space-x-4">
    @foreach ($statuses as $status)
        <!-- Kontainer Status -->
        <div class="w-1/3 text-white p-4 mt-4 rounded shadow-2xlx" ondrop="drop(event, {{ $status->id }})"
            ondragover="allowDrop(event)">
            <!-- Nama Status dengan Warna -->
            <h2 class="font-bold mb-2 p-2 rounded text-center" style="background-color: {{ $status->color }}">
                {{ $status->name }}
            </h2>

            <!-- Kontainer Tugas -->
            <div id="status-{{ $status->id }}" class="bg-gray-300 space-y-2 max-h-[500px] overflow-y-auto">
                @foreach ($status->tasks as $task)
                    <!-- Task dengan Background Putih, Border, Shadow, dan Teks Hitam -->
                    <div id="task-{{ $task->id }}"
                        class="bg-white border border-gray-300 p-2 rounded shadow-lg text-black" draggable="true"
                        ondragstart="drag(event, {{ $task->id }})">
                        <!-- Nama Task -->
                        <div class="flex justify-between items-center mb-4">
                            <span class="space-x-4 flex">
                                <span wire:click="editTask({{ $task->id }}, '{{ $task->name }}')"
                                    class="cursor-pointer font-medium">
                                    {{ $task->name }}
                                </span>
                            </span>
                        </div>

                        <!-- Info Task -->
                        <div class="flex items-center space-x-1 text-sm text-gray-700">
                            <i class="bx bx-user-circle text-lg"></i>
                            <span>{{ $task->responsible->name }}</span>
                        </div>

                        <!-- Info Status -->
                        <div class="flex items-center space-x-1 text-sm text-gray-700">
                            <i class="bx bx-task text-lg" style="color: {{ $task->status->color }}"></i>
                            <span>{{ $task->status->name }}</span>
                        </div>

                        <!-- Info Prioritas -->
                        <div class="flex items-center space-x-1 text-sm text-gray-700">
                            <i class="bx bxs-flag-alt text-lg" style="color: {{ $task->priority->color }}"></i>
                            <span>{{ $task->priority->name }}</span>
                        </div>

                        <!-- Info Tipe -->
                        <div class="flex items-center space-x-1 text-sm text-gray-700">
                            <i class="bx bxs-purchase-tag text-lg" style="color: {{ $task->type->color }}"></i>
                            <span>{{ $task->type->name }}</span>
                        </div>

                        <!-- Tanggal Task -->
                        <div class="flex justify-between items-center">
                            <div
                                class="flex items-center space-x-1 text-sm
                                {{ $task->end_date && \Carbon\Carbon::parse($task->end_date)->isPast() ? 'text-red-500' : 'text-gray-700' }}">
                                <i class="bx bx-calendar text-lg"></i>
                                <span>
                                    {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('M d') : '' }}
                                </span>
                                <span>
                                    -
                                    {{ $task->end_date ? \Carbon\Carbon::parse($task->end_date)->format('M d') : '' }}
                                </span>
                            </div>

                            <!-- Tombol Show -->
                            <button onclick="" class="flex items-center" title="Show"
                                wire:click="openTaskModal({{ $task->id }})">
                                <i class='bx bx-show text-xl' style="color: {{ $status->color }}"></i>
                            </button>


                            <!-- Tombol Delete -->
                            @if ($status->name === 'Archived')
                                <button onclick="my_modal_{{ $task->id }}.showModal()"
                                    class="flex items-center" title="Delete">
                                    <i class="bx bx-trash text-xl text-red-500"></i>
                                </button>
                            @endif

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
                                            Hapus
                                        </button>
                                        <button class="btn hover:bg-gray-900 dark:bg-gray-700 dark:text-white"
                                            onclick="my_modal_{{ $task->id }}.close()">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@if ($showTaskModal && $selectedTask)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-md">
        <div class="bg-white p-8 rounded-lg shadow-2xl max-w-3xl w-full relative space-y-6">
            <!-- Tombol Close -->
            <button wire:click="closeTaskModal" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Title -->
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">{{ $selectedTask->name }}</h2>
            </div>

            <!-- Task Description -->
            <div>
                <p class="text-gray-700 text-sm"><strong>Deskripsi:</strong></p>
                <p class="text-gray-800 mt-2 leading-relaxed">{!! $selectedTask->content !!}</p>
            </div>

            <!-- Task Information -->
            <div class="space-y-4">
                <p><strong>Dibuat oleh:</strong> {{ $selectedTask->owner->name }}</p>
                <p><strong>Responsible:</strong> {{ $selectedTask->responsible->name }}</p>
                <p><strong>Priority:</strong> {{ $selectedTask->priority->name }}</p>
                <p><strong>Start Date:</strong> {{ $selectedTask->start_date }}</p>
                <p><strong>End Date:</strong> {{ $selectedTask->end_date }}</p>
            </div>

            <!-- Alerts for Deadline Warnings -->
            @if (
                $selectedTask->end_date &&
                Carbon\Carbon::now()->diffInDays(Carbon\Carbon::parse($selectedTask->end_date), false) <= 1 &&
                Carbon\Carbon::now()->lt(Carbon\Carbon::parse($selectedTask->end_date))
            )
                <div role="alert" class="bg-yellow-200 text-black p-4 rounded-xl shadow-md flex items-center space-x-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: Task ini akan mencapai deadline dalam {{ Carbon\Carbon::parse($selectedTask->end_date)->diffForHumans() }}</span>
                </div>
            @endif

            @if ($selectedTask->end_date && Carbon\Carbon::now()->gt(Carbon\Carbon::parse($selectedTask->end_date)))
                <div role="alert" class="bg-red-300 text-black p-4 rounded-xl shadow-md flex items-center space-x-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Warning: Task ini sudah mencapai deadline</span>
                </div>
            @endif
        </div>
    </div>
@endif




@if ($editingTaskId)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        wire:click.self="closeModal">
        <div class="bg-white p-6 rounded-lg w-1/2 relative max-h-screen overflow-y-auto">
            <!-- Modal Header -->
            <h3 class="text-xl font-semibold">Edit Task</h3>
            <button wire:click="closeModal"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Form Fields -->
            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Task Name -->
                <div class="col-span-1">
                    <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
                    <input id="name" type="text" wire:model="editedTask.name"
                        placeholder="Enter task name" class="bg-gray-100 p-2 rounded w-full"
                        wire:keyup="updateTaskRealTime" />
                </div>

                <!-- Content -->
                <div class="col-span-1">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" wire:model="editedTask.content" placeholder="Enter task content"
                        class="bg-gray-100 p-2 rounded w-full" wire:keyup="updateTaskRealTime"></textarea>
                </div>

                <!-- Owner -->
                <div class="col-span-1">
                    <label for="owner_id" class="block text-sm font-medium text-gray-700">Owner</label>
                    <select id="owner_id" wire:model="editedTask.owner_id"
                        class="bg-gray-100 p-2 rounded w-full" wire:keyup="updateTaskRealTime">
                        <option value="">Select Owner</option>
                        @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Start Date -->
                <div class="col-span-1">
                    <label for="start-date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="start-date" wire:model="editedTask.start_date"
                        class="bg-gray-100 p-2 rounded w-full" />
                </div>

                <!-- End Date -->
                <div class="col-span-1">
                    <label for="end-date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" id="end-date" wire:model="editedTask.end_date"
                        class="bg-gray-100 p-2 rounded w-full" />
                </div>

                <!-- Responsible -->
                <div class="col-span-1">
                    <label for="responsible_id"
                        class="block text-sm font-medium text-gray-700">Responsible</label>
                    <select id="responsible_id" wire:model="editedTask.responsible_id"
                        class="bg-gray-100 p-2 rounded w-full" wire:keyup="updateTaskRealTime">
                        <option value="">Select Responsible</option>
                        @foreach ($responsibles as $responsible)
                            <option value="{{ $responsible->id }}">{{ $responsible->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type -->
                <div class="col-span-1">
                    <label for="type_id" class="block text-sm font-medium text-gray-700">Type</label>
                    <select id="type_id" wire:model="editedTask.type_id" class="bg-gray-100 p-2 rounded w-full"
                        wire:keyup="updateTaskRealTime">
                        <option value="">Select Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Priority -->
                <div class="col-span-1">
                    <label for="priority_id" class="block text-sm font-medium text-gray-700">Priority</label>
                    <select id="priority_id" wire:model="editedTask.priority_id"
                        class="bg-gray-100 p-2 rounded w-full" wire:keyup="updateTaskRealTime">
                        <option value="">Select Priority</option>
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Code -->
                <div class="col-span-1">
                    <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                    <input id="code" type="text" wire:model="editedTask.code" placeholder="Enter Code"
                        class="bg-gray-100 p-2 rounded w-full" wire:keyup="updateTaskRealTime" />
                </div>

                <!-- Order -->
                <div class="col-span-1">
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input id="order" type="number" wire:model="editedTask.order" placeholder="Enter Order"
                        class="bg-gray-100 p-2 rounded w-full" wire:keyup="updateTaskRealTime" />
                </div>

                <!-- Estimation -->
                <div class="col-span-1">
                    <label for="estimation" class="block text-sm font-medium text-gray-700">Estimation</label>
                    <input id="estimation" type="number" wire:model="editedTask.estimation"
                        placeholder="Enter Estimation" class="bg-gray-100 p-2 rounded w-full"
                        wire:keyup="updateTaskRealTime" />
                </div>

                <!-- Update Button -->
                <div class="col-span-2 text-right mt-4">
                    <button wire:click="saveTask"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Modal for Creating Task -->
@can('manageTasks-create')
    @if ($creatingTask)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg w-1/2 relative overflow-y-auto max-h-screen">
                <button wire:click="resetCreateTask"
                    class="absolute top-2 right-2 text-xl text-gray-500 hover:text-gray-800">&times;
                </button>

                <h3 class="text-xl font-semibold">Create Task</h3>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ([['label' => 'Task Name', 'model' => 'newTask.name', 'type' => 'text'], ['label' => 'Content', 'model' => 'newTask.content', 'type' => 'textarea'], ['label' => 'Owner', 'model' => 'newTask.owner_id', 'type' => 'select', 'options' => $owners], ['label' => 'Start Date', 'model' => 'newTask.start_date', 'type' => 'date'], ['label' => 'End Date', 'model' => 'newTask.end_date', 'type' => 'date'], ['label' => 'Responsible', 'model' => 'newTask.responsible_id', 'type' => 'select', 'options' => $responsibles], ['label' => 'Type', 'model' => 'newTask.type_id', 'type' => 'select', 'options' => $types], ['label' => 'Priority', 'model' => 'newTask.priority_id', 'type' => 'select', 'options' => $priorities], ['label' => 'Code', 'model' => 'newTask.code', 'type' => 'text'], ['label' => 'Order', 'model' => 'newTask.order', 'type' => 'number'], ['label' => 'Estimation', 'model' => 'newTask.estimation', 'type' => 'number']] as $field)
                        <div class="col-span-1">
                            <label for="{{ $field['model'] }}"
                                class="block text-sm font-medium text-gray-700">{{ $field['label'] }}</label>
                            @if ($field['type'] == 'select')
                                <select id="{{ $field['model'] }}" wire:model="{{ $field['model'] }}"
                                    class="bg-gray-100 p-2 rounded w-full">
                                    <option value="">Select {{ $field['label'] }}</option>
                                    @foreach ($field['options'] as $option)
                                        <option value="{{ $option->id }}">{{ $option->name }}</option>
                                    @endforeach
                                </select>
                            @elseif($field['type'] == 'textarea')
                                <textarea id="{{ $field['model'] }}" wire:model="{{ $field['model'] }}" placeholder="Enter {{ $field['label'] }}"
                                    class="bg-gray-100 p-2 rounded w-full"></textarea>
                            @else
                                <input id="{{ $field['model'] }}" type="{{ $field['type'] }}"
                                    wire:model="{{ $field['model'] }}" placeholder="Enter {{ $field['label'] }}"
                                    class="bg-gray-100 p-2 rounded w-full" />
                            @endif
                        </div>
                    @endforeach

                    <div class="col-span-2 text-right mt-4">
                        <button wire:click="saveNewTask"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">
                            Create Task
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endcan





<script>
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev, taskId) {
        if (!@this.get('editingTaskId')) {
            ev.dataTransfer.setData("taskId", taskId);
            const element = document.getElementById(`task-${taskId}`);
            if (element) {
                element.style.opacity = "0.5";
            }
        }
    }

    function drop(ev, newStatusId) {
        ev.preventDefault();
        const taskId = ev.dataTransfer.getData("taskId");
        const taskElement = document.getElementById(`task-${taskId}`);
        const targetContainer = document.getElementById(`status-${newStatusId}`);
        if (taskElement && targetContainer) {
            taskElement.style.opacity = "1";
            targetContainer.appendChild(taskElement);
            @this.updateTaskStatus(taskId, newStatusId);
        }
    }
</script>
