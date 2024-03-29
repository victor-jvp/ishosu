<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReciboCab extends Model
{
    use SoftDeletes;

    protected $connection   = "mysql";
    protected $table = 'recibos_cab';
    protected $dates = [
        "FECHA"
    ];

    public function getIdZeroAttribute()
    {
//        $estacion = (!is_null($this->createdBy->estacion)) ? $this->createdBy->estacion->codigo : "";
        return $this->estacion.str_pad($this->num, "6", "0", STR_PAD_LEFT);
    }

    public function getMontoRecibidoAttribute()
    {
        if ($this->TIPO_PAGO == "T") {
            return $this->reciboDet()->sum("MONTO");
        } else {
            return $this->reciboDet()->sum(DB::raw("CANTIDAD * DENOMINACION"));
        }
    }

    public function factura()
    {
        return $this->belongsTo(Tfachisa::class, "NUMEDOCU")->orderBy('NUMEDOCU', 'desc');
    }

    /*public function notaEntregaNew()
    {
        return $this->belongsTo(Tfachisa::class, "NUMEDOCU")->orderBy('NUMEDOCU', 'desc');
    }*/

    public function notaEntrega()
    {
        $objecto = (Tfachisa::where("NUMEDOCU", "=", $this->NUMEDOCU)->count() > 0) ? Tfachisa::class : Tfacnda::class;

        return $this->belongsTo($objecto, "NUMEDOCU")->orderBy('NUMEDOCU', 'desc');
    }

    public function notaDebito()
    {
        return $this->belongsTo(Tcpce::class, "NUMEDOCU")->orderBy('NUMEDOCU', 'desc');
    }

    public function reciboDet()
    {
        return $this->hasMany(ReciboDet::class, "id_recibo");
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, "TIPO_DOC", "TIPO_DOC");
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
        static::creating(function ($model) {
            $user              = Auth::user();
            $model->created_by = $user->getAuthIdentifier();
            $model->updated_by = $user->getAuthIdentifier();
        });
        static::updating(function ($model) {
            $user              = Auth::user();
            $model->updated_by = $user->getAuthIdentifier();
        });
    }
}
