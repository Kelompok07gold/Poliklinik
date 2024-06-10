<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Pendaftaran::create([
                'pasien_id' => 1,
                'no_antrian' => $faker->unique()->regexify('REG[0-9]{2}'),
                'status' => $faker->randomElement(['Terdaftar', 'Selesai']),
                'tanggal_pendaftaran' => Carbon::today(),
                'pembayaran' => $faker->randomElement(['BPJS', 'Umum']),
                'diagnosa' => $faker->text(),
            ]);
        }
    }
}
