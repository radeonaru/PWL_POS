<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request)
    {
        // dump($request->berkas);
        // dump($request->file('file'));
        // return "Pemrosesan file upload disini";
        // if ($request->hasFile('berkas')) {
        //     echo "path(): " . $request->berkas->path(); 
        //     echo "<br>";
        //     echo "extension(): " . $request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): " . $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getClientOriginalName(): " . $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): " . $request->berkas->getSize();
        // }
        // else 
        // {
        //     echo "Tidak ada file yang diupload";
        // }

        $request->validate([
            'berkas' => 'required|file|image|max:500',
        ]);
        $extFile=$request->berkas->getClientOriginalName();
        $namaFile ='web'.time().".".$extFile;
        $path = $request->berkas->storeAs('public', $namaFile);

        $pathBaru=asset('storage/public/'.$namaFile);
        echo "File berhasil diupload, file berada di: $path";
        echo "<br>";
        echo "Tampilkan link: <a href='$pathBaru'>$pathBaru</a>";
        // echo $request->berkas->getClientOriginalName()."lolos validasi";
    }
}
