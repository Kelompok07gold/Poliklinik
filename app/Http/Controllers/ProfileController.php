<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.profile');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'new_username' => 'required|string|max:255',
            'new_email' => 'required|email|max:255',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Update username dan email
        $user->name = $request->new_username;
        $user->email = $request->new_email;
        $user->save();

        // Update password jika ada perubahan
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
