<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $idUser = Auth::id();

        // Ambil data pendaftaran berdasarkan id_user
        $daftarPendaftaran = Pendaftaran::with('pasien')
            ->whereHas('pasien', function ($query) use ($idUser) {
                $query->where('id_user', $idUser);
            })
            ->where('status', 'terdaftar')
            ->get();

        // Ambil data pendaftaran selesai berdasarkan id_user
        $daftarSelesai = Pendaftaran::with('pasien')
            ->whereHas('pasien', function ($query) use ($idUser) {
                $query->where('id_user', $idUser);
            })
            ->where('status', 'selesai')
            ->get();


        return view('page.arsip', compact('daftarPendaftaran', 'daftarSelesai'));
    }
}
