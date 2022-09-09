@extends('layouts.app')
@section('dashboard')
    <div class="container-fluid mt-2">
        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">
                <img src="{{asset('assets/images/profile-bg.jpg')}}" alt="" class="profile-wid-img" />
            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                        <img src="{{asset('landing/img/testimonials/user-not-found.png')}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                        {{-- <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                            <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                <span class="avatar-title rounded-circle bg-light text-body">
                                    <i class="ri-camera-fill"></i>
                                </span>
                            </label>
                        </div> --}}
                    </div>
                    {{-- <div class="avatar-lg">
                        <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user-img" class="img-thumbnail rounded-circle" />
                    </div> --}}
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{ucfirst($biodata->name)}}</h3>
                        <p class="text-white-75">{{ucfirst($biodata->role)}}</p>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>Indonesia</div>
                            <div>
                                <i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Bandar Lampung
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Biodata</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#katasandi" role="tab">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Kata Sandi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Informasi Akun</h5>
                                            <form action="{{route('profile.ubah')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan nama lengkap" value="{{$biodata->name}}">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="no_telp" class="form-label">No. Telpon</label>
                                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan nomor telpon" value="{{$biodata->no_telp}}">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email" value="{{$biodata->email}}">
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="mb-3 pb-2">
                                                            <label for="alamat" class="form-label">Alamat</label>
                                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" rows="3">{{$biodata->alamat}}</textarea>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Ubah Profile</button>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </form>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <div class="tab-pane fade" id="katasandi" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Ubah Kata Sandi</h5>
                                    <form action="{{route('profile.ubahKataSandi')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="old_pw" class="form-label">Kata Sandi Lama</label>
                                                    <input type="text" class="form-control" id="old_pw" name="old_pw" placeholder="Masukan kata sandi lama">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="new_pw" class="form-label">Kata Sandi Baru</label>
                                                    <input type="text" class="form-control" id="new_pw" name="new_pw" placeholder="Masukan kata sandi baru">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="konfir_new_pw" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                                    <input type="text" class="form-control" id="konfir_new_pw" name="konfir_new_pw" placeholder="Masukan konfirmasi kata sandi baru">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Ubah Kata Sandi</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </form>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
@endsection
@push('ex-js')
    <!-- profile-setting init js -->
    <script src="{{asset('assets/js/pages/profile-setting.init.js')}}"></script>
@endpush