<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UserDataTable;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request):RedirectResponse 
    {
        $validate = request()->validate([
            'username' => 'bail|required|unique:m_user,username',
            'nama' => 'required',
            'password' => 'required',
            'level_id' => 'required',
        ]);

        $password = Hash::make($validate['password']);

        UserModel::create([
            'username' => $validate['username'],
            'nama' => $validate['nama'],
            'password' => Hash::make($validate['password']),
            'level_id' => $validate['level_id'],
        ]);

        return redirect('/user');
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        return view('user.edit', ['data' => $user]);
    }

    public function update(Request $request, $id):RedirectResponse
    {
        $validate = request()->validate([
            'username' => 'bail|required|unique:m_user,username,'.$id.',user_id',
            'nama' => 'required',
            'password' => 'required',
            'level_id' => 'required',
        ]);

        $user = UserModel::find($id);
        $user->username = $validate['username'];
        $user->nama = $validate['nama'];
        $user->password = Hash::make($validate['password']);
        $user->level_id = $validate['level_id'];
        $user->save();

        return redirect('/user');
    }

    public function destroy($id):RedirectResponse
    {
        UserModel::find($id)->delete();

        return redirect('/user');
    }


}
