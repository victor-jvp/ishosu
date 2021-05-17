<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboCab extends Model
{
    public $timestamps = false;

    protected $table = 'recibos_cab';

    public function reciboDet()
    {
        return $this->hasMany(ReciboDet::class, "ID_RECIBO");
    }
}
