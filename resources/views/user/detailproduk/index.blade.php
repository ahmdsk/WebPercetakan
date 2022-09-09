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
                                        <td>{{$p->product_stock}}</td>
                                        <td>{{$p->category->category_name}}</td>
                                        <td><a href="{{route('product.order', $p->id)}}" class="btn btn-sm btn-success">Pesan</a></td>
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
@endsection