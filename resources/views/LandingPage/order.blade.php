@extends('layouts._landingpage.layouts')
@section('landing')
<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="overlay op-8 bg-black"></div>
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Checkout</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="index.html">Home </a></li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="checkout-wrap pt-100 pb-75">
        <div class="container">
            <form action="{{route('produk.order')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gx-5">
                    <div class="col-xl-7 col-lg-7">
                        <div class="checkout-form">
                            <input type="hidden" name="jumlahProduk" value="{{count($produk)}}">
                            @foreach($produk as $p)
                            <input type="hidden" name="id_produk[]" value="{{$p->id_product}}"/>
                            <input type="hidden" name="id_keranjang[]" value="{{$p->id_keranjang}}">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h3 class="checkout-box-title">{{$p->product_name}}</h3>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk[]" id="nama_produk" required value="{{$p->product_name}}" placeholder="Nama Produk" readonly/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="jumlah_produk">Jumlah Produk</label>
                                        <input type="text" name="jumlah_produk[]" id="jumlah_produk" required value="{{$p->total_produk}}" placeholder="Jumlah Produk" readonly/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="harga_produk">Harga Produk</label>
                                        <input type="number" name="harga_produk[]" id="harga_produk" required value="{{$p->product_price}}" placeholder="Harga Produk" readonly/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="harga_produk">Total Harga</label>
                                        <input type="number" name="total_harga_produk[]" id="total_harga_produk" required value="{{$p->total_harga}}" placeholder="Harga Produk" readonly/>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="filePesanan" class="form-label">File Pesanan (Format: .pdf, .png, .jpg, .jpeg) (Optional)</label>
                                    <input class="form-control" type="file" name="file_pesanan[]" id="filePesanan">
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan Pesanan (Optional)</label>
                                      <textarea name="keterangan[]" cols="5" rows="5" id="keterangan" placeholder="Keterangan Pesanan (Optional)"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5>Total Pesanan</h5>
                                    <h5>Rp. {{number_format($produk->sum('total_harga'))}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="checkout-details bg-albastor">
                            <h3 class="checkout-box-title">Metode Pembayaran</h3>
                            <div class="bill-details">
                                <div class="bill-item-wrap">
                                    <div class="select-payment-method mt-20">
                                        <div>
                                            <input type="radio" id="tf_lunas" name="metode_pembayaran" value="transfer_lunas" required/>
                                            <label for="tf_lunas">Transfer (Lunas)</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="tf_50" name="metode_pembayaran" value="transfer_50" required/>
                                            <label for="tf_50">Transfer (DP 50%)</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="cash" name="metode_pembayaran" value="cash" required/>
                                            <label for="cash">Bayar Ditempat</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <h6>No Rekening <span class="text-muted">(untuk pembayaran transfer)</span></h6>
                                        <ul>
                                            @forelse ($rekening as $rek)
                                            <li>{{$rek->nama_bank}} ({{$rek->no_rek}}) A/N {{$rek->nama_pemilik}}</li>
                                            @empty
                                            <li>Belum Ada Rekening Tercantum. Silahkan Hubungi Admin!</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="mb-3" id="buktiTf">
                                        <label for="buktitfForm" class="form-label">Upload Bukti Transfer (Format: .png, .jpeg, .jpg) (Wajib! Kecuali <b>Bayar Ditempat</b>)</label>
                                        <input class="form-control" name="bukti_tf" type="file" id="buktitfForm">
                                    </div>
                                    <div class="checkout-footer mt-20">
                                        <button type="submit" class="btn style1 d-block w-100 mt-25">
                                            Pesan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection