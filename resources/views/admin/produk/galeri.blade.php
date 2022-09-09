@extends('layouts.app')
@section('dashboard')
<div class="row">
    <div class="col-xl-12">
        <div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-sm-auto">
                            <h4>{{$web['title']}} : {{$product->product_name}}</h4>
                        </div>
                        <div class="col-sm-auto">
                            <div>
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addImageModal"><i
                                    class="ri-add-line align-bottom me-1"></i> Tambah Gambar</a>
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
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Tipe Gambar</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gambar_product as $gp)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            @if ($gp->gambar)
                                                <img src="{{asset('landing/img/products/'.$gp->gambar)}}" style="width: 100px">
                                            @else
                                                Tidak ada gambar.
                                            @endif
                                        </td>
                                        <td>
                                            @if ($gp->jenis_gambar == 'gambar_utama')
                                                Gambar Utama
                                            @elseif ($gp->jenis_gambar == 'gambar_tambahan')
                                                Gambar Tambahan
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" onclick="editModal({{$gp->id}})" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" onclick="deleteAlert({{$gp->id}})" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data</td>
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

<!-- add modals -->
<div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addImageModalLabel">Tambah Gambar Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert">
                    Perhatian! Untuk Jenis Gambar (Gambar Utama) Hanya Boleh Satu Gambar Saja
                </div>
                <form action="{{ route('tambah.galeri') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="products_id" value="{{$product->id}}">
                    <div class="row g-3">
                        <div class="col-12">
                            <div>
                                <label for="tipeGambarSelect">Tipe Gambar</label>
                                <select class="form-control" id="tipeGambarSelect" name="jenis_gambar" required>
                                    <option value="" selected disabled>Pilih Tipe Gambar</option>
                                    <option value="gambar_utama">Gambar Utama</option>
                                    <option value="gambar_tambahan">Gambar Tambahan</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom-file">
                                <label for="formFile" class="form-label">Gambar <span class="text-muted" style="font-style: italic">(.jpg, .jpeg, .png)</span></label>
                                <input class="form-control" type="file" id="formFile" name="gambar" required>                              
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
<div class="modal fade" id="editProductImageModal" tabindex="-1" aria-labelledby="editProductImageModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Gambar Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" enctype="multipart/form-data" id="editImageForm">
                    @csrf
                    <input type="hidden" name="products_id" name="products_id_edit" value="{{$product->id}}">
                    <div class="row g-3">
                        <div class="col-12">
                            <div>
                                <label for="jenis_gambar_edit">Tipe Gambar</label>
                                <select class="form-control" name="jenis_gambar" id="jenis_gambar_edit" required>
                                    <option value="gambar_utama">Gambar Utama</option>
                                    <option value="gambar_tambahan">Gambar Tambahan</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom-file">
                                <label for="gambar_edit" class="form-label">Gambar <span class="text-muted" style="font-style: italic">(.jpg, .jpeg, .png)</span></label>
                                <input class="form-control" type="file" id="gambar_edit" name="gambar">                              
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
                url: "{{url('/products/galeri/edit')}}"+"/"+id,
                success: function(json){
                    $("#editImageForm").attr('action', "{{url('/products/galeri/edit')}}"+"/"+id);

                    $("#products_id_edit").val(json.data.products_id);
                    $("#jenis_gambar_edit").val(json.data.jenis_gambar);
                    $("#gambar_edit").val(json.data.gambar);
                }
            });
            $('#editProductImageModal').modal('show');
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
                        url: "{{url('/products/galeri/hapus')}}"+"/"+id,
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