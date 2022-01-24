<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaerahController extends Controller
{
	//Fungsi Untuk Menampilkan Data
    public function index(){
    	$data['daerah'] = \App\Daerah::get();
    	return view('daerah', $data);
    }

    //Fungsi Untuk Mencari Data
    public function cari(Request $request){
    	$cari = $request->cari;
    	$kategori = $request->kategori;
        if ($kategori == 'all') {
            $daerah = \App\Daerah::where('kode_daerah', 'like', '%'.$cari.'%')
                                 ->orWhere('nama_daerah', 'like', '%'.$cari.'%')
                                 ->orWhere('jml_pend', 'like', '%'.$cari.'%')
                                 ->orWhere('jml_positif', 'like', '%'.$cari.'%')
                                 ->orWhere('jml_sembuh', 'like', '%'.$cari.'%')
                                 ->orWhere('jml_meninggal', 'like', '%'.$cari.'%')
                                 ->paginate();
        }
        else{
            $daerah = \App\Daerah::where($kategori, 'like', '%'.$cari.'%')->paginate();
        }
    	return view('daerah', ['daerah' => $daerah]);
    }

    //Fungsi Untuk Mengurutkan Data
    public function urutkan(Request $request){
    	$sort = $request->sort;
    	$by = $request->by;
    	$daerah = \App\Daerah::orderBy($by, $sort)->paginate();
    	return view('daerah', ['daerah' => $daerah]);
    }

    //Dua Fungsi Untuk Menambah Data
    public function create(){
    	return view('daerah.form');
    }

    public function store(Request $request){
	    $pesan = [
	    	'unique' => ':attribute ini telah terpakai',
			'required' => 'Kolom :attribute harus diisi',
			'numeric' => 'Kolom :attribute harus berisi angka saja'
		];

		$rule = [
			'kode_daerah' => 'required|unique:t_daerah',
			'nama_daerah' => 'required',
			'jml_pend' => 'required|numeric',
			'jml_positif' => 'required|numeric',
			'jml_sembuh' => 'required|numeric',
			'jml_meninggal' => 'required|numeric',
		];
		$this->validate($request, $rule, $pesan);

    	$input = $request->all();

    	$status = \App\Daerah::create($input);

    	if ($status) {
    		return redirect('/daerah')->with('success','Data Berhasil Ditambahkan');
    	}
    	else {
    		return redirect('/daerah/create')->with('error','Data Gagal Ditambahkan');
    	}
    }

    //Dua Fungsi Untuk Mengedit Data
    public function edit(Request $request, $id){
    	$data['daerah'] = \App\Daerah::find($id);
    	return view('daerah.form', $data);
    }

    public function update(Request $request, $id){
	    $pesan = [
			'required' => 'Kolom :attribute harus diisi',
			'numeric' => 'Kolom :attribute harus berisi angka saja'
		];

		$rule = [
			'kode_daerah' => 'required',
			'nama_daerah' => 'required',
			'jml_pend' => 'required|numeric',
			'jml_positif' => 'required|numeric',
			'jml_sembuh' => 'required|numeric',
			'jml_meninggal' => 'required|numeric',
		];
		$this->validate($request, $rule, $pesan);

    	$input = $request->all();

    	$daerah = \App\Daerah::find($id);
    	$status = $daerah->update($input);

    	if ($status) {
    		return redirect('/daerah')->with('success','Data Berhasil Diubah');
    	}
    	else {
    		return redirect('/daerah/create')->with('error','Data Gagal Diubah');
    	}
    }

    //Fungsi Untuk Menghapus Data
    public function destroy(Request $request, $id){
    	$daerah = \App\Daerah::find($id);
    	$status = $daerah->delete();

    	if ($status) {
    		return redirect('/daerah')->with('success','Data Berhasil Dihapus');
    	}
    	else {
    		return redirect('/daerah/create')->with('error','Data Gagal Dihapus');
    	}
    }
}
