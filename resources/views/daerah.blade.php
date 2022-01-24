<!DOCTYPE html>
<html>
<head>
	<title>Data Tiap Daerah</title>
</head>
<body>
	@extends('layouts.app')

	@section('content')

	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	@if(session('error'))
		<div class="alert alert-error">
			{{ session('error') }}
		</div>
	@endif

	<table align="center" width="563px">
		<tr align="center">
			<th colspan="2"><font size="100px">Data Daerah</font><br><br></th>
		</tr>
		<tr>
			<td align="left">
				<button class="btn-primary"><a class="text-white" href="{{ url('/daerah/create') }}">Tambah Data</a></button>
				<button><a href="{{ url('/daerah') }}">RESET</a></button>
			</td>
			<td align="right">
				<form action="{{ url('/daerah/cari') }}" method="GET">
					<input type="text" name="cari" value="{{ old('cari') }}" placeholder="Search">
					<select name="kategori">
						<option value="all">--KATEGORI--</option>
						<option value="nama_daerah" {{ old('kategori')=="nama_daerah" ? 'selected' : '' }}>Nama Daerah</option>
						<option value="jml_pend" {{ old('kategori')=="jml_pend" ? 'selected' : '' }}>Jumlah Penduduk</option>
						<option value="jml_positif" {{ old('kategori')=="jml_positif" ? 'selected' : '' }}>Jumlah Positif</option>
						<option value="jml_sembuh" {{ old('kategori')=="jml_sembuh" ? 'selected' : '' }}>Jumlah Sembuh</option>
						<option value="jml_meninggal" {{ old('kategori')=="jml_meninggal" ? 'selected' : '' }}>Jumlah Meninggal</option>
					</select>
					<button type="submit">
						<img class="cari" src="{{ url('assets/img/search.png') }}">
					</button>
				</form>
			</td>
		</tr>
	</table>

	<table border="1" align="center">
		<tr align="center">
			<th rowspan="2">No</th>
			<th rowspan="2">Nama Daerah</th>
			<th colspan="4">Jumlah</th>
			<th rowspan="2">Aksi</th>
		</tr>
		<tr>
			<th>
				<a href="{{ url('/daerah/sort') }}?sort=asc&by=jml_pend">▲</a>
				Penduduk 
				<a href="{{ url('/daerah/sort') }}?sort=desc&by=jml_pend">▼</a>
			</th>
			<th>
				<a href="{{ url('/daerah/sort') }}?sort=asc&by=jml_positif">▲</a>
				Positif
				<a href="{{ url('/daerah/sort') }}?sort=desc&by=jml_positif">▼</a>
			</th>
			<th>
				<a href="{{ url('/daerah/sort') }}?sort=asc&by=jml_sembuh">▲</a>
				Sembuh
				<a href="{{ url('/daerah/sort') }}?sort=desc&by=jml_sembuh">▼</a>
			</th>
			<th>
				<a href="{{ url('/daerah/sort') }}?sort=asc&by=jml_meninggal">▲</a>
				Meninggal
				<a href="{{ url('/daerah/sort') }}?sort=desc&by=jml_meninggal">▼</a>
			</th>
		</tr>
		@foreach ($daerah as $row)
		<tr align="center">
			<td> {{ isset($i) ? ++$i : $i = 1 }} </td>
			<td align="left"> {{ $row->nama_daerah }} </td>
			<td> {{ $row->jml_pend }} </td>
			<td> {{ $row->jml_positif }} </td>
			<td> {{ $row->jml_sembuh }} </td>
			<td> {{ $row->jml_meninggal }} </td>
			<td align="left">
				<form action="{{ url('/daerah/' . $row->id . '/edit') }}" >
					<button class="btn-success" type="submit">Edit</button>
				</form>

				<form action="{{ url('/daerah', $row->id) }}" method="POST">
					@method('DELETE')
					@csrf
					<button class="btn-danger" type="submit">Delete</button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	@endsection
</body>
</html>