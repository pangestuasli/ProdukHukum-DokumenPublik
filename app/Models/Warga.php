<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
        'foto', // optional untuk foto profil tunggal
    ];

    // Relasi ke WargaFile (multiple files)
    public function files()
    {
        return $this->hasMany(WargaFile::class, 'warga_id', 'warga_id');
    }
}
