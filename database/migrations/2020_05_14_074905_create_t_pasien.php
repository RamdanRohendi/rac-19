<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPasien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pasien', function (Blueprint $table) {
            $table->id();
            $table->integer('no_pasien')->unique();
            $table->string('nik', 16);
            $table->string('nama', 100);
            $table->string('jenkel', 1);
            $table->char('kode_daerah', 7);
            $table->text('alamat');
            $table->string('status', 8);
            $table->char('kode_rs', 5);
            $table->timestamps();
        });

        Schema::table('t_pasien', function (Blueprint $table){
            $table->foreign('kode_daerah')->references('kode_daerah')->on('t_daerah');
            $table->foreign('kode_rs')->references('kode_rs')->on('t_rumah_sakit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_pasien');
    }
}
