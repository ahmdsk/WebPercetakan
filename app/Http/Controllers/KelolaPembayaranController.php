<?php

namespace App\Http\Controllers;

use App\Models\KelolaPembayaran;
use Illuminate\Http\Request;

class KelolaPembayaranController extends Controller
{
    public function index(){
        $data['web'] = [
            'title' => 'Kelola Pembayaran',
            'breadcrumb' => [
                ['url' => '/setting/pembayaran', 'name' => 'Menu Pembayaran'],
                ['url' => '/setting/pembayaran', 'name' => 'Kelola Pembayaran'],
            ],
        ];

        $data['pembayaran'] = KelolaPembayaran::all();

        return view('admin.pembayaran.index', $data);
    }

    public function tambahPembayaran(Request $request){
        $rekening = $request->except(['_token']);

        $addRekening = KelolaPembayaran::insert($rekening);
        if($addRekening){
            return back()->with('success', 'Rekening Berhasil Ditambah');
        }else{
            return back()->with('error', 'Rekening Gagal Ditambah');
        }
    }

    public function editPembayaran($id){
        $pembayaran = KelolaPembayaran::find($id);
        return response()->json([
            'status' => 200,
            'data'   => $pembayaran
        ]);
    }

    public function updatePembayaran(Request $request, $id){
        $rekening = $request->except(['_token']);

        $updateRekening = KelolaPembayaran::find($id)->update($rekening);
        if($updateRekening){
            return back()->with('success', 'Kategori Produk Berhasil Diupdate');
        }else{
            return back()->with('error', 'Kategori Produk Gagal Diupdate');
        }
    }

    public function hapusPembayaran($id){
        $rekening = KelolaPembayaran::destroy($id);
        if($rekening){
            return response()->json([
                "status" => 200
            ]);
        }
    }
}
