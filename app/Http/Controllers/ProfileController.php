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

        $user = auth()->user();

        if ($user->photo && Storage::disk('public')->exists('profile/' . $user->photo)) {
            Storage::disk('public')->delete('profile/' . $user->photo);
        }

        $filename = uniqid() . '.' . $request->file('photo')->extension();
        $request->file('photo')->storeAs('profile', $filename, 'public');

        $user->photo = $filename;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui.',
            'photo_url' => asset('storage/profile/' . $filename),
        ]);
    }
}