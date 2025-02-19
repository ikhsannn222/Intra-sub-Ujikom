<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use App\Models\Tasks;
use App\Models\User;
use Carbon\Carbon;

class Notifications extends Component
{
    public $notifications = [];
    public $history = [];
    public $unreadCount = 0;

    public function mount()
    {
        $this->loadNotifications();
        $this->loadHistory();
    }

    public function loadNotifications()
    {
        // Hanya mengambil notifikasi yang belum dibaca
        $this->notifications = Notification::where('user_id', auth()->id())
                                           ->whereNull('read_at')
                                           ->latest()
                                           ->get();
        $this->unreadCount = $this->notifications->count();
    }

    public function loadHistory()
    {
        // Hanya mengambil notifikasi yang sudah dibaca
        $this->history = Notification::where('user_id', auth()->id())
                                     ->whereNotNull('read_at')
                                     ->latest()
                                     ->get();
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification) {
            $notification->update([
                'is_read' => true,
                'read_at' => Carbon::now(),
            ]);
        }
        // Update tampilan setelah perubahan
        $this->loadNotifications();
        $this->loadHistory();
    }

    public function handleTasksMoved($tasksId, $newStatusId)
    {
        $tasks = Tasks::find($tasksId);
        $user = auth()->user();

        if ($user->hasRole('staff')) {
            $admin = User::role('admin')->first();
            if ($admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'message' => "Task '{$tasks->name}' telah dipindahkan ke status '{$tasks->status->name}' oleh {$user->name}",
                    'is_read' => false,
                ]);
            }
        }

        if ($user->hasRole('admin')) {
            $staff = $tasks->responsible;
            if ($staff) {
                Notification::create([
                    'user_id' => $staff->id,
                    'message' => "Task '{$tasks->name}' telah dipindahkan ke status '{$tasks->status->name}' oleh {$user->name}",
                    'is_read' => false,
                ]);
            }
        }

        $this->loadNotifications();
    }

    public function handleTaskCreated($taskId)
    {
        $task = Tasks::find($taskId);
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $staff = $task->responsible;
            if ($staff) {
                Notification::create([
                    'user_id' => $staff->id,
                    'message' => "Task baru '{$task->name}' telah ditambahkan oleh {$user->name}",
                    'is_read' => false,
                ]);
            }
        }

        $this->loadNotifications();
    }

    public function deleteHistory($notificationId)
{
    $notification = Notification::find($notificationId);
    if ($notification) {
        $notification->delete();
        $this->loadHistory();
    }
}


    public function render()
    {
        return view('livewire.notifications');
    }
}
