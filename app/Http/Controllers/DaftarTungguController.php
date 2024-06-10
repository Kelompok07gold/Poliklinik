<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DaftarTungguController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today(); // Mendapatkan tanggal hari ini

        $daftarPendaftaran = Pendaftaran::with('pasien')
            ->where('status', 'terdaftar')
            ->whereDate('created_at', $today) // Hanya data yang dibuat hari ini
            ->get();

        return view('page.daftar-tunggu', compact('daftarPendaftaran'));
    }

    public function updateDiagnosaStatus(Request $request, $id)
    {
        // Validasi data input jika diperlukan
        $request->validate([
            'diagnosa' => 'required|string',
        ]);

        // Cari data pendaftaran berdasarkan ID
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update diagnosa dan status menjadi "selesai"
        $pendaftaran->diagnosa = $request->diagnosa;
        $pendaftaran->status = 'selesai';
        $pendaftaran->save();

        // Redirect atau response sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('success', 'Data diagnosa dan status berhasil diperbarui.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
