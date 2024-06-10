@extends('layouts.app')
@section('title', 'Pendaftaran Lanjutan')

@section('content')
    <div class="main-content">
        <div class="card card-sm text-center"> <!-- Menambahkan kelas text-center -->
            <div class="card-body">
                <h3>Detail Pasien</h3>
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '{{ session('error') }}'
                        });
                    </script>
                @endif
                <form action="{{ route('pendaftaran-lanjutan.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="no_rm">NO Rekam Medis</label>
                        <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ $pasien->no_rm }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $pasien->nama }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" value="{{ $pasien->nik }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ $pasien->tanggal_lahir }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" readonly>{{ $pasien->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pendaftaran">Pilih Tanggal Pemeriksaan</label>
                        <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran">
                    </div>
                    <div class="form-group">
                        <label for="pembayaran">Jenis Pembayaran</label>
                        <select class="form-control" id="pembayaran" name="pembayaran">
                            <option value="Umum">Umum</option>
                            <option value="BPJS">BPJS</option>
                        </select>
                    </div>

                    <div id="bpjs-input" style="display: none;" class="form-group">
                        <label for="no_bpjs">Nomor BPJS</label>
                        <input type="text" class="form-control" id="no_bpjs" name="no_bpjs"
                            placeholder="Masukkan Nomor BPJS">
                    </div>
                    <button type="submit" class="btn btn-primary">Proses Pendaftaran</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Mendengarkan perubahan pada dropdown pembayaran
        document.getElementById('pembayaran').addEventListener('change', function() {
            var selectedValue = this.value;
            var bpjsInput = document.getElementById('bpjs-input');

            // Jika pembayaran BPJS dipilih, tampilkan input nomor BPJS
            if (selectedValue === 'BPJS') {
                bpjsInput.style.display = 'block';
            } else {
                // Jika bukan BPJS, sembunyikan input nomor BPJS
                bpjsInput.style.display = 'none';
            }
        });
    </script>
@endsection
