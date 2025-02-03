<div>
     <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('project-statuses.index') }}">Project Status</a></li>
            <li><a class="text-black-400 font-semibold">Add data Project Status</a></li>
        </ul>
    </div>
    <a href="{{ route('project-statuses.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Add Project Status
    </h2>
    <div class="p-6 bg-white shadow rounded-lg dark:bg-gray-800">
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Name</label>
                <input type="text" id="name" wire:model="name"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Input status name">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Color</label>
                <div class="flex items-center">
                    <input type="color" id="head" wire:model.live="color" name="head"
                        class="w-12 h-10 p-0 border border-gray-300 dark:background-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <label for="head"
                        class="ml-2 block w-full px-3 py-2 border border-gray-300 dark:text-gray-400 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       >{{ $color ? $color : '#FFFFFF' }}</label>
                </div>
                @error('color')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4 flex items-center">
                <input type="checkbox" id="is_default" wire:model="is_default"
                    class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                <label for="is_default" class="ml-2 block text-sm text-gray-900 dark:text-gray-400">Default</label>
            </div>

            <div class="flex">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">Save</button>
                <button type="reset" class="btn btn-md btn-warning text-black hover:text-white mr-2 dark:text-white">Reset</button>
            </div>
        </form>

    </div>
</div>

