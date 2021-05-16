<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tfachisa extends Model
{
    use HasFactory;

    // protected $connecion = "ishosu";
    protected $table = "tfachisa";
    public $incrementing = false;
    protected $primaryKey = "NUMEDOCU";
    protected $keyType = "string";
    protected $casts = [
        'FECHA'    => "datetime:Y-m-d",
        'TOTADOCU' => "double",
        "CAMBDOL"  => "double",
    ];

    public function cliente()
    {
        return $this->belongsTo(Tcpca::class, "CODICLIE", "CODICLIE");
    }
}
