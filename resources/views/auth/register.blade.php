@php $perusahaan = DB::table('perusahaan')->first(); @endphp
@extends('layouts.auth_layouts')
@section('title', 'Register')
@section('auth')
<div class="auth-page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <a href="{{route('register')}}" class="d-inline-block auth-logo">
                            <img src="{{ asset('landing/img/logo/'.$perusahaan->logo) }}" alt="" height="80">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">

                    <div class="card-body p-4">
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Create New Account</h5>
                            <p class="text-muted">Get your free velzon account now</p>
                        </div>
                        <div class="p-2 mt-4">
                            <form class="needs-validation" novalidate method="POST" action="{{route('register')}}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Username <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter username"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror pe-5 password-input"
                                            placeholder="Enter password" name="password" id="password" required>
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon"><i
                                                class="ri-eye-fill align-middle" id="eye-pass"></i></button>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password-confirm">Password Confirmation</label>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input type="password" class="form-control pe-5 password-input"
                                            placeholder="Enter password" name="password_confirmation" id="password-confirm" required>
                                        <button
                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon-confirm"><i
                                                class="ri-eye-fill align-middle" id="eye-pass-confirm"></i></button>
                                        @error('password-confirm')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="no_telp" class="form-label">No Telpon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" placeholder="Enter number phone"
                                        required>
                                    @error('no_telp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" row="7" id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Enter Address"></textarea>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the
                                        Velzon <a href="#"
                                            class="text-primary text-decoration-underline fst-normal fw-medium">Terms
                                            of Use</a></p>
                                </div>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
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
                    <p class="mb-0">Already have an account ? <a href="{{route('login')}}"
                            class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
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

        $("#password-addon-confirm").on('click', (e) => {
            if($("#password-confirm").attr('type') == 'password'){
                $("#password-confirm").attr('type', 'text');
                $("#eye-pass-confirm").removeClass('ri-eye-fill');
                $("#eye-pass-confirm").addClass('ri-eye-off-fill');
            }else{
                $("#password-confirm").attr('type', 'password');
                $("#eye-pass-confirm").removeClass('ri-eye-off-fill');
                $("#eye-pass-confirm").addClass('ri-eye-fill');
            }
        });
    </script>
@endpush