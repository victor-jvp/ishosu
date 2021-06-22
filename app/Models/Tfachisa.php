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

    protected $connection   = "ishosu";
    protected $table        = "tfachisa";
    public    $incrementing = false;
    protected $primaryKey   = "NUMEDOCU";
    protected $keyType      = "string";
    protected $casts        = [
        'FECHA'    => "datetime:Y-m-d",
        'TOTADOCU' => "double",
        "CAMBDOL"  => "double",
        "TIPODOCU" => "string",
        "CODICLIE" => "string",
        "CODIRUTA" => "string",
    ];
    protected $appends      = [
        "total_cobrado",
        "total_gravable",
        "total_exento"
    ];

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

    public function getTotalGravableAttribute()
    {
        $acumPrecio = 0;
        foreach ($this->detalles as $item) {
            if ($item->IMPU1 > 0) {
                $acumPrecio += round($item->precio_unitario * $item->UNIDADES, 2);
            }
        }
        return $acumPrecio;
    }

    public function getTotalExentoAttribute()
    {
        $acumPrecio = 0;
        foreach ($this->detalles as $item) {
            if ($item->IMPU1 <= 0) {
                $acumPrecio += round($item->precio_unitario * $item->UNIDADES, 2);
            }
        }
        return $acumPrecio;
    }

    public function cliente()
    {
        return $this->belongsTo(Tcpca::class, "CODICLIE", "CODICLIE");
    }

    public function ruta()
    {
        return $this->belongsTo(Truta::class, "CODIRUTA", "CODIRUTA");
    }

    public function recibos()
    {
        return $this->hasMany(ReciboCab::class, "NUMEDOCU", "NUMEDOCU");
    }

    public function detalles()
    {
        return $this->hasMany(Tfachisb::class, 'NUMEDOCU', 'NUMEDOCU');
    }
}
