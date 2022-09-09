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
                        <div class="col-sm-auto">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRekeningModal"><i
                                        class="ri-add-line align-bottom me-1"></i> Cantumkan Rekening</a>
                            </div>
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
                                    <th scope="col">Nama Bank</th>
                                    <th scope="col">Nama Pemilik</th>
                                    <th scope="col">No Rekening</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembayaran as $p)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$p->nama_bank}}</td>
                                    <td>{{$p->nama_pemilik}}</td>
                                    <td>{{$p->no_rek}}</td>
                                    <td>
                                        <a href="#" onclick="editModal({{$p->id}})" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="#" onclick="deleteAlert({{$p->id}})" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @empty
                                <td>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </td>
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

<!-- add modals -->
<div class="modal fade" id="addRekeningModal" tabindex="-1" aria-labelledby="addRekeningModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRekeningModalLabel">Tambah Rekening</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tambah.pembayaran') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="nama_bank" class="form-label">Nama Bank</label>
                                <input type="text" class="form-control" id="nama_bank" name="nama_bank" required placeholder="Masukan nama bank">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required placeholder="Masukan nama pemilik">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-12">
                            <div>
                                <label for="no_rek" class="form-label">No Rekening</label>
                                <input type="text" class="form-control" id="no_rek" name="no_rek" required placeholder="Masukan nomor rekening">
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

<!-- edit modals -->
<div class="modal fade" id="editRekeningModal" tabindex="-1" aria-labelledby="editRekeningModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRekeningModalLabel">Edit Rekening Bank</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editRekeningForm" method="post">
                    @csrf
                    <input type="hidden" name="id" id="idRekening">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="nama_bank_edit" class="form-label">Nama Bank</label>
                                <input type="text" class="form-control" id="nama_bank_edit" name="nama_bank" required placeholder="Masukan nama bank">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="nama_pemilik_edit" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik_edit" name="nama_pemilik" required placeholder="Masukan nama pemilik">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-12">
                            <div>
                                <label for="no_rek_edit" class="form-label">No Rekening</label>
                                <input type="text" class="form-control" id="no_rek_edit" name="no_rek" required placeholder="Masukan nomor rekening">
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
        function editModal(id){
            $.ajax({
                url: "{{url('/setting/pembayaran/edit')}}"+"/"+id,
                success: function(json){
                    $("#editRekeningForm").attr('action', "{{url('/setting/pembayaran/edit')}}"+"/"+id);
                    $("#idRekening").val(json.data.id);
                    $("#nama_bank_edit").val(json.data.nama_bank);
                    $("#nama_pemilik_edit").val(json.data.nama_pemilik);
                    $("#no_rek_edit").val(json.data.no_rek);
                }
            });
            $('#editRekeningModal').modal('show');
        }

        function deleteAlert(id){
            Swal.fire({
                icon: 'question',
                title: 'Hapus data',
                text: 'Kamu yakin ingin menghapus data ini?',
                showDenyButton: true,
                confirmButtonText: 'Lanjut',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/setting/pembayaran/hapus')}}"+"/"+id,
                        success: function(json){
                            if(json.status == 200){
                                Swal.fire('Data Berhasil dihapus!', '', 'success');
                                location.reload();
                            }else{
                                Swal.fire('Data Gagal dihapus!', '', 'error');
                                location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endpush