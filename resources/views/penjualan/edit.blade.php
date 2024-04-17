@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                {{--                @dd(url('/penjualan/'.$penjualan->penjualan_id)) --}}
                <form method="POST" action="{{ url('/penjualan/' . $penjualan->penjualan_id) }}" class="form-horizontal">

                    @csrf
                    <!--add 'PUT' method, because we use Route::put() for update-->
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-11 control-label col-form-label text-center">----Penjualan----</label>
                        <label class="col-11 control-label col-form-label">Kode
                            Penjualan: {{ $penjualan->penjualan_kode }} </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pengelola</label>
                        <div class="col-11">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Pilih Pengelola -</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->user_id }}" @if ($item->user_id == $penjualan->user_id) selected @endif>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pembeli</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="pembeli" name="pembeli"
                                value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                            @error('pembeli')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal</label>
                        <div class="col-11">
                            <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                                value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal) }}" required>
                            @error('penjualan_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-11 control-label col-form-label text-center">----Detail Penjualan----</label>
                    </div>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($details as $detail)
                        <label class="col-11 control-label col-form-label text-left">****Detail Penjualan {{ $no }}
                            *****</label>
                        <input type="hidden" name="count" value="{{ $no }}">
                        <input type="hidden" name="id[]" value="{{ $detail->detail_id }}">
                        <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Nama Barang</label>
                            <div class="col-11">
                                <select class="form-control" id="barang_id" name="barang_id[]" required>
                                    <option value="">- Pilih Barang -</option>
                                    @foreach ($barangs as $item)
                                        <option value="{{ $item->barang_id }}"
                                            @if ($item->barang_id == $detail->barang_id) selected @endif>{{ $item->barang_nama }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Jumlah Barang</label>
                            <div class="col-11">
                                <input type="number" class="form-control" id="jumlah" name="jumlah[]"
                                    value="{{ old('jumlah.' . $loop->index, $detail->jumlah) }}" required>
                                @error('jumlah')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        @php
                            $no++;
                        @endphp
                    @endforeach
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush
