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
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i
                                        class="ri-add-line align-bottom me-1"></i> Tambah Kategori</a>
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
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td><a href="#" class="fw-semibold">{{$c->category_name}}</a></td>
                                    <td>
                                        <a href="#" onclick="editModal({{$c->id}})" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="#" onclick="deleteAlert({{$c->id}})" class="btn btn-sm btn-danger">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add_category') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <div>
                                <label for="category_name" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required placeholder="Enter category name">
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
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="editCategoryForm" method="post">
                    @csrf
                    <input type="hidden" name="id" id="editCategory">
                    <div class="row g-3">
                        <div class="col-12">
                            <div>
                                <label for="category_name_edit" class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" id="category_name_edit" name="category_name" required placeholder="Enter category name">
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
                url: "{{url('/category/edit')}}"+"/"+id,
                success: function(json){
                    let data = json.data.category_name;
                    $("#editCategoryForm").attr('action', "{{url('/category/edit')}}"+"/"+id);
                    $("#editCategory").val(data);
                    $("#category_name_edit").val(data);
                }
            });
            $('#editCategoryModal').modal('show');
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
                        url: "{{url('/category/delete')}}"+"/"+id,
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