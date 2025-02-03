<?php

namespace App\Models;
// use...
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = true;

    public function Tasks()
    {
        return $this->hasMany(Tasks::class, 'status_id');
    }
}
