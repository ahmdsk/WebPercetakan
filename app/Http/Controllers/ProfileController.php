<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $data['web'] = [
            'title' => 'Profile',
            'breadcrumb' => [
                ['url' => '/', 'name' => 'Dashboard'],
                ['url' => '/profile', 'name' => 'Profile'],
            ],
        ];

        $data['biodata'] = User::find(Auth::user()->id);

        return view('profile', $data);
    }

    public function userProfile(){
        $data['title'] = 'Ubah Profile';
        $data['biodata'] = User::find(Auth::user()->id);
        
        return view('LandingPage.profile', $data);
    }

    public function ubahProfile(Request $request){
        $ubahProfile = User::find(Auth::user()->id)->update([
            'name'      => $request->nama_lengkap,
            'no_telp'   => $request->no_telp,
            'email'     => $request->email,
            'alamat'    => $request->alamat,
        ]);

        if($ubahProfile){
            return back()->with('success', 'Berhasil update profile!');
        }else{
            return back()->with('error', 'Gagal update profile!');
        }
    }

    public function ubahKataSandi(Request $request){
        $user = Auth::user();

        if(Hash::check($request->old_pw, $user->password)){

            if($request->new_pw == $request->konfir_new_pw){
                $ubahPass = User::where('id', $user->id)->update([
                    'password'  => bcrypt($request->new_pw, PASSWORD_DEFAULT)
                ]);

                if($ubahPass){
                    return back()->with('success', 'Berhasil Update Password!');
                }else{
                    return back()->with('error', 'Gagal Update Password!');
                }
            }else{
                return back()->with('warning', 'Konfirmasi Password Tidak Sama!');
            }

        }else{
            return back()->with('warning', 'Password Lama Salah!');
        }
    }
}