<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Attach User
    </h2>

    @if (session()->has('message'))
        <div class="mb-4 text-sm text-green-600 bg-green-100 rounded-lg p-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form Input for Editing Attach User -->
    <form wire:submit.prevent="update" class="space-y-4">
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
            <select id="user_id" wire:model="user_id" class="block w-full px-4 py-2 mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:shadow-outline-purple">
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Menampilkan Nama User yang Dipilih -->
        @if($user_id)
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Selected User: {{ $users->firstWhere('id', $user_id)->name }}</p>
            </div>
        @endif

        <div class="mb-4">
            <label for="project_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project</label>
            <select id="project_id" wire:model="project_id" class="block w-full px-4 py-2 mt-1 text-sm border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:shadow-outline-purple">
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
            @error('project_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Menampilkan Nama Project yang Dipilih -->
        @if($project_id)
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Selected Project: {{ $projects->firstWhere('id', $project_id)->name }}</p>
            </div>
        @endif

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Update
            </button>
        </div>
    </form>
</div>
