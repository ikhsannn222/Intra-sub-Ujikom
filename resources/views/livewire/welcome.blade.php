<div>

    {{-- content --}}
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-900 dark:text-gray-100">
            Dashboard
        </h2>

        <div class="flex items-start gap-4">
            <!-- Kolom untuk Jam Digital dan Sambutan -->
            <div class="w-1/2">
                <!-- Jam Digital Card -->
                <div class="bg-indigo-50 dark:bg-indigo-900 rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl duration-300 ease-in-out">
                    <p class="text-4xl font-extrabold text-indigo-800 dark:text-indigo-200" wire:poll.1s="updateClock">
                        {{ now()->format('H:i:s') }}
                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-300">
                        {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                </div>

                <!-- Card Sambutan untuk User, tepat di bawah jam digital -->
                <div class="mt-4 bg-green-50 dark:bg-green-900 rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl duration-300 ease-in-out">
                    <p class="text-2xl text-gray-800 dark:text-gray-100">
                        Selamat datang di halaman dashboard,
                        <span class="text-blue-500 font-semibold">{{ Auth::user()->name }}</span>!
                    </p>
                </div>

                @if ($totalUsers)
                    <div class="flex items-center bg-blue-50 dark:bg-blue-900 rounded-lg shadow-md p-6 mt-4 transition-transform transform hover:scale-105 hover:shadow-xl duration-300 ease-in-out">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-500 rounded-full text-white">
                            <i class='bx bxs-user text-2xl'></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Total User</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Kalender Card tetap di sebelah jam digital -->
            <div class="w-1/2">
                <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105 hover:shadow-xl duration-300 ease-in-out">
                    <!-- Navigasi Kalender -->
                    <div class="flex items-center justify-between mb-4">
                        <button wire:click="changeMonth(-1)" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200">
                           << Prev
                        </button>
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ $currentMonthName }} {{ $currentYear }}
                        </h2>
                        <button wire:click="changeMonth(1)" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200">
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
                                        @else bg-gray-200 dark:bg-gray-600 text-gray-400 @endif
                                        hover:bg-blue-200 dark:hover:bg-blue-600 transition-all duration-300 ease-in-out">
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
            {{-- <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-center w-12 h-12 bg-orange-100 dark:bg-orange-500 rounded-full text-orange-500 dark:text-orange-100">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-6">
                    <p class="text-lg font-medium text-gray-700 dark:text-gray-200">Total Clients</p>
                    <p class="text-2xl font-semibold text-gray-900 dark:text-white">6389</p>
                </div>
            </div> --}}
        </div>
    </div>

</div>
