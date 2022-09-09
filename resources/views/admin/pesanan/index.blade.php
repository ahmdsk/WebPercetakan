@extends('layouts.app')
@section('dashboard')
<div class="row">
    <div class="col-xl-12">
        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-sm-auto">
                            <h4>{{$web['title']}}</h4>
                        </div>
                    </div>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width: 100%" id="myTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Pesanan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga Produk (Jumlah)</th>
                                    <th scope="col">Total Pesanan</th>
                                    <th scope="col">Metode Pembayaran</th>
                                    <th scope="col">Bukti Pembayaran</th>
                                    <th scope="col">File Pesanan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesanan as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->kode_pesanan}}</td>
                                        <td>
                                            @if ($p->status == 'Waiting')
                                                <span class="badge bg-danger">Menunggu Konfirmasi</span>
                                            @elseif ($p->status == 'Proses')
                                                <span class="badge bg-warning">Sedang dikerjakan</span>
                                            @elseif ($p->status == 'Selesai')
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->ket_pesanan != null)
                                               {{$p->ket_pesanan}}
                                            @else
                                               Tidak ada keterangan.
                                            @endif
                                        </td>
                                        <td>{{$p->product_name}}</td>
                                        <td>Rp. {{number_format($p->product_price)}} / {{$p->jumlah_pesanan}}</td>
                                        <td>Rp. {{number_format($p->harga_pesanan)}}</td>
                                        <td>
                                            @if ($p->metode_pembayaran == 'cash')
                                                Bayar Ditempat
                                            @elseif ($p->metode_pembayaran == 'transfer_50')
                                                Transfer DP (50%)
                                            @elseif ($p->metode_pembayaran == 'transfer_lunas')
                                                Transfer Lunas
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->bukti_pembayaran != null)
                                                <a href="{{asset('document/bukti/'.$p->bukti_pembayaran)}}" target="_blank" rel="noopener noreferrer"><img src="{{asset('document/bukti/'.$p->bukti_pembayaran)}}" alt="Bukti bayar {{$p->kode_pesanan}}" style="width: 100px"></a>
                                            @else
                                                Tidak ada bukti bayar.
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->file_name != null)
                                                <a href="{{asset('document/cetak/'.$p->file_name)}}" target="_blank" class="btn btn-sm btn-success">File</a>
                                            @else
                                                Tidak ada file.
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button id="btnAction" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="btnAction">
                                                    <li><a class="dropdown-item" href="#" onclick="ubahStatus('{{$p->kode_pesanan}}')">Ubah Status</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="konfirPembayaran('{{$p->kode_pesanan}}')" style="display: {{$p->metode_pembayaran == 'transfer_50' ? 'block' : 'none'}}">Konfirmasi Pembayaran</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->


                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <!-- end col -->
</div>

<!-- update status modals -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel">Ubah Status Pesanan: <div id="kodePesananProduct"></div></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('pesanan.ubahstatus')}}" method="post" id="updateStatusForm">
                    @csrf
                    <input type="hidden" id="kodePesanan" name="kodePesanan">
                    <div class="row g-3">
                        <div class="col-12">
                            <div>
                                <select class="form-control" name="status">
                                    <option selected disabled>Ubah Status Pesanan</option>
                                    <option value="Waiting">Menunggu Konfirmasi</option>
                                    <option value="Proses">Sedang Dikerjakan</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('ex-js')
    <script>
        function ubahStatus(kode){
            $.ajax({
                url: "{{url('/pesanan/ubahstatus')}}"+"/"+kode,
                success: function(json){
                    // $("#statusPesanan").val(json.data.status);
                    $("#kodePesananProduct").val(json.data.kode_pesanan);
                    $("#kodePesanan").val(json.data.kode_pesanan);
                }
            });
            $('#updateStatusModal').modal('show');
        }

        function konfirPembayaran(kode){
            Swal.fire({
                icon: 'question',
                title: 'Konfirmasi Pembayaran',
                text: 'Yakin Ingin Konfirmasi Pesanan Ini Menjadi Transfer Lunas?',
                showDenyButton: true,
                confirmButtonText: 'Lanjut',
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/konfir_pembayaran')}}"+"/"+kode,
                        success: function(json){
                            if(json.status == 200){
                                Swal.fire('Status Pembayaran Berhasil Diubah Menjadi Lunas!', '', 'success');
                                location.reload();
                            }else{
                                Swal.fire('Status Pembayaran Gagal Diubah!', '', 'error');
                                location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush