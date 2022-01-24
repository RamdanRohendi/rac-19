<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
	protected $table = 't_daerah';

	protected $fillable = [
		'kode_daerah','nama_daerah','jml_pend','jml_positif','jml_sembuh','jml_meninggal'
	];
}