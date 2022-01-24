<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RsController extends Controller
{
    //Fungsi Untuk Menampilkan Data
    public function index(){
    	$data['rs'] = \App\RumahSakit::with('get_namaDaerah')->get();
    	return view('rumahsakit', $data);
    }

    //Fungsi Untuk Mencari Data
    public function cari(Request $request){
        $cari = $request->cari;
        $kategori = $request->kategori;
        if ($kategori == 'all') {
            $rs = \App\RumahSakit::where('kode_rs', 'like', '%'.$cari.'%')
                                 ->orWhere('nama_rs', 'like', '%'.$cari.'%')
                                 ->orWhere('kode_daerah', 'like', '%'.$cari.'%')
                                 ->orWhere('alamat', 'like', '%'.$cari.'%')
                                 ->orWhere('jml_pasien', 'like', '%'.$cari.'%')
                                 ->paginate();
        }
        else{
            $rs = \App\RumahSakit::where($kategori, 'like', '%'.$cari.'%')->paginate();
        }
        return view('rumahsakit', ['rs' => $rs]);
    }

    //Fungsi Untuk Mengurutkan Data
    public function urutkan(Request $request){
        $sort = $request->sort;
        $by = $request->by;
        $rs = \App\RumahSakit::orderBy($by, $sort)->paginate();
        return view('rumahsakit', ['rs' => $rs]);
    }

    //Dua Fungsi Untuk Menambah Data
    public function create(){
    	$data['rs'] = \App\RumahSakit::get();
    	return view('rumahsakit.form', $data);
    }

    public function store(Request $request){
	    $pesan = [
	    	'max' => 'Kolom :attribute melebihi jumlah max',
	    	'unique' => ':attribute ini telah terpakai',
			'required' => 'Kolom :attribute harus diisi',
			'numeric' => 'Kolom :attribute harus berisi angka saja'
		];

		$rule = [
			'kode_rs' => 'required|unique:t_rumah_sakit|max:5',
			'nama_rs' => 'required',
			'kode_daerah' => 'required',
			'alamat' => 'required',
			'jml_pasien' => 'required|numeric',
		];
		$this->validate($request, $rule, $pesan);

    	$input = $request->all();

    	$status = \App\RumahSakit::create($input);

    	if ($status) {
    		return redirect('/rs')->with('success','Data Berhasil Ditambahkan');
    	}
    	else {
    		return redirect('/rs/create')->with('error','Data Gagal Ditambahkan');
    	}
    }


    //Dua Fungsi Untuk Mengedit Data
    public function edit(Request $request, $id){
    	$data['rs'] = \App\RumahSakit::find($id);
    	$data['daerah'] = \App\Daerah::get();
    	return view('rumahsakit.form', $data);
    }

    public function update(Request $request, $id){
	    $pesan = [
	    	'max' => 'Kolom :attribute melebihi jumlah max',
	    	'unique' => ':attribute ini telah terpakai',
			'required' => 'Kolom :attribute harus diisi',
			'numeric' => 'Kolom :attribute harus berisi angka saja'
		];

		$rule = [
			'kode_rs' => 'required|max:5',
			'nama_rs' => 'required',
			'kode_daerah' => 'required',
			'alamat' => 'required',
			'jml_pasien' => 'required|numeric',
		];
		$this->validate($request, $rule, $pesan);

    	$input = $request->all();

    	$rs = \App\RumahSakit::find($id);
    	$status = $rs->update($input);

    	if ($status) {
    		return redirect('/rs')->with('success','Data Berhasil Diubah');
    	}
    	else {
    		return redirect('/rs/create')->with('error','Data Gagal Diubah');
    	}
    }

    //Fungsi Untuk Menghapus Data
    public function destroy(Request $request, $id){
    	$rs = \App\RumahSakit::find($id);
    	$status = $rs->delete();

    	if ($status) {
    		return redirect('/rs')->with('success','Data Berhasil Dihapus');
    	}
    	else {
    		return redirect('/rs/create')->with('error','Data Gagal Dihapus');
    	}
    }
}
