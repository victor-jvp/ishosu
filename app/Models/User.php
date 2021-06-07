<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $connection   = "mysql";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tuser()
    {
        return $this->hasOne(Tuser::class, "LOGIN", "username");
    }

    public function documentosCreatedBy()
    {
        return $this->hasMany(ReciboCab::class, "created_by");
    }

    public function documentosUpdatedBy()
    {
        return $this->hasMany(ReciboCab::class, "updated_by");
    }

    public function relacionesCreatedBy()
    {
        return $this->hasMany(ReciboCab::class, "created_by");
    }

    public function relacionesUpdatedBy()
    {
        return $this->hasMany(ReciboCab::class, "updated_by");
    }

    public function estacion()
    {
        return $this->belongsTo(Estacion::class, "estacion_id");
    }
}
