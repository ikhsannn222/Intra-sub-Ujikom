<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="img/logo-intra-new.svg" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Change Password</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form wire:submit.prevent="updatePassword" class="space-y-6">
            @csrf

            @if (session()->has('message'))
                <div class="mb-4 text-green-500">
                    {{ session('message') }}
                </div>
            @endif

            <div>
                <label for="old_password" class="block text-sm font-medium text-gray-900">Old Password</label>
                <div class="mt-2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <!-- Ganti dengan ikon dari BoxIcons -->
                        <box-icon name='lock-alt' class="h-5 w-5 text-gray-400"></box-icon>
                    </div>
                    <input id="old_password" name="old_password" type="password" placeholder="Insert Old Password" wire:model.defer="old_password" required class="block w-full pl-10 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('old_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-900">New Password</label>
                <div class="mt-2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <!-- Ikon baru untuk Password Baru: Key -->
                        <box-icon name='key' class="h-5 w-5 text-gray-400"></box-icon>
                    </div>
                    <input id="new_password" name="new_password" type="password" placeholder="Insert New Password" wire:model.defer="new_password" required class="block w-full pl-10 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                @error('new_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-900">Confirm New Password</label>
                <div class="mt-2 relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <!-- Ikon untuk Konfirmasi Password Baru -->
                        <box-icon name='lock-open-alt' class="h-5 w-5 text-gray-400"></box-icon>
                    </div>
                    <input id="new_password_confirmation" name="new_password_confirmation" type="password" placeholder="Confirm New Password" wire:model.defer="new_password_confirmation" required class="block w-full pl-10 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>


            <div>
                <button type="button" onclick="document.getElementById('confirm-modal').showModal()" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Change Password
                </button>
            </div>
        </form>
    </div>

    <dialog id="confirm-modal" class="modal fixed inset-0 flex items-center justify-center">
        <div class="modal-box bg-white text-gray-800 dark:bg-gray-800 dark:text-white p-4 md:p-5">
            <svg class="mx-auto mb-4 text-gray-400 w-20 h-20 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3 class="text-lg font-bold">Apakah Anda yakin ingin mengganti password?</h3>
            <small class="text-sm text-gray-500"><i>*Ini akan membawa anda ke halaman login jika yakin</i></small>
            <div class="modal-action">
                <button wire:click="updatePassword" class="btn bg-indigo-600 text-white hover:bg-indigo-700 border-none">
                    Ya, Change Password
                </button>
                <button class="btn hover:bg-gray-900 dark:bg-gray-700 dark:text-white" onclick="document.getElementById('confirm-modal').close()">
                    Cancel
                </button>
            </div>
        </div>
    </dialog>
</div>
