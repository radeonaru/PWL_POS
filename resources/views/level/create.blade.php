@extends('layouts.app')

@section('subtitle', 'level')
@section('content_header_title', 'level')
@section('content_header_subtitle', 'Create')

@section('content_body')
{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Level</h3>
            </div>

            <form method="post" action="../level">
            @csrf {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="kodeLevel">Kode Level</label>
                    <input type="text" class="@error('kodeLevel') is-invalid @enderror form-control" id="kodeLevel" name="kodeLevel" placeholder="Masukkan Kode Level">

                    @error('kodeLevel')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                            @enderror
                </div>
                <div class="form-group">
                    <label for="namaLevel">Nama level</label>
                    <input type="text" class="@error('namaLevel') is-invalid @enderror form-control" id="namaLevel" name="namaLevel" placeholder="Masukkan Nama Level">
                    @error('namaLevel')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                            @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
    @endsection