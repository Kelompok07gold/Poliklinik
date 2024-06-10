<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.dashboard');
    }

    // Di dalam controller
    public function dataPerbulan()
    {
        // Mendapatkan jumlah data per bulan dengan status selesai dalam satu tahun
        $dataPerbulan = Pendaftaran::where('status', 'selesai')
            ->select(DB::raw('MONTH(tanggal_pendaftaran) as bulan'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy(DB::raw('MONTH(tanggal_pendaftaran)'))
            ->get();

        // Inisialisasi array untuk menyimpan jumlah data per bulan
        $jumlahDataPerBulan = [];

        // Inisialisasi array untuk bulan
        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Memasukkan jumlah data per bulan ke dalam array
        foreach ($dataPerbulan as $data) {
            $jumlahDataPerBulan[$bulan[$data->bulan - 1]] = $data->jumlah;
        }

        // Mengirimkan data dalam format JSON
        return $jumlahDataPerBulan;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
