@extends('layouts.app')
@section('dashboard')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body checkout-tab">
                <form action="{{route('produk.pesan')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="step-arrow-nav mt-n3 mx-n3 mb-3">
                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fs-14 p-3 active" id="pills-info-product-tab" data-bs-toggle="pill" data-bs-target="#pills-info-product" type="button" role="tab" aria-controls="pills-info-product" aria-selected="false">
                                    <i class="ri-truck-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i> Info Produk
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link fs-14 p-3" id="pills-pembayaran-tab" data-bs-toggle="pill" data-bs-target="#pills-pembayaran" type="button" role="tab" aria-controls="pills-pembayaran" aria-selected="false">
                                    <i class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i> Pembayaran
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="pills-info-product" role="tabpanel" aria-labelledby="pills-info-product-tab">
                            <div>
                                <h5 class="mb-1">Informasi Produk</h5>
                                <p class="text-muted mb-4">Mohon lengkapi semua informasi dibawah</p>
                            </div>

                            <div>
                                <div class="row">
                                    <input type="hidden" name="produk_id" value="{{ $product->id }}">
                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="product_name" class="form-label">Nama Produk</label>
                                            <input type="text" class="form-control" id="product_name" placeholder="Nama Produk" name="nama_produk" value="{{ $product->product_name }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="product_price" class="form-label">Harga Produk / {{ $product->product_satuan }}</label>
                                            <input type="text" class="form-control" id="product_price" placeholder="Harga Produk" name="harga_produk" value="{{ $product->product_price }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="product_count" class="form-label">Jumlah Produk</label>
                                            <input type="number" class="form-control" min="1" id="product_count" name="jumlah_produk" placeholder="Jumlah Produk">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan <span class="text-muted">(Optional)</span></label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Pesanan" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="d-flex align-items-baseline">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cetak" value="jasa_cetak" id="cetak" checked>
                                    <label class="form-check-label" for="cetak">
                                        Jasa Cetak &nbsp;
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cetak" value="non_cetak" id="non_cetak">
                                    <label class="form-check-label" for="non_cetak">
                                        Non Cetak
                                    </label>
                                </div>
                            </div>

                            <div class="mt-4" id="form_cetak">
                                <div class="row gy-3">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                                Dengan File
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                                Tanpa File
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="home1" role="tabpanel">
                                            <div class="card-body">
                                                <p class="text-muted">Jika kamu sudah memiliki file untuk dicetak silahkan upload <b>dibawah</b>. jika kamu belum memiliki file silahkan klik tab <b>"tanpa file"</b>.</p>
                                                {{-- <input type="file" class="filepond" multiple name="fileCetak[]"> --}}
                                                <input type="file" multiple name="fileCetak[]">
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="profile1" role="tabpanel">
                                            <div class="card-body">
                                                <p class="text-muted">Jika anda tidak memiliki file, kami sedia jasa pengetikan / desain. silahkan berikan keterangan pada kolom dibawah.</p>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan <span class="text-muted">(Wajib)</span></label>
                                                    <textarea class="form-control" id="keterangan" name="ket_pesanan" placeholder="Keterangan Pesanan" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="d-flex align-items-start gap-3 mt-3">
                                <button type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-pembayaran-tab">
                                    <i class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>Lanjut Ke Pembayaran
                                </button>
                            </div> --}}
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="pills-pembayaran" role="tabpanel" aria-labelledby="pills-pembayaran-tab">
                            <div>
                                <h5 class="mb-1">Pilih Pembayaran</h5>
                                <p class="text-muted mb-4">Silahkan pilih metode pembayaran anda</p>
                            </div>

                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse" aria-expanded="true" aria-controls="paymentmethodCollapse">
                                        <div class="form-check card-radio">
                                            <input id="bayar_transfer_50" name="method_bayar" value="transfer_50" type="radio" class="form-check-input" checked>
                                            <label class="form-check-label" for="bayar_transfer_50">
                                                <span class="fs-16 text-muted me-2"><i class="ri-bank-card-fill align-bottom"></i></span>
                                                <span class="fs-14 text-wrap">Transfer (DP 50%)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse" aria-expanded="true" aria-controls="paymentmethodCollapse">
                                        <div class="form-check card-radio">
                                            <input id="bayar_transfer_lunas" name="method_bayar" value="transfer_lunas" type="radio" class="form-check-input">
                                            <label class="form-check-label" for="bayar_transfer_lunas">
                                                <span class="fs-16 text-muted me-2"><i class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                <span class="fs-14 text-wrap">Transfer (Lunas)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show" aria-expanded="false" aria-controls="paymentmethodCollapse">
                                        <div class="form-check card-radio">
                                            <input id="bayar_langsung" name="method_bayar" value="cash" type="radio" class="form-check-input">
                                            <label class="form-check-label" for="bayar_langsung">
                                                <span class="fs-16 text-muted me-2"><i class="ri-money-dollar-box-fill align-bottom"></i></span>
                                                <span class="fs-14 text-wrap">Bayar Langsung</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse show" id="paymentmethodCollapse">
                                <div class="card p-4 shadow-none mb-0">
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <p class="text-muted">Rekening Bank Tersedia: </p>
                                            <ul>
                                                @forelse ($pembayaran as $rek)
                                                <li>{{$rek->nama_bank}}: {{$rek->no_rek}} ({{$rek->nama_pemilik}})</li>
                                                @empty
                                                <li>Belum Ada, Silahkan Hubungi Admin</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="text-muted">Upload Bukti Pembayaran</p>
                                            <input type="file" name="bukti_transfer">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted mt-2 fst-italic">
                                    <i data-feather="lock" class="text-muted icon-xs"></i> Your transaction is secured with SSL encryption
                                </div>
                            </div>

                            <div class="d-flex align-items-start gap-3 mt-4">
                                {{-- <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-info-product-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Kembali Ke Product</button> --}}
                                {{-- <button type="button" id="checkoutButton" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-selesai-tab"><i class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Selesaikan Orderan</button> --}}
                                <button type="submit" class="btn btn-primary btn-label right ms-auto"><i class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Selesaikan Orderan</button>
                            </div>
                        </div>
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </form>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
@endsection
@push('ex-js')
    <!-- init js -->
    {{-- <script src="{{ asset('assets/js/pages/ecommerce-product-checkout.init.js') }}"></script> --}}
    <script>
        $("#cetak").on('click', () => {
            $("#form_cetak").show();
        });
        
        $("#non_cetak").on('click', () => {
            $("#form_cetak").hide();
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#checkoutButton').on('click', function(e){
            e.preventDefault();
            var formData = new FormData($(this).parents('form')[0]);

            $.ajax({
                url: '{{route('produk.pesan')}}',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() {
                    return $.ajaxSettings.xhr();
                },
                success: function (data) {
                    alert("Data Uploaded: "+data);
                }
            });
        });
    </script>
@endpush