<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenHukum extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'dokumen_hukum';

    /**
     * Kunci utama tabel.
     *
     * @var string
     */
    protected $primaryKey = 'dokumen_id';

    /**
     * Kolom yang dapat diisi massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'jenis_id',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status',
    ];

    /**
     * Tipe data untuk kolom tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke model JenisDokumen.
     */
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'jenis_id');
    }

    /**
     * Relasi ke model KategoriDokumen.
     */
    public function kategoriDokumen()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    /**
     * Scope untuk dokumen dengan status tertentu.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk pencarian.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nomor', 'like', "%{$search}%")
              ->orWhere('judul', 'like', "%{$search}%")
              ->orWhere('ringkasan', 'like', "%{$search}%");
        });
    }
}