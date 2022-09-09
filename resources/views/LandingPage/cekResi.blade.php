@extends('layouts._landingpage.layouts')
@section('landing')
<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="overlay op-8 bg-black"></div>
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Cek Resi Pesanan</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="/">Home </a></li>
                    <li>Cek Resi Pesanan</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="Login-wrap pt-100 pb-50">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form-wrap style2">
                        <div class="login-header">
                            <h3>Cek Resi Pesanan</h3>
                        </div>
                        <div class="login-body">
                            <form class="form-wrap" action="#" id="formCekResi" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="kode_trx">Kode Transaksi</label>
                                            <input id="kode_trx" name="kode_trx" type="text" placeholder="Masukan Kode Transaksi Kamu Disini" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn style1 w-100 d-block">
                                                Cek Resi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="tableCekResi"></div>
</div>
@endsection
@push('ex-js')
    <script>
        $("#formCekResi").on('click', (e) => {
            e.preventDefault();
            
            $.ajax({
                url: '{{url('cekresi')}}',
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    kode_trx: $("#kode_trx").val()
                },
                success: function(html){
                    $("#tableCekResi").html(html);
                }
            });
        });
    </script>
@endpush