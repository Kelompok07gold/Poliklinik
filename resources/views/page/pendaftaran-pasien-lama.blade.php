@extends('layouts.app')
@section('title', 'Pendaftaran Pasien Lama')

@section('content')
    <div class="main-content">
        <div class="card card-sm text-center"> <!-- Menambahkan kelas text-center -->
            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ session('error') }}'
                    });
                </script>
            @endif
            <div class="card-body">
                <img src="foto/logo.png" alt="Logo" class="mb-3" style="max-width: 20%;">

                <form action="{{ route('pendaftaran-pasien-lama.create') }}" method="POST">
                    @csrf
                    <h3>Pendaftaran Pasien Lama</h3>
                    <p>Silakan masukkan No. Rekam Medis (RM) Anda.</p>
                    <div class="form-group">
                        <label for="nik">No. Rekam Medis (RM)</label>
                        <input type="text" class="form-control" id="nik" name="nik"
                            placeholder="Masukkan No. Rekam Medis (RM)" pattern="RM\d{4}"
                            title="Format yang diharapkan: RM1234">
                        <small id="nik_help" class="form-text text-muted">Contoh format: RM1234</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}'
                    });
                </script>
            @endif
        </div>
    </div>
@endsection
