<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';
    protected $fillable = [
        'pasien_id',
        'no_antrian',
        'status',
        'tanggal_pendaftaran',
        'diagnosa',
        'pembayaran',
        'no_bpjs',
    ];

    // Tambahkan relasi ke model Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
