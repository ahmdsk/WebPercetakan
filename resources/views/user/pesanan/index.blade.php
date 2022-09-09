@extends('layouts.app')
@section('dashboard')
<div class="row">
    <div class="col-xl-12">
        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-sm-auto">
                            <h4>{{$web['title']}}</h4>
                        </div>
                    </div>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width: 100%" id="myTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Pesanan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga Produk (Jumlah)</th>
                                    <th scope="col">Total Pesanan</th>
                                    <th scope="col">Metode Pembayaran</th>
                                    <th scope="col">Bukti Pembayaran</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesanan as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->kode_pesanan}}</td>
                                        <td>
                                            @if ($p->status == 'Waiting')
                                                <span class="badge bg-danger">Menunggu Konfirmasi</span>
                                            @elseif ($p->status == 'Proses')
                                                <span class="badge bg-warning">Sedang dikerjakan</span>
                                            @elseif ($p->status == 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>{{$p->products->product_name}}</td>
                                        <td>Rp. {{number_format($p->products->product_price)}} / {{$p->jumlah_pesanan}}</td>
                                        <td>Rp. {{number_format($p->harga_pesanan)}}</td>
                                        <td>
                                            @if ($p->metode_pembayaran == 'cash')
                                                Bayar Ditempat
                                            @elseif ($p->metode_pembayaran == 'transfer_50')
                                                Transfer DP (50%)
                                            @elseif ($p->metode_pembayaran == 'transfer_lunas')
                                                Transfer Lunas
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->bukti_pembayaran != null)
                                                <a href="{{asset('document/bukti/'.$p->bukti_pembayaran)}}" target="_blank" rel="noopener noreferrer"><img src="{{asset('document/bukti/'.$p->bukti_pembayaran)}}" alt="Bukti bayar {{$p->kode_pesanan}}" style="width: 100px"></a>
                                            @else
                                                Tidak ada bukti bayar.
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->status == 'Waiting' || $p->status == 'Proses')
                                                <a href="#" class="btn btn-sm btn-danger">Cek Resi</a>
                                            @elseif ($p->status == 'Selesai')
                                                <a href="#" class="btn btn-sm btn-success">Cetak Invoice</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->


                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end col -->
</div>
@endsection