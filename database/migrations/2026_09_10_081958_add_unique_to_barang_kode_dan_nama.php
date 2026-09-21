<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $indexes = DB::select("SHOW INDEX FROM barang");

        $kodeBarangUnique = collect($indexes)
            ->contains(function ($index) {
                return $index->Key_name === 'barang_kode_barang_unique';
            });

        $namaBarangUnique = collect($indexes)
            ->contains(function ($index) {
                return $index->Key_name === 'barang_nama_barang_unique';
            });

        if (!$kodeBarangUnique) {
            Schema::table('barang', function (Blueprint $table) {
                $table->unique('kode_barang');
            });
        }

        if (!$namaBarangUnique) {
            Schema::table('barang', function (Blueprint $table) {
                $table->unique('nama_barang');
            });
        }
    }

    public function down(): void
    {
        $indexes = DB::select("SHOW INDEX FROM barang");

        $kodeBarangUnique = collect($indexes)
            ->contains(function ($index) {
                return $index->Key_name === 'barang_kode_barang_unique';
            });

        $namaBarangUnique = collect($indexes)
            ->contains(function ($index) {
                return $index->Key_name === 'barang_nama_barang_unique';
            });

        if ($kodeBarangUnique) {
            Schema::table('barang', function (Blueprint $table) {
                $table->dropUnique('barang_kode_barang_unique');
            });
        }

        if ($namaBarangUnique) {
            Schema::table('barang', function (Blueprint $table) {
                $table->dropUnique('barang_nama_barang_unique');
            });
        }
    }
};