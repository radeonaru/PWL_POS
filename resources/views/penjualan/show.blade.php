@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($details)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> Data yang Anda cari tidak ditemukan.
                </div>
            @else
                @php
                    $no = 1;
                @endphp
                @foreach ($details as $item)
                    <label class="col-11 control-label col-form-label text-left">****Detail Penjualan {{ $no }}
                        *****</label>
                    <table class="table table-bordered table-striped table-hover table-sm mb-4">
                        <tr>
                            <th>Detail ID</th>
                            <td>{{ $item->detail_id }}</td>
                        </tr>
                        <tr>
                            <th>Kode Penjualan</th>
                            <td>{{ $item->penjualan->penjualan_kode }}</td>
                        </tr>
                        <tr>
                            <th>Barang Nama</th>
                            <td>{{ $item->barang->barang_nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp. {{ number_format($item->harga, 0, ',', '.') }},00</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $item->jumlah }}</td>
                        </tr>
                    </table>
                    @php
                        $no++;
                    @endphp
                @endforeach
            @endempty
            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
