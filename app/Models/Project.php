<?php

namespace App\Models;
// use...
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'status_id',
        'ticket_prefix',
        'cover_image',
    ];
    public $timestamp = true;

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function status()
    {
        return $this->belongsTo(Statuses::class, 'status_id');
    }

    public function Tasks()
    {
        return $this->hasMany(Tasks::class);
    }
}
