<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tahun',
        'nominal',
        'created_at',
        'updated_at',
    ];
}
