<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{

    public string $search = '';

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public string $currentTime = '';
    public int $currentMonth;
    public int $currentYear;
    public array $calendar = [];
    public ?int $totalUsers = null;

    public function mount(): void
    {
        $this->updateClock();

        // Inisialisasi bulan dan tahun saat ini
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;

// Generate kalender
        $this->generateCalendar();

    }

    public function updateClock(): void
    {
        $this->currentTime = now()->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm:ss');
    }

    public function generateCalendar(): void
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        // Mulai dari tanggal 1 bulan ini
        $startOfMonth = Carbon::createFromDate($this->currentYear, $this->currentMonth, 1);

        // Tentukan tanggal awal minggu untuk tampilan kalender
        $startOfCalendar = $startOfMonth->copy()->startOfWeek();

        // Tentukan tanggal akhir minggu dari akhir bulan
        $endOfMonth = $startOfMonth->copy()->endOfMonth();
        $endOfCalendar = $endOfMonth->copy()->endOfWeek();

        // Debugging untuk memastikan range
        logger('Start of calendar: ' . $startOfCalendar->toDateString());
        logger('End of calendar: ' . $endOfCalendar->toDateString());

        // Hasilkan semua tanggal dari awal sampai akhir
        $dates = collect($startOfCalendar->daysUntil($endOfCalendar)->toArray());

        // Bagi tanggal ke dalam minggu
        $this->calendar = $dates->chunk(7)->map(function ($week) {
            return $week->map(function ($date) {
                return [
                    'day' => $date->day,
                    'isToday' => $date->isToday(),
                    'isCurrentMonth' => $date->month === $this->currentMonth,
                ];
            })->toArray();
        })->toArray();
    }

    public function changeMonth(int $direction): void
    {
        // Ubah bulan berdasarkan arah (+1 untuk maju, -1 untuk mundur)
        $this->currentMonth += $direction;

        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        } elseif ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }

        // Generate kalender untuk bulan baru
        $this->generateCalendar();
    }

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[ ...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function render()
    {
        $user = Auth::user();

// Pastikan totalUsers diperbarui di sini
        if ($user && $user->hasRole('superadmin')) {
            $this->totalUsers = User::count();
        }

        return view('livewire.welcome', [
            'users' => $this->users(),
            'headers' => $this->headers(),
            'currentMonthName' => Carbon::createFromDate($this->currentYear, $this->currentMonth, 1)
                ->locale('id')
                ->isoFormat('MMMM'),
            'totalUsers' => $this->totalUsers,
        ]);
    }
}
