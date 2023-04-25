<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimSidaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tim_sidaks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('nip_baru', 18)->unique();
            $table->string('nama');
            $table->enum('keterangan', ['H', 'TK', 'S', 'I', 'C'])->nullable();
            $table->uuid('opd_id');
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
        Schema::dropIfExists('tim_sidaks');
    }
}
