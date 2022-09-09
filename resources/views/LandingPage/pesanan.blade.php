@extends('layouts._landingpage.layouts')
@section('landing')
<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="overlay op-8 bg-black"></div>
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Data Pesanan</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="index.html">Home </a></li>
                    <li>Data Pesanan</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cart-wrap ptb-100">
        <div class="container">
            <div class="row gx-5">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Pesanan</th>
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
                                            <td>{{$p->products->product_name}}</td>
                                            <td>Rp. {{number_format($p->products->product_price)}} x
                                                {{$p->jumlah_pesanan}}</td>
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
                                                <a href="{{asset('document/bukti/'.$p->bukti_pembayaran)}}"
                                                    target="_blank" rel="noopener noreferrer"><img
                                                        src="{{asset('document/bukti/'.$p->bukti_pembayaran)}}"
                                                        alt="Bukti bayar {{$p->kode_pesanan}}" style="width: 100px"></a>
                                                @else
                                                Tidak ada bukti bayar.
                                                @endif
                                            </td>
                                            <td>
                                                @if ($p->metode_pembayaran == 'transfer_50')
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="lunaskan('{{$p->kode_pesanan}}')" data-bs-toggle="modal" data-bs-target="#lunaskanModal" style="background-color: blue; padding: 10px">
                                                    Lunaskan
                                                  </button>
                                                @else
                                                    @if ($p->status == 'Waiting' || $p->status == 'Proses')
                                                    <a href="{{route('cekresi')}}" class="btn btn-sm btn-danger">Cek
                                                        Resi</a>
                                                    @elseif ($p->status == 'Selesai')
                                                    <a href="{{route('produk.detail', $p->product_id)}}"
                                                        class="btn btn-sm btn-warning">Beri Nilai</a>
                                                    @endif
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="lunaskanModal" tabindex="-1" aria-labelledby="lunaskanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lunaskanModalLabel">Lunaskan Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/konfir_bayar')}}" method="post">
                    @csrf
                    <input type="hidden" name="id_pesanan" id="id_pesanan">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="alert alert-warning" role="alert">
                                Perhatian! Silahkan Isi Keterangan Transfer Dengan Kode Pesanan Anda
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label for="statusPesanan">Metode Pembayaran</label>
                                <select class="form-control" id="statusPesanan" name="status">
                                    <option selected disabled>Pilih Metode Pembayaran</option>
                                    <option value="cash">Bayar Ditempat</option>
                                    <option value="transfer_lunas">Transfer</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <label for="bukti">Bukti Pembayaran <b>(Wajib Diisi Untuk Pembayaran Transfer)</b></label>
                            <input type="file" name="bukti" id="bukti" class="form-control">
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('ex-js')
<script>
    function lunaskan(kode){
        $.ajax({
            url: "{{url('/konfir_bayar')}}"+'/'+kode,
            success: function(json){
                $("#id_pesanan").val(json.data.id);
            }
        });

        new bootstrap.Modal($('#lunaskanModal'));
    }
</script>
@endpush