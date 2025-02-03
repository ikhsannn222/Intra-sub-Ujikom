<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('permission.index') }}">Permission</a></li>
            <li><a class="text-black-400 font-semibold">Edit data Permission</a></li>
        </ul>
    </div>
    <a href="{{ route('permission.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="my-6 text-2xl font-semibold text-black-700 dark:text-black-200">
        Edit Permission
    </h2>

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-black-800">
            <label for="name" class="block text-sm font-medium text-black-700 mb-2">Name</label>
            <input id="name" name="name" type="text" placeholder="Masukan Nama" autocomplete="off"
                wire:model="name" required
                class="w-full px-4 py-2 border border-black-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-black-900">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-md btn-primary">
            Update
        </button>

    </form>
</div>
