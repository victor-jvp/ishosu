<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tinv extends Model
{
    use HasFactory;

    protected $connection   = "ishosu";
    protected $table        = "Tinva";
    public    $incrementing = false;
    protected $primaryKey   = "CODIPROD";
    protected $keyType      = "string";

    protected $casts = [
        'UNIDCAJA' => 'double'
    ];

    protected $attributes = [
        'CODIPROD',
        'UNIDCAJA'
    ];

}
