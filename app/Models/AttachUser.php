<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'projects_id',
    ];

    public $timestamp = true;

    // public function users()
    // {
    //     return $this->hasMany(User::class, 'users_id');
    // }

    // public function projects()
    // {
    //     return $this->hasMany(Project::class, 'projects_id');
    // }

    public function user()
{
    return $this->belongsTo(User::class, 'users_id');
}

}
