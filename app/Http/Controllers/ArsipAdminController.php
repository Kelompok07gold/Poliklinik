<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class ArsipAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarPendaftaran = Pendaftaran::with([
            'pasien' => function ($query) {
                $query->orderBy('no_rm', 'asc');
            }
        ])
            ->where('status', 'selesai')
            ->orderBy('tanggal_pendaftaran', 'asc')
            ->get();

        return view('page.arsip-admin', compact('daftarPendaftaran'));
    }
    public function data_awal()
    {
        $daftarPendaftaran = Pendaftaran::with([
            'pasien' => function ($query) {
                $query->orderBy('no_rm', 'asc');
            }
        ])
            ->where('status', 'selesai')
            ->orderBy('tanggal_pendaftaran', 'asc')
            ->get();

        return response()->json($daftarPendaftaran);
    }
    public function dataAwalBulanIni()
    {
        // Ambil bulan dan tahun saat ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // Ambil data pendaftaran untuk bulan ini
        $daftarPendaftaran = Pendaftaran::with([
            'pasien' => function ($query) {
                $query->orderBy('no_rm', 'asc');
            }
        ])
            ->whereYear('tanggal_pendaftaran', $tahunIni)
            ->whereMonth('tanggal_pendaftaran', $bulanIni)
            ->where('status', 'selesai')
            ->orderBy('tanggal_pendaftaran', 'asc')
            ->get();

        return response()->json($daftarPendaftaran);
    }
    public function dataAwalCustom(Request $request)
    {
        // Ambil tanggal mulai dan tanggal akhir dari permintaan
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Ambil data pendaftaran berdasarkan rentang tanggal
        $daftarPendaftaran = Pendaftaran::with([
            'pasien' => function ($query) {
                $query->orderBy('no_rm', 'asc');
            }
        ])
            ->whereBetween('tanggal_pendaftaran', [$tanggalMulai, $tanggalAkhir])
            ->where('status', 'selesai')
            ->orderBy('tanggal_pendaftaran', 'asc')
            ->get();

        return response()->json($daftarPendaftaran);
    }

}
