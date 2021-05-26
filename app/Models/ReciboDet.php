<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboDet extends Model
{
    public $timestamps = false;
    protected $table = "recibos_det";
    protected $dates = [
        "FECHA_PAGO"
    ];

    public function bank_e()
    {
        return $this->belongsTo(Bank::class, "bank_id_e");
    }
    public function bank_r()
    {
        return $this->belongsTo(Bank::class, "bank_id_r");
    }
}
