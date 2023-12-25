<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pengunjung', 'no_tlp', 'email', 'nik', 'tgl_lahir', 'alamat'
    ];
}
