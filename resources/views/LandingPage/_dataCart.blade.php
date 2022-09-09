<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<div class="cart-popup-body">
    @forelse ($keranjang as $k)
    <div class="cart-item">
        <div class="cart-item-action">
            <button class="delete-cart-item" onclick="deleteCart({{$k->id_keranjang}})">
                <i class="ri-close-circle-fill"></i>
            </button>
        </div>
        <div class="cart-item-img">
            @if ($k->gambar != null)
            <img src="{{ asset('landing/img/products/'.$k->gambar) }}" alt="Image">
            @else
            <img src="{{ asset('landing/img/products/no-images.png') }}" alt="Image">
            @endif
        </div>
        <div class="cart-item-info">
            <h5><a href="shop-details.html">{{$k->product_name}}</a></h5>
            <p>Rp. {{number_format($k->product_price)}} x {{$k->total_produk}}</p>
        </div>
    </div>
    @empty
    <div class="text-center">
        <span class="text-muted">Keranjang Kosong</span>
    </div>
    @endforelse
</div>
<div class="cart-popup-footer">
    <div class="total-amt">
        <h5>Total Bayar</h5>
        <h5>Rp. {{number_format($keranjang->sum('total_harga'))}}</h5>
    </div>
    <div class="cart-popup-btn">
        <a href="{{route('produk.order')}}" class="btn style2">Checkout</a>
    </div>
</div>

<script src="{{ asset('landing/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/sweetalerts.init.js') }}"></script>

<script>
    function deleteCart(id){
        Swal.fire({
            icon: 'question',
            title: 'Hapus Produk Di Keranjang',
            text: 'Kamu yakin ingin menghapus produk ini?',
            showDenyButton: true,
            confirmButtonText: 'Lanjut',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{url('/hapusCart')}}"+"/"+id,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data){
                        if(data.status == 200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data dikeranjang berhasil dihapus!',
                            });
                            location.reload();
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Data dikeranjang gagal dihapus!',
                            });
                            location.reload();
                        }
                    }
                });
            }
        });
    }
</script>