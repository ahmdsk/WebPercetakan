<div class="cart-wrap pb-100">
    <div class="container">
        <div class="row gx-5">
            <div class="col-xl-12">
                <div class="cart-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Kode Pesanan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga Produk (Jumlah)</th>
                                <th scope="col">Total Pesanan</th>
                                <th scope="col">Metode Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pesananKode != null)
                            <tr>
                                <td>{{$pesananKode->kode_pesanan}}</td>
                                <td>
                                    @if ($pesananKode->status == 'Waiting')
                                    <span class="badge bg-danger">Menunggu Konfirmasi</span>
                                    @elseif ($pesananKode->status == 'Proses')
                                    <span class="badge bg-warning">Sedang dikerjakan</span>
                                    @elseif ($pesananKode->status == 'Selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td>{{$pesananKode->products->product_name}}</td>
                                <td>Rp. {{number_format($pesananKode->products->product_price)}} x {{$pesananKode->jumlah_pesanan}}</td>
                                <td>Rp. {{number_format($pesananKode->harga_pesanan)}}</td>
                                <td>
                                    @if ($pesananKode->metode_pembayaran == 'cash')
                                    Bayar Ditempat
                                    @elseif ($pesananKode->metode_pembayaran == 'transfer_50')
                                    Transfer DP (50%)
                                    @elseif ($pesananKode->metode_pembayaran == 'transfer_lunas')
                                    Transfer Lunas
                                    @endif
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>