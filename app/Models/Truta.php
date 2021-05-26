<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truta extends Model
{
    use HasFactory;

    // protected $connecion = "ishosu";
    protected $table        = 'truta';
    public    $incrementing = false;
    protected $primaryKey   = "CODIRUTA";
    protected $keyType      = "string";
}