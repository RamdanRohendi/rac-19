<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
	protected $table = 't_pasien';

	protected $fillable = [
		'no_pasien','nik','nama','jenkel','kode_daerah','alamat','status','kode_rs'
	];

	public function get_namaDaerah(){
		return $this->belongsTo('App\\Daerah','kode_daerah','kode_daerah');
	}

	public function get_namaRs(){
		return $this->belongsTo('App\\RumahSakit','kode_rs','kode_rs');
	}
}