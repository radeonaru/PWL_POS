<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        $breadcrumb = (object)[
            'title' => 'File Upload',
            'list' => ['Home', 'File Upload']
        ];

        $page = (object) [
            'title' => 'Gunakan Untuk Mengupload File Gambar'
        ];

        $activeMenu = 'fileUpload';


        return view('file-upload', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
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
        
        $breadcrumb = (object)[
            'title' => 'File Preview',
            'list' => ['Home', 'File Preview']
        ];

        $page = (object) [
            'title' => 'Preview dari Gambar yang Telah Diupload'
        ];

        $activeMenu = 'fileUpload';

        return view('file-upload-result', [
            'namaFile' => $namaFile,
            'path' => $path,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu,
        ]);
}
}