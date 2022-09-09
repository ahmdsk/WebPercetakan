<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $data['web'] = [
            'title' => 'Pengguna',
            'breadcrumb' => [
                ['url' => '/dashboard', 'name' => 'Dashboard'],
                ['url' => '/users', 'name' => 'Pengguna'],
            ],
        ];
        
        $data['users'] = User::all();

        return view('admin.users.index', $data);
    }

    public function tambahUser(Request $request){
        $cekUser = $request->validate([
            'nama'      => 'required',
            'email'     => 'required|email',
            'no_telp'   => 'required',
            'akses'     => 'required',
        ]);

        if($cekUser){
            $cekEmailNoTelp = User::where('email', $request->email)->orWhere('no_telp', $request->no_telp)->get();

            if(count($cekEmailNoTelp) == 0){
                $tambahUser = User::insert([
                    'name'      => $request->nama,
                    'email'     => $request->email,
                    'no_telp'   => $request->no_telp,
                    'password'  => bcrypt('12345678'),
                    'role'      => $request->akses,
                    'alamat'    => $request->alamat,
                ]);
    
                if($tambahUser){
                    return back()->with('success', 'Berhasil menambah user baru');
                }else{
                    return back()->with('warning', 'Gagal menambah user baru!');
                }
            }else{
                return back()->with('warning', 'Email / No Telpon Telah Terdaftar!');
            }
        }else{
            return back()->with('error', 'Silahkan lengkapi form!');
        }
    }

    public function editUser($id){
        $user = User::find($id);

        if(!empty($user)){
            return response()->json([
                'status' => 200,
                'data'   => $user
            ]);
        }else{
            return response()->json([
                'status' => 404
            ]);
        }
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        $data = [
            'name'      => $request->nama,
            'email'     => $request->email,
            'no_telp'   => $request->no_telp,
            'role'      => $request->akses,
            'alamat'    => $request->alamat,
        ];

        $ubahUser = $user->update($data);
        if($ubahUser){
            return back()->with('success', 'Data user '.$request->nama.' berhasil diubah!');
        }else{
            return back()->with('error', 'Data user '.$request->nama.' gagal diubah!');
        }
    }

    public function hapusUser($id){
        $user = User::find($id);
        
        if(!empty($user)){
            $hapusUser = $user->delete();
            
            if($hapusUser){
                return response()->json(['status' => 200]);
            }
        }
    }

    public function resetPasswordUser($id){
        $user = User::find($id);

        if(!empty($user)){
            $resetPass = $user->update(['password'    => bcrypt('12345678')]);
            
            if($resetPass){
                return response()->json(['status' => 200]);
            }
        }
    }
}
