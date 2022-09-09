@extends('layouts._landingpage.layouts')
@section('landing')
<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="overlay op-8 bg-black"></div>
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Ubah Profile</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="{{url('/')}}">Home </a></li>
                    <li>Ubah Profile</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="profile-wrap pt-50 pb-75">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Ubah Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Ubah Kata Sandi</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="pt-50 row">
                        <div class="col-lg-8">
                            <form action="{{route('profile.ubah')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap"
                                                name="nama_lengkap" placeholder="Masukan nama lengkap"
                                                value="{{$biodata->name}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="no_telp" class="form-label">No. Telpon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                placeholder="Masukan nomor telpon" value="{{$biodata->no_telp}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Masukan email" value="{{$biodata->email}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="alamat" name="alamat"
                                                placeholder="Masukan Alamat" rows="3">{{$biodata->alamat}}</textarea>
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
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="pt-50 row">
                        <div class="col-lg-12">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection