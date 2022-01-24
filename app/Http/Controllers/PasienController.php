<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    //Fungsi Untuk Menampilkan Data
    public function index(){
    	$data['pasien'] = \App\Pasien::with('get_namaDaerah')->with('get_namaRs')->get();
    	return view('pasien', $data);
    }

    //Fungsi Untuk Mencari Data
    public function cari(Request $request){
        $cari = $request->cari;
        $kategori = $request->kategori;
        if ($kategori == 'all') {
            $pasien = \App\Pasien::where('no_pasien', 'like', '%'.$cari.'%')
                                 ->orWhere('nik', 'like', '%'.$cari.'%')
                                 ->orWhere('nama', 'like', '%'.$cari.'%')
                                 ->orWhere('jenkel', 'like', '%'.$cari.'%')
                                 ->orWhere('kode_daerah', 'like', '%'.$cari.'%')
                                 ->orWhere('alamat', 'like', '%'.$cari.'%')
                                 ->orWhere('status', 'like', '%'.$cari.'%')
                                 ->orWhere('kode_rs', 'like', '%'.$cari.'%')
                                 ->paginate();
        }
        else{
            $pasien = \App\Pasien::where($kategori, 'like', '%'.$cari.'%')->paginate();
        }
        return view('pasien', ['pasien' => $pasien]);
    }

    //Fungsi Untuk Mengurutkan Data
    public function urutkan(Request $request){
        $sort = $request->sort;
        $by = $request->by;
        $pasien = \App\Pasien::orderBy($by, $sort)->paginate();
        return view('pasien', ['pasien' => $pasien]);
    }

    //Dua Fungsi Untuk Menambahkan Data
    public function create(){
    	$data['daerah'] = \App\Daerah::get();
    	$data['rs'] = \App\RumahSakit::get();
    	return view('pasien.form', $data);
    }
    
    public function store(Request $request){
	    $pesan = [
	    	'unique' => ':attribute ini telah terpakai',
			'required' => 'Kolom :attribute harus diisi',
		];

		$rule = [
			'no_pasien' => 'required|unique:t_pasien',
			'nik' => 'required',
			'nama' => 'required',
			'jenkel' => 'required',
			'kode_daerah' => 'required',
			'alamat' => 'required',
			'status' => 'required',
			'kode_rs' => 'required'
		];
		$this->validate($request, $rule, $pesan);

    	$input = $request->all();

    	$status = \App\Pasien::create($input);

    	if ($status) {
    		return redirect('/pasien')->with('success','Data Berhasil Ditambahkan');
    	}
    	else {
    		return redirect('/pasien/create')->with('error','Data Gagal Ditambahkan');
    	}
    }

    //Dua Fungsi Untuk Mengedit Data
    public function edit(Request $request, $id){
    	$data['pasien'] = \App\Pasien::find($id);
    	$data['daerah'] = \App\Daerah::get();
    	$data['rs'] = \App\RumahSakit::get();
    	return view('pasien.form', $data);
    }

    public function update(Request $request, $id){
	    $pesan = [
	    	'unique' => ':attribute ini telah terpakai',
			'required' => 'Kolom :attribute harus diisi',
		];

		$rule = [
			'no_pasien' => 'required',
			'nik' => 'required',
			'nama' => 'required',
			'jenkel' => 'required',
			'kode_daerah' => 'required',
			'alamat' => 'required',
			'status' => 'required',
			'kode_rs' => 'required'
		];
		$this->validate($request, $rule, $pesan);

    	$input = $request->all();

    	$pasien = \App\Pasien::find($id);
    	$status = $pasien->update($input);

    	if ($status) {
    		return redirect('/pasien')->with('success','Data Berhasil Diubah');
    	}
    	else {
    		return redirect('/pasien/create')->with('error','Data Gagal Diubah');
    	}
    }

    //Fungsi Untuk Menghapus Data
    public function destroy(Request $request, $id){
    	$pasien = \App\Pasien::find($id);
    	$status = $pasien->delete();

    	if ($status) {
    		return redirect('/pasien')->with('success','Data Berhasil Dihapus');
    	}
    	else {
    		return redirect('/pasien/create')->with('error','Data Gagal Dihapus');
    	}
    }
}
