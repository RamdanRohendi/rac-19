<!DOCTYPE html>
<html>
<head>
	<title>Data Rumah Sakit</title>
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

	<table align="center" width="610px">
		<tr align="center">
			<th colspan="2"><font size="100px">Data Rumah Sakit</font><br><br></th>
		</tr>
		<tr>
			<td align="left">
				<button class="btn-primary"><a class="text-white" href="{{ url('/rs/create') }}">Tambah Data</a></button>
				<button><a href="{{ url('/rs') }}">RESET</a></button>
			</td>
			<td align="right">
				<form action="{{ url('/rs/cari') }}" method="GET">
					<input type="text" name="cari" value="{{ old('cari') }}" placeholder="Search">
					<select name="kategori">
						<option value="all">--PILIH KATEGORI--</option>
						<option value="nama_rs" {{ old('kategori')=="nama_rs" ? 'selected' : '' }}>Nama RS</option>
						<option value="alamat" {{ old('kategori')=="alamat" ? 'selected' : '' }}>Alamat</option>
						<option value="jml_pasien" {{ old('kategori')=="jml_pasien" ? 'selected' : '' }}>Jumlah Pasien</option>
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
			<th>
				<a href="{{ url('/rs/sort') }}?sort=asc&by=jml_pasien">▲</a>
				Nama Rs
				<a href="{{ url('/rs/sort') }}?sort=desc&by=jml_pasien">▼</a>
			</th>
			<th>
				<a href="{{ url('/rs/sort') }}?sort=asc&by=jml_pasien">▲</a>
				Daerah 
				<a href="{{ url('/rs/sort') }}?sort=desc&by=jml_pasien">▼</a>
			</th>
			<th>Alamat</th>
			<th>
				<a href="{{ url('/rs/sort') }}?sort=asc&by=jml_pasien">▲</a>
				Jumlah Pasien 
				<a href="{{ url('/rs/sort') }}?sort=desc&by=jml_pasien">▼</a>
			</th>
			<th>Aksi</th>
		</tr>
		@foreach ($rs as $row)
		<tr>
			<td> {{ isset($i) ? ++$i : $i = 1 }} </td>
			<td> {{ $row->nama_rs }} </td>
			<td> {{ $row->get_namaDaerah->nama_daerah }} </td>
			<td> {{ $row->alamat }} </td>
			<td> {{ $row->jml_pasien }} </td>
			<td>
				<form action="{{ url('/rs/' . $row->id . '/edit') }}" >
					<button type="submit" class="btn-success">Edit</button>
				</form>

				<form action=" {{ url('/rs', $row->id) }} " method="POST">
					@method('DELETE')
					@csrf
					<button type="submit" class="btn-danger">Delete</button>
				</form>
			</td>
		</tr>
		@endforeach
	</table>
	@endsection
</body>
</html>