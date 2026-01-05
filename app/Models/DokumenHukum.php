<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class DokumenHukum extends Model
{
    protected $table = 'dokumen_hukum';
    protected $primaryKey = 'dokumen_id';


    protected $fillable = [
        'jenis_id',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status',
        'file_dokumen'
    ];


    public function jenis()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_id', 'jenis_id');
    }


    public function kategori()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    public function lampiran()
    {
        return $this->hasMany(LampiranDokumen::class, 'dokumen_id', 'dokumen_id');
    }
}