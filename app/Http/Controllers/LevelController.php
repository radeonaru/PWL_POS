<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable)
    {
        return $dataTable->render('level.index');

    }


    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request):RedirectResponse
    {
        $validate = request()->validate([
            'kodeLevel' => 'bail|required|unique:m_level,level_kode',
            'namaLevel' => 'required',
        ]);

        LevelModel::create([
            'level_kode' => $validate['kodeLevel'],
            'level_nama' => $validate['namaLevel'],
        ]);

        return redirect('/level');
    }

    public function edit($id)
    {
        $level = LevelModel::find($id);
        return view('level.edit', ['data' => $level]);
    }

    public function update(Request $request, $id):RedirectResponse
    {
        $validate = request()->validate([
            'kodeLevel' => 'bail|required|unique:m_level,level_kode,'.$id.',level_id',
            'namaLevel' => 'required',
        ]);

        $level = LevelModel::find($id);
        $level->level_kode = $validate['kodeLevel'];
        $level->level_nama = $validate['namaLevel'];
        $level->save();

        return redirect('/level');
    }

    public function destroy($id):RedirectResponse
    {
        LevelModel::find($id)->delete();

        return redirect('/level');
    }
}
