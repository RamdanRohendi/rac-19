<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Daerah</title>
</head>
<body>
	@extends('layouts.app')

	@section('content')

	&nbsp;<a href="{{ url('/daerah') }}"><button class="btn-success">Kembali</button></a>

	@if (session('error'))
	<div class="alert alert-error">
		{{ session('error') }}
	</div>
	@endif

	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Perhatian !!!</strong>
		<br />
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>	
	@endif

	<center>
        <label><h1>Data Daerah</h1></label>
        <br>
        @if(empty($daerah))
			<h5>Tambah Data</h5>
		@endif

		@if(!empty($daerah))
			<h5>Edit Data</h5>
		@endif

		<form action="{{ url('/daerah', @$daerah->id) }}" method="POST">
			@csrf

			@if(!empty($daerah))
				@method('PATCH')
			@endif

			<table class="table-dark" cellpadding="6">
				<tr>
					<td>Kode Daerah</td>
					<td>:</td>
					<td><input type="text" name="kode_daerah" value="{{ old('kode_daerah', @$daerah->kode_daerah) }}"></td>
				</tr>
				<tr>
					<td>Nama Daerah</td>
					<td>:</td>
					<td><input type="text" name="nama_daerah" value="{{ old('nama_daerah', @$daerah->nama_daerah) }}"></td>
				</tr>
				<tr>
					<td>Jumlah Penduduk</td>
					<td>:</td>
					<td><input type="text" name="jml_pend" value="{{ old('jml_pend', @$daerah->jml_pend) }}"></td>
				</tr>
				<tr>
					<td>Jumlah Positif</td>
					<td>:</td>
					<td><input type="text" name="jml_positif" value="{{ old('jml_positif', @$daerah->jml_positif) }}"></td>
				</tr>
				<tr>
					<td>Jumlah Sembuh</td>
					<td>:</td>
					<td><input type="text" name="jml_sembuh" value="{{ old('jml_sembuh', @$daerah->jml_sembuh) }}"></td>
				</tr>
				<tr>
					<td>Jumlah Meninggal</td>
					<td>:</td>
					<td><input type="text" name="jml_meninggal" value="{{old('jml_meninggal', @$daerah->jml_meninggal) }}"></td>
				</tr>
			</table><br>

			<button type="submit" class="btn-primary">Simpan</button>
		</form>       
    </center>

	@endsection
</body>
</html>