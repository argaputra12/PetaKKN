<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelompok_id',

    ];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
