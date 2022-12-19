@extends('layouts._landingpage.layouts')
@section('landing')
<section class="hero-wrap style3">
    <div class="hero-slider-two owl-carousel">
        <div class="hero-slide-item">
            <div class="container">
                <div class="row gx-5 align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="hero-content">
                            {{-- <span data-aos="fade-left" data-aos-duration="1200" data-aos-delay="100">Produk Baru</span> --}}
                            <h1 data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">Iklan Kan Produk kamu dengan X Banner</h1>
                            <p data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Cum verit atis assum enda maiores
                                eos ducimus ullam accusamus vitae beatae quas in.</p>
                            <div class="hero-btn" data-aos="fade-left" data-aos-duration="1200"
                                data-aos-delay="400">
                                <a href="#" class="btn style1">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="hero-img-wrap" data-speed="0.10" data-revert="true">
                            <div class="hero-promotext">
                                <span>X BANNER</span>
                            </div>
                            <img src="{{ asset('landing/img/hero/x-banner.png') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slide-item">
            <div class="container">
                <div class="row gx-5 align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="hero-content">
                            <span data-aos="fade-left" data-aos-duration="1200" data-aos-delay="100">Tampil Kece</span>
                            <h1 data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">Tampil Kece Dengan ID Card Perusahaan Kamu</h1>
                            <p data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Cum verit atis assum enda maiores
                                eos ducimus ullam accusamus vitae beatae quas in.</p>
                            <div class="hero-btn" data-aos="fade-left" data-aos-duration="1200"
                                data-aos-delay="400">
                                <a href="#" class="btn style1">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="hero-img-wrap" data-speed="0.10" data-revert="true">
                            <div class="hero-promotext">
                                <span>ID CARD</span>
                            </div>
                            <img src="{{ asset('landing/img/hero/ID-CARD.png') }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="feature-wrap pt-100 pb-75">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200"
                data-aos-delay="100">
                <div class="feature-card style2">
                    <span class="feature-icon">
                        <i class="flaticon-premium"></i>
                    </span>
                    <div class="feature-text">
                        <h3>Premium Quality</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibend
                            sit.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200"
                data-aos-delay="200">
                <div class="feature-card style2">
                    <span class="feature-icon">
                        <i class="flaticon-quality-1"></i>
                    </span>
                    <div class="feature-text">
                        <h3>Flexible To Wear</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibend
                            sit.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200"
                data-aos-delay="300">
                <div class="feature-card style2">
                    <span class="feature-icon">
                        <i class="flaticon-sport-shoes"></i>
                    </span>
                    <div class="feature-text">
                        <h3>Long Lasting</h3>
                        <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin lorem quis bibend
                            sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (count($rekomendasi) > 0)
<section class="product-wrap ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style1 text-center mb-40">
                    <span>REKOMENDASI PRODUK</span>
                    <h2>Rekomendasi Produk</h2>
                </div>
            </div>
        </div>
        {{-- <div class="product-slider-three owl-carousel"> --}}
        <div class="row">
            @forelse ($rekomendasi as $lp)
                <div class="col-md-4">
                    <div class="product-card style3">
                        <div class="product-img bg-athens">
                            @if ($lp['gambar'] != null)
                                <img src="{{ asset('landing/img/products/'.$lp['gambar']) }}" alt="{{$lp['product_name']}}">
                            @else
                                <img src="{{ asset('landing/img/products/no-images.png') }}" alt="{{$lp['product_name']}}">
                            @endif
                            {{-- <span class="promo-text"><i class="flaticon-star"></i>{{number_format($lp['jumlah_rating']['rating'], 1)}}</span> --}}
                            <span class="promo-text" style="background-color: brown">Rekomendasi</span>
                            <ul class="product-option list-style">
                                <li><a href="{{route('produk.detail', $lp['id']) }}"><i
                                            class="ri-eye-line"></i></a></li>
                                <li>
                                    <form action="{{ route('cart', $lp['id']) }}" method="post">
                                        @csrf
                                        <button type="submit"><i class="ri-shopping-cart-2-line"></i></button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="product-info">
                            <h3><a href="">{{$lp['product_name']}}</a></h3>
                            <p class="product-price">{{'Rp. '.number_format($lp['product_price'])}}</p>
                        </div>
                    </div>
                </div>
            @empty
            <div class="text-center">
                <h4>Produk belum tersedia.</h4>
            </div>  
            @endforelse
        </div>
        {{-- </div> --}}
    </div>
</section>
@endif

<section class="product-wrap ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style1 text-center mb-40">
                    <span>PRODUK BARU</span>
                    <h2>Produk Terbaru Kami</h2>
                </div>
            </div>
        </div>
        <div class="product-slider-three owl-carousel">
            @forelse ($latest_product as $lp)
            <div class="product-card style3">
                <div class="product-img bg-athens">
                    @if ($lp['gambar'] != null)
                        <img src="{{ asset('landing/img/products/'.$lp['gambar']) }}" alt="{{$lp['product_name']}}">
                    @else
                        <img src="{{ asset('landing/img/products/no-images.png') }}" alt="{{$lp['product_name']}}">
                    @endif
                    <span class="promo-text"><i class="flaticon-star"></i>{{number_format($lp['jumlah_rating']['rating'], 1)}}</span>
                    <ul class="product-option list-style">
                        <li><a href="{{route('produk.detail', $lp['id']) }}"><i
                                    class="ri-eye-line"></i></a></li>
                        <li>
                            <form action="{{ route('cart', $lp['id']) }}" method="post">
                                @csrf
                                <button type="submit"><i class="ri-shopping-cart-2-line"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="product-info">
                    <h3><a href="">{{$lp['product_name']}}</a></h3>
                    <p class="product-price">{{'Rp. '.number_format($lp['product_price'])}}</p>
                </div>
            </div>
            @empty
            <div class="text-center">
                <h4>Produk belum tersedia.</h4>
            </div>  
            @endforelse
        </div>
    </div>
