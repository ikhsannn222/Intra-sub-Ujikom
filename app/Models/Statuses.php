<?php

namespace App\Models;
// use...
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

}
