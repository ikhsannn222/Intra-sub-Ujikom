<div class="p-6 shadow-md rounded-lg mt-4">
    <h2 class="text-2xl font-semibold mb-4 dark:text-gray-300 dark:focus:shadow-outline-gray text-black">Edit Profile</h2>

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

    <form wire:submit.prevent="update">
        <div class="flex mb-4">
            <div class="flex justify-center mb-4">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="current avatar"
                         class="h-60 w-30 rounded-full border-2 border-black-500/50">
                @else
                    <div class="inline-flex items-center justify-center w-40 h-40 overflow-hidden bg-indigo-500 rounded-full dark:bg-indigo-500">
                        <span class="text-6xl font-medium text-white dark:text-gray-300">
                            {{ strtoupper(substr($name ?? Auth::user()->name, 0, 2)) }}
                        </span>
                    </div>
                @endif
            </div>
            <div class="w-2/3 pl-4">
                <input type="file" wire:model="avatar"
                       class="mb-4 dark:text-gray-300 dark:focus:shadow-outline-gray text-black max-w-xs overflow-hidden text-ellipsis whitespace-nowrap">
                <br>
            </div>
            @error('avatar')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">Name</label>
            <input type="text" wire:model="name"
                   class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-md shadow-sm dark:text-gray-300 dark:focus:shadow-outline-gray text-black"
                   required>
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-400">E-mail</label>
            <input type="email" wire:model="email"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:shadow-outline-gray text-black"
                   required>
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            <small><i>*jika password lupa, lapor kepada admin intra-sub</i></small>
        </div>

        <button type="submit"
                class="btn btn-md btn-primary text-black hover:text-white dark:text-white px-4 py-2 rounded">
            Save Changes
        </button>
        <a href="{{ route('welcome') }}" class="btn btn-md btn-success text-white mt-4 justify-content-end">
            << Back
        </a>
    </form>
</div>
