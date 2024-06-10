<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';

    protected $fillable = [
        'no_rm',
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'status_perkawinan',
        'alamat',
        'rt',
        'rw',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
