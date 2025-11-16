<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';

    protected $fillable = [
        'no_ktp',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telepon',
        'email',
    ];
}
