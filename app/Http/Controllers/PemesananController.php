<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function pesanProduk(Request $request){
        // request jika file terupload
        $fileCetak = $request->file('fileCetak');
        $fileBukti = $request->file('bukti_transfer');

        // cek apakah ini jasa cetak / non cetak
        if($request->cetak == 'jasa_cetak'){
            // cek file cetak
            if(isset($fileCetak)){
                foreach($fileCetak as $file){
                    $new_fileCetak = rand().'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('document/cetak/'), $new_fileCetak);

                    if($request->method_bayar == 'cash'){
                        $tambahPesanan = Pemesanan::insertGetId([
                            'user_id'       => Auth::user()->id,
                            'product_id'    => $request->produk_id,
                            'kode_pesanan'  => 'TRX'.rand(),
                            'status'        => 'Waiting',
                            'metode_pembayaran' => $request->method_bayar,
                            'jumlah_pesanan'    => $request->jumlah_produk,
                            'harga_pesanan'     => $request->harga_produk * $request->jumlah_produk
                        ]);

                        if($tambahPesanan){
                            $tambahFileCetak = DB::table('files_cetak')->insert([
                                'id_pesanan' => $tambahPesanan,
                                'file_name'  => $new_fileCetak
                            ]);

                            if($tambahFileCetak){
                                $product = Products::where('id', $request->produk_id)->first();
                                $product->update([
                                    'product_stock' => $product->product_stock - (int) $request->jumlah_produk
                                ]);

                                return back()->with('success', 'Selamat, Pesanan berhasil silahkan cek pada menu data pesanan!');
                            }else{
                                return back()->with('error', 'Gagal, Pesanan gagal dilakukan!');
                            }
                        }
                    }else{
                        $new_fileBukti = rand().'.'.$fileBukti->getClientOriginalExtension();
                        $fileBukti->move(public_path('document/bukti/'), $new_fileBukti);

                        $tambahPesanan = Pemesanan::insertGetId([
                            'user_id'       => Auth::user()->id,
                            'product_id'    => $request->produk_id,
                            'kode_pesanan'  => 'TRX'.rand(),
                            'status'        => 'Waiting',
                            'metode_pembayaran' => $request->method_bayar,
                            'jumlah_pesanan'    => $request->jumlah_produk,
                            'harga_pesanan' => $request->harga_produk * $request->jumlah_produk,
                            'bukti_pembayaran' => $new_fileBukti
                        ]);

                        if($tambahPesanan){
                            $tambahFileCetak = DB::table('files_cetak')->insert([
                                'id_pesanan' => $tambahPesanan,
                                'file_name'  => $new_fileCetak
                            ]);

                            if($tambahFileCetak){
                                $product = Products::where('id', $request->produk_id)->first();
                                $product->update([
                                    'product_stock' => $product->product_stock - (int) $request->jumlah_produk
                                ]);

                                return back()->with('success', 'Selamat, Pesanan berhasil silahkan cek pada menu data pesanan!');
                            }else{
                                return back()->with('error', 'Gagal, Pesanan gagal dilakukan!');
                            }
                        }
                    }
                }
            }else{
                if($request->method_bayar == 'cash'){
                    $tambahPesanan = Pemesanan::insert([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $request->produk_id,
                        'kode_pesanan'  => 'TRX'.rand(),
                        'status'        => 'Waiting',
                        'ket_pesanan'       => $request->ket_pesanan,
                        'metode_pembayaran' => $request->method_bayar,
                        'jumlah_pesanan'    => $request->jumlah_produk,
                        'harga_pesanan'     => $request->harga_produk * $request->jumlah_produk
                    ]);

                    if($tambahPesanan){
                        $product = Products::where('id', $request->produk_id)->first();
                        $product->update([
                            'product_stock' => $product->product_stock - (int) $request->jumlah_produk
                        ]);

                        return back()->with('success', 'Selamat, Pesanan berhasil silahkan cek pada menu data pesanan!');
                    }else{
                        return back()->with('error', 'Gagal, Pesanan gagal dilakukan!');
                    }
                }else{
                    $new_fileBukti = rand().'.'.$fileBukti->getClientOriginalExtension();
                    $fileBukti->move(public_path('document/bukti/'), $new_fileBukti);

                    $tambahPesanan = Pemesanan::insertGetId([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $request->produk_id,
                        'kode_pesanan'  => 'TRX'.rand(),
                        'status'        => 'Waiting',
                        'ket_pesanan'       => $request->ket_pesanan,
                        'metode_pembayaran' => $request->method_bayar,
                        'jumlah_pesanan'    => $request->jumlah_produk,
                        'harga_pesanan'     => $request->harga_produk * $request->jumlah_produk,
                        'bukti_pembayaran'  => $new_fileBukti
                    ]);

                    if($tambahPesanan){
                        $product = Products::where('id', $request->produk_id)->first();
                        $product->update([
                            'product_stock' => $product->product_stock - (int) $request->jumlah_produk
                        ]);

                        return back()->with('success', 'Selamat, Pesanan berhasil silahkan cek pada menu data pesanan!');
                    }else{
                        return back()->with('error', 'Gagal, Pesanan gagal dilakukan!');
                    }
                }
            }
        }elseif($request->cetak == 'non_cetak'){
            if($request->method_bayar == 'cash'){
                $tambahPesanan = Pemesanan::insertGetId([
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $request->produk_id,
                    'kode_pesanan'  => 'TRX'.rand(),
                    'status'        => 'Waiting',
                    'metode_pembayaran' => $request->method_bayar,
                    'jumlah_pesanan'    => $request->jumlah_produk,
                    'harga_pesanan' => $request->harga_produk * $request->jumlah_produk
                ]);

                if($tambahPesanan){
                    $product = Products::where('id', $request->produk_id)->first();
                    $product->update([
                        'product_stock' => $product->product_stock - (int) $request->jumlah_produk
                    ]);

                    return back()->with('success', 'Selamat, Pesanan berhasil silahkan cek pada menu data pesanan!');
                }else{
                    return back()->with('error', 'Gagal, Pesanan gagal dilakukan!');
                }
            }else{
                $new_fileBukti = rand().'.'.$fileBukti->getClientOriginalExtension();
                $fileBukti->move(public_path('document/bukti/'), $new_fileBukti);

                $tambahPesanan = Pemesanan::insertGetId([
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $request->produk_id,
                    'kode_pesanan'  => 'TRX'.rand(),
                    'status'        => 'Waiting',
                    'metode_pembayaran' => $request->method_bayar,
                    'jumlah_pesanan'    => $request->jumlah_produk,
                    'harga_pesanan' => $request->harga_produk * $request->jumlah_produk,
                    'bukti_pembayaran' => $new_fileBukti
                ]);

                if($tambahPesanan){
                    $product = Products::where('id', $request->produk_id)->first();
                    $product->update([
                        'product_stock' => $product->product_stock - (int) $request->jumlah_produk
                    ]);

                    return back()->with('success', 'Selamat, Pesanan berhasil silahkan cek pada menu data pesanan!');
                }else{
                    return back()->with('error', 'Gagal, Pesanan gagal dilakukan!');
                }
            }
        }else{
            return back()->with('warning', 'Silahkan pilih jasa terlebih dahulu!');
        }
    }

    public function kelolaPesanan(){
        $data['web'] = [
            'title' => 'Data Pesanan',
            'breadcrumb' => [
                ['url' => url('/dashboard'), 'name' => 'Dashboard'],
                ['url' => url('/datapesanan'), 'name' => 'Data Pesanan'],
            ],
        ];

        // $data['pesanan'] = Pemesanan::where('status', '!=', 'Selesai')->orderBy('id', 'desc')->get();

        $data['pesanan'] = DB::table('pemesanan')
                    ->leftjoin('files_cetak', 'files_cetak.id_pesanan', '=', 'pemesanan.id')
                    ->join('products', 'products.id', '=', 'pemesanan.product_id')
                    ->where('status', '!=', 'Selesai')->orderBy('pemesanan.id', 'desc')->get();

        return view('admin.pesanan.index', $data);
    }

    public function laporanDataTransaksi(){
        $data['web'] = [
            'title' => 'Laporan Data Transaksi',
            'breadcrumb' => [
                ['url' => url('/dashboard'), 'name' => 'Dashboard'],
                ['url' => route('laporantransaksi'), 'name' => 'Laporan Data Transaksi'],
            ],
        ];

        $data['pesanan'] = Pemesanan::where('status', '=', 'Selesai')->get();

        return view('admin.pesanan.laporanDataTransaksi', $data);
    }

    public function konfirPesanan($kode){
        $konfirPesanan = Pemesanan::where('kode_pesanan', $kode)->update([
            'metode_pembayaran' => 'transfer_lunas'
        ]);

        if($konfirPesanan){
            return response()->json([
                'status' => 200
            ]);
        }else{
            return response()->json([
                'status' => 503
            ]);
        }
    }

    public function ubahStatusPesanan($kode){
        $pesanan = Pemesanan::where('kode_pesanan', $kode)->first();
        return response()->json([
            'status' => 200,
            'data'   => $pesanan
        ]);
    }

    public function updateStatusPesanan(Request $request){
        $pesanan = Pemesanan::where('kode_pesanan', $request->kodePesanan)->first();
        $updatePesanan = $pesanan->update([
            'status' => $request->status
        ]);

        if($updatePesanan){
            return back()->with('success', 'Status Pesanan Berhasil Diupdate');
        }else{
            return back()->with('error', 'Status Pesanan Gagal Diupdate');
        }
    }

    public function dataPesanan(){
        $data['title'] = 'Data Pesanan';

        $data['pesanan'] = Pemesanan::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('LandingPage.pesanan', $data);
    }

    public function cekResi(){
        $data['title'] = 'Cek Resi Pesanan';
        return view('LandingPage.cekResi', $data);
    }

    public function cekResiPost(Request $request){
        $data['pesananKode']   = Pemesanan::where('kode_pesanan', $request->kode_trx)->first();
        return view('LandingPage._tableCekResi', $data);
    }

    public function konfirPembayaran($kode){
        $pesanan = Pemesanan::where('kode_pesanan', $kode)->first();

        if($pesanan != null){
            return response()->json([
                'status' => 200,
                'data'   => $pesanan
            ]);
        }else{
            return response()->json([
                'status' => 404
            ]);
        }
    }

    public function konfirPembayaranPost(Request $request){
        if($request->status == 'transfer_lunas'){
            $bukti = $request->file('bukti');

            if(!empty($bukti)){
                $nama_buktiBaru = rand().'.'.$bukti->getClientOriginalExtension();
                $bukti->move(public_path('document/bukti/'), $nama_buktiBaru);

                $lunaskan = DB::table('pemesanan')
                            ->where('id', $request->id_pesanan)->update([
                                'metode_pembayaran' => $request->status,
                                'bukti_pembayaran' => $nama_buktiBaru
                            ]);

                if($lunaskan){
                    return back()->with('success', 'Terimakasih telah melunaskan pembayaran!');
                }else{
                    return back()->with('error', 'Gagal melunaskan pemesanan!');
                }
            }else{
                return back()->with('warning', 'Mohon upload bukti pembayaran!');
            }
        }else{
            $lunaskan = DB::table('pemesanan')
                            ->where('id', $request->id_pesanan)->update([
                                'metode_pembayaran' => $request->status
                            ]);

            if($lunaskan){
                return back()->with('success', 'Terimakasih telah melunaskan pembayaran!');
            }else{
                return back()->with('error', 'Gagal melunaskan pemesanan!');
            }
        }
    }

    // method cart
    public function ambilCart(){
        $data['keranjang'] = DB::table('keranjang')
                    ->join('products', 'products.id', '=', 'keranjang.product_id')
                    ->leftjoin('products_image', 'products_image.products_id', '=', 'products.id')
                    ->select(
                        'products.id AS id_products', 'products.*',
                        'keranjang.id AS id_keranjang', 'keranjang.*',
                        'products_image.id AS id_gambar', 'products_image.*'
                    )->where('user_id', Auth::user()->id)
                    ->where('jenis_gambar', 'gambar_utama')
                    ->orWhereNull('jenis_gambar')
                    ->get();

        return view('LandingPage._dataCart', $data);
    }

    public function jumlahCart(){
        if(Auth::user()){
            $keranjang = DB::table('keranjang')
                        ->join('products', 'products.id', '=', 'keranjang.product_id')
                        ->leftjoin('products_image', 'products_image.products_id', '=', 'products.id')
                        ->where('user_id', Auth::user()->id)
                        ->where('jenis_gambar', 'gambar_utama')
                        ->orWhereNull('jenis_gambar')
                        ->count();
        }else{
            $keranjang = 0;
        }

        return response()->json(['jumlah' => $keranjang]);
    }

    public function hapusCart($id){
        $cekKeranjang = DB::table('keranjang')->where('id', $id)->delete();

        if($cekKeranjang){
            return response()->json(['status' => 200]);
        }else{
            return response()->json(['status' => 404]);
        }
    }

    public function tambahCart($product_id, Request $request){
        $cariHargaProduk = DB::table('products')->where('id', $product_id)->first();

        $cekKeranjang = DB::table('keranjang')
                    ->where('user_id', Auth::user()->id)
                    ->where('product_id', $product_id)
                    ->get();

        // cek jika produk sama update quantity saja
        if(count($cekKeranjang) > 0){
            foreach($cekKeranjang as $ck){
                if(!empty($request->jumlah)){
                    $dataUpdateCart = [
                            'total_produk'  => $ck->total_produk + $request->jumlah,
                            'total_harga'   => ($ck->total_produk + $request->jumlah) * $cariHargaProduk->product_price
                        ];                    
                }else{
                    $dataUpdateCart = [
                            'total_produk'  => $ck->total_produk + 1,
                            'total_harga'   => ($ck->total_produk + 1) * $cariHargaProduk->product_price
                        ];
                }
    
                $updateCart = DB::table('keranjang')->where('id', $ck->id)->update($dataUpdateCart);
                if($updateCart){
                    return back()->with('success', 'Berhasil Menambah Produk '.$cariHargaProduk->product_name.' Dalam Keranjang Mu');
                }else{
                    return back()->with('warning', 'Gagal Menambah Ke Keranjang');
                }
            }
        }else{
            if(!empty($request->jumlah)){
                $dataCart = [
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $product_id,
                    'total_produk'  => $request->jumlah,
                    'total_harga'   => $request->jumlah * $cariHargaProduk->product_price
                ];
            }else{
                $dataCart = [
                    'user_id'       => Auth::user()->id,
                    'product_id'    => $product_id,
                    'total_produk'  => 1,
                    'total_harga'   => $cariHargaProduk->product_price
                ];
            }

            $tambahCart = DB::table('keranjang')->insert($dataCart);
            if($tambahCart){
                return back()->with('success', 'Produk '.$cariHargaProduk->product_name.' Berhasil Ditambah Ke Keranjang');
            }else{
                return back()->with('warning', 'Gagal Menambah Ke Keranjang');
            }
        }
    }
}
