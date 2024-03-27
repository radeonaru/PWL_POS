@extends('layouts.app')

@section('subtitle', 'kategori')
@section('content_header_title', 'kategori')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori</h3>
            </div>

            <form method="post" action="../kategori">
            <div class="card-body">
                <div class="form-group">
                    <label for="kodeKategori">Kode Kategori</label>
                    <input type="text" class="form-control" id="kodeKategori" name="kodeKategori" placeholder="kodeKategori">
                </div>
                <div class="form-group">
                    <label for="namaKategori">Nama kategori</label>
                    <input type="text" class="form-control" id="namakategori" name="namaKategori" placeholder="namaKategori">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
@endsection