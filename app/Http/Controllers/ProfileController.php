<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel; // Import your user model explicitly

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $userId = $user->user_id; // Get the user ID

        // Retrieve a fresh instance of the model to ensure we can save it
        $userModel = UserModel::find($userId);

        if ($userModel->foto_profil && Storage::disk('public')->exists('profile/' . $userModel->foto_profil)) {
            Storage::disk('public')->delete('profile/' . $userModel->foto_profil);
        }

        $filename = uniqid() . '.' . $request->file('photo')->extension();
        $request->file('photo')->storeAs('profile', $filename, 'public');

        $userModel->foto_profil = $filename;
        $userModel->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui.',
            'photo_url' => asset('storage/profile/' . $filename),
        ]);
    }
}
