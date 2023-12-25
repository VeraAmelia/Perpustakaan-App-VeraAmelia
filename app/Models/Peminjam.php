<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_peminjam', 'books_id', 'pengunjung_id', 'pegawai_id', 'status'
    ];
}
