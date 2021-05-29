<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuser extends Model
{
    use HasFactory;

    // protected $connection   = "ishosu";
    protected $table        = "tuser";
    public    $incrementing = false;
    protected $primaryKey   = "LOGIN";
    protected $keyType      = "string";

    public function user()
    {
        return $this->hasOne(User::class, "username");
    }
}
