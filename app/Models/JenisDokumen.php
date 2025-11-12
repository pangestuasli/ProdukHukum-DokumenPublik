<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    use HasFactory;

    protected $table = 'jenis_dokumen';
    protected $primaryKey = 'jenis_id';
    protected $fillable = ['nama_jenis', 'deskripsi'];
}
