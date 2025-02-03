<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <!-- Container -->
    <div class="flex flex-col lg:flex-row bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-5xl">
        <!-- Bagian Form Login -->
        <div class="flex flex-col justify-center px-8 py-12 lg:px-12 w-full max-w-lg">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img class="mx-auto h-12 w-auto" src="img/logo-intra-new.svg" alt="Logo Intra">
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                    LOGIN
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Please login to access the SMPL Intra website
                </p>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" wire:submit="login" method="POST">
                    @csrf
                    @if (session()->has('error'))
                        <div class="text-red-600 text-sm mb-2">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div>
                        <label for="nrp" class="block text-sm font-medium leading-6 text-gray-900">NRP</label>
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class='bx bxs-user-account text-xl'></i>
                            </div>
                            <input id="nrp" name="nrp" type="text" placeholder="Insert NRP"
                                wire:model="form.nrp" required
                                class="block w-full pl-10 rounded-md border-gray-300 py-2 text-gray-900 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="mt-2 relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class='bx bx-key text-xl'></i>
                            </div>
                            <input id="password" name="password" type="{{ $showPassword ? 'text' : 'password' }}"
                                placeholder="Insert Password" wire:model="form.password" required
                                class="block w-full pl-10 rounded-md border-gray-300 py-2 text-gray-900 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <button type="button" wire:click="togglePassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3">
                                @if ($showPassword)
                                    <!-- Icon Mata Terbuka -->
                                    <i class='bx bxs-show'></i>
                                @else
                                    <!-- Icon Mata Tertutup -->
                                    <i class='bx bxs-hide'></i>
                                @endif
                            </button>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bagian Gambar -->
        <div class="hidden lg:block lg:w-[60%]">
            <img src="img/foto-industri.jpg" alt="tidak ada foto"
                class="h-full w-full object-cover"
                style="height: 97vh; background-image: url('img/foto-industri.jpg'); background-size: cover; background-position: center;">
        </div>
    </div>
</div>
