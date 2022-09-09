@php $perusahaan = DB::table('perusahaan')->first(); @endphp
<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/swiper-min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/dark-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/responsive.css') }}">
    <title>{{$title ?? 'Home'}} - {{$perusahaan->nama_perusahaan}}</title>
    <link rel="icon" type="image/png" href="{{ asset('landing/img/logo/'.$perusahaan->logo) }}">

    <!-- Sweet Alert css-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="loader js-preloader">
        <div></div>
        <div></div>
        <div></div>
    </div>


    <div class="switch-theme-mode">
        <label id="switch" class="switch">
            <input type="checkbox" onchange="toggleTheme()" id="slider">
            <span class="slider round"></span>
        </label>
    </div>


    <div class="page-wrapper">

        @include('layouts._landingpage._header')
        @yield('landing')

        <footer class="footer-wrap bg-mine-shaft">
            <div class="container">
                <div class="row pt-100 pb-75">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 pe-xl-5">
                        <div class="footer-widget">
                            <a href="index.html" class="footer-logo">
                                <img src="{{ asset('landing/img/logo/'.$perusahaan->logo) }}" alt="Image" style="width: 135px !important">
                            </a>
                            <p class="comp-desc">{{ $perusahaan->deskripsi }}</p>
                            <div class="social-link">
                                <h6>Follow Us:</h6>
                                <ul class="social-profile list-style style3">
                                    <li>
                                        <a target="_blank" href="https://facebook.com/">
                                            <i class="ri-facebook-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://twitter.com/">
                                            <i class="ri-twitter-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://linkedin.com/">
                                            <i class="ri-linkedin-fill"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a target="_blank" href="https://instagram.com/">
                                            <i class="ri-pinterest-fill"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="footer-widget-title">Information</h3>
                            <ul class="footer-menu list-style">
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Our Shop
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Contact Us
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Refund Policy
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Privacy Policy
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 ps-xl-4">
                        <div class="footer-widget">
                            <h3 class="footer-widget-title">Account</h3>
                            <ul class="footer-menu list-style">
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        My Account
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        My Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Returns
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Wishlist
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="ri-arrow-right-s-line"></i>
                                        Shipping
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <h3 class="footer-widget-title">Get In Touch</h3>
                            <ul class="contact-info list-style">
                                <li>
                                    <i class="flaticon-pin"></i>
                                    <h6>Location</h6>
                                    <p>{{ $perusahaan->alamat ?? '' }}</p>
                                </li>
                                <li>
                                    <i class="flaticon-email-1"></i>
                                    <h6>Email</h6>
                                    <a href="#"><span class="__cf_email__">{{ $perusahaan->email_perusahaan ?? '' }}</span></a>
                                </li>
                                <li>
                                    <i class="flaticon-call"></i>
                                    <h6>Phone</h6>
                                    <a href="#">{{ $perusahaan->no_telp_perusahaan ?? '' }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p class="copyright-text">
                <i class="ri-copyright-line"></i>
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <span>{{ $perusahaan->nama_perusahaan ?? '' }}</span>
            </p>
        </footer>

    </div>

    <a href="javascript:void(0)" class="back-to-top bounce"><i class="ri-arrow-up-s-line"></i></a>

    <script src="{{ asset('landing/js/jquery.min.js') }}"></script>
    <script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('landing/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('landing/js/aos.js') }}"></script>
    <script src="{{ asset('landing/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/js/swiper-min.js') }}"></script>
    <script src="{{ asset('landing/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('landing/js/fancybox.js') }}"></script>
    <script src="{{ asset('landing/js/appear.js') }}"></script>
    <script src="{{ asset('landing/js/tweenmax.min.js') }}"></script>
    <script src="{{ asset('landing/js/progressbar.min.js') }}"></script>
    <script src="{{ asset('landing/js/main.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweetalerts.init.js') }}"></script>

    @if ($message = session()->get('success'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{$message}}',
            });
        </script>
    @endif

    @if ($message = session()->get('warning'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian!',
                text: '{{$message}}',
            });
        </script>
    @endif

    @if ($message = session()->get('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{$message}}',
            });
        </script>
    @endif

    @stack('ex-js')
</body>

</html>