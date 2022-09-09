@extends('layouts._landingpage.layouts')
@section('landing')
<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="overlay op-8 bg-black"></div>
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Detail Produk</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="{{url('/')}}">Home </a></li>
                    <li><a href="#">Produk</a></li>
                    <li>Detail Produk</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="product-details-wrap ptb-100">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6">
                    <div class="single-product-gallery">
                        <div class="swiper-container single-product_slider">
                            <div class="swiper-wrapper">
                                @forelse ($gambar as $g)
                                <div class="swiper-slide single-product-item">
                                    <img src="{{ asset('landing/img/products/'.$g->gambar) }}" img="Image" />
                                </div> 
                                @empty   
                                <div class="swiper-slide single-product-item">
                                    <img src="{{ asset('landing/img/products/no-images.png') }}" img="Image" />
                                </div>
                                @endforelse
                            </div>
                            <div class="swiper-button-next">
                                <i class="flaticon-right-arrow"></i>
                            </div>
                            <div class="swiper-button-prev">
                                <i class="flaticon-left-arrow-1"></i>
                            </div>
                        </div>
                        <div thumbsSlider="" class="swiper-container single-product_thumbs">
                            <div class="swiper-wrapper">
                                @forelse ($gambar as $g)
                                <div class="swiper-slide single-product-thumb bg-albastor">
                                    <img src="{{ asset('landing/img/products/'.$g->gambar) }}" img="Image" />
                                </div> 
                                @empty   
                                <div class="swiper-slide single-product-thumb bg-albastor">
                                    <img src="{{ asset('landing/img/products/no-images.png') }}" img="Image" />
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-product-details">
                        <div class="single-product-title">
                            <h2>{{$produk->product_name}}</h2>
                            <h3><span>Rp. {{number_format($produk->product_price)}}</span></h3>
                            <div class="ratings">
                                <ul class="list-style">
                                    @for ($i = 1; $i <= $jumlah_rating; $i++)
                                    <li><i class="ri-star-fill"></i></li>
                                    @endfor
                                </ul>
                                <span>({{number_format($jumlah_rating, 1)}} rating)</span>
                            </div>
                        </div>
                        <p class="single-product-desc">
                            @if ($produk->desc == null)
                            Tidak ada keterangan produk
                            @else
                            {{$produk->product_desc}}
                            @endif
                        </p>
                        <form action="{{route('cart', $produk->id)}}" method="post">
                            @csrf
                            <div class="product-more-option">
                                <div class="product-more-option-item">
                                    <h5>Kategori :</h5>
                                    <a href="">{{$produk->category->category_name}}</a>
                                </div>
                                <div class="product-more-option-item">
                                    <h5>Status :</h5>
                                    <span>
                                        @if ($produk->product_stock == 'tersedia')
                                            Tersedia
                                        @else
                                            Tidak Tersedia
                                        @endif
                                    </span>
                                </div>
                                <div class="product-more-option-item">
                                    <h5>Jumlah :</h5>
                                    <div class="product-quantity">
                                        <div class="qtySelector">
                                            <span class="decreaseQty">
                                                <i class="ri-subtract-line"></i>
                                            </span>
                                            <input type="text" class="qtyValue" value="1" name="jumlah"/>
                                            <span class="increaseQty">
                                                <i class="ri-add-line"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-product-option">
                                <button type="submit" class="btn style1">Tambah Ke Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row pt-100">
                <div class="col-lg-12">
                    <div class="product-description-wrap">
                        <div class="product-description">
                            <div class="desc-title">
                                <h2>Ulasan</h2>
                            </div>
                            <div class="row gx-5">
                                <div class="col-lg-6">
                                    @forelse ($ulasan as $u)
                                    <div class="testimonial-card style1">
                                        <div class="client-info-wrap">
                                            <div class="client-img">
                                                <img src="{{asset('landing/img/testimonials/user-not-found.png')}}" alt="Image" />
                                            </div>
                                            <div class="client-info">
                                                <h5>{{$u->name}}</h5>
                                                <ul class="ratings list-style">
                                                    @for ($i = 1; $i <= $u->ratings; $i++)
                                                        <li><i class="flaticon-star"></i></li>
                                                    @endfor
                                                </ul>
                                                <p class="client-quote" style="margin-top: -15px">
                                                    {{$u->keterangan}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="text-center">
                                        <h4>Belum Ada Ulasan</h4>
                                    </div>  
                                    @endforelse
                                </div>
                                @auth
                                <div class="col-lg-6">
                                    <div class="client-review-form">
                                        @if ($cekUlasan == 'sudah_mengulas')
                                            <h5>Terimakasih! Kamu Telah Memberi Ulasan Sebelumnya</h5>
                                            <form action="{{route('edit.ulasan')}}" method="POST" class="comment-form">
                                                @csrf
                                                <input type="hidden" name="id_ulasan" value="{{$dataUlasan->id_rating}}">
                                                <input type="hidden" name="id_produk" value="{{$produk->id}}">
                                                <div class="row gx-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group s1">
                                                            <input type="text" placeholder="Masukan Nama Kamu" value="{{auth()->user()->name}}" required />
                                                        </div>
                                                        <div class="form-group s2">
                                                            <input type="number" name="rating" min="1" max="5" placeholder="Ulasan 1-5" value="{{$dataUlasan->ratings}}" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <textarea name="komentar" cols="30" rows="10"
                                                                placeholder="Masukan Komentar (Optional)">{{$dataUlasan->keterangan}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button class="btn style1 mt-25">
                                                            Edit Ulasan
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @elseif ($cekUlasan == 'belum_mengulas')
                                            <h5>Berikan Ulasan Kamu</h5>
                                            <form action="{{route('ulasan')}}" method="POST" class="comment-form">
                                                @csrf
                                                <input type="hidden" name="id_produk" value="{{$produk->id}}">
                                                <div class="row gx-3">
                                                    <div class="col-lg-6">
                                                        <div class="form-group s1">
                                                            <input type="text" placeholder="Masukan Nama Kamu" value="{{auth()->user()->name ?? ''}}" required />
                                                        </div>
                                                        <div class="form-group s2">
                                                            <input type="number" name="rating" min="1" max="5" placeholder="Ulasan 1-5" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <textarea name="komentar" cols="30" rows="10"
                                                                placeholder="Masukan Komentar (Optional)"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button class="btn style1 mt-25">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @elseif ($cekUlasan == 'belum_pesan')
                                            <h5>Silahkan Pesan Terlebih Dahulu Agar Dapat Memberi Ulasan</h5>
                                        @endif
                                    </div>
                                </div>
                                @endauth

                                @guest   
                                <div class="col-lg-6">
                                    <div class="client-review-form">
                                        <h5>Silahkan Login Terlebih Dahulu Untuk <a href="{{route('login')}}" style="text-decoration: underline; color: #cd9453">Memberi Ulasan</a></h5>
                                    </div>
                                </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection