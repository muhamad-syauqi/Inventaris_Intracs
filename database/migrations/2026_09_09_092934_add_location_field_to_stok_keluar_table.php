<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stok_keluar', function (Blueprint $table) {
            $table->string('gerbang_tol', 100)->nullable()->after('jumlah');
            $table->string('nomor_gardu', 50)->nullable()->after('gerbang_tol');
        });
    }

    public function down(): void
    {
        Schema::table('stok_keluar', function (Blueprint $table) {
            $table->dropColumn([
                'gerbang_tol',
                'nomor_gardu',
            ]);
        });
    }
};