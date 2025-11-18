<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $fillable = [
        'nama_jenis',
        'deskripsi',
        'foto_path',
    ];
}
