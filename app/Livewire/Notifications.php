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
        $user = auth()->user();

        $query = Notification::where('user_id', $user->id)
                             ->whereNull('read_at')
                             ->whereDate('created_at', Carbon::today());

        // Filter khusus untuk staff
        if ($user->role === 'superadmin') {
            $query->where(function ($q) {
                $q->where('message', 'like', '%memindahkan%')
                  ->orWhere('message', 'like', '%menambah%')
                  ->orWhere('message', 'like', '%menghapus%')
                  ->orWhere('message', 'like', '%merubah%');
            });
        }

        $this->notifications = $query->latest()->get();
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

    public function handleTasksMoved($taskId, $newStatusId)
    {
        $task = Tasks::find($taskId);
        $user = auth()->user();

        if (!$task || !$user) return;

        // Jika yang memindahkan staff
        if ($user->role === 'staff') {
            $superadmin = \App\Models\User::where('role', 'superadmin')->first();
            if ($superadmin) {
                Notification::create([
                    'user_id' => $superadmin->id,
                    'message' => "Task '{$task->name}' telah dipindahkan ke status '{$newStatusId}' oleh {$user->name}",
                    'is_read' => false,
                ]);
            }
        }

        // jika superadmin yang memindahkan task
        if ($user->role === 'superadmin' && $task->responsible) {
            Notification::create([
                'user_id' => $task->responsible->id,
                'message' => "Task '{$task->name}' telah dipindahkan ke status '{$newStatusId}' oleh {$user->name}",
                'is_read' => false,
            ]);
        }

        // Refresh notifikasi setelah aksi
        $this->loadNotifications();
    }

    public function handleTaskCreated($taskId)
    {
        $task = Tasks::find($taskId);
        $user = auth()->user();

        if (!$task || !$user || $user->role !== 'superadmin') return;

        if ($task->responsible) {
            Notification::create([
                'user_id' => $task->responsible->id,
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

        if (!$task || !$user || $user->role !== 'superadmin') return;

        if ($task->responsible) {
            Notification::create([
                'user_id' => $task->responsible->id,
                'message' => "Task '{$task->name}' telah dihapus oleh {$user->name}",
                'is_read' => false,
            ]);
        }

        $task->delete();
        $this->loadNotifications();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
