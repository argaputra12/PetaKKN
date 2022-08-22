<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'provinsi', 'kota_id', 'kelompok_id', 'js_coordinates'
    ];

    public function kelompoks(){
        return $this->belongsTo(Kelompok::class);
    }

    public function kotas(){
        return $this->belongsTo(Kota::class);
    }
}
