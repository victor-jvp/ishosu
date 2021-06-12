<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankR extends Model
{
    protected $connection = "ishosu";
    protected $table = "vbanctas";
    public    $incrementing = false;
    protected $primaryKey   = "CODIBANC";
    protected $keyType      = "string";
}
