@extends('layouts.app')
@section('dashboard')
<div class="row">
    <div class="col-xxl-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Profile Perusahaan</h5>
                <form action="{{route('ubahProfile')}}" method="post">
                    @csrf
                    <input type="hidden" name="id_perusahaan" value="{{$perusahaan->id_perusahaan}}">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan"
                                    value="{{$perusahaan->nama_perusahaan}}" required>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="no_telp" class="form-label">No. Telpon Perusahaan</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor telpon"
                                    value="{{$perusahaan->no_telp_perusahaan}}" required>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Perusahaan</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukan email"
                                    value="{{$perusahaan->email_perusahaan}}" required>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div class="mb-3 pb-2">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukan deskripsi"
                                    rows="7" required>{{$perusahaan->deskripsi}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 pb-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat"
                                    rows="7" required>{{$perusahaan->alamat}}</textarea>
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
    <div class="col-xxl-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Logo Perusahaan</h5>
                <form action="{{route('ubahProfile')}}" method="post">
                    @csrf
                    <input type="hidden" name="id_perusahaan" value="{{$perusahaan->id_perusahaan}}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3 pb-2">
                                <div style="width: 100%; text-align: center" class="mb-3">
                                    @if ($perusahaan->logo != null)   
                                    <a href="{{asset('landing/img/logo/'.$perusahaan->logo)}}" target="_blank"><img src="{{asset('landing/img/logo/'.$perusahaan->logo)}}" alt="" style="width: 150px"></a>
                                    @else
                                    <a href="{{asset('landing/img/products/no-images.png')}}" target="_blank"><img src="{{asset('landing/img/products/no-images.png')}}" alt="" style="width: 150px"></a>
                                    @endif
                                </div>
                                <input type="file" name="logo" class="form-control" required>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Ubah Logo</button>
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
@endsection