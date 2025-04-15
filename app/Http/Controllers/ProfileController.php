<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Profil Saya',
            'list' => ['Home', 'Profile']
        ];
    
        $page = (object)[
            'title' => 'Halaman Profil Pengguna'
        ];
    
        $activeMenu = 'profile';
    
        return view('profile', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }
    
    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->foto && File::exists(public_path('uploads/' . $user->foto))) {
            File::delete(public_path('uploads/' . $user->foto));
        }

        $foto = $request->file('foto');
        $namaFoto = $user->username . '_' . time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('uploads'), $namaFoto);

        $user->foto = $namaFoto;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}