<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcpce extends Model
{
    use HasFactory;

    protected $connection   = "ishosu";
    protected $table        = 'tcpce';
    public    $incrementing = false;
    protected $primaryKey   = "CODICLIE";
    protected $keyType      = "string";
    protected $casts        = [
        "AGENTERET" => "boolean",
        "CODICLIE" => "string",
    ];

    protected $appends      = [
        "cobrado_usd",
        "cobrado_vef",
        "total_cobrado"
    ];

    public function getCobradoUsdAttribute()
    {
        return $this->recibos->where("TIPO_MONEDA", "=", "USD")->sum("MontoRecibido");
    }

    public function getCobradoVefAttribute()
    {
        return $this->recibos->where("TIPO_MONEDA", "=", "VEF")->sum("MontoRecibido");
    }

    public function getTotalCobradoAttribute()
    {
        $totalCobrado = 0;
        foreach ($this->recibos as $item) {
            $tasaCamb     = $item->TASA_CAMB;
            $montoRecibido = ($item->TIPO_PAGO == "T") ? $item->reciboDet()->sum("MONTO") : $item->reciboDet()->sum(DB::raw("CANTIDAD * DENOMINACION"));
            $totalCobrado += ($item->TIPO_MONEDA == "VEF" && $tasaCamb > 0) ? $montoRecibido / $tasaCamb : $montoRecibido;
        }
        return round($totalCobrado, 2);
    }

    public function faAfectada()
    {
        return $this->hasOne(Tfachisa::class, "NUMEDOCU", "NUMEAFEC");
    }

    public function neAfectada()
    {
        return $this->hasOne(Tfacnda::class, "NUMEDOCU", "NUMEAFEC");
    }

    public function cliente()
    {
        return $this->belongsTo(Tcpca::class, "CODICLIE", "CODICLIE");
    }

    public function recibos()
    {
        return $this->hasMany(ReciboCab::class, "NUMEDOCU", "NUMEDOCU");
    }
}
