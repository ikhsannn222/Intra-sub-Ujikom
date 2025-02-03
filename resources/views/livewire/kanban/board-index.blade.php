<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('board.index') }}" class="text-black-400 font-semibold">Board</a></li>
        </ul>
    </div>
    <a href="{{ route('welcome') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mb-2 dark:text-gray-200 mt-4 text-black">Board</h2>


    <div class="flex justify-center mb-4">
        <div class="p-6 rounded-lg shadow-md max-w-2xl dark:bg-gray-800 bg-white w-full">
            <label for="project" class="block text-sm font-medium text-gray-700 mb-1 dark:text-gray-200 text-black">
                Project <span class="text-red-500">*</span>
            </label>
            <select wire:model.live="selectedProject" id="project" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-black-300 bg-white rounded-lg focus:ring-purple-500 focus:border-purple-500">
                @can('manageKanban-view')
                <option value="" class="text-black-400 dark:text-black-400">Choose Project</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" class="text-black-400 dark:text-black-400">{{ $project->name }}</option>
                @endforeach
                @endcan
            </select>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Select a project to display the board.</p>
        </div>
    </div>
</div>
