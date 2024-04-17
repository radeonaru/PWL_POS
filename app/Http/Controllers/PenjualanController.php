<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use App\Models\userModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index(): View
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Penjualan yang terdaftar dalam sistem'
        ];

        /**
         * Set active menu
         */
        $activeMenu = 'penjualan';

        /**
         * Retrieve all user data for filter in penjualan table, columns are dependable filter requirement
         */
        $users = userModel::select(['user_id', 'nama'])->get();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'users' => $users, 'activeMenu' => $activeMenu]);
    }

    /**
     * take penjualan data in JSON format for datatables
     * @throws \Exception
     */
    public function list(Request $request): JsonResponse
    {
        $penjualans = PenjualanModel::with('user');

        /**
         * Filter Barang data that we retrieve above base kategori_id retrieved in barang.index view
         */
        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        /**
         * Option for not filtered or use all stok data
         */
        $penjualans = $penjualans->get();

        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn  = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">'

                    . csrf_field()
                    . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button>
                        </form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Penjualan baru'
        ];

        $barangs = barangModel::all();
        $users = userModel::all();

        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barangs' => $barangs, 'users' => $users, 'activeMenu' => $activeMenu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $isKodePenjualan = PenjualanModel::where('penjualan_kode', $request->penjualan_kode)->first();
        $isPengelola = PenjualanModel::where('user_id', $request->user_id)->first();
        if ($isKodePenjualan and $isPengelola) {
            $penjualan_id = $isKodePenjualan->penjualan_id;
        } else {
            $penjualan_id = PenjualanModel::insertGetId([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => now(),
            ]);
        }
        $barang = barangModel::find($request->barang_id);

        PenjualanDetailModel::insert([
            'penjualan_id' => $penjualan_id,
            'barang_id' => $request->barang_id,
            'harga' => $barang->harga_jual,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $details = PenjualanDetailModel::with('barang', 'penjualan')->where('penjualan_id', $id)->get();

        $breadcrumb = (object)[
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail Penjualan'
        ];

        /**
         * Set active menu
         */
        $activeMenu = 'penjualan';

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'details' => $details, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        /**
         * Retrieve specific penjualan data with id
         */
        $penjualan = PenjualanModel::find($id);

        /**
         * Retrieve all user_id and nama for make user easy to edit t_penjualan_detail tabel
         */
        $barangs = barangModel::all();

        /**
         * Retrieve all barang_id and barang_nama for make user easy to edit t_penjualan_detail tabel
         */
        $users = userModel::all();

        /**
         * Retrieve all barang_id and barang_nama for make user easy to edit t_penjualan_detail tabel
         */
        $details = PenjualanDetailModel::where('penjualan_id', $id)->get();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'details' => $details, 'barangs' => $barangs, 'users' => $users, 'activeMenu' => $activeMenu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        /**
         * Retrieve a portion of  input data for t_penjualan table
         */
        $penjualanValidated = $request->only('user_id', 'pembeli', 'penjualan_tanggal');

        /**
         * Update row t_penjualan Table data, base request form data
         */
        PenjualanModel::where('penjualan_id', $id)->update($penjualanValidated);

        /**
         * Updates row t_penjualan_detail Table data, base request form data
         */
        for ($i = 0; $i < $request->count; $i++) {
            /**
             * Retrieve a portion of the input data for t_penjualan table for each detail_id
             */
            $detailPenjualanValidated = [
                'barang_id' => $request->barang_id[$i],
                'jumlah' => $request->jumlah[$i]
            ];
            PenjualanDetailModel::where('detail_id', $request->id[$i])->update($detailPenjualanValidated);
        }

        return redirect('/penjualan')->with('success', 'Data Penjualan berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $check = PenjualanModel::find($id);

        /**
         * check whatever penjualan data with id is available or not
         */
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data Penjualan tidak ditemukan');
        }

        try {
            /**
             * If we delete t_penjualan, t_penjualan detail that use penjualan_id will be remove first
             */
            PenjualanDetailModel::where('penjualan_id', $check->penjualan_id)->delete();
            /**
             * Delete penjualan data
             */
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data Penjualan berhasil dihapus');
        } catch (QueryException) {
            return redirect('/penjualan')->with('error', 'Data Penjualan gagal dihapus, karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
