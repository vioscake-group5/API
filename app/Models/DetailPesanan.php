<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';

    protected $primaryKey = 'id_psn';

    // protected $guarded = ['id_psn'];

    protected $fillable = [
        'id_psn',
        'id_base',
        'id_desain',
        'id_ukuran',
        'id_pesanan',
    ];

    // Relasi satu-ke-satu dengan Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

}
