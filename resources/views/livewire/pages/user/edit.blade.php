<div>
    <div class="breadcrumbs text-sm mt-4">
        <ul>
            <li><a href="{{ route('welcome') }}">Dashboard</a></li>
            <li><a href="{{ route('user.index') }}">User</a></li>
            <li><a class="text-black-400 font-semibold">Edit data User</a></li>
        </ul>
    </div>
    <a href="{{ route('user.index') }}" class="btn btn-md text-black">
        <i class="bx bx-arrow-back text-xl"></i>
    </a>
    <h2 class="text-2xl font-semibold text-black-700 dark:text-black-200">
        Edit User
    </h2>

    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-black-800">
            <label class="block text-sm">
                <span class="text-black-700 dark:text-black-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black"
                    placeholder="Masukkan nama user" wire:model="name" />
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </label>

            <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">NRP</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black"
                    placeholder="Masukkan NRP" wire:model="nrp" />
                @error('nrp')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </label>

            <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">E-mail</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black"
                    placeholder="Masukkan E-mail" type="email" wire:model="email" />
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-black-700 dark:text-black-400">Status</span>
                <select wire:model="is_active"
                    class="block w-full mt-1 text-sm dark:text-black-300 dark:border-black-600 dark:bg-black-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-black text-black">
                    <option value="">Choose Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non-aktif</option>
                </select>
                @error('is_active')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </label>

            <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">Cover</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input"
                    type="file" wire:model="avatar" />
                @error('avatar')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </label>

            <label for="departement_id" class="block text-sm mt-4">Departement</label>
            <select wire:model="departement_id" id="departement_id"
                class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black">
                <option value="">Choose Departement</option>
                @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                @endforeach
            </select>
            @error('departement_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <label for="jabatan_id" class="block text-sm mt-4">Jabatan</label>
            <select wire:model="jabatan_id" id="jabatan_id"
                class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black">
                <option value="">Choose Jabatan</option>
                @foreach ($jabatans as $jabatan)
                    <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                @endforeach
            </select>
            @error('jabatan_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <label for="bagian_id" class="block text-sm mt-4">Bagian</label>
            <select wire:model="bagian_id" id="bagian_id"
                class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black">
                <option value="">Choose Bagian</option>
                @foreach ($bagians as $bagian)
                    <option value="{{ $bagian->id }}">{{ $bagian->name }}</option>
                @endforeach
            </select>
            @error('bagian_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror


            <label for="role" class="block text-sm mt-4">Role</label>
            <select wire:model="role" id="role"
                class="block w-full mt-1 text-sm dark:text-black-300 dark:border-black-600 dark:bg-black-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-black text-black">
                <option value="">Choose Role</option>
                <option value="superadmin">Super Admin</option>
                <option value="staff">Staff</option>
            </select>
            @error('role')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror

            <label class="block text-sm mt-4">
                <span class="text-black-700 dark:text-black-400">Password</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-black-600 dark:bg-black-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-black-300 dark:focus:shadow-outline-black form-input text-black"
                    type="password" wire:model="password" placeholder="Kosongkan jika tidak ingin mengubah password" />
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <button type="submit" class="btn btn-md btn-primary">Update</button>
    </form>
</div>
