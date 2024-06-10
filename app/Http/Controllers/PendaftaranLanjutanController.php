<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PendaftaranLanjutanController extends Controller
{
    public function nextPage()
    {
        // Ambil ID pasien dari sesi
        $pasienId = Session::get('pasien_id');

        // Dapatkan data pasien berdasarkan ID
        $pasien = Pasien::find($pasienId);

        return view('page.pendaftaran-lanjutan', compact('pasien'));
    }
    public function store(Request $request)
    {
        // Hitung jumlah antrian pada tanggal pendaftaran yang sama
        $tanggalPendaftaran = $request->tanggal_pendaftaran;
        $jumlahAntrianHariIni = Pendaftaran::whereDate('tanggal_pendaftaran', $tanggalPendaftaran)->count();

        // Dapatkan nomor antrian terakhir pada hari ini
        $nomorAntrianTerakhir = Pendaftaran::whereDate('tanggal_pendaftaran', $tanggalPendaftaran)->max('no_antrian');
        $nomorAntrianTerakhir = $nomorAntrianTerakhir ? intval(substr($nomorAntrianTerakhir, 3)) : 0;

        // Jika jumlah antrian sudah mencapai atau melebihi 10, tampilkan pesan kesalahan
        if ($jumlahAntrianHariIni >= 10) {
            return redirect()->back()->with('error', 'Maaf, kuota pemeriksaan untuk hari ini sudah terpenuhi.');
        }

        // Generate nomor antrian baru
        $nomorAntrianBaru = 'REG' . str_pad($nomorAntrianTerakhir + 1, 2, '0', STR_PAD_LEFT);

        // Validasi input
        $request->validate([
            'tanggal_pendaftaran' => 'required|date',
        ]);

        // Ambil pasien_id dari sesi
        $pasienId = Session::get('pasien_id');

        // Simpan data pendaftaran dengan nomor antrian baru dan pasien_id dari sesi
        Pendaftaran::create([
            'pasien_id' => $pasienId,
            'no_antrian' => $nomorAntrianBaru,
            'tanggal_pendaftaran' => $tanggalPendaftaran,
            'pembayaran' => $request->pembayaran,
            'no_bpjs' => $request->no_bpjs,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.index')->with('success', 'Pendaftaran berhasil disimpan.');
    }
}
