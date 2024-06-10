@extends('layouts.app')
@section('title', 'Pendaftaran Lanjutan')

@section('content')
    <div class="main-content">
        <div class="card">
            <div class="card-body">
                <h3>Daftar Pendaftaran Terdaftar</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No. Antrian</th>
                            <th scope="col">Tanggal Pendaftaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Check tiket</th> <!-- Kolom untuk tombol -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPendaftaran as $pendaftaran)
                            <tr>
                                <td>{{ $pendaftaran->no_antrian }}</td>
                                <td>{{ $pendaftaran->tanggal_pendaftaran }}</td>
                                <td>{{ $pendaftaran->status }}</td>

                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-{{ $pendaftaran->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-{{ $pendaftaran->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <!-- Tampilkan detail pendaftaran di sini -->
                                                <img src="foto/logo.png" alt="Logo" class="mb-3 d-block mx-auto"
                                                    style="max-width: 30%; text-align: center;">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pendaftaran</h5>
                                                <p>No. RM: {{ $pendaftaran->pasien->no_rm }}</p>
                                                <p>No. Antrian: {{ $pendaftaran->no_antrian }}</p>
                                                <p>Tanggal Pendaftaran: {{ $pendaftaran->tanggal_pendaftaran }}</p>
                                                <p>Status: {{ $pendaftaran->status }}</p>
                                                <!-- Tambahkan detail lainnya sesuai kebutuhan -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Daftar Pendaftaran Terdaftar</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No. Antrian</th>
                            <th scope="col">Tanggal Pendaftaran</th>
                            <th scope="col">Status</th>
                            <th scope="col">Check tiket</th> <!-- Kolom untuk tombol -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarSelesai as $selesai)
                            <tr>
                                <td>{{ $selesai->no_antrian }}</td>
                                <td>{{ $selesai->tanggal_pendaftaran }}</td>
                                <td>{{ $selesai->status }}</td>

                                <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-{{ $selesai->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-{{ $selesai->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!-- Tombol close modal -->
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close" onclick="closeModal()">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <!-- Tampilkan detail pendaftaran di sini -->
                                                <img src="foto/logo.png" alt="Logo" class="mb-3 d-block mx-auto"
                                                    style="max-width: 30%;">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pendaftaran</h5>
                                                <p>No. RM: {{ $selesai->pasien->no_rm }}</p>
                                                <p>No. Antrian: {{ $selesai->no_antrian }}</p>
                                                <p>Tanggal Pendaftaran: {{ $selesai->tanggal_pendaftaran }}</p>
                                                <p>Status: {{ $selesai->status }}</p>
                                                <p>Diagnosa Dokter: </p>
                                                <p> {{ $selesai->diagnosa }}</p>
                                                <!-- Tambahkan detail lainnya sesuai kebutuhan -->

                                                <!-- Tombol untuk mencetak modal -->
                                                <button class="btn btn-primary"
                                                    onclick="printModal('modal-{{ $selesai->id }}')">Cetak</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function printModal(modalId) {
            var printContents = document.getElementById(modalId).innerHTML;
            var originalContents = document.body.innerHTML;

            // Ganti gaya cetak untuk ukuran yang lebih besar
            var styles = '<style type="text/css">';
            styles += '@media print {';
            styles += '    .modal-dialog { width: 100% !important; max-width: none !important; }';
            styles += '    .modal-content { width: 100% !important; max-width: none !important; }';
            styles += '    .modal-body { height: auto !important; }';
            styles += '}';
            styles += '</style>';
            var combinedContent = styles + printContents;

            document.body.innerHTML = combinedContent;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        // Fungsi untuk menutup modal dan me-refresh halaman
        function closeModal() {
            // Tutup modal
            $(".modal").modal("hide");

            // Refresh halaman setelah 500ms (sebelum modal benar-benar tertutup)
            setTimeout(function() {
                location.reload();
            }, 10);
        }
    </script>

@endsection
