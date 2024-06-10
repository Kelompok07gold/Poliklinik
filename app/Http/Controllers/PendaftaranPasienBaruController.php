<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PendaftaranPasienBaruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.pendaftaran-pasien-baru');
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
        $idUser = auth()->id();

        // Check if the NIK already exists in the database
        $existingPatient = Pasien::where('nik', $request->nik)->first();

        if ($existingPatient) {
            // Jika NIK sudah ada di database, beri respon error
            return redirect()->back()->with('error', 'NIK sudah terdaftar.');
        }

        // Mendapatkan nomor rekam medis terakhir dari database berdasarkan nomor rekam medis
        $lastPatient = Pasien::orderBy('no_rm', 'desc')->first();

        // Inisialisasi nomor rekam medis baru
        $nextPatientNumber = 1;

        // Jika ada data pasien sebelumnya, kita dapat mengambil nomor rekam medis berikutnya
        if ($lastPatient) {
            // Mengambil angka dari nomor rekam medis terakhir
            $lastPatientNumber = intval(substr($lastPatient->no_rm, 2));

            // Menambahkan 1 ke nomor rekam medis terakhir untuk mendapatkan nomor rekam medis berikutnya
            $nextPatientNumber = $lastPatientNumber + 1;
        }

        // Format nomor rekam medis baru dengan padding nol di depannya
        $newPatientNumber = sprintf("RM%04d", $nextPatientNumber);

        // Simpan data pasien baru ke database
        Pasien::create([
            'no_rm' => $newPatientNumber,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telp' => $request->no_telp,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'id_user' => $idUser,
        ]);

        // Redirect atau lakukan apa pun yang Anda butuhkan setelah menyimpan data
        return redirect()->route('pendaftaran-pasien-baru.index')->with('success', 'Data pasien berhasil disimpan.');
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
