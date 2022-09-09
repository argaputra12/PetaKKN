<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'identitas_kelompok',
        'nama_ketua',
        'link_sosmed',
        'program_telah_jalan',
        'dokumen_penunjang',
        'status'
    ];


}
