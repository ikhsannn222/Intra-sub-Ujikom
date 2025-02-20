<div x-data="{
    openHistory: false,
    toggleHistory() {
        this.openHistory = !this.openHistory;
        localStorage.setItem('openHistory', this.openHistory);
    }
}" x-init="localStorage.setItem('openHistory', false)">
    <!-- Notifikasi Aktif -->
    <div class="space-y-3 max-h-96 overflow-auto">
        @forelse ($notifications as $notification)
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                wire:key="{{ $notification->id }}"
                wire:click="markAsRead({{ $notification->id }})"
                @click="show = false"
                class="flex items-center justify-between p-3 bg-gray-100 dark:bg-gray-700 border-l-4 border-blue-500 rounded-lg shadow-md hover:bg-gray-200 dark:hover:bg-gray-800 transition duration-300 cursor-pointer"
            >
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                    {{ $notification->message }}
                </p>

                <!-- Ikon Ceklis -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 text-blue-500 hover:text-green-500 transition duration-300"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M5 12l5 5L20 7"></path>
                </svg>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-300 p-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M13 16H7m6-4H7m4-4H7m9 8h3m-3-4h3m-3-4h3M5 20h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/>
                </svg>
                <p class="text-center">Tidak ada notifikasi baru.</p>
            </div>
        @endforelse
    </div>

    <!-- Tombol Histori -->
    <div class="mt-4 text-center">
        <button @click="toggleHistory()" class="text-gray-600 dark:text-gray-300 hover:text-blue-500 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 7v5l3 3"></path>
                <path d="M12 3a9 9 0 1 0 9 9h-4"></path>
            </svg>
            <span class="text-sm">Histori Notifikasi</span>
        </button>
    </div>

    <!-- Modal Histori -->
    <div x-show="openHistory" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50"
        @click.away="openHistory = false">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow-lg w-96 max-h-96 overflow-auto relative">
            <button @click="openHistory = false" class="absolute top-3 right-3 text-gray-600 dark:text-gray-300 hover:text-red-500 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </button>

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3 text-center">Histori Notifikasi</h3>

            @forelse ($history as $historyItem)
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    wire:key="history-{{ $historyItem->id }}"
                    class="p-3 bg-gray-50 dark:bg-gray-800 border-l-4 border-gray-500 rounded-lg shadow-md mb-2 flex justify-between items-center"
                >
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $historyItem->message }}</p>
                        <p class="text-xs text-gray-500 font-semibold">
                            {{ $historyItem->read_at ? 'Dibaca pada: ' . \Carbon\Carbon::parse($historyItem->read_at)->translatedFormat('d M Y H:i') : 'Belum dibaca' }}
                        </p>
                    </div>

                    <!-- Tombol Hapus Histori -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-red-500 hover:text-red-700 cursor-pointer transition duration-300"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        wire:click="deleteHistory({{ $historyItem->id }})"
                        @click="show = false"
                    >
                        <path d="M3 6h18"></path>
                        <path d="M8 6v14"></path>
                        <path d="M16 6v14"></path>
                        <path d="M5 6l1 14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-14"></path>
                        <path d="M10 6V4h4v2"></path>
                    </svg>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center text-gray-500 dark:text-gray-300 p-4">
                    <p class="text-center">Tidak ada histori notifikasi.</p>
                </div>
            @endforelse

            <div class="mt-4 text-right">
                <button @click="toggleHistory()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
