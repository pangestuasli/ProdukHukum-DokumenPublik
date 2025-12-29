<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenHukum extends Model
{
    use HasFactory;

    protected $table = 'dokumen_hukum';
    protected $primaryKey = 'dokumen_id';
    
    protected $fillable = [
        'jenis_id',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Relasi ke jenis dokumen
    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'jenis_id');
    }

    // Relasi ke kategori dokumen
    public function kategoriDokumen()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    // === RELASI KE MEDIA (SIMPLE VERSION) ===
    
    // Semua file
    public function files()
    {
        return $this->hasMany(Media::class, 'ref_id', 'dokumen_id')
            ->where('ref_table', 'dokumen_hukum')
            ->orderBy('sort_order');
    }

    // File utama (yang pertama)
    public function fileUtama()
    {
        return $this->hasOne(Media::class, 'ref_id', 'dokumen_id')
            ->where('ref_table', 'dokumen_hukum')
            ->where('sort_order', 0);
    }

    // Lampiran
    public function lampiran()
    {
        return $this->hasMany(Media::class, 'ref_id', 'dokumen_id')
            ->where('ref_table', 'dokumen_hukum')
            ->where('sort_order', '>', 0);
    }

    // Helper untuk cek ada file atau tidak
    public function getAdaFileAttribute()
    {
        return $this->files()->exists();
    }
    public function lampiranDokumen()
    {
        return $this->hasMany(LampiranDokumen::class, 'dokumen_id', 'dokumen_id');
    }
}