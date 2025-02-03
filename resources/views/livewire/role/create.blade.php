<div class="container mx-auto">
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('role.index') }}">Role</a></li>
            <li><a class="text-black-400 font-semibold">Add data Role</a></li>
        </ul>
    </div>
    <a href="{{ route('role.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tambah Role
    </h2>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store">
        @csrf
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <!-- Input untuk Nama Role -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name Role</label>
                <input id="name" name="name" type="text" placeholder="Input Name Role" autocomplete="off"
                    wire:model="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-gray-900">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Checkbox untuk Permissions -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Permission:</label>
                <!-- Check All / Uncheck All -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="checkAll" wire:click="toggleSelectAllPermissions" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="checkAll" class="ml-2 text-sm text-gray-700">Check All</label>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach ($permissions as $permission)
                        <div class="flex items-center">
                            <input type="checkbox" wire:model="Getpermissions" value="{{ $permission->id }}"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label class="ml-2 text-sm text-gray-700">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('Getpermissions')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Save dan Back -->
            <button type="reset" class="btn btn-md btn-warning text-white">Reset</button>
            <button type="submit" class="btn btn-md btn-primary">Save</button>
        </div>
    </form>
</div>
