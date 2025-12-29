<?php
// app/Models/LampiranDokumen.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LampiranDokumen extends Model
{
    use HasFactory;

    protected $table = 'lampiran_dokumen';
    protected $primaryKey = 'lampiran_id';
    public $timestamps = true;

    protected $fillable = [
        'dokumen_id',
        'berkas_lampiran',
        'keterangan'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship dengan DokumenHukum
     * (ubah dari Dokumen ke DokumenHukum)
     */
    public function dokumenHukum(): BelongsTo
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }

    /**
     * Alias untuk kompatibilitas
     */
    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }

    /**
     * Accessor untuk URL berkas
     */
    public function getBerkasUrlAttribute()
    {
        return asset('storage/lampiran/' . $this->berkas_lampiran);
    }

    /**
     * Accessor untuk tipe file
     */
    public function getTipeFileAttribute()
    {
        $ext = pathinfo($this->berkas_lampiran, PATHINFO_EXTENSION);
        return strtolower($ext);
    }

    /**
     * Accessor untuk ukuran file
     */
    public function getFileSizeAttribute()
    {
        $path = storage_path('app/public/lampiran/' . $this->berkas_lampiran);
        if (file_exists($path)) {
            $size = filesize($path);
            if ($size < 1024) {
                return $size . ' B';
            } elseif ($size < 1048576) {
                return round($size / 1024, 2) . ' KB';
            } else {
                return round($size / 1048576, 2) . ' MB';
            }
        }
        return 'N/A';
    }

    /**
     * Scope untuk filter berdasarkan dokumen
     */
    public function scopeByDokumen($query, $dokumenId)
    {
        return $query->where('dokumen_id', $dokumenId);
    }
}