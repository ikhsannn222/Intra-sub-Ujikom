<div>
    <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
        <div class="container flex items-center h-full px-6 mx-auto text-purple-600 dark:text-purple-300">
            <!-- Mobile Hamburger (Kiri) -->
            <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                @click="toggleSideMenu" aria-label="Menu">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Geser ke Kanan -->
            <div class="ml-auto flex items-center space-x-4">
                <!-- Notifikasi -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative focus:outline-none">
                        <i class='bx bxs-envelope text-2xl text-gray-800 dark:text-gray-200'></i>
                        <span wire:poll.5s wire:listen="notificationUpdated"
                            class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                            {{ $unreadCount }}
                        </span>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-300 dark:border-gray-700 z-50">
                        <div class="py-2">
                            <livewire:notifications />
                        </div>
                    </div>
                </div>

                <!-- Profile dengan Dropdown -->
                <div class="relative" x-data="{ isProfileMenuOpen: false }">
                    <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                        @click="isProfileMenuOpen = !isProfileMenuOpen"
                        @keydown.escape="isProfileMenuOpen = false" aria-label="Account" aria-haspopup="true">
                        <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-indigo-500 rounded-full dark:bg-indigo-500">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Photo" class="w-full h-full object-cover rounded-full">
                            @else
                                <span class="font-medium text-white dark:text-gray-300">
                                    {{ strtoupper(substr($name ?? Auth::user()->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <template x-if="isProfileMenuOpen">
                        <ul x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click.away="isProfileMenuOpen = false"
                            @keydown.escape="isProfileMenuOpen = false"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700 z-50"
                            aria-label="submenu">
                            <li class="flex">
                                <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('profile.edit') }}">
                                    <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 22 22">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('change-password') }}">
                                    <i class='bx bxs-lock' style="font-size: 16px;"></i>
                                    <span class="ml-2">Change Password</span>
                                </a>
                            </li>
                            <li class="flex">
                                <button
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    @click="document.getElementById('logout-modal').showModal()">
                                    <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Log out</span>
                                </button>
                            </li>
                        </ul>
                    </template>

                    <!-- Modal Logout -->
                    <dialog id="logout-modal" class="modal fixed inset-0 flex items-center justify-center">
                        <div class="modal-box bg-white text-gray-800 dark:bg-gray-800 dark:text-white p-4 md:p-5">
                            <svg class="mx-auto mb-4 text-gray-400 w-20 h-20 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="text-lg font-bold">Apakah Anda yakin ingin keluar?</h3>
                            <div class="modal-action">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn bg-red-500 text-white hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 border-none">
                                        Ya, Keluar
                                    </button>
                                </form>
                                <button class="btn hover:bg-gray-900 dark:bg-gray-700 dark:text-white"
                                    onclick="document.getElementById('logout-modal').close()">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </dialog>
                </div>
            </div>
        </div>
    </header>
</div>
