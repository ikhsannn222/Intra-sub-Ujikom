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
        $this->notifications = Notification::where('user_id', auth()->id())
                                           ->whereNull('read_at')
                                           ->whereDate('created_at', Carbon::today())
                                           ->latest()
                                           ->get();
        $this->unreadCount = $this->notifications->count();
    }

    public function loadHistory()
    {
        $this->history = Notification::where('user_id', auth()->id())
                                     ->whereNotNull('read_at')
                                     ->whereDate('created_at', Carbon::today())
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
        $this->loadNotifications();
        $this->loadHistory();
    }

    public function handleTasksMoved($taskId, $newStatusId)
    {
        $task = Tasks::find($taskId);
        $user = auth()->user();

        if (!$task || !$user) {
            return;
        }

        if ($user->id == 2) {
            Notification::create([
                'user_id' => 1, // Superadmin
                'message' => "Task '{$task->name}' telah dipindahkan ke status '{$newStatusId}' oleh {$user->name}",
                'is_read' => false,
            ]);
        }

        if ($user->id == 1) {
            $responsibleStaff = $task->responsible;
            if ($responsibleStaff) {
                Notification::create([
                    'user_id' => $responsibleStaff->id,
                    'message' => "Task '{$task->name}' telah dipindahkan ke status '{$newStatusId}' oleh {$user->name}",
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

        if (!$task || !$user || $user->id != 1) {
            return; // Hanya superadmin yang bisa menambah task
        }

        $responsibleStaff = $task->responsible;
        if ($responsibleStaff) {
            Notification::create([
                'user_id' => $responsibleStaff->id,
                'message' => "Task baru '{$task->name}' telah ditambahkan oleh {$user->name}",
                'is_read' => false,
            ]);
        }

        $this->loadNotifications();
    }

    public function handleTaskDeleted($taskId)
    {
        $task = Tasks::find($taskId);
        $user = auth()->user();

        if (!$task || !$user || $user->id != 1) {
            return; // Hanya superadmin yang bisa menghapus task
        }

        $responsibleStaff = $task->responsible;
        if ($responsibleStaff) {
            Notification::create([
                'user_id' => $responsibleStaff->id,
                'message' => "Task '{$task->name}' telah dihapus oleh {$user->name}",
                'is_read' => false,
            ]);
        }

        $task->delete();
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

    public function refreshNotifications()
    {
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
