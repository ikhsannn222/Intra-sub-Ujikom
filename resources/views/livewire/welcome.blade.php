<div>

    {{-- content --}}
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Dashboard
        </h2>

        <div class="flex items-start gap-4">
            <!-- Kolom untuk Jam Digital dan Sambutan -->
            <div class="w-1/2">
                <!-- Jam Digital Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                    <p class="text-4xl font-extrabold text-gray-800 dark:text-white" wire:poll.1s="updateClock">
                        {{ now()->format('H:i:s') }}
                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                </div>

                <!-- Card Sambutan untuk User, tepat di bawah jam digital -->
                <div class="mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                    <p class="text-2xl text-gray-800 dark:text-gray-200">
                        Selamat datang di halaman dashboard,
                        <span class="text-blue-500 font-semibold">{{ Auth::user()->name }}</span>!
                    </p>
                </div>

                @if ($totalUsers)
                    <div class="flex items-center bg-white rounded-lg shadow-md p-4 mt-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-500 rounded-full text-white">
                            <i class='bx bxs-user text-2xl'></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-800">Total User</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Kalender Card tetap di sebelah jam digital -->
            <div class="w-1/2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                    <!-- Navigasi Kalender -->
                    <div class="flex items-center justify-between mb-4">
                        <button wire:click="changeMonth(-1)" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md">
                           << Prev
                        </button>
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ $currentMonthName }} {{ $currentYear }}
                        </h2>
                        <button wire:click="changeMonth(1)" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md">
                           Next >>
                        </button>
                    </div>

                    <!-- Tabel Kalender -->
                    <div class="grid grid-cols-7 gap-1 text-center">
                        <!-- Header Hari -->
                        @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                            <div class="font-bold text-gray-700 dark:text-gray-200">{{ $day }}</div>
                        @endforeach

                        <!-- Hari dalam Kalender -->
                        @foreach ($calendar as $week)
                            @foreach ($week as $date)
                                <div
                                    class="p-2 rounded-md
                                        @if ($date['isToday']) bg-blue-500 text-white font-bold
                                        @elseif ($date['isCurrentMonth']) bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200
                                        @else bg-gray-200 dark:bg-gray-600 text-gray-400 @endif">
                                    {{ $date['day'] }}
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            {{-- <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div
                    class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-black-600 dark:text-black-400">
                        Total clients
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-black-200">
                        6389
                    </p>
                </div>
            </div> --}}
        </div>
    </div>

</div>
