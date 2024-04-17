<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StokRequest;
use Illuminate\View\View;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Stok Barang',
            'list' => ['Home', 'Stok']
        ];

        $page = (object)[
            'title' => 'Daftar Stok barang yang tersedia'
        ];

        $activeMenu = 'stok';
        $barang = barangModel::all();
        $user = userModel::all();

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page,
            'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $stocks = stokModel::select(['stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah'])->with(['barang', 'user']);

        // Filter data user berdasarkan level_id
        if ($request->barang_id) {
            $stocks->where('barang_id', $request->barang_id);
        }

        return DataTables::of($stocks)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $stok->stok_id) . '"> ' . csrf_field() . method_field('DELETE')
                    . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create(): view
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok Barang',
            'list' => ['Home', 'Stok Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok barang baru'
        ];

        $barang = barangModel::all();
        $user = userModel::all();
        $activeMenu = 'stok';
        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function store(StokRequest $request): RedirectResponse
    {
        $request->validate([
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|max:40',
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        stokModel::create([
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    public function show(string $id)
    {
        $stok = stokModel::with('barang', 'user')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Stok Barang',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object)[
            'title' => "Detail Stok Barang"
        ];

        $activeMenu = 'stok';

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page,
            'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $stok = stokModel::find($id);
        $user = userModel::all();
        $barang = barangModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Stok Barang',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object)[
            'title' => "Edit Stok Barang"
        ];

        $activeMenu = 'stok';

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page,
            'stok' => $stok, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|max:10',
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        stokModel::find($id)->update([
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = stokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data Stok tidak ditermukan');
        }

        try {
            stokModel::destroy($id);

            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (QueryException $e) {

            return redirect('/stok')->with('error', 'Data stok gagal dihapus, karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}