<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
    //     // $data = [
    //     //     'kategori_kode' => 'SNK',
    //     //     'kategori_nama' => 'Snack\Makanan Ringan',
    //     //     'created_at' => now()
    //     // ];
    //     // DB::table('m_kategori')->insert($data);
    //     // return 'Insert data baru berhasil';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
    //     // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
    //     // return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row.'baris';

    //     // $data = DB::table('m_kategori')->get();
    //     // return view('kategori', ['data' => $data]);

        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view ('kategori.create');
    }

    public function store(Request $request)
    {
        // KategoriModel::create([
        //     'kategori_kode' => $request->kodeKategori,
        //     'kategori_nama' => $request->namaKategori,
        // ]);

        $validate = $request->validate([
            'kodeKategori' => 'bail|required|max:3|unique:m_kategori,kategori_kode',
            'namaKategori' => 'required',
        ]);

        KategoriModel::create([
            'kategori_kode' => $validate['kodeKategori'],
            'kategori_nama' => $validate['namaKategori'],
        
        ]);

        return redirect('/kategori');
    }

    public function edit($id){
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['data' => $kategori]);
    }

    public function update(Request $request, $id):RedirectResponse
    {
        $validate = $request->validate([
            'kodeKategori' => 'bail|required|max:3|unique:m_kategori,kategori_kode,'.$id.',kategori_id',
            'namaKategori' => 'required',
        ]);

        $kategori = KategoriModel::find($id);
        $kategori->kategori_kode = $validate['kodeKategori'];
        $kategori->kategori_nama = $validate['namaKategori'];
        $kategori->save();
        return redirect('/kategori');
    }

    public function destroy($id) {
        KategoriModel::find($id)->delete();

        return redirect('/kategori');
    }
}
