<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Relacion extends Model
{
    use SoftDeletes;

    protected $table = "relaciones";
    protected $casts = [
        "FECHA" => "date:Y-m-d"
    ];

    public function getIdZeroAttribute()
    {
        return str_pad($this->id,"6","0",STR_PAD_LEFT);
    }

    public function recibos()
    {
        return $this->hasMany(ReciboCab::class, "id_relacion");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, "updated_by");
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $user = Auth::user();
            $model->created_by = $user->getAuthIdentifier();
            $model->updated_by = $user->getAuthIdentifier();
        });
        static::updating(function($model)
        {
            $user = Auth::user();
            $model->updated_by = $user->getAuthIdentifier();
        });
    }
}
