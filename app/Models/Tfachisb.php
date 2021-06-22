<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tfachisb extends Model
{
    protected $connection   = "ishosu";
    protected $table        = "tfachisb";
    public    $incrementing = false;
    protected $casts        = [
        'UNIDADES' => "double",
        "PRECVENT" => "double",
        "IMPU1"    => "double",
    ];
    protected $appends =[
        'precio_unitario'
    ];

    public function getPrecioUnitarioAttribute()
    {
        return $this->PRECVENT / $this->inventory->UNIDCAJA;
    }

    public function inventory()
    {
        return $this->belongsTo(Tinv::class, 'CODIPROD', 'CODIPROD');
    }
}
