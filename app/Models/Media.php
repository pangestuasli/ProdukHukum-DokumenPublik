<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';
    
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order'
    ];

    // Relasi ke dokumen
    public function dokumen()
    {
        return $this->belongsTo(DokumenHukum::class, 'ref_id', 'dokumen_id');
    }

    // Helper untuk icon file
    public function getIconAttribute()
    {
        $ext = strtolower(pathinfo($this->file_url, PATHINFO_EXTENSION));
        
        $icons = [
            'pdf' => 'mdi-file-pdf-box text-danger',
            'doc' => 'mdi-file-word-box text-primary',
            'docx' => 'mdi-file-word-box text-primary',
            'xls' => 'mdi-file-excel-box text-success',
            'xlsx' => 'mdi-file-excel-box text-success',
            'jpg' => 'mdi-file-image-box text-warning',
            'jpeg' => 'mdi-file-image-box text-warning',
            'png' => 'mdi-file-image-box text-warning',
            'gif' => 'mdi-file-image-box text-warning',
        ];

        return $icons[$ext] ?? 'mdi-file-document-box text-secondary';
    }

    // Helper untuk download URL - PERBAIKI INI!
    public function getDownloadUrlAttribute()
    {
        return route('dokumen-hukum.file.download', [
            'dokumen' => $this->ref_id,
            'file' => $this->media_id
        ]);
    }

    // Cek file exists
    public function getFileExistsAttribute()
    {
        return file_exists(storage_path('app/public/' . $this->file_url));
    }
}