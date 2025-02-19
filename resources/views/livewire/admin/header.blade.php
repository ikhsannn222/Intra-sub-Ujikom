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
                        <!-- Ganti dengan Icon Bx -->
                        <i class='bx bxs-envelope text-2xl text-gray-800 dark:text-gray-200'></i>

                        <!-- Badge Jumlah Notifikasi -->
                        <span wire:poll.5s wire:listen="notificationUpdated"
                            class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                            {{ $unreadCount }}
                        </span>
                    </button>

                    <!-- Dropdown Notifikasi -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-300 dark:border-gray-700 z-50">
                        <div class="py-2">
                            <livewire:notifications />
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="relative">
                    <button class="align-middle rounded-full focus:outline-none" @click="toggleProfileMenu" aria-label="Account">
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
                </div>
            </div>
        </div>
    </header>
</div>

