<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Pasien</title>
</head>
<body>
	@extends('layouts.app')

	@section('content')

	&nbsp;<a href="{{ url('/pasien') }}"><button class="btn-success">Kembali</button></a>

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
        <label><h1>Data Pasien</h1></label>
        <br>
        @if(empty($pasien))
			<h5>Tambah Data</h5>
		@endif

		@if(!empty($pasien))
			<h5>Edit Data</h5>
		@endif

        <form action="{{ url('/pasien', @$pasien->id) }}" method="POST">
			@csrf

			@if(!empty($pasien))
				@method('PATCH')
			@endif

			<table class="table-dark" cellpadding="6">
				<tr>
					<td>Nomor Pasien</td>
					<td>:</td>
					<td><input type="text" name="no_pasien" value="{{ old('no_pasien', @$pasien->no_pasien) }}"></td>
				</tr>
				<tr>
					<td>NIK</td>
					<td>:</td>
					<td><input type="text" name="nik" value="{{ old('nik', @$pasien->nik) }}"></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td><input type="text" name="nama" value="{{ old('nama', @$pasien->nama) }}"></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>:</td>
					<td>
						<input type="radio" name="jenkel" value="L" {{ old('jenkel', @$pasien->jenkel)=="L" ? 'checked' : '' }}> Laki-laki
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<input type="radio" name="jenkel" value="P" {{ old('jenkel', @$pasien->jenkel)=="P" ? 'checked' : '' }}> Perempuan
					</td>
				</tr>
				<tr>
					<td>Daerah</td>
					<td>:</td>
					<td>
						<select name="kode_daerah">
							<option value="">--PILIH DAERAH--</option>
							@foreach($daerah as $row)
							<option value="{{ $row->kode_daerah }}" 
								{{ old('kode_daerah', @$pasien->kode_daerah)=="$row->kode_daerah" ? 'selected' : '' }}>
								{{ $row->nama_daerah }}
							</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td><input type="text" name="alamat" value="{{ old('alamat', @$pasien->alamat) }}"></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>
						<select name="status">
							<option value="">--PILIH STATUS--</option>
							<option value="ODP" {{ old('status', @$pasien->status)=="ODP" ? 'selected' : '' }}>ODP</option>
							<option value="PDP" {{ old('status', @$pasien->status)=="PDP" ? 'selected' : '' }}>PDP</option>
							<option value="OTG" {{ old('status', @$pasien->status)=="OTG" ? 'selected' : '' }}>OTG</option>
							<option value="Suspect" {{ old('status', @$pasien->status)=="Suspect" ? 'selected' : '' }}>Suspect</option>
							<option value="Komorbiditas" {{ old('status', @$pasien->status)=="Komorbiditas" ? 'selected' : '' }}>Komorbiditas</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Rumah Sakit</td>
					<td>:</td>
					<td>
						<select name="kode_rs">
							<option value="">--PILIH RUMAH SAKIT--</option>
							@foreach($rs as $row)
							<option value="{{ $row->kode_rs }}" 
								{{ old('kode_rs', @$pasien->kode_rs)=="$row->kode_rs" ? 'selected' : '' }}>
								{{ $row->nama_rs }}
							</option>
							@endforeach
						</select>
					</td>
				</tr>
			</table><br>

			<button type="submit" class="btn-primary">Simpan</button>
		</form>     
    </center>
	
	@endsection
</body>
</html>