</section>


<section class="promo-wrap pb-75">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="feature-item-wrap style5">
                    <div class="feature-item" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                        <div class="feature-icon">
                            <i class="flaticon-delivery"></i>
                        </div>
                        <div class="feature-text">
                            <h3>Free Shipping</h3>
                            <p>Lorem ipsum dolor sit amet conse tetur adipisicing elit sed do tepor.</p>
                        </div>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class="flaticon-24-hour-clock"></i>
                        </div>
                        <div class="feature-text">
                            <h3>Support 24/7</h3>
                            <p>Lorem ipsum dolor sit amet conse tetur adipisicing elit sed do tepor.</p>
                        </div>
                    </div>
                    <div class="feature-item" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class="flaticon-credit-card"></i>
                        </div>
                        <div class="feature-text">
                            <h3>Secured Payment</h3>
                            <p>Lorem ipsum dolor sit amet conse tetur adipisicing elit sed do tepor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="testimonial-wrap ptb-100 bg-albastor" id="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style1 text-center mb-40">
                    <span>TESTIMONIALS</span>
                    <h2>Our Customers Feedback</h2>
                </div>
            </div>
        </div>
        <div class="testimonial-slider-two owl-carousel">
            <div class="testimonial-card style2">
                <ul class="ratings list-style">
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                </ul>
                <p class="client-quote">Lorem ipsum dolor sit amet adip elitionus repellus ata tetur delni vel
                    quam aliqous earadi umiotion sit explibom dolor eme.</p>
                <div class="client-info-wrap">
                    <div class="client-img">
                        <img src="{{ asset('landing/img/testimonials/client-1.jpg') }}" alt="Image">
                    </div>
                    <div class="client-info">
                        <h4>Jim Morison</h4>
                        <span>Director, BAT</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card style2">
                <ul class="ratings list-style">
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                </ul>
                <p class="client-quote">Lorem ipsum dolor sit amet adip elitionus repellus ata tetur delni vel
                    quam aliqous earadi umiotion sit explibom dolor eme.</p>
                <div class="client-info-wrap">
                    <div class="client-img">
                        <img src="{{ asset('landing/img/testimonials/client-2.jpg') }}" alt="Image">
                    </div>
                    <div class="client-info">
                        <h4>Alex Cruis</h4>
                        <span>CEO, IBAC</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card style2">
                <ul class="ratings list-style">
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                </ul>
                <p class="client-quote">Lorem ipsum dolor sit amet adip elitionus repellus ata tetur delni vel
                    quam aliqous earadi umiotion sit explibom dolor eme.</p>
                <div class="client-info-wrap">
                    <div class="client-img">
                        <img src="{{ asset('landing/img/testimonials/client-3.jpg') }}" alt="Image">
                    </div>
                    <div class="client-info">
                        <h4>Tom Haris</h4>
                        <span>Engineer, Olleo</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card style2">
                <ul class="ratings list-style">
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                </ul>
                <p class="client-quote">Lorem ipsum dolor sit amet adip elitionus repellus ata tetur delni vel
                    quam aliqous earadi umiotion sit explibom dolor eme.</p>
                <div class="client-info-wrap">
                    <div class="client-img">
                        <img src="{{ asset('landing/img/testimonials/client-4.jpg') }}" alt="Image">
                    </div>
                    <div class="client-info">
                        <h4>Harry Jackson</h4>
                        <span>Enterpreneur</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card style2">
                <ul class="ratings list-style">
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                </ul>
                <p class="client-quote">Lorem ipsum dolor sit amet adip elitionus repellus ata tetur delni vel
                    quam aliqous earadi umiotion sit explibom dolor eme.</p>
                <div class="client-info-wrap">
                    <div class="client-img">
                        <img src="{{ asset('landing/img/testimonials/client-5.jpg') }}" alt="Image">
                    </div>
                    <div class="client-info">
                        <h4>Chris Haris</h4>
                        <span>MD, ITec</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card style2">
                <ul class="ratings list-style">
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                    <li><i class="flaticon-star"></i></li>
                </ul>
                <p class="client-quote">Lorem ipsum dolor sit amet adip elitionus repellus ata tetur delni vel
                    quam aliqous earadi umiotion sit explibom dolor eme.</p>
                <div class="client-info-wrap">
                    <div class="client-img">
                        <img src="{{ asset('landing/img/testimonials/client-6.jpg') }}" alt="Image">
                    </div>
                    <div class="client-info">
                        <h4>Anthony Mascar</h4>
                        <span>Enterpreneur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection