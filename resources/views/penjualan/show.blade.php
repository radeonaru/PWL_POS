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
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tablesm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $penjualan->penjualan_id }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>{{ $penjualan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Kode Penjualan</th>
                        <td>{{ $penjualan->penjualan_kode }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $penjualan->pembeli }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Penjualan</th>
                        <td>{{ $penjualan->penjualan_tanggal }}</td>
                    </tr>
                </table>
            @endempty
            <br>
        </div>
        <div class="card-header">
            <h3 class="card-title">Detail Penjualan Barang</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($penjualan_detail)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tablesm">
                    <tr>
                        <th>No</th>
                        <th>Barang </th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Sub-Total</th>
                    </tr>

                    <?php $no = 1; ?>
                    <?php $total = 0; ?>

                    @foreach ($penjualan_detail as $pd)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pd->barang->barang_nama }}</td>
                            <td>{{ $pd->jumlah }}</td>
                            <td>{{ $pd->harga }}</td>
                            <td>{{ $pd->harga * $pd->jumlah }}</td>
                        </tr>
                        <?php $total += $pd->harga * $pd->jumlah; ?>
                    @endforeach
                </table>

                <div class="card-body">
                    <div class="font-weight-bolder">Total :
                        <span>{{ Number::currency($total, 'Rp.') }}</span>
                    </div>
                </div>
            @endempty
            <br>
            <a href="{{ url('penjualan') }}" class="btn btn-default mt2">Kembali</a>
        </div>
    </div>
    </div>
    <a href="{{ url('penjualan') }}" class="btn btn-default mt2">Kembali</a>

@endsection
@push('css')
@endpush
@push('js')
@endpush