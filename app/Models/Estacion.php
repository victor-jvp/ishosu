<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $connection   = "mysql";
    protected $table = "estaciones";
}