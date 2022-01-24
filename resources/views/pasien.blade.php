<!DOCTYPE html>
<html>
<head>
	<title>Data Pasien</title>
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

	<table align="center" width="770px">
		<tr align="center">
			<th colspan="2"><font size="100px">Data Pasien</font><br><br></th>
		</tr>
		<tr>
			<td align="left">
				<button class="btn-primary"><a class="text-white" href="{{ url('/pasien/create') }}">Tambah Data</a></button>
				<button><a href="{{ url('/pasien') }}">RESET</a></button>
			</td>
			<td align="right">
				<form action="{{ url('/pasien/cari') }}" method="GET">
					<input type="text" name="cari" value="{{ old('cari') }}" placeholder="Search">
					<select name="kategori">
						<option value="all">--PILIH KATEGORI--</option>
						<option value="nik" {{ old('kategori')=="nik" ? 'selected' : '' }}>NIK</option>
						<option value="nama" {{ old('kategori')=="nama" ? 'selected' : '' }}>Nama</option>
						<option value="jenkel" {{ old('kategori')=="jenkel" ? 'selected' : '' }}>Jenis Kelamin</option>
						<option value="alamat" {{ old('kategori')=="alamat" ? 'selected' : '' }}>Alamat</option>
						<option value="status" {{ old('kategori')=="status" ? 'selected' : '' }}>Status</option>
					</select>
					<button type="submit">
						<img class="cari" src="{{ url('assets/img/search.png')}}">
					</button>
				</form>
			</td>
		</tr>
	</table>

	<table border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>NIK</th>
			<th>
				<a href="{{ url('/pasien/sort') }}?sort=asc&by=nama">▲</a>
				Nama
				<a href="{{ url('/pasien/sort') }}?sort=desc&by=nama">▼</a>
			</th>
			<th>JK</th>
			<th>Daerah</th>
			<th>Alamat</th>
			<th>Status</th>
			<th>Rumah Sakit</th>
			<th>Aksi</th>
		</tr>
		@foreach ($pasien as $row)
		<tr>
			<td align="center"> {{ isset($i) ? ++$i : $i = 1 }} </td>
			<td> {{ $row->nik }} </td>
			<td> {{ $row->nama }} </td>
			<td align="center"> {{ $row->jenkel }} </td>
			<td> {{ $row->get_namaDaerah->nama_daerah }} </td>
			<td> {{ $row->alamat }} </td>
			<td align="center"> {{ $row->status }} </td>
			<td> {{ $row->get_namaRs->nama_rs }} </td>
			<td>
				<form action="{{ url('/pasien/' . $row->id . '/edit') }}" >
					<button class="btn-success" type="submit">Edit</button>
				</form>

				<form action=" {{ url('/pasien', $row->id) }} " method="POST">
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