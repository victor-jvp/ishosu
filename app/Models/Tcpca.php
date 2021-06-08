<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcpca extends Model
{
    use HasFactory;

    protected $connection   = "ishosu";
    protected $table        = 'tcpca';
    public    $incrementing = false;
    protected $primaryKey   = "CODICLIE";
    protected $keyType      = "string";
    protected $casts        = [
        "AGENTERET" => "boolean",
    ];

    protected $visible = [
        "CODICLIE",
        "NOMBCLIE",
        "RIF",
        "AGENTERET"
    ];

    public function getIdClienteAttribute()
    {
        return trim($this->CODICLIE);
    }
}
