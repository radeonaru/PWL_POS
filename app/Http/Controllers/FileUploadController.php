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
        $request->validate([
            'nama' => 'required',
            'berkas' => 'required|file|image|max:500',
        ]);
        $extFile=$request->berkas->getClientOriginalExtension();
        $namaFile = $request->nama . "." . $extFile;
        $path = $request->berkas->storeAs('uploads', $namaFile);
        
        echo "Gambar berhasil di upload ke <a href='storage/$path'>$namaFile</a>";
        echo "<br><br>";
        echo "<img width=500 src='storage/$path'/>";
    }
}
