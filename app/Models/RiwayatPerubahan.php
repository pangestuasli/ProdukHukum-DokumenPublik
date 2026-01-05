<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DokumenHukum;

class RiwayatPerubahan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_perubahan';
    protected $primaryKey = 'riwayat_id';
    
    protected $fillable = [
        'dokumen_id',
        'tanggal',
        'uraian_perubahan',
        'versi'
    ];

    protected $casts = [
        'tanggal' => 'date'
    ];

    /**
     * Relasi ke DokumenHukum
     */
    public function dokumenHukum()
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }

    /**
     * Scope untuk filter berdasarkan dokumen
     */
    public function scopeByDokumen($query, $dokumenId)
    {
        return $query->where('dokumen_id', $dokumenId);
    }

    /**
     * Scope untuk urutkan berdasarkan versi
     */
    public function scopeOrderByVersi($query, $direction = 'desc')
    {
        return $query->orderBy('versi', $direction);
    }

    /**
     * Get next version number for a document
     */
    public static function getNextVersion($dokumenId)
    {
        $latest = self::where('dokumen_id', $dokumenId)
                     ->orderBy('versi', 'desc')
                     ->first();
        
        return $latest ? $latest->versi + 1 : 1;
    }
}