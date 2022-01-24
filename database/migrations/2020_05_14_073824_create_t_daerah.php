<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDaerah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('t_daerah', function (Blueprint $table) {
            $table->id();
            $table->char('kode_daerah', 7)->unique();
            $table->string('nama_daerah', 100);
            $table->bigInteger('jml_pend');
            $table->bigInteger('jml_positif');
            $table->bigInteger('jml_sembuh');
            $table->bigInteger('jml_meninggal');
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
        Schema::dropIfExists('t_daerah');
    }
}
