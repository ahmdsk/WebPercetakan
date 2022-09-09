@php $perusahaan = DB::table('perusahaan')->first(); @endphp
@extends('layouts.auth_layouts')
@section('title', 'Login')
@section('auth')
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="{{ route('login') }}" class="d-inline-block auth-logo">
                            <img src="{{ asset('landing/img/logo/'.$perusahaan->logo) }}" alt="" height="80">
                        </a>
                    </div>
                    {{-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> --}}
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p class="text-muted">Sign in to continue to Velzon.</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email / No Telpon</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" placeholder="Masukan email / no telpon kamu">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    {{-- <div class="float-end">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-muted">Forgot
                                            password?</a>
                                        @endif
                                    </div> --}}
                                    <label class="form-label" for="password">Password</label>
                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror pe-5" placeholder="Masukan kata sandi kamu" id="password" name="password">
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle"></i></button>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                    </div>
                                    <div>
                                        <button type="button"
                                            class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                class="ri-facebook-fill fs-16"></i></button>
                                        <button type="button"
                                            class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                class="ri-google-fill fs-16"></i></button>
                                        <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                class="ri-github-fill fs-16"></i></button>
                                        <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i
                                                class="ri-twitter-fill fs-16"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="mt-4 text-center">
                    <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}"
                            class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection
@push('ex-js')
    <script>
        $("#password-addon").on('click', (e) => {
            if($("#password").attr('type') == 'password'){
                $("#password").attr('type', 'text');
                $("#eye-pass").removeClass('ri-eye-fill');
                $("#eye-pass").addClass('ri-eye-off-fill');
            }else{
                $("#password").attr('type', 'password');
                $("#eye-pass").removeClass('ri-eye-off-fill');
                $("#eye-pass").addClass('ri-eye-fill');
            }
        });
    </script>
@endpush