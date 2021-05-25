<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        "CAMBDOL"  => "double",
    ];
    protected $appends      = [
        "cobrado_usd",
        "cobrado_vef",
//        "total_cobrado"
    ];

    public function getCobradoUsdAttribute()
    {
        return $this->recibos->where("TIPO_MONEDA", "=", "USD")->sum("MontoRecibido");
    }

    public function getCobradoVefAttribute()
    {
        return $this->recibos->where("TIPO_MONEDA", "=", "VEF")->sum("MontoRecibido");
    }

/*    public function getTotalCobradoAttribute()
    {
        $totalCobrado = 0;
        foreach ($this->recibos as $item) {
            $tasaCamb     = $item->TASA_CAMB;
            $totalCobrado += ($item->TIPO_MONEDA == "VEF") ? $item->montoRecibido / $tasaCamb : $item->montoRecibido;
        }

        return $totalCobrado;
    }*/

    public function cliente()
    {
        return $this->belongsTo(Tcpca::class, "CODICLIE", "CODICLIE");
    }

    public function recibos()
    {
        return $this->hasMany(ReciboCab::class, "NUMEDOCU", "NUMEDOCU");
    }
}
