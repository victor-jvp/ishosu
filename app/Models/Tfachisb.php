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
        "CAMBDOL"  => "double",
        "PRECVENT" => "double",
        "IMPU1"    => "double",
    ];
}
