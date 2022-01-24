<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
	protected $table = 't_rumah_sakit';

	protected $fillable = [
		'kode_rs','nama_rs','kode_daerah','alamat','jml_pasien'
	];

	public function get_namaDaerah(){
		return $this->belongsTo('App\\Daerah','kode_daerah','kode_daerah');
	}
}