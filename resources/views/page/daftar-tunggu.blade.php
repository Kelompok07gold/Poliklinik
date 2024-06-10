@extends('layouts.app')
@section('title', 'Daftar Tunggu')

@section('content')
    <div class="main-content">
        <div class="row">
            @foreach ($daftarPendaftaran as $pendaftaran)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <form action="{{ route('update-daftar-tunggu', ['id' => $pendaftaran->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <h5 class="card-title">Daftar Tunggu</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">REG{{ $pendaftaran->id }}</h6>
                                <p class="card-text">Nama: {{ $pendaftaran->pasien->nama }}</p>
                                <div class="form-group">
                                    <label for="diagnosa">Diagnosa:</label>
                                    <textarea class="form-control" id="diagnosa_{{ $pendaftaran->id }}" name="diagnosa" rows="3"
                                        placeholder="Masukkan diagnosa"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
