<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_kelas',
        'kompetensi_keahlian',
        'created_at',
        'updated_at',
    ];
}
