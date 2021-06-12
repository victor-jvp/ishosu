<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankE extends Model
{
    protected $connection = "ishosu";
    protected $table = "tbancos";
    public    $incrementing = false;
    protected $primaryKey   = "CODIGO";
    protected $keyType      = "string";
}
