<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $connection   = "mysql";
    protected $table = "tipo_documento";
    public    $incrementing = false;
    protected $primaryKey   = "TIPO_DOC";
    protected $keyType      = "string";
}
