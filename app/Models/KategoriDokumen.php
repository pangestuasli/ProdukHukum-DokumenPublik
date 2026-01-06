<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriDokumen extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'kategori_dokumen';

    /**
     * Kunci utama tabel.
     *
     * @var string
     */
    protected $primaryKey = 'kategori_id';

    /**
     * Kolom yang dapat diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Relasi ke dokumen hukum
     */
    public function dokumenHukum(): HasMany
    {
        return $this->hasMany(DokumenHukum::class, 'kategori_id', 'kategori_id');
    }
}