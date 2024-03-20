<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];

        // $data = [
        //     'level_id' => 2
        //     'username' => 'manager_dua',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345'),
        // ];

        // $data = [
        //     'level_id' => 2
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345'),
        // ];

        // UserModel::create($data);
        // UserModel::insert($data);

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('username', 'customer-1')->update($data);
        
        // $user = UserModel::all();

        // $user = UserModel::where('level_id', 1);

        // $user = UserModel::findOr(20, ['username', 'nama'], function() {
        //     abort(404);
        // });

        // $user = UserModel::findOrFail(1);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        
        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);
        
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2,
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // $user->save();

        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Manager55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);

        // $user -> username = 'manager56';

        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['nama','username']);

        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['nama', 'username']);

        // $user->save();

        // $user->isDirty();
        // $user->isClean();
        // dd($user->isDirty());

        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user -> username = 'manager12';

        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged(['username', 'level_id']);
        $user->wasChanged('nama');
        dd($user->wasChanged(['nama', 'username']));

        // return view('user', ['data' => $user]);
    }
}
