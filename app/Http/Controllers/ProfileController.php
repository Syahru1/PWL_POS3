<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Storage;
 
 class ProfileController extends Controller
 {
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);
    
        $user = auth()->user(); // Pastikan $user adalah instance dari model
        if (!$user instanceof \App\Models\UserModel) {
            return response()->json([
                'success' => false,
                'message' => 'Authenticated user is not a valid instance of the User model.',
            ], 400);
        }
    
        // Hapus foto lama jika ada
        if ($user->foto_profil && Storage::disk('public')->exists('profile/' . $user->foto_profil)) {
            Storage::disk('public')->delete('profile/' . $user->foto_profil);
        }
    
        // Simpan foto baru
        $filename = uniqid() . '.' . $request->file('photo')->extension();
        $request->file('photo')->storeAs('profile', $filename, 'public');
    
        // Simpan nama file ke kolom foto_profil
        $user->foto_profil = $filename; // Pastikan ini sesuai dengan nama kolom di database
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui.',
            'photo_url' => asset('storage/profile/' . $filename),
        ]);
    }
 }