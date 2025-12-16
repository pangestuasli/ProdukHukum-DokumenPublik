<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $table = 'jenis_dokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable = [
        'nama_jenis',
        'deskripsi'
    ];
}
