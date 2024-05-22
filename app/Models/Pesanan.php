<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'status',
        'id_akun',
    ];

    // protected $guarded = ['id_pesanan'];

    // Relasi dengan Akun
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }

    // Relasi dengan DetailPesanan
    public function detailPesanan()
    {
        return $this->hasOne(DetailPesanan::class, 'id_psn', 'id_pesanan');
    }

}
