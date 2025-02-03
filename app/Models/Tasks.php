<?php

namespace App\Models;
// use...
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'content', 'owner_id', 'responsible_id', 'status_id', 'project_id', 'type_id', 'priority_id', 'code', 'order', 'estimation','start_date','end_date'
    ];

    // Relasi ke User sebagai owner
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relasi ke User sebagai responsible
    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    // Relasi ke Statuses
    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // Relasi ke TaskType
    public function type()
    {
        return $this->belongsTo(TaskType::class, 'type_id');
    }

    // Relasi ke Priorities
    public function priority()
    {
        return $this->belongsTo(Priorities::class, 'priority_id');
    }
}
