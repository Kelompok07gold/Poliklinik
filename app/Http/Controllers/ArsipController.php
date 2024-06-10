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
            ->where('pasien_id', $idUser)->where('status', 'terdaftar')
            ->get();

        $daftarSelesai = Pendaftaran::with('pasien')
            ->where('pasien_id', $idUser)->where('status', 'selesai')
            ->get();
        return view('page.arsip', compact('daftarPendaftaran', 'daftarSelesai'));
    }
}
