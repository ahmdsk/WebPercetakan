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
                                <a href="javascript:void(0)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal"><i
                                    class="ri-add-line align-bottom me-1"></i> Tambah Produk</a>
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
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga Produk / Satuan</th>
                                    <th scope="col">Stok Produk</th>
                                    <th scope="col">Kategori Produk</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $p)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$p->product_name}}</td>
                                        <td>Rp. {{number_format($p->product_price)}} / {{$p->product_satuan}}</td>
                                        <td>
                                            @if ($p->product_stock == 'tersedia')
                                                Tersedia
                                            @else
                                                Tidak Tersedia
                                            @endif
                                        </td>
                                        <td>{{$p->category->category_name}}</td>
                                        <td>
                                            <a href="{{route('product.galery', $p->id)}}" class="btn btn-sm btn-success">Galeri Produk</a>
                                            <a href="#" onclick="editModal({{$p->id}})" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" onclick="deleteAlert({{$p->id}})" class="btn btn-sm btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
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
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Tambah Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add_product') }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required placeholder="Masukan nama produk">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_price" class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" required placeholder="Masukan harga produk">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_satuan" class="form-label">Satuan Produk</label>
                                <input type="text" class="form-control" id="product_satuan" name="product_satuan" required placeholder="Masukan satuan produk">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_stock" class="form-label">Stok Produk</label>
                                <select class="form-control" id="product_stock" name="product_stock">
                                    <option value="" selected disabled>Pilih Status Produk</option>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak_tersedia">Tidak Tersedia</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="categorySelect">Kategori Produk</label>
                                <select class="form-control" id="categorySelect" name="category_id">
                                    <option value="" selected disabled>Pilih Kategori Produk</option>
                                    @forelse ($category as $c)
                                        <option value="{{$c->id}}">{{$c->category_name}}</option>
                                    @empty
                                        <option>Belum ada Kategori</option>
                                    @endforelse
                                </select>                            
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_desc" class="form-label">Deskripsi Produk <i>(Optional)</i></label>
                                <input type="text" class="form-control" id="product_desc" name="product_desc" placeholder="Masukan deskripsi produk">
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
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editProductForm">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_name_edit" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name_edit" name="product_name" required placeholder="Masukan nama produk">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_price_edit" class="form-label">Harga Produk</label>
                                <input type="number" class="form-control" id="product_price_edit" name="product_price" required placeholder="Masukan harga produk">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_satuan_edit" class="form-label">Satuan Produk</label>
                                <input type="text" class="form-control" id="product_satuan_edit" name="product_satuan" required placeholder="Masukan satuan produk">
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_stock_edit" class="form-label">Stok Produk</label>
                                <select class="form-control" id="product_stock_edit" name="product_stock">
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak_tersedia">Tidak Tersedia</option>
                                </select> 
                                {{-- <input type="number" class="form-control" id="product_stock_edit" name="product_stock" required placeholder="Masukan stok produk"> --}}
                            </div>
                        </div><!--end col-->
                        <div class="col-xxl-6">
                            <div>
                                <label for="categorySelectEdit">Kategori Produk</label>
                                <select class="form-control" id="categorySelectEdit" name="category_id">
                                    <option value="" selected disabled>Pilih Kategori Produk</option>
                                    @forelse ($category as $c)
                                        <option value="{{$c->id}}">{{$c->category_name}}</option>
                                    @empty
                                        <option>Belum ada Kategori</option>
                                    @endforelse
                                </select>                            
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="product_desc_edit" class="form-label">Deskripsi Produk <i>(Optional)</i></label>
                                <input type="text" class="form-control" id="product_desc_edit" name="product_desc" placeholder="Masukan deskripsi produk">
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
                url: "{{url('/products/edit')}}"+"/"+id,
                success: function(json){
                    $("#editProductForm").attr('action', "{{url('/products/edit')}}"+"/"+id);

                    $("#product_name_edit").val(json.data.product_name);
                    $("#product_price_edit").val(json.data.product_price);
                    $("#product_satuan_edit").val(json.data.product_satuan);
                    $("#product_stock_edit").val(json.data.product_stock);
                    $("#categorySelectEdit").val(json.data.category_id);
                    $("#product_desc_edit").val(json.data.product_desc);
                }
            });
            $('#editProductModal').modal('show');
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
                        url: "{{url('/products/delete')}}"+"/"+id,
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