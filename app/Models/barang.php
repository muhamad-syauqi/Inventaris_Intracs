<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'satuan',
        'stok',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function stokMasuk()
    {
        return $this->hasMany(StokMasuk::class, 'barang_id');
    }

    public function stokKeluar()
    {
        return $this->hasMany(StokKeluar::class, 'barang_id');
    }
}
