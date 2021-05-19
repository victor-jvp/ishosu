<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tfacnda extends Model
{
    use HasFactory;

    // protected $connecion = "ishosu";
    protected $table = "tfacnda";
    public $incrementing = false;
    protected $primaryKey = "NUMEDOCU";
    protected $keyType = "string";
    protected $casts = [
        'FECHA'    => "datetime:Y-m-d",
        'TOTADOCU' => "double",
        "CAMBDOL"  => "double",
    ];
    protected $appends = [
        "monto_cobrado"
    ];

    public function getMontoCobradoAttribute()
    {
        return $this->recibos->sum("MontoRecibido");
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
