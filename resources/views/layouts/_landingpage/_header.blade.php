<header class="header-wrap style3">
    <div class="header-bottom">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{url('/')}}">
                    <img class="logo-light" src="{{ asset('landing/img/logo/'.$perusahaan->logo) }}" alt="logo" style="width: 60px !important">
                    <img class="logo-dark" src="{{ asset('landing/img/logo/'.$perusahaan->logo) }}" alt="logo" style="width: 60px !important">
                </a>
                <div class="collapse navbar-collapse main-menu-wrap" id="navbarSupportedContent">
                    <div class="menu-close xl-none">
                        <a href="javascript:void(0)"> <i class="ri-close-line"></i></a>
                    </div>
                    <div id="navbarWeb"></div>
                    @guest
                    <div class="others-options lg-none">
                        <a href="{{route('login')}}" class="btn style2">Login</a>
                    </div>  
                    @endguest                 
                    <div class="others-options lg-none">
                        <button class="searchbtn" type="button">
                            <i class="flaticon-search"></i>
                        </button>
                    </div>
                    <div class="others-options lg-none">
                        <div class="shopcart">
                            <i class="flaticon-shopping-cart"></i>
                            <span id="jumlahCart"></span>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="mobile-bar-wrap">
                <button class="searchbtn xl-none" type="button">
                    <i class="flaticon-search"></i>
                </button>
                <div class="shopcart d-xl-none">
                    <i class="flaticon-shopping-cart"></i>
                    <span id="jumlahCartMobile"></span>
                </div>
                <div class="mobile-menu xl-none">
                    <a href="javascript:void(0)"><i class="ri-menu-line"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="search-area">
        <div class="container">
            <button type="button" class="close-searchbox">
                <i class="ri-close-line"></i>
            </button>
            <form action="{{route('cari')}}" method="get">
                <div class="form-group">
                    <input type="search" placeholder="Cari Produk Disini" name="p" autofocus>
                </div>
            </form>
        </div>
    </div>
    @guest
    <div class="cart-popup">
        <button type="button" class="close-cart-popup"><i class="ri-close-fill"></i></button>
        <div class="cart-popup-body">
            <div class="text-center">
                <span class="text-muted">Keranjang Kosong</span>
            </div>
        </div>
    </div>
    @endguest

    @auth
    <div class="cart-popup">
        <button type="button" class="close-cart-popup"><i class="ri-close-fill"></i></button>
        <div id="popup-keranjang"></div>
    </div>
    @endauth
</header>
@push('ex-js')
    <script>
        $(document).ready(function(){
            $.ajax({
                url: '{{route('ambilKategori')}}',
                type: 'GET',
                success: function(html){
                    $("#navbarWeb").replaceWith(html);
                }
            });

            $.ajax({
                url: '{{route('cart.ambil')}}',
                type: 'GET',
                success: function(html){
                    $("#popup-keranjang").replaceWith(html);
                }
            });

            $.ajax({
                url: '{{route('cart.jumlah')}}',
                type: 'GET',
                success: function(data){
                    $("#jumlahCart").text(data.jumlah);
                    $("#jumlahCartMobile").text(data.jumlah);
                }
            })
        });
    </script>
@endpush