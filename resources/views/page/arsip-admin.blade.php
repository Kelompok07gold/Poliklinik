@extends('layouts.app')
@section('title', 'Arsip Pendaftaran')

@section('content')
    <div class="main-content">
        <div class="card">
            <div class="card-body">
                <h3>Daftar Pendaftaran Terdaftar</h3>
                <div class="mb-3">
                    <button type="button" id="bulan-ini-button" class="btn btn-primary mr-2">Bulan Ini</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#customFilterModal">Custom</button>
                </div>

                <!-- Modal for custom filter -->
                <div class="modal fade" id="customFilterModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter Kustom</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="customFilterForm" action="" method="GET">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Pendaftaran dan No Antrian</th>
                            <th scope="col">No. RM</th>
                            <th scope="col">Status</th>
                            <th scope="col">Check tiket</th> <!-- Kolom untuk tombol -->
                        </tr>
                    </thead>
                    <tbody id="data-pendaftaran">
                        <!-- Data akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Fungsi untuk memuat data
            function loadData(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        renderData(data); // Panggil fungsi untuk menampilkan data
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Fungsi untuk menampilkan data dalam tabel
            function renderData(data) {
                const tableBody = $('#data-pendaftaran');
                tableBody.empty(); // Kosongkan tabel sebelum menambahkan data baru
                data.forEach(pendaftaran => {
                    const row = `
                        <tr>
                            <td>${pendaftaran.tanggal_pendaftaran}, ${pendaftaran.no_antrian}</td>
                            <td>${pendaftaran.pasien.no_rm}</td>
                            <td>${pendaftaran.status}</td>
                            <td>
                                <button type="button" class="btn btn-info show-modal" data-pendaftaran-id="${pendaftaran.id}" data-pendaftaran='${JSON.stringify(pendaftaran)}'>
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });
            }

            // Memuat data awal saat halaman dimuat
            loadData('/data-awal');

            // Event listener untuk tombol "Bulan Ini"
            $('#bulan-ini-button').click(function() {
                loadData('/data-awal-bulan-ini'); // Memuat data bulan ini saat tombol diklik
            });

            // Event listener untuk formulir kustom
            $('#customFilterForm').submit(function(event) {
                event.preventDefault(); // Menghentikan perilaku default dari formulir

                // Mengambil nilai dari input tanggal mulai dan tanggal akhir
                const tanggalMulai = $('#tanggal_mulai').val();
                const tanggalAkhir = $('#tanggal_akhir').val();

                // Kirim data filter ke backend dan muat ulang data sesuai dengan filter yang diterapkan
                loadData(`/data-awal-custom?tanggal_mulai=${tanggalMulai}&tanggal_akhir=${tanggalAkhir}`);

                // Menutup modal
                $('#customFilterModal').modal('hide');
            });

            // Menggunakan event delegation untuk menangani klik pada tombol yang dibuat dinamis
            $(document).on('click', '.show-modal', function() {
                const pendaftaranId = $(this).data('pendaftaran-id');
                const pendaftaranData = $(this).data('pendaftaran');

                const modalHtml = `
                    <div class="modal fade" id="modal-${pendaftaranId}" tabindex="-1" role="dialog"
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
                                    <img src="https://marketplace.canva.com/EAE4oLXwWVs/1/0/1600w/canva-biru-tua-dan-biru-kehijauan-gradasi-modern-dokter-logo-kesehatan-B5VpOl-RH1w.jpg"
                                        alt="Logo" class="mb-3 d-block mx-auto"
                                        style="max-width: 30%; text-align: center;">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Pendaftaran</h5>
                                    <p>No. RM: ${pendaftaranData.pasien.no_rm}</p>
                                    <p>No. Antrian: ${pendaftaranData.no_antrian}</p>
                                    <p>Tanggal Pendaftaran: ${pendaftaranData.tanggal_pendaftaran}</p>
                                    <p>Status: ${pendaftaranData.status}</p>
                                    <p>Diagnosa Dokter</p>
                                    <p>${pendaftaranData.diagnosa}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $('body').append(modalHtml);
                $('#modal-' + pendaftaranId).modal('show');
            });
        });
    </script>
@endsection
