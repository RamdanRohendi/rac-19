<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatacovidIDN extends Model
{
	protected $table = 't_datacovidIDN';

	protected $fillable = [
		'positif','pdp','sembuh','meninggal'
	];
}