@extends('layouts._landingpage.layouts')
@section('landing')
<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="overlay op-8 bg-black"></div>
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Hasil Pencarian Produk {{ucfirst(request('p'))}}</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="">Home </a></li>
                    <li>Pencarian Produk {{ucfirst(request('p'))}}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-wrap ptb-100">
        <div class="container">
            <h4>Hasil Pencarian Dari: {{ucfirst(request('p'))}}</h4>
            <hr>
            <div class="row justify-content-center">
                @forelse ($produk as $p)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="product-card style4">
                        <div class="product-img bg-athens">
                            @if ($p['gambar'] != null)
                                <img src="{{ asset('landing/img/products/'.$p['gambar']) }}" alt="{{$p['product_name']}}">
                            @else
                                <img src="{{ asset('landing/img/products/no-images.png') }}" alt="{{$p['product_name']}}">
                            @endif
                            <ul class="product-option list-style">
                                <li>
                                    <a href="{{route('produk.detail', $p['id']) }}">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('cart', $p['id']) }}" method="post">
                                        @csrf
                                        <button type="submit"><i class="ri-shopping-cart-2-line"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="product-info">
                            <ul class="ratings list-style">
                                @for ($i = 1; $i <= $p['jumlah_rating']['rating']; $i++)
                                <li><i class="flaticon-star"></i></li>
                                @endfor
                            </ul>
                            <h3><a href="{{route('produk.detail', $p['id']) }}">{{$p['product_name']}}</a></h3>
                            <p class="product-price">
                                Rp. {{number_format($p['product_price'])}}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    <h3>Tidak ada product</h3>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection