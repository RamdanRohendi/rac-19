<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Rumah Sakit</title>
</head>
<body>
	@extends('layouts.app')

	@section('content')

	&nbsp;<a href="{{ url('/rs') }}"><button class="btn-success">Kembali</button></a>

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
        <label><h1>Data Rumah Sakit</h1></label>
        <br>
        @if(empty($rs))
			<h5>Tambah Data</h5>
		@endif

		@if(!empty($rs))
			<h5>Edit Data</h5>
		@endif

        <form action="{{ url('/rs', @$rs->id) }}" method="POST">
			@csrf

			@if(!empty($rs))
				@method('PATCH')
			@endif

			<table class="table-dark" cellpadding="6">
				<tr>
					<td>Kode Rumah Sakit</td>
					<td>:</td>
					<td><input type="text" name="kode_rs" value="{{ old('kode_rs', @$rs->kode_rs) }}"></td>
				</tr>
				<tr>
					<td>Nama Rumah Sakit</td>
					<td>:</td>
					<td><input type="text" name="nama_rs" value="{{ old('nama_rs', @$rs->nama_rs) }}"></td>
				</tr>
				<tr>
					<td>Nama Daerah</td>
					<td>:</td>
					<td>
						<select name="kode_daerah">
							<option value="">--PILIH DAERAH--</option>
							@foreach($daerah as $row)
							<option value="{{ $row->kode_daerah }}" 
								{{ old('kode_daerah', @$rs->kode_daerah)=="$row->kode_daerah" ? 'selected' : '' }}>
								{{ $row->nama_daerah }}
							</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><input type="text" name="alamat" value="{{ old('alamat', @$rs->alamat) }}"></td>
				</tr>
				<tr>
					<td>Jumlah Pasien</td>
					<td>:</td>
					<td><input type="text" name="jml_pasien" value="{{ old('jml_pasien', @$rs->jml_pasien) }}"></td>
				</tr>
			</table><br>

			<button type="submit" class="btn-primary">Simpan</button>
		</form>       
    </center>

	@endsection
</body>
</html>