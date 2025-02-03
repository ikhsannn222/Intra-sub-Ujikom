<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('user.index') }}">User</a></li>
            <li><a class="text-black-400 font-semibold">Add data User</a></li>
        </ul>
    </div>
    <a href="{{ route('user.index') }}" class="btn btn-md bg-white text-black mt-2">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="text-2xl font-semibold text-black-700 dark:text-black-200 mt-2">
        Add User
    </h2>
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        @csrf
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <label class="block text-sm">
                <span class="text-black-700 dark:text-black-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert username" wire:model="name" />
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">NRP</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert NRP" wire:model="nrp" />
                @error('nrp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">E-mail</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    placeholder="Insert E-mail" type="email" wire:model="email" />
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Status
                </span>
                <select wire:model="is_active"
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                    <option>Pilih Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non-aktif</option>
                </select>
                @error('is_active')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Cover</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    type="file" wire:model="avatar" />
                @error('avatar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
            <label for="role" class="block text-sm mt-4">Role</label>
            <select wire:model="role" id="role"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Role</option>
                <option value="superadmin">Super Admin</option>
                <option value="staff">Staff</option>
            </select>
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <label for="departement_id" class="block text-sm mt-4">Departement</label>
            <select wire:model="departement_id" id="departement_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Departement</option>
                @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                @endforeach
            </select>
            @error('departement_id')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="jabatan_id" class="block text-sm mt-4">Jabatan</label>
            <select wire:model="jabatan_id" id="jabatan_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Jabatan</option>
                @foreach ($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                @endforeach
            </select>
            @error('jabatan_id')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="bagian_id" class="block text-sm mt-4">Bagian</label>
            <select wire:model="bagian_id" id="bagian_id"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray text-black">
                <option value="">Choose Bagian</option>
                @foreach ($bagians as $bagian)
                    <option value="{{ $bagian->id }}">{{ $bagian->name }}</option>
                @endforeach
            </select>
            @error('bagian_id')
                <span class="error">{{ $message }}</span>
            @enderror
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Password</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input text-black"
                    type="password" wire:model="password" placeholder="Insert Password" />
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </label>
        </div>
        <button type="reset" class="btn btn-md btn-warning text-wh">Reset</button>
        <button type="submit" class="btn btn-md btn-primary">Save</button>
    </form>
</div>
