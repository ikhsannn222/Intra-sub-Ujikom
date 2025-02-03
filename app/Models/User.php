<?php

namespace App\Models;
// use....
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nrp',
        'email',
        'is_active',
        'avatar',
        'password',
        'departement_id',
        'bagian_id',
        'jabatan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'bagian_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function Tasks()
    {
        return $this->hasMany(Tasks::class);
    }

    public function responsibleTasks()
    {
        return $this->hasMany(Tasks::class, 'responsible_id');
    }

    public function attachUsers()
    {
    return $this->hasMany(AttachUser::class, 'users_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
