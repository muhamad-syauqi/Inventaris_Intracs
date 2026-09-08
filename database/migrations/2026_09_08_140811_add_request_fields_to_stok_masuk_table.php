<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stok_masuk', function (Blueprint $table) {

            $table->string('nomor_do', 100)
                ->nullable()
                ->after('user_id');

            $table->date('tanggal_request')
                ->nullable()
                ->after('nomor_do');

            $table->string('nama_request', 150)
                ->nullable()
                ->after('tanggal_request');

        });
    }

    public function down(): void
    {
        Schema::table('stok_masuk', function (Blueprint $table) {

            $table->dropColumn([
                'nomor_do',
                'tanggal_request',
                'nama_request',
            ]);

        });
    }
};