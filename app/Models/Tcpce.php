<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcpce extends Model
{
    use HasFactory;

    // protected $connection   = "ishosu";
    protected $table        = 'tcpce';
    public    $incrementing = false;
    protected $primaryKey   = "CODICLIE";
    protected $keyType      = "string";
    protected $casts        = [
        "AGENTERET" => "boolean",
    ];
}
