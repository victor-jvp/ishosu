<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReciboCab extends Model
{
    protected $table = 'recibos_cab';
    protected $dates = [
        "FECHA"
    ];

    public function getIdZeroAttribute()
    {
        return str_pad($this->id,"6","0",STR_PAD_LEFT);
    }

    public function getMontoRecibidoAttribute()
    {
        if ($this->TIPO_PAGO == "T") {
            return $this->reciboDet()->sum("MONTO");
        }else{
            return $this->reciboDet()->sum(DB::raw("CANTIDAD * DENOMINACION"));
        }
    }

    public function factura()
    {
        return $this->belongsTo(Tfachisa::class, "NUMEDOCU");
    }

    public function notaEntrega()
    {
        return $this->belongsTo(Tfacnda::class, "NUMEDOCU");
    }

    public function reciboDet()
    {
        return $this->hasMany(ReciboDet::class, "ID_RECIBO");
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
