<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_desa',
        'nama_kecamatan',
        'kota_id'
    ];

    public function kota(){
        return $this->belongsTo(Kota::class);
    }
}
