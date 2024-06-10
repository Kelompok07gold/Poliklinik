<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PendaftaranPasienLamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.pendaftaran-pasien-lama');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $idUser = Auth::id();
        $user = Auth::user(); // Mengambil informasi lengkap tentang pengguna yang sedang login
        $roleUser = $user->role; // Anda harus menyesuaikan dengan struktur tabel dan field yang sesuai

        $request->validate([
            'nik' => 'required|regex:/^RM\d{4}$/'
        ]);

        $pasien = Pasien::where('no_rm', $request->nik)->first();

        if (!$pasien) {
            return redirect()->back()->with('error', 'Pasien dengan nomor rekam medis tersebut tidak ditemukan.');
        }

        // Melakukan pengkondisian berdasarkan id_user dan peran pengguna
        if ($pasien->id_user !== $idUser && $roleUser !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
        }

        Session::put('pasien_id', $pasien->id);

        return redirect()->route('pendaftaran-lanjutan');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
