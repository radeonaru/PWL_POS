@extends('layouts.app')

@section('subtitle', 'Edit Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    <div class="container">
        <div class="card">
            <div class="card-header">Edit Kategori</div>
            <div class="card-body">
                <form action="{{ url('kategori/update', $data->kategori_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="kategori_id">Kategori ID</label>
                        <input type="text" class="form-control" id="kategori_id" name="kategori_id" value="{{ $data->kategori_id }}" disabled>

                    </div>

                    <div class="form-group">
                        <label for="kodeKategori">Kategori Kode</label>
                        <input type="text" class="@error('kodeKategori') is-invalid @enderror form-control" id="kodeKategori" name="kodeKategori" value="{{ $data->kategori_kode }}">
                        @error('kodeKategori')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="namaKategori">Kategori Nama</label>
                        <input type="text" class="@error('namaKategori') is-invalid @enderror form-control" id="namaKategori" name="namaKategori" value="{{ $data->kategori_nama }}">
                        @error('namaKategori')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                        @enderror
                    </div>

                    <a class="btn btn-danger" href={{url('/kategori') }}>Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection