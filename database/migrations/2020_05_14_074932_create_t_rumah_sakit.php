<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTRumahSakit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_rumah_sakit', function (Blueprint $table) {
            $table->id();
            $table->char('kode_rs', 5)->unique();
            $table->string('nama_rs', 100);
            $table->char('kode_daerah', 7);
            $table->text('alamat');
            $table->bigInteger('jml_pasien');
            $table->timestamps();
        });

        Schema::table('t_rumah_sakit', function (Blueprint $table){
            $table->foreign('kode_daerah')->references('kode_daerah')->on('t_daerah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_rumah_sakit');
    }
}
