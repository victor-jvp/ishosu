<?php

namespace App\Models;

use App\Models\Tcpca;
use App\Models\ReciboCab;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tfachisa extends Model
{
    use HasFactory;

    // protected $connecion = "ishosu";
    protected $table        = "tfachisa";
    public    $incrementing = false;
    protected $primaryKey   = "NUMEDOCU";
    protected $keyType      = "string";
    protected $casts        = [
        'FECHA'    => "datetime:Y-m-d",
        'TOTADOCU' => "double",
        "CAMBDOL"  => "double"
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

    public function cliente()
    {
        return $this->belongsTo(Tcpca::class, "CODICLIE", "CODICLIE");
    }

    public function recibos()
    {
        return $this->hasMany(ReciboCab::class, "NUMEDOCU", "NUMEDOCU");
    }
}
