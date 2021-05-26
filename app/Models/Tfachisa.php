<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            $montoRecibido = ($item->TIPO_PAGO == "T") ? $item->reciboDet->sum("MONTO") : $item->reciboDet->sum(DB::raw("CANTIDAD * DENOMINACION"));
            $totalCobrado += doubleval( ($item->TIPO_MONEDA == "VEF" && $tasaCamb > 0) ? $montoRecibido / $tasaCamb : $montoRecibido);
        }
        return $totalCobrado;
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
