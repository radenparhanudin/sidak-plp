<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->integer('jumlah_asn')->nullable();
            $table->integer('hadir')->nullable();
            $table->decimal('p_hadir')->nullable();
            $table->integer('tanpa_keterangan')->nullable();
            $table->decimal('p_tanpa_keterangan')->nullable();
            $table->integer('sakit')->nullable();
            $table->decimal('p_sakit')->nullable();
            $table->integer('izin')->nullable();
            $table->decimal('p_izin')->nullable();
            $table->integer('cuti')->nullable();
            $table->decimal('p_cuti')->nullable();
            $table->string('file_absensi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opds');
    }
}
