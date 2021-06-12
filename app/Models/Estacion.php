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

    public function scopeAumentarRecibo($query, $user)
    {
        if  ($user->estacion){
            $estacion = $query->find($user->estacion->id);
            $estacion->recibo_num++;
            $estacion->save();
        }
    }
    public function scopeAumentarRelacion($query, $user)
    {
        if  ($user->estacion){
            $estacion = $query->find($user->estacion->id);
            $estacion->relacion_num++;
            $estacion->save();
        }
    }
}
