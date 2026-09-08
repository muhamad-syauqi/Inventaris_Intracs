<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;

class StokMasuk extends Model
{
    use HasFactory;

    protected $table = 'stok_masuk';

    protected $fillable = [
        'barang_id',
        'user_id',
        'jumlah',
        'keterangan',
        'nomor_do',
        'tanggal_request',
        'nama_request',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